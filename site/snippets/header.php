<!DOCTYPE html>
<html lang="<?= $site->lang() ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title><?= $page->metaTitle() ?? $page->title() . ' – ' . $site->title() ?></title>
  <meta name="description" content="<?= $page->metaDescription() ?? $site->description() ?>">
  <meta name="theme-color" content="#5B7F3B">

  <!-- Open Graph -->
  <meta property="og:title" content="<?= $page->title() ?>">
  <meta property="og:description" content="<?= $page->metaDescription() ?? $site->description() ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $page->url() ?>">
  <?php if ($image = $page->cover_image()->toFile() ?? $page->hero_image()->toFile()): ?>
    <meta property="og:image" content="<?= $image->url() ?>">
  <?php endif; ?>

  <!-- Canonical -->
  <link rel="canonical" href="<?= $page->url() ?>">

  <!-- Favicon -->
  <link rel="icon" href="<?= url('/assets/img/favicon.ico') ?>">
  <link rel="apple-touch-icon" href="<?= url('/assets/img/apple-touch-icon.png') ?>">

  <!-- Styles -->
  <link rel="stylesheet" href="<?= url('/assets/css/style.css') ?>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body class="<?= page('sitemap')?->isActive() ? 'is-page-' . $page->template() : '' ?>">
  <!-- Navigation -->
  <header role="banner" class="site-header">
    <div class="site-header__top">
      <div class="container">
        <div class="site-header__content">
          <!-- Logo/Title -->
          <a href="<?= $site->url() ?>" class="site-logo">
            <?php if ($logo = $site->logo()->toFile()): ?>
              <img src="<?= $logo->url() ?>" alt="<?= $site->title() ?>" class="site-logo__image">
            <?php endif; ?>
            <span class="site-logo__text"><?= $site->title() ?></span>
          </a>

          <!-- Mobile Menu Toggle -->
          <button type="button" class="nav-toggle" id="nav-toggle" aria-label="Toggle menu" aria-expanded="false">
            <span class="nav-toggle__line"></span>
            <span class="nav-toggle__line"></span>
            <span class="nav-toggle__line"></span>
          </button>

          <!-- Main Navigation -->
          <nav role="navigation" class="main-nav" id="main-nav">
            <ul class="main-nav__list">
              <?php foreach ($site->children()->listed() as $item): ?>
                <li class="main-nav__item">
                  <a
                    href="<?= $item->url() ?>"
                    class="main-nav__link <?= $item->isActive() ? 'is-active' : '' ?>"
                  >
                    <?= $item->title() ?>
                  </a>

                  <!-- Submenu if children exist -->
                  <?php if ($item->hasChildren()): ?>
                    <ul class="main-nav__submenu">
                      <?php foreach ($item->children()->listed() as $child): ?>
                        <li class="main-nav__subitem">
                          <a
                            href="<?= $child->url() ?>"
                            class="main-nav__sublink <?= $child->isActive() ? 'is-active' : '' ?>"
                          >
                            <?= $child->title() ?>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- Breadcrumb -->
    <?php if ($page->depth() > 1): ?>
      <div class="site-header__breadcrumb">
        <div class="container">
          <?php snippet('breadcrumb', ['page' => $page]) ?>
        </div>
      </div>
    <?php endif; ?>
  </header>

  <!-- Accessibility Skip Link -->
  <a href="#main" class="sr-only sr-only--focusable">Passer au contenu principal</a>
</body>
