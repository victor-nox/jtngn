<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <header class="page-header">
      <h1><?= $page->title() ?></h1>
    </header>

    <div class="contact-layout">
      <!-- Contact Form -->
      <div class="contact-form-section">
        <h2 class="section-title">Nous contacter</h2>

        <?php if ($page->intro_text()->isNotEmpty()): ?>
          <p class="intro-text"><?= $page->intro_text() ?></p>
        <?php endif; ?>

        <!-- Kirby Uniform Form Example -->
        <form action="<?= $page->url() ?>" method="POST" class="contact-form">
          <div class="form-group">
            <label for="name" class="form-label">Nom *</label>
            <input
              type="text"
              id="name"
              name="name"
              class="form-input"
              required
            >
          </div>

          <div class="form-group">
            <label for="email" class="form-label">Email *</label>
            <input
              type="email"
              id="email"
              name="email"
              class="form-input"
              required
            >
          </div>

          <div class="form-group">
            <label for="phone" class="form-label">Téléphone</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              class="form-input"
            >
          </div>

          <div class="form-group">
            <label for="subject" class="form-label">Sujet *</label>
            <input
              type="text"
              id="subject"
              name="subject"
              class="form-input"
              required
            >
          </div>

          <div class="form-group">
            <label for="message" class="form-label">Message *</label>
            <textarea
              id="message"
              name="message"
              class="form-textarea"
              rows="6"
              required
            ></textarea>
          </div>

          <!-- Honeypot field (hidden) -->
          <div class="form-group hidden" aria-hidden="true">
            <label for="website">Site web</label>
            <input type="text" id="website" name="website">
          </div>

          <button type="submit" class="btn btn--primary">
            Envoyer
          </button>
        </form>

        <?php if ($page->contact_form_note()->isNotEmpty()): ?>
          <p class="form-note text-muted mt-3"><?= $page->contact_form_note() ?></p>
        <?php endif; ?>
      </div>

      <!-- Contact Information Sidebar -->
      <aside class="contact-info-section">
        <div class="contact-info">
          <h3 class="contact-info__title">Coordonnées</h3>

          <?php if ($page->contact_phone()->isNotEmpty()): ?>
            <div class="contact-info__item">
              <span class="contact-info__label">Téléphone</span>
              <a href="tel:<?= str_replace(' ', '', $page->contact_phone()) ?>" class="contact-info__value">
                <?= $page->contact_phone() ?>
              </a>
            </div>
          <?php endif; ?>

          <?php if ($page->contact_email()->isNotEmpty()): ?>
            <div class="contact-info__item">
              <span class="contact-info__label">Email</span>
              <a href="mailto:<?= $page->contact_email() ?>" class="contact-info__value">
                <?= $page->contact_email() ?>
              </a>
            </div>
          <?php endif; ?>

          <?php if ($page->contact_address()->isNotEmpty()): ?>
            <div class="contact-info__item">
              <span class="contact-info__label">Adresse</span>
              <p class="contact-info__value">
                <?= nl2br($page->contact_address()) ?>
              </p>
            </div>
          <?php endif; ?>

          <?php if ($page->opening_hours()->isNotEmpty()): ?>
            <div class="contact-info__item">
              <span class="contact-info__label">Horaires</span>
              <p class="contact-info__value">
                <?= nl2br($page->opening_hours()) ?>
              </p>
            </div>
          <?php endif; ?>
        </div>
      </aside>
    </div>

    <!-- Map -->
    <?php if ($page->map_embed()->isNotEmpty()): ?>
      <section class="map-section mt-5">
        <h2 class="section-title">Localisation</h2>
        <div class="map-container">
          <?= $page->map_embed()->unescapeHtml() ?>
        </div>
      </section>
    <?php endif; ?>
  </div>
</main>

<?php snippet('footer') ?>
