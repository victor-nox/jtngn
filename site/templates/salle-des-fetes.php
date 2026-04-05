<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <article class="page-content">
      <header class="page-header">
        <h1><?= $page->title() ?></h1>
      </header>

      <div class="page-layout">
        <!-- Main content -->
        <div class="page-main">
          <!-- Description -->
          <section class="description-section">
            <?= $page->description()->blocks() ?>
          </section>

          <!-- Key Info -->
          <section class="info-grid mt-5">
            <?php if ($page->capacity()->isNotEmpty()): ?>
              <div class="info-item">
                <h3 class="info-item__title">Capacité</h3>
                <p class="info-item__value"><?= $page->capacity() ?> personnes</p>
              </div>
            <?php endif; ?>

            <?php if ($page->area()->isNotEmpty()): ?>
              <div class="info-item">
                <h3 class="info-item__title">Superficie</h3>
                <p class="info-item__value"><?= $page->area() ?> m²</p>
              </div>
            <?php endif; ?>
          </section>

          <!-- Equipment -->
          <?php if ($page->equipment()->toStructure()->count() > 0): ?>
            <section class="equipment-section mt-5">
              <h2 class="section-title">Équipements</h2>
              <ul class="equipment-list">
                <?php foreach ($page->equipment()->toStructure() as $item): ?>
                  <li class="equipment-item">
                    <h4 class="equipment-item__name"><?= $item->name() ?></h4>
                    <?php if ($item->description()->isNotEmpty()): ?>
                      <p class="equipment-item__description"><?= $item->description() ?></p>
                    <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </section>
          <?php endif; ?>

          <!-- Pricing -->
          <?php if ($page->tarifs()->toStructure()->count() > 0): ?>
            <section class="pricing-section mt-5">
              <h2 class="section-title">Tarifs</h2>
              <div class="pricing-table">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Type de location</th>
                      <th>Prix</th>
                      <th>Détails</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($page->tarifs()->toStructure() as $tarif): ?>
                      <tr>
                        <td><?= $tarif->type() ?></td>
                        <td class="pricing-cell"><?= $tarif->price() ?></td>
                        <td class="details-cell"><?= $tarif->details() ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </section>
          <?php endif; ?>

          <!-- Gallery -->
          <?php if ($page->gallery()->count() > 0): ?>
            <section class="gallery-section mt-5">
              <h2 class="section-title">Galerie photos</h2>
              <div class="gallery">
                <?php foreach ($page->gallery() as $image): ?>
                  <figure class="gallery__item">
                    <a href="<?= $image->url() ?>" class="gallery__link" data-lightbox="salle">
                      <img
                        src="<?= $image->thumb(['width' => 400, 'height' => 300])->url() ?>"
                        alt="<?= $image->alt() ?? $page->title() ?>"
                        class="gallery__image"
                      >
                    </a>
                  </figure>
                <?php endforeach; ?>
              </div>
            </section>
          <?php endif; ?>
        </div>

        <!-- Sidebar: Reservation Info -->
        <aside class="page-sidebar">
          <div class="sidebar-box booking-box">
            <h3 class="sidebar-box__title">Réservation</h3>
            <div class="sidebar-box__content">
              <?= $page->reservation_info()->kirbytext() ?>

              <?php if ($page->reservation_contact()->isNotEmpty()): ?>
                <div class="contact-item mt-3">
                  <span class="contact-label">Email</span>
                  <a href="mailto:<?= $page->reservation_contact() ?>" class="contact-value">
                    <?= $page->reservation_contact() ?>
                  </a>
                </div>
              <?php endif; ?>

              <?php if ($page->reservation_phone()->isNotEmpty()): ?>
                <div class="contact-item mt-3">
                  <span class="contact-label">Téléphone</span>
                  <a href="tel:<?= str_replace(' ', '', $page->reservation_phone()) ?>" class="contact-value">
                    <?= $page->reservation_phone() ?>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </aside>
      </div>
    </article>
  </div>
</main>

<?php snippet('footer') ?>
