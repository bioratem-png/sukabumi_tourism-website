<?php
$pageTitle = 'Culinary - Sukabumi Regency';
$current = 'culinary';

$dishes = [
    [
        'id' => 'mochi',
        'image' => 'mochi.jpg.jpeg',
        'name' => 'Mochi Sukabumi',
        'category' => 'snack',
        'label' => 'Snack',
        'description' => 'Soft, chewy rice-flour sweets with a range of fillings. A classic gift to bring home from Sukabumi.',
        'goodFor' => 'Gifts and tea-time snacks',
        'searchTerms' => 'mochi rice cake rice-flour sweet souvenir gift',
    ],
    [
        'id' => 'grilled-fish',
        'image' => 'grilled-fish.jpg',
        'name' => 'Grilled fresh fish',
        'category' => 'seafood',
        'label' => 'Seafood',
        'description' => 'Fish from the Palabuhanratu fishing port, grilled and served with rice, sambal and fresh vegetables.',
        'goodFor' => 'Lunch by the coast',
        'searchTerms' => 'ikan bakar fish seafood grilled grilled fish coastal',
    ],
    [
        'id' => 'pepes-ikan',
        'image' => 'pepes-ikan.jpg',
        'name' => 'Pepes ikan',
        'category' => 'main',
        'label' => 'Main dish',
        'description' => 'Fish seasoned with herbs and spices, wrapped in banana leaf and steamed or grilled. A Sundanese favourite.',
        'goodFor' => 'Family meals',
        'searchTerms' => 'fish ikan banana leaf steamed wrapped sundanese',
    ],
    [
        'id' => 'nasi-liwet',
        'image' => 'nasi-liwet.jpg',
        'name' => 'Nasi liwet',
        'category' => 'main',
        'label' => 'Main dish',
        'description' => 'Rice cooked with coconut milk and spices, usually shared with side dishes. A common dish at Sundanese gatherings.',
        'goodFor' => 'Group meals',
        'searchTerms' => 'rice nasi coconut milk group family sundanese',
    ],
    [
        'id' => 'surabi',
        'image' => 'surabi.jpg',
        'name' => 'Surabi',
        'category' => 'snack',
        'label' => 'Snack',
        'description' => 'A small, soft rice-flour pancake cooked in clay moulds, served with coconut milk sauce or savoury toppings.',
        'goodFor' => 'Breakfast and snacks',
        'searchTerms' => 'serabi pancake rice flour breakfast coconut snack',
    ],
    [
        'id' => 'lalapan',
        'image' => 'lalapan.jpg',
        'name' => 'Lalapan and sambal',
        'category' => 'main',
        'label' => 'Main dish',
        'description' => 'Fresh raw vegetables served with spicy sambal, a standard side dish with Sundanese meals.',
        'goodFor' => 'Light, fresh sides',
        'searchTerms' => 'lalab vegetables salad sambal chili raw fresh side',
    ],
];

function culinary_food_placeholder() {
    echo '<svg viewBox="0 0 320 160" preserveAspectRatio="xMidYMid slice" aria-hidden="true">'
       . '<rect width="320" height="160" fill="#f1e4c8"/>'
       . '<path d="M90 82h140c0 38-31 62-70 62s-70-24-70-62Z" fill="#c48b2c"/>'
       . '<rect x="82" y="76" width="156" height="10" rx="5" fill="#a87420"/>'
       . '<path d="M130 62q-8-12 0-22t0-20M160 62q-8-12 0-22t0-20M190 62q-8-12 0-22t0-20" fill="none" stroke="#b9a37a" stroke-width="3" stroke-linecap="round"/>'
       . '</svg>';
}

