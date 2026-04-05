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

          <!-- Contact -->
          <section class="school-contact mt-5">
            <h2 class="section-title">Nous contacter</h2>
            <?php if ($page->contact_email()->isNotEmpty() || $page->contact_phone()->isNotEmpty()): ?>
              <div class="contact-items">
                <?php if ($page->contact_email()->isNotEmpty()): ?>
                  <a href="mailto:<?= $page->contact_email() ?>" class="contact-link">
                    <span class="contact-icon"><?= icon('email') ?></span>
                    <?= $page->contact_email() ?>
                  </a>
                <?php endif; ?>

                <?php if ($page->contact_phone()->isNotEmpty()): ?>
                  <a href="tel:<?= str_replace(' ', '', $page->contact_phone()) ?>" class="contact-link">
                    <span class="contact-icon"><?= icon('phone') ?></span>
                    <?= $page->contact_phone() ?>
                  </a>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </section>

          <!-- Team -->
          <?php if ($page->team()->toStructure()->count() > 0): ?>
            <section class="team-section mt-5">
              <h2 class="section-title">Équipe pédagogique</h2>
              <div class="team-grid">
                <?php foreach ($page->team()->toStructure() as $member): ?>
                  <article class="team-card">
                    <?php if ($photo = $member->photo()->toFile()): ?>
                      <img
                        src="<?= $photo->thumb(['width' => 300, 'height' => 300])->url() ?>"
                        alt="<?= $member->name() ?>"
                        class="team-card__photo"
                      >
                    <?php endif; ?>
                    <h3 class="team-card__name"><?= $member->name() ?></h3>
                    <p class="team-card__role"><?= $member->role() ?></p>
                    <?php if ($member->class()->isNotEmpty()): ?>
                      <p class="team-card__class"><?= $member->class() ?></p>
                    <?php endif; ?>
                    <?php if ($member->bio()->isNotEmpty()): ?>
                      <p class="team-card__bio"><?= $member->bio() ?></p>
                    <?php endif; ?>
                  </article>
                <?php endforeach; ?>
              </div>
            </section>
          <?php endif; ?>

          <!-- Schedule -->
          <?php if ($page->schedule()->isNotEmpty()): ?>
            <section class="schedule-section mt-5">
              <h2 class="section-title">Horaires</h2>
              <div class="schedule-content">
                <?= nl2br($page->schedule()) ?>
              </div>
            </section>
          <?php endif; ?>

          <!-- Pedagogical Projects -->
          <?php if ($page->pedagogical_projects()->isNotEmpty()): ?>
            <section class="projects-section mt-5">
              <h2 class="section-title">Projets pédagogiques</h2>
              <div class="projects-content">
                <?= nl2br($page->pedagogical_projects()) ?>
              </div>
            </section>
          <?php endif; ?>

          <!-- Activities -->
          <?php if ($page->activities()->isNotEmpty()): ?>
            <section class="activities-section mt-5">
              <h2 class="section-title">Activités et ateliers</h2>
              <div class="activities-content">
                <?= nl2br($page->activities()) ?>
              </div>
            </section>
          <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <aside class="page-sidebar">
          <div class="sidebar-box">
            <h3 class="sidebar-box__title">Informations pratiques</h3>
            <div class="sidebar-box__content">
              <?php if ($page->contact_phone()->isNotEmpty()): ?>
                <div class="info-item">
                  <span class="info-label">Téléphone</span>
                  <a href="tel:<?= str_replace(' ', '', $page->contact_phone()) ?>" class="info-value">
                    <?= $page->contact_phone() ?>
                  </a>
                </div>
              <?php endif; ?>

              <?php if ($page->contact_email()->isNotEmpty()): ?>
                <div class="info-item">
                  <span class="info-label">Email</span>
                  <a href="mailto:<?= $page->contact_email() ?>" class="info-value">
                    <?= $page->contact_email() ?>
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
