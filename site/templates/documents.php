<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <header class="page-header">
      <h1><?= $page->title() ?></h1>
      <?php if ($page->intro_text()->isNotEmpty()): ?>
        <p class="page-header__subtitle"><?= $page->intro_text() ?></p>
      <?php endif; ?>
    </header>

    <!-- Documents by Category -->
    <?php
      $documents = $page->documents()->toStructure();
      $categories = $documents->pluck('category', null, true);
    ?>

    <?php foreach ($categories as $category => $docs): ?>
      <section class="documents-section mt-5">
        <h2 class="section-title"><?= ucfirst($category) ?></h2>

        <ul class="document-list">
          <?php foreach ($docs as $doc): ?>
            <?php $file = $doc->file()->toFile(); ?>
            <?php if ($file): ?>
              <li class="document-item">
                <a href="<?= $file->url() ?>" class="document-link" download>
                  <span class="document-icon"><?= icon('document') ?></span>
                  <div class="document-details">
                    <span class="document-title"><?= $doc->title() ?></span>
                    <?php if ($doc->description()->isNotEmpty()): ?>
                      <p class="document-description"><?= $doc->description() ?></p>
                    <?php endif; ?>
                  </div>
                  <span class="document-size"><?= $file->niceSize() ?></span>
                </a>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endforeach; ?>

    <!-- Empty state -->
    <?php if ($documents->count() === 0): ?>
      <div class="empty-state">
        <p class="empty-state__text">Aucun document disponible pour le moment.</p>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php snippet('footer') ?>
