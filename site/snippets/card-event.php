<?php
/**
 * Event Card Component
 * Renders an event as a card
 *
 * @var $event Kirby\Cms\Page
 */
?>

<article class="event-card">
  <!-- Date Badge -->
  <div class="event-card__date-badge">
    <time datetime="<?= $event->event_date('c') ?>">
      <span class="event-badge__day"><?= $event->event_date('d') ?></span>
      <span class="event-badge__month"><?= $event->event_date('M', 'event_date') ?></span>
    </time>
  </div>

  <?php if ($image = $event->cover_image()->toFile()): ?>
    <a href="<?= $event->url() ?>" class="event-card__image-link">
      <img
        src="<?= $image->thumb(['width' => 400, 'height' => 250])->url() ?>"
        alt="<?= $event->title() ?>"
        class="event-card__image"
      >
    </a>
  <?php endif; ?>

  <div class="event-card__content">
    <!-- Title -->
    <h3 class="event-card__title">
      <a href="<?= $event->url() ?>" class="event-card__link">
        <?= $event->title() ?>
      </a>
    </h3>

    <!-- Event Info -->
    <div class="event-card__info">
      <?php if ($event->event_time_start()->isNotEmpty()): ?>
        <p class="event-card__time">
          <span class="event-icon">🕐</span>
          <?= $event->event_time_start() ?>
          <?php if ($event->event_time_end()->isNotEmpty()): ?>
            – <?= $event->event_time_end() ?>
          <?php endif; ?>
        </p>
      <?php endif; ?>

      <p class="event-card__location">
        <span class="event-icon">📍</span>
        <?= $event->location() ?>
      </p>
    </div>

    <!-- Description excerpt -->
    <p class="event-card__excerpt">
      <?php
        $blocks = $event->text()->blocks();
        if ($blocks->count() > 0) {
          $firstBlock = $blocks->first();
          if (isset($firstBlock['content']['text'])) {
            echo excerpt($firstBlock['content']['text'], 100);
          }
        }
      ?>
    </p>

    <!-- Read More Link -->
    <a href="<?= $event->url() ?>" class="event-card__read-more">
      Voir détails →
    </a>
  </div>
</article>
