<?php snippet('header') ?>

<main role="main" class="main">
  <div class="container">
    <article class="page-content">
      <header class="page-header">
        <h1><?= $page->title() ?></h1>
      </header>

      <div class="page-layout">
        <!-- Main content -->
        <div class="page-main">
          <?= $page->text()->blocks() ?>
        </div>

        <!-- Sidebar with facts -->
        <?php if ($page->sidebar_facts()->toStructure()->count() > 0): ?>
          <aside class="page-sidebar">
            <div class="facts-box">
              <h3 class="facts-box__title">Chiffres clés</h3>
              <dl class="facts-list">
                <?php foreach ($page->sidebar_facts()->toStructure() as $fact): ?>
                  <div class="fact-item">
                    <dt class="fact-item__label"><?= $fact->label() ?></dt>
                    <dd class="fact-item__value"><?= $fact->value() ?></dd>
                  </div>
                <?php endforeach; ?>
              </dl>
            </div>
          </aside>
        <?php endif; ?>
      </div>

      <!-- Gallery -->
      <?php if ($page->gallery()->count() > 0): ?>
        <section class="gallery-section mt-5">
          <h2 class="section-title">Galerie</h2>
          <div class="gallery">
            <?php foreach ($page->gallery() as $image): ?>
              <figure class="gallery__item">
                <a href="<?= $image->url() ?>" class="gallery__link" data-lightbox="commune">
                  <img
                    src="<?= $image->thumb(['width' => 400, 'height' => 300])->url() ?>"
                    alt="<?= $image->alt() ?? $page->title() ?>"
                    class="gallery__image"
                  >
                </a>
              </figure>
            <?php endforeach; ?>
          </div>
        </section>
      <?php endif; ?>
    </article>
  </div>
</main>

<?php snippet('footer') ?>
