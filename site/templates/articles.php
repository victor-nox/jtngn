<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <header class="page-header">
      <h1><?= $page->title() ?></h1>
      <?php if ($page->intro_text()->isNotEmpty()): ?>
        <p class="page-header__subtitle"><?= $page->intro_text() ?></p>
      <?php endif; ?>
    </header>

    <!-- Articles Grid -->
    <div class="articles-grid mt-5">
      <?php foreach ($page->children()->listed()->sortBy('date', 'desc') as $article): ?>
        <?php snippet('card-article', ['article' => $article]) ?>
      <?php endforeach; ?>
    </div>

    <!-- Empty state -->
    <?php if ($page->children()->listed()->count() === 0): ?>
      <div class="empty-state">
        <p class="empty-state__text">Aucun article pour le moment.</p>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php snippet('footer') ?>
