<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <article class="page-content">
      <header class="page-header">
        <h1><?= $page->title() ?></h1>
      </header>

      <div class="<?= $page->show_sidebar()->toBool() ? 'page-layout' : 'page-single' ?>">
        <!-- Main content -->
        <div class="page-main">
          <?= $page->text()->blocks() ?>
        </div>

        <!-- Sidebar (optional) -->
        <?php if ($page->show_sidebar()->toBool() && $page->sidebar_text()->isNotEmpty()): ?>
          <aside class="page-sidebar">
            <div class="sidebar-box">
              <?php if ($page->sidebar_title()->isNotEmpty()): ?>
                <h3 class="sidebar-box__title"><?= $page->sidebar_title() ?></h3>
              <?php endif; ?>
              <div class="sidebar-box__content">
                <?= $page->sidebar_text()->kirbytext() ?>
              </div>
            </div>
          </aside>
        <?php endif; ?>
      </div>
    </article>
  </div>
</main>

<?php snippet('footer') ?>
