<?php
/**
 * Breadcrumb Component
 * Displays the current page hierarchy
 *
 * @var $page Kirby\Cms\Page
 */
?>

<nav class="breadcrumb" aria-label="Chemin de navigation">
  <ol class="breadcrumb__list">
    <!-- Home -->
    <li class="breadcrumb__item">
      <a href="<?= $site->url() ?>" class="breadcrumb__link">
        Accueil
      </a>
    </li>

    <!-- Parent pages -->
    <?php foreach ($page->parents()->flip() as $parent): ?>
      <?php if ($parent->depth() > 0): ?>
        <li class="breadcrumb__item">
          <a href="<?= $parent->url() ?>" class="breadcrumb__link">
            <?= $parent->title() ?>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>

    <!-- Current page -->
    <li class="breadcrumb__item" aria-current="page">
      <span class="breadcrumb__current"><?= $page->title() ?></span>
    </li>
  </ol>
</nav>
