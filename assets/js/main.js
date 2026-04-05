/**
 * Jettingen.fr - Main JavaScript
 * Mobile navigation, smooth scroll, animations, and form helpers
 */

(function () {
  'use strict';

  // ========================================
  // MOBILE NAVIGATION TOGGLE
  // ========================================

  const navToggle = document.getElementById('nav-toggle');
  const mainNav = document.getElementById('main-nav');

  if (navToggle && mainNav) {
    navToggle.addEventListener('click', function () {
      const isOpen = mainNav.classList.contains('is-open');
      mainNav.classList.toggle('is-open');
      navToggle.setAttribute('aria-expanded', !isOpen);
    });

    // Close menu when link is clicked
    const navLinks = mainNav.querySelectorAll('.main-nav__link');
    navLinks.forEach((link) => {
      link.addEventListener('click', function () {
        mainNav.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function (event) {
      if (!navToggle.contains(event.target) && !mainNav.contains(event.target)) {
        mainNav.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // ========================================
  // SMOOTH SCROLL
  // ========================================

  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (href === '#') return;

      const target = document.querySelector(href);
      if (!target) return;

      e.preventDefault();

      const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
      const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth',
      });
    });
  });

  // ========================================
  // INTERSECTION OBSERVER FOR ANIMATIONS
  // ========================================

  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px',
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe cards and sections
  document.querySelectorAll('.article-card, .event-card, .quick-link-card, .team-card').forEach((el) => {
    el.classList.add('fade-in');
    observer.observe(el);
  });

  // ========================================
  // FORM VALIDATION
  // ========================================

  const contactForm = document.querySelector('.contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      const honeypot = this.querySelector('input[name="website"]');

      // Check honeypot (anti-spam)
      if (honeypot && honeypot.value.trim() !== '') {
        e.preventDefault();
        return false;
      }

      // Basic validation
      const requiredFields = this.querySelectorAll('[required]');
      let isValid = true;

      requiredFields.forEach((field) => {
        if (!field.value.trim()) {
          field.classList.add('is-invalid');
          isValid = false;
        } else {
          field.classList.remove('is-invalid');
        }
      });

      if (!isValid) {
        e.preventDefault();
        console.warn('Form has empty required fields');
      }
    });

    // Remove error state on focus
    contactForm.querySelectorAll('input, textarea').forEach((field) => {
      field.addEventListener('focus', function () {
        this.classList.remove('is-invalid');
      });
    });
  }

  // ========================================
  // TABLE OF CONTENTS (for long articles)
  // ========================================

  function generateTableOfContents() {
    const articleContent = document.querySelector('.article-content, .event-content');
    if (!articleContent) return;

    const headings = articleContent.querySelectorAll('h2, h3');
    if (headings.length < 3) return; // Only create TOC if 3+ headings

    const toc = document.createElement('nav');
    toc.className = 'table-of-contents';
    toc.innerHTML = '<h3>Sommaire</h3>';

    const list = document.createElement('ul');

    headings.forEach((heading, index) => {
      if (!heading.id) {
        heading.id = `heading-${index}`;
      }

      const level = parseInt(heading.tagName[1]);
      const item = document.createElement('li');
      item.className = `toc-level-${level}`;

      const link = document.createElement('a');
      link.href = `#${heading.id}`;
      link.textContent = heading.textContent;

      item.appendChild(link);
      list.appendChild(item);
    });

    toc.appendChild(list);

    // Insert before article content
    const articleHeader = document.querySelector('.article-header, .event-header');
    if (articleHeader) {
      articleHeader.parentNode.insertBefore(toc, articleHeader.nextSibling);
    }
  }

  generateTableOfContents();

  // ========================================
  // LAZY LOADING IMAGES
  // ========================================

  if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
            img.classList.add('is-loaded');
          }
          imageObserver.unobserve(img);
        }
      });
    });

    document.querySelectorAll('img[data-src]').forEach((img) => {
      imageObserver.observe(img);
    });
  }

  // ========================================
  // BACK TO TOP BUTTON
  // ========================================

  const createBackToTop = () => {
    const button = document.createElement('button');
    button.className = 'back-to-top';
    button.setAttribute('aria-label', 'Back to top');
    button.innerHTML = '↑';
    document.body.appendChild(button);

    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        button.classList.add('is-visible');
      } else {
        button.classList.remove('is-visible');
      }
    });

    button.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  };

  createBackToTop();

  // ========================================
  // COOKIE NOTICE (Optional)
  // ========================================

  function initCookieNotice() {
    const cookieNotice = document.querySelector('.cookie-notice');
    if (!cookieNotice) return;

    const acceptBtn = cookieNotice.querySelector('[data-accept-cookies]');
    if (!acceptBtn) return;

    // Check if cookies already accepted
    if (localStorage.getItem('cookies-accepted') === 'true') {
      cookieNotice.style.display = 'none';
      return;
    }

    acceptBtn.addEventListener('click', () => {
      localStorage.setItem('cookies-accepted', 'true');
      cookieNotice.style.display = 'none';
    });
  }

  initCookieNotice();

  // ========================================
  // LINK EXTERNAL INDICATORS
  // ========================================

  document.querySelectorAll('a[href^="http"], a[href^="//"]').forEach((link) => {
    if (!link.hostname || link.hostname === window.location.hostname) return;
    link.setAttribute('rel', 'noopener noreferrer');
    link.setAttribute('target', '_blank');
    link.classList.add('is-external');
  });

  // ========================================
  // UTILITY: EXCERPT HELPER
  // ========================================

  window.excerpt = function (text, length) {
    if (!text) return '';
    const stripped = text.replace(/<[^>]*>/g, '');
    if (stripped.length <= length) return stripped;
    return stripped.substring(0, length).trim() + '…';
  };

  // ========================================
  // UTILITY: ICON RENDERER
  // ========================================

  window.icon = function (name) {
    const icons = {
      document: '📄',
      calendar: '📅',
      users: '👥',
      home: '🏠',
      info: 'ℹ️',
      phone: '☎️',
      email: '✉️',
      location: '📍',
      clock: '🕐',
    };
    return icons[name] || '🔗';
  };

  console.log('Jettingen.fr scripts loaded successfully');
})();
