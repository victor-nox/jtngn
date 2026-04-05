<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <article class="event-single">
      <!-- Event Header -->
      <header class="event-header">
        <?php if ($image = $page->cover_image()->toFile()): ?>
          <img
            src="<?= $image->thumb(['width' => 1200, 'height' => 400])->url() ?>"
            alt="<?= $page->title() ?>"
            class="event-header__image"
          >
        <?php endif; ?>

        <div class="event-header__content">
          <h1 class="event-header__title"><?= $page->title() ?></h1>

          <div class="event-info">
            <div class="event-info__date">
              <span class="event-icon"><?= icon('calendar') ?></span>
              <time datetime="<?= $page->event_date('c') ?>">
                <?= $page->event_date('d F Y', 'event_date') ?>
              </time>
            </div>

            <?php if ($page->event_time_start()->isNotEmpty()): ?>
              <div class="event-info__time">
                <span class="event-icon"><?= icon('clock') ?></span>
                <span class="event-time">
                  <?= $page->event_time_start() ?>
                  <?php if ($page->event_time_end()->isNotEmpty()): ?>
                    – <?= $page->event_time_end() ?>
                  <?php endif; ?>
                </span>
              </div>
            <?php endif; ?>

            <div class="event-info__location">
              <span class="event-icon"><?= icon('location') ?></span>
              <span><?= $page->location() ?></span>
            </div>
          </div>
        </div>
      </header>

      <!-- Event Content -->
      <div class="event-content">
        <?= $page->text()->blocks() ?>
      </div>

      <!-- Registration -->
      <?php if ($page->registration_link()->isNotEmpty()): ?>
        <div class="event-registration mt-5">
          <a href="<?= $page->registration_link() ?>" class="btn btn--primary" target="_blank" rel="noopener">
            S'inscrire
          </a>
        </div>
      <?php endif; ?>

      <!-- Navigation -->
      <?php
        $eventsPage = page('events');
        $events = $eventsPage?->children()->listed()->sortBy('event_date', 'asc');
        $current = $events?->findBy('id', $page->id());
        $position = $events?->indexOf($current);
      ?>

      <?php if ($events && $events->count() > 1): ?>
        <nav class="event-nav mt-5">
          <div class="event-nav__prev">
            <?php if ($position > 0): ?>
              <?php $prev = $events->nth($position - 1); ?>
              <a href="<?= $prev->url() ?>" class="event-nav__link">
                <span class="event-nav__label">Événement précédent</span>
                <span class="event-nav__title"><?= $prev->title() ?></span>
              </a>
            <?php endif; ?>
          </div>

          <div class="event-nav__up">
            <a href="<?= $eventsPage->url() ?>" class="event-nav__link">
              Retour aux événements
            </a>
          </div>

          <div class="event-nav__next">
            <?php if ($position < $events->count() - 1): ?>
              <?php $next = $events->nth($position + 1); ?>
              <a href="<?= $next->url() ?>" class="event-nav__link">
                <span class="event-nav__label">Événement suivant</span>
                <span class="event-nav__title"><?= $next->title() ?></span>
              </a>
            <?php endif; ?>
          </div>
        </nav>
      <?php endif; ?>
    </article>
  </div>
</main>

<?php snippet('footer') ?>
