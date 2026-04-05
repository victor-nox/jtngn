<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <article class="article-single">
      <!-- Article Header -->
      <header class="article-header">
        <?php if ($image = $page->cover_image()->toFile()): ?>
          <img
            src="<?= $image->thumb(['width' => 1200, 'height' => 400])->url() ?>"
            alt="<?= $page->title() ?>"
            class="article-header__image"
          >
        <?php endif; ?>

        <div class="article-header__content">
          <h1 class="article-header__title"><?= $page->title() ?></h1>

          <div class="article-meta">
            <time datetime="<?= $page->date('c') ?>" class="article-meta__date">
              <?= $page->date('d F Y', 'date') ?>
            </time>

            <?php if ($page->author()->isNotEmpty()): ?>
              <span class="article-meta__author">Par <?= $page->author() ?></span>
            <?php endif; ?>

            <?php if ($page->category()->isNotEmpty()): ?>
              <span class="article-meta__category">
                <?= $page->category()->label() ?? $page->category() ?>
              </span>
            <?php endif; ?>
          </div>
        </div>
      </header>

      <!-- Article Content -->
      <div class="article-content">
        <?= $page->text()->blocks() ?>
      </div>

      <!-- Related Documents -->
      <?php if ($page->related_documents()->count() > 0): ?>
        <section class="related-documents mt-5">
          <h2 class="section-title">Documents à télécharger</h2>
          <ul class="document-list">
            <?php foreach ($page->related_documents() as $file): ?>
              <li class="document-item">
                <a href="<?= $file->url() ?>" class="document-link" download>
                  <span class="document-icon"><?= icon('document') ?></span>
                  <span class="document-name"><?= $file->filename() ?></span>
                  <span class="document-size">(<?= $file->niceSize() ?>)</span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </section>
      <?php endif; ?>

      <!-- Navigation -->
      <?php
        $articlesPage = page('articles');
        $articles = $articlesPage?->children()->listed()->sortBy('date', 'desc');
        $current = $articles?->findBy('id', $page->id());
        $position = $articles?->indexOf($current);
      ?>

      <?php if ($articles && $articles->count() > 1): ?>
        <nav class="article-nav mt-5">
          <div class="article-nav__prev">
            <?php if ($position > 0): ?>
              <?php $prev = $articles->nth($position + 1); ?>
              <a href="<?= $prev->url() ?>" class="article-nav__link">
                <span class="article-nav__label">Article précédent</span>
                <span class="article-nav__title"><?= $prev->title() ?></span>
              </a>
            <?php endif; ?>
          </div>

          <div class="article-nav__up">
            <a href="<?= $articlesPage->url() ?>" class="article-nav__link">
              Retour aux articles
            </a>
          </div>

          <div class="article-nav__next">
            <?php if ($position < $articles->count() - 1): ?>
              <?php $next = $articles->nth($position - 1); ?>
              <a href="<?= $next->url() ?>" class="article-nav__link">
                <span class="article-nav__label">Article suivant</span>
                <span class="article-nav__title"><?= $next->title() ?></span>
              </a>
            <?php endif; ?>
          </div>
        </nav>
      <?php endif; ?>
    </article>
  </div>
</main>

<?php snippet('footer') ?>
