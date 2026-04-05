<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <header class="page-header">
      <h1><?= $page->title() ?></h1>
      <?php if ($page->intro_text()->isNotEmpty()): ?>
        <p class="page-header__subtitle"><?= $page->intro_text() ?></p>
      <?php endif; ?>
    </header>

    <!-- Events Grid -->
    <div class="events-grid mt-5">
      <?php
        $upcomingEvents = $page->children()
          ->listed()
          ->sortBy('event_date', 'asc')
          ->filterBy('event_date', '>=', date('c'));
      ?>

      <?php foreach ($upcomingEvents as $event): ?>
        <?php snippet('card-event', ['event' => $event]) ?>
      <?php endforeach; ?>

      <!-- Past events -->
      <?php
        $pastEvents = $page->children()
          ->listed()
          ->sortBy('event_date', 'desc')
          ->filterBy('event_date', '<', date('c'));
      ?>

      <?php if ($pastEvents->count() > 0): ?>
        <h3 class="section-subtitle mt-5">Événements passés</h3>
        <?php foreach ($pastEvents as $event): ?>
          <?php snippet('card-event', ['event' => $event]) ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Empty state -->
    <?php if ($page->children()->listed()->count() === 0): ?>
      <div class="empty-state">
        <p class="empty-state__text">Aucun événement pour le moment.</p>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php snippet('footer') ?>
