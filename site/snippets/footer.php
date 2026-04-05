  <!-- Footer -->
  <footer role="contentinfo" class="site-footer">
    <div class="site-footer__main">
      <div class="container">
        <div class="footer-grid">
          <!-- About/Contact -->
          <div class="footer-section">
            <h3 class="footer-section__title">Jettingen</h3>
            <?php if ($site->address()->isNotEmpty()): ?>
              <p class="footer-contact">
                <strong>Adresse</strong><br>
                <?= nl2br($site->address()) ?>
              </p>
            <?php endif; ?>

            <?php if ($site->phone()->isNotEmpty()): ?>
              <p class="footer-contact">
                <strong>Téléphone</strong><br>
                <a href="tel:<?= str_replace(' ', '', $site->phone()) ?>">
                  <?= $site->phone() ?>
                </a>
              </p>
            <?php endif; ?>

            <?php if ($site->email()->isNotEmpty()): ?>
              <p class="footer-contact">
                <strong>Email</strong><br>
                <a href="mailto:<?= $site->email() ?>">
                  <?= $site->email() ?>
                </a>
              </p>
            <?php endif; ?>

            <?php if ($site->opening_hours()->isNotEmpty()): ?>
              <p class="footer-contact">
                <strong>Horaires</strong><br>
                <?= nl2br($site->opening_hours()) ?>
              </p>
            <?php endif; ?>
          </div>

          <!-- Quick Links -->
          <div class="footer-section">
            <h3 class="footer-section__title">Navigation</h3>
            <ul class="footer-menu">
              <?php foreach ($site->children()->listed() as $item): ?>
                <li class="footer-menu__item">
                  <a href="<?= $item->url() ?>" class="footer-menu__link">
                    <?= $item->title() ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <!-- Social Media -->
          <?php if ($site->social_media()->toStructure()->count() > 0): ?>
            <div class="footer-section">
              <h3 class="footer-section__title">Suivez-nous</h3>
              <div class="social-links">
                <?php foreach ($site->social_media()->toStructure() as $social): ?>
                  <a
                    href="<?= $social->url() ?>"
                    class="social-link"
                    rel="noopener"
                    target="_blank"
                    title="<?= $social->platform() ?>"
                  >
                    <span class="social-link__icon">
                      <?php
                        $platform = $social->platform();
                        echo match($platform) {
                          'facebook' => '󰈌',
                          'twitter' => '󰕄',
                          'instagram' => '󰋜',
                          'linkedin' => '󰌻',
                          'youtube' => '󰗃',
                          default => '🔗'
                        };
                      ?>
                    </span>
                    <span class="social-link__text"><?= ucfirst($social->platform()) ?></span>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="site-footer__bottom">
      <div class="container">
        <div class="footer-bottom">
          <!-- Copyright -->
          <p class="footer-copyright">
            <?php if ($site->footer_text()->isNotEmpty()): ?>
              <?= $site->footer_text() ?>
            <?php else: ?>
              &copy; <?= date('Y') ?> <?= $site->title() ?>. Tous droits réservés.
            <?php endif; ?>
          </p>

          <!-- Legal Links -->
          <ul class="footer-legal">
            <li>
              <a href="#mentions-legales" class="footer-legal__link">Mentions légales</a>
            </li>
            <li>
              <a href="#confidentialite" class="footer-legal__link">Politique de confidentialité</a>
            </li>
            <li>
              <a href="#accessibilite" class="footer-legal__link">Accessibilité</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="<?= url('/assets/js/main.js') ?>" defer></script>
</body>
</html>
