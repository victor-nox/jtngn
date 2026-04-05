<?php
/**
 * Article Card Component
 * Renders a news article as a card
 *
 * @var $article Kirby\Cms\Page
 */
?>

<article class="article-card">
  <?php if ($image = $article->cover_image()->toFile()): ?>
    <a href="<?= $article->url() ?>" class="article-card__image-link">
      <img
        src="<?= $image->thumb(['width' => 400, 'height' => 250])->url() ?>"
        alt="<?= $article->title() ?>"
        class="article-card__image"
      >
    </a>
  <?php endif; ?>

  <div class="article-card__content">
    <!-- Meta -->
    <div class="article-card__meta">
      <time datetime="<?= $article->date('c') ?>" class="article-card__date">
        <?= $article->date('d F Y', 'date') ?>
      </time>

      <?php if ($article->category()->isNotEmpty()): ?>
        <span class="article-card__category">
          <?= $article->category()->label() ?? $article->category() ?>
        </span>
      <?php endif; ?>
    </div>

    <!-- Title -->
    <h3 class="article-card__title">
      <a href="<?= $article->url() ?>" class="article-card__link">
        <?= $article->title() ?>
      </a>
    </h3>

    <!-- Author -->
    <?php if ($article->author()->isNotEmpty()): ?>
      <p class="article-card__author">Par <?= $article->author() ?></p>
    <?php endif; ?>

    <!-- Excerpt -->
    <p class="article-card__excerpt">
      <?php
        // Get first block text as excerpt
        $blocks = $article->text()->blocks();
        if ($blocks->count() > 0) {
          $firstBlock = $blocks->first();
          if (isset($firstBlock['content']['text'])) {
            echo excerpt($firstBlock['content']['text'], 150);
          }
        }
      ?>
    </p>

    <!-- Read More Link -->
    <a href="<?= $article->url() ?>" class="article-card__read-more">
      Lire la suite →
    </a>
  </div>
</article>
