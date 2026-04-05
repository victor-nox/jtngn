<?php snippet('header') ?>

<main role="main" class="main">
  <!-- Hero Section -->
  <section class="hero" id="hero-section">
    <?php if ($image = $page->hero_image()->toFile()): ?>
      <img
        src="<?= $image->thumb(['width' => 1920, 'height' => 600])->url() ?>"
        alt="<?= $page->hero_title() ?>"
        class="hero__image"
      >
    <?php endif; ?>

    <div class="hero__content">
      <h1 class="hero__title"><?= $page->hero_title() ?></h1>
      <p class="hero__subtitle"><?= $page->hero_subtitle() ?></p>

      <?php if ($page->hero_cta_text()->isNotEmpty() && $page->hero_cta_link()->isNotEmpty()): ?>
        <a href="<?= $page->hero_cta_link()->toPage()?->url() ?? '#' ?>" class="btn btn--primary">
          <?= $page->hero_cta_text() ?>
        </a>
      <?php endif; ?>
    </div>
  </section>

  <!-- Quick Links / Accès rapide -->
  <?php if ($page->quick_links()->toStructure()->count() > 0): ?>
    <section class="quick-links" id="quick-access">
      <div class="container">
        <h2 class="section-title">Accès rapide</h2>
        <div class="quick-links__grid">
          <?php foreach ($page->quick_links()->toStructure() as $link): ?>
            <a href="<?= $link->url() ?>" class="quick-link-card">
              <div class="quick-link-card__icon">
                <?= icon($link->icon()) ?>
              </div>
              <h3 class="quick-link-card__title"><?= $link->title() ?></h3>
              <?php if ($link->description()->isNotEmpty()): ?>
                <p class="quick-link-card__description"><?= $link->description() ?></p>
              <?php endif; ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- News Section -->
  <section class="news-section" id="news">
    <div class="container">
      <h2 class="section-title"><?= $page->news_title() ?? 'Dernières actualités' ?></h2>

      <div class="articles-grid">
        <?php
          $articlesPage = page('articles');
          $articles = $articlesPage?->children()->listed()->sortBy('date', 'desc')->limit($page->news_limit() ?? 3);
        ?>

        <?php if ($articles && $articles->count() > 0): ?>
          <?php foreach ($articles as $article): ?>
            <?php snippet('card-article', ['article' => $article]) ?>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-muted">Aucun article pour le moment.</p>
        <?php endif; ?>
      </div>

      <?php if ($articlesPage): ?>
        <div class="text-center mt-4">
          <a href="<?= $articlesPage->url() ?>" class="btn btn--secondary">
            Voir toutes les actualités
          </a>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Info Section -->
  <?php if ($page->info_text()->isNotEmpty()): ?>
    <section class="info-section bg-light">
      <div class="container">
        <h2 class="section-title"><?= $page->info_title() ?></h2>
        <div class="info-content">
          <?= $page->info_text()->kirbytext() ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>

<?php snippet('footer') ?>