include 'includes/header.php';
?>

  <main id="main">
    <section class="hero hero--compact hero--culinary">
      <div class="wrap">
        <div class="hero-body">
          <h1>Culinary</h1>
          <p>Sweet snacks, fresh seafood and Sundanese home cooking. Here are some dishes to look for in Sukabumi.</p>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="wrap">
        <div class="section-head">
          <h2>Dishes to try</h2>
          <p>Browse local favourites, then open a dish to explore its photo gallery and learn what to look for.</p>
        </div>

        <div class="culinary-toolbar">
          <div class="field culinary-search">
            <label for="dish-search">Find a dish</label>
            <div class="dish-search-control">
              <span class="dish-search-icon" aria-hidden="true"></span>
              <input id="dish-search" type="search" placeholder="Search by dish, ingredient, or taste" autocomplete="off" aria-describedby="dish-search-help">
              <button id="dish-search-clear" class="dish-search-clear" type="button" aria-label="Clear dish search" hidden>&times;</button>
            </div>
            <small id="dish-search-help">Try “rice”, “fish”, or “snack”.</small>
          </div>
          <div class="chips" role="group" aria-label="Filter dishes by type">
            <button class="chip" type="button" data-dish-category="all" aria-pressed="true">All dishes</button>
            <button class="chip" type="button" data-dish-category="snack" aria-pressed="false">Snacks</button>
            <button class="chip" type="button" data-dish-category="seafood" aria-pressed="false">Seafood</button>
            <button class="chip" type="button" data-dish-category="main" aria-pressed="false">Main dishes</button>
          </div>
        </div>
        <div class="dish-results-summary">
          <p class="result-count" id="dish-result-count" role="status" aria-live="polite" aria-atomic="true"></p>
          <button class="dish-reset" id="dish-reset" type="button" hidden>Clear filters</button>
        </div>

        <div class="grid" id="dish-list">
          <?php foreach ($dishes as $dish): ?>
            <article class="card culinary-card"
                     data-dish-category="<?= htmlspecialchars($dish['category'], ENT_QUOTES, 'UTF-8') ?>"
                     data-dish-search="<?= htmlspecialchars($dish['name'] . ' ' . $dish['label'] . ' ' . $dish['description'] . ' ' . $dish['goodFor'] . ' ' . $dish['searchTerms'], ENT_QUOTES, 'UTF-8') ?>">
              <div class="card-scene card-scene--layered">
                <?php culinary_food_placeholder(); ?>
                <img src="images/<?= htmlspecialchars($dish['image'], ENT_QUOTES, 'UTF-8') ?>"
                     alt="<?= htmlspecialchars($dish['name']) ?>"
                     loading="lazy"
                     onerror="this.remove()">
              </div>
              <div class="card-body">
                <div class="card-meta">
                  <span class="tag tag--<?= htmlspecialchars($dish['category']) ?>"><?= htmlspecialchars($dish['label']) ?></span>
                </div>
                <h3><?= htmlspecialchars($dish['name']) ?></h3>
                <p><?= htmlspecialchars($dish['description']) ?></p>
                <div class="card-meta">Good for: <?= htmlspecialchars($dish['goodFor']) ?></div>
                <button class="card-link" type="button" data-dish-id="<?= htmlspecialchars($dish['id'], ENT_QUOTES, 'UTF-8') ?>">
                  View photos and dish info
                </button>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
        <div class="dish-empty-state" id="dish-empty-state" hidden>
          <span class="dish-empty-mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" focusable="false"><circle cx="10.8" cy="10.8" r="6.8"></circle><path d="m16 16 4.5 4.5"></path></svg>
          </span>
          <h3>No dishes found</h3>
          <p>Try a different spelling or search for an ingredient, dish type, or meal.</p>
          <button class="btn" type="button" id="dish-empty-reset">Show all dishes</button>
        </div>
      </div>
    </section>

    <section class="culinary-note section section--white" aria-labelledby="culinary-note-title">
      <div class="wrap culinary-note-inner">
        <div>
          <p class="signup-eyebrow">A taste of West Java</p>
          <h2 id="culinary-note-title">Follow the flavours</h2>
        </div>
        <p>Sundanese meals often bring rice, fresh vegetables, sambal and shared dishes to the table. Ask local hosts about seasonal specialties, and let them know about any dietary needs.</p>
        <a class="btn" href="destination.php">Explore Sukabumi</a>
      </div>
    </section>
  </main>

  <dialog class="dish-dialog" id="dish-dialog" aria-labelledby="dish-dialog-title">
    <button class="dialog-close" type="button" aria-label="Close dish details">Close</button>
    <div class="dish-dialog-scene">
      <img class="dish-main-photo" src="" alt="">
    </div>
    <div class="dialog-body">
      <span class="tag dish-dialog-tag"></span>
      <h2 id="dish-dialog-title"></h2>
      <p class="dish-dialog-description"></p>
      <p class="dish-dialog-goodfor"></p>
      <section class="detail-gallery-section" aria-labelledby="dish-gallery-title">
        <h3 id="dish-gallery-title">Dish photo gallery</h3>
        <p>Select a photo to view it. Example photos from Wikimedia Commons are credited with their license below.</p>
        <div class="detail-gallery dish-gallery" role="group" aria-label="Dish photos"></div>
      </section>
      <p class="dialog-credit dish-photo-credit" aria-live="polite"></p>
    </div>
  </dialog>

<?php include 'includes/footer.php'; ?>