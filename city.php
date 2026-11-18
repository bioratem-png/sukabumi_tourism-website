<?php
$pageTitle = 'Kota Sukabumi City Guide | Places, Coffee & Leisure';
$pageDescription = 'Explore Kota Sukabumi: city landmarks, shopping at Citimall, family activities, coffee shops, and billiards.';
$current = 'city';
include 'includes/header.php';

$cityPlaces = [
    [
        'name' => 'Alun-Alun Kota Sukabumi',
        'category' => 'sightseeing',
        'label' => 'City landmark',
        'description' => 'A central public square and an easy starting point for a walk around the heart of the city.',
        'search' => 'Alun-Alun Kota Sukabumi',
        'icon' => '01',
        'image' => 'images/city/city-square.jpg',
        'imageAlt' => 'The city lawn square beside the Grand Mosque in Sukabumi',
        'photoCredit' => 'Afrogindahood',
        'photoSource' => 'https://commons.wikimedia.org/wiki/File:Sukabumi_City_Lawn_Square_in_2022.jpg',
        'photoLicense' => 'CC BY-SA 4.0',
        'photoLicenseUrl' => 'https://creativecommons.org/licenses/by-sa/4.0/'
    ],
    [
        'name' => 'Lapang Merdeka',
        'category' => 'sightseeing',
        'label' => 'Public space',
        'description' => 'A familiar city-center open space. Check local notices for events, access, and facilities.',
        'search' => 'Lapang Merdeka Sukabumi',
        'icon' => '02',
        'image' => 'images/city/lapang-merdeka.jpg',
        'imageAlt' => 'Lapang Merdeka at night in Sukabumi',
        'photoCredit' => 'Anandasoni',
        'photoSource' => 'https://commons.wikimedia.org/wiki/File:Lapang_merdeka_di_Malam_Hari.jpg',
        'photoLicense' => 'CC BY-SA 3.0',
        'photoLicenseUrl' => 'https://creativecommons.org/licenses/by-sa/3.0/'
    ],
    [
        'name' => 'Gedung Juang 45',
        'category' => 'sightseeing',
        'label' => 'History & heritage',
        'description' => 'A historic city landmark to add to a heritage-minded walk. Confirm visitor access before making a special trip.',
        'search' => 'Gedung Juang 45 Sukabumi',
        'listingUrl' => 'https://www.google.com/maps/search/?api=1&query=Gedung+Juang+45+Sukabumi',
        'icon' => '03',
        'image' => 'images/city/gedung-juang-45.png',
        'imageAlt' => 'Gedung Juang 45 in Sukabumi',
        'photoCredit' => 'Image supplied by site owner.',
        'photoSource' => '',
        'photoLicense' => '',
        'photoLicenseUrl' => ''
    ],
    [
        'name' => 'Balai Kota Sukabumi',
        'category' => 'sightseeing',
        'label' => 'Civic architecture',
        'description' => 'See a notable civic building in the city center. Check local guidance about public access before visiting.',
        'search' => 'Balai Kota Sukabumi',
        'icon' => '04',
        'image' => 'images/city/city-hall.jpg',
        'imageAlt' => 'Main building of Sukabumi City Hall',
        'photoCredit' => 'Afrogindahood',
        'photoSource' => 'https://commons.wikimedia.org/wiki/File:Sukabumi_City_Hall_2021.jpg',
        'photoLicense' => 'CC BY-SA 4.0',
        'photoLicenseUrl' => 'https://creativecommons.org/licenses/by-sa/4.0/'
    ],
    [
        'name' => 'Masjid Agung Kota Sukabumi',
        'category' => 'sightseeing',
        'label' => 'City landmark',
        'description' => 'A prominent landmark beside the central city square. Please respect prayer times and visitor guidance.',
        'search' => 'Sukabumi Grand Mosque',
        'icon' => '05',
        'image' => 'images/city/grand-mosque.jpg',
        'imageAlt' => 'Sukabumi Grand Mosque beside the city square',
        'photoCredit' => 'Afrogindahood',
        'photoSource' => 'https://commons.wikimedia.org/wiki/File:Sukabumi_Grand_Mosque_2022_01.jpg',
        'photoLicense' => 'CC BY-SA 4.0',
        'photoLicenseUrl' => 'https://creativecommons.org/licenses/by-sa/4.0/'
    ],
    [
        'name' => 'Citimall Sukabumi',
        'category' => 'shopping',
        'label' => 'Shopping & dining',
        'description' => 'A city mall for browsing shops, finding a meal, or taking a break indoors. Check the latest directory and hours before visiting.',
        'search' => 'Citimall Sukabumi',
        'icon' => '06',
        'image' => 'images/city/citimall-sukabumi-exterior.png',
        'imageAlt' => 'Citimall Sukabumi exterior beside the city street',
        'photoCredit' => 'Photo supplied by site owner',
        'photoSource' => '',
        'photoLicense' => '',
        'photoLicenseUrl' => ''
    ],
    [
        'name' => 'Coffee shops near Alun-Alun Sukabumi',
        'category' => 'coffee',
        'label' => 'Coffee & cafés',
        'description' => 'Browse current local cafés and coffee spots, then check recent reviews, opening hours, and directions.',
        'search' => 'coffee shops near Alun-Alun Kota Sukabumi',
        'icon' => '07'
    ],
    [
        'name' => 'Jogja Billiard Sukabumi',
        'category' => 'leisure',
        'label' => 'Games & nightlife',
        'description' => 'A pool and billiards option to look up in Kota Sukabumi. Check the map listing, current hours, age requirements, and table availability before visiting.',
        'search' => 'Jogja Billiard Sukabumi',
        'listingUrl' => 'https://share.google/jJdj1yp8cp0H4uFWI',
        'socialUrl' => 'https://www.instagram.com/jogjabilliard.sukabumi/',
        'icon' => '08'
    ],
    [
        'name' => 'Alun-Alun & Lapang Merdeka family visit',
        'category' => 'family',
        'label' => 'Family time',
        'description' => 'Explore current family-friendly activities and attractions around the city, with map directions and recent visitor information.',
        'search' => 'Alun-Alun Kota Sukabumi Lapang Merdeka family park',
        'icon' => '09'
    ]
];

$cityGalleryExtras = [
    'Alun-Alun Kota Sukabumi' => [
        [
            'src' => 'images/city/alun-alun-sukabumi-mountain-view.png',
            'alt' => 'View across Sukabumi public square toward the mountain',
            'caption' => 'Alun-Alun area with the mountain in the distance. Photo supplied by the site owner.',
            'credit' => 'Image supplied by site owner.',
            'source' => '',
            'license' => '',
            'licenseUrl' => '',
            'userProvided' => true
        ],
        [
            'src' => 'images/city/lapang-merdeka-mountain-wide.png',
            'alt' => 'Wide view across Sukabumi city square toward the mountain',
            'caption' => 'Wide view of the central Sukabumi public-square area. Photo supplied by the site owner.',
            'credit' => 'Image supplied by site owner.',
            'source' => '',
            'license' => '',
            'licenseUrl' => '',
            'userProvided' => true
        ],
        [
            'src' => 'images/city/lapang-merdeka-sign-gathering.png',
            'alt' => 'Visitors gathered by the Lapang Merdeka sign in the city-square area',
            'caption' => 'The sign identifies this part of the central city-square area as Lapang Merdeka. Photo supplied by the site owner.',
            'credit' => 'Image supplied by site owner.',
            'source' => '',
            'license' => '',
            'licenseUrl' => '',
            'userProvided' => true
        ],
        [
            'src' => 'images/city/lapang-merdeka-skate-park.png',
            'alt' => 'Skate area in the central Sukabumi city-square area',
            'caption' => 'Skate area in the central Sukabumi public-square area. Photo supplied by the site owner.',
            'credit' => 'Image supplied by site owner.',
            'source' => '',
            'license' => '',
            'licenseUrl' => '',
            'userProvided' => true
        ],
        [
            'src' => 'images/city/lapang-merdeka-field.png',
            'alt' => 'Open field and trees in the central Sukabumi city-square area',
            'caption' => 'Open field in the central Sukabumi public-square area. Photo supplied by the site owner.',
            'credit' => 'Image supplied by site owner.',
            'source' => '',
            'license' => '',
            'licenseUrl' => '',
            'userProvided' => true
        ]
    ],
    'Lapang Merdeka' => [],
    'Citimall Sukabumi' => [
        [
            'src' => 'images/city/citimall-shopping-area.png',
            'alt' => 'Shopping area and book fair inside Citimall Sukabumi',
            'caption' => 'Citimall Sukabumi shopping area photo supplied by the site owner.',
            'credit' => 'Image supplied by site owner.',
            'source' => '',
            'license' => '',
            'licenseUrl' => '',
            'userProvided' => true
        ],
        [
            'src' => 'images/city/citimall-shopping-floor.png',
            'alt' => 'Shop and food court area inside Citimall Sukabumi',
            'caption' => 'Citimall Sukabumi interior photo supplied by the site owner.',
            'credit' => 'Image supplied by site owner.',
            'source' => '',
            'license' => '',
            'licenseUrl' => '',
            'userProvided' => true
        ],
        [
            'src' => 'images/city/citimall-sukabumi.png',
            'alt' => 'Lantern-lit courtyard at Citimall Sukabumi',
            'caption' => 'Citimall Sukabumi courtyard, supplied by the site owner.',
            'credit' => 'Image supplied by site owner.',
            'source' => '',
            'license' => '',
            'licenseUrl' => '',
            'userProvided' => true
        ],
    ],
    'Alun-Alun & Lapang Merdeka family visit' => [
        [
            'src' => 'images/city/city-square.jpg',
            'alt' => 'Open lawn and public square beside Sukabumi Grand Mosque',
            'caption' => 'A real Sukabumi public square; check current access and activities locally.',
            'credit' => 'Afrogindahood',
            'source' => 'https://commons.wikimedia.org/wiki/File:Sukabumi_City_Lawn_Square_in_2022.jpg',
            'license' => 'CC BY-SA 4.0',
            'licenseUrl' => 'https://creativecommons.org/licenses/by-sa/4.0/'
        ],
    ]
];

$cityPhotoGallery = [];
foreach ($cityPlaces as &$place) {
    $place['photos'] = [];
    if (!empty($place['image'])) {
        $place['photos'][] = [
            'src' => $place['image'],
            'alt' => $place['imageAlt'],
            'caption' => $place['imageAlt'],
            'credit' => $place['photoCredit'],
            'source' => $place['photoSource'],
            'license' => $place['photoLicense'],
            'licenseUrl' => $place['photoLicenseUrl'],
            'userProvided' => empty($place['photoSource'])
        ];
    }
    if (!empty($cityGalleryExtras[$place['name']])) {
        $place['photos'] = array_merge($place['photos'], $cityGalleryExtras[$place['name']]);
    }
    $place['galleryStart'] = count($cityPhotoGallery);
    $cityPhotoGallery = array_merge($cityPhotoGallery, $place['photos']);
}
unset($place);
?>

<main id="main">
  <section class="hero hero--compact hero--city">
    <div class="wrap">
      <div class="hero-body">
        <p class="hero-eyebrow"><span aria-hidden="true"></span> West Java, Indonesia</p>
        <h1>Kota Sukabumi</h1>
        <p>A city break with local cafés, shopping, public spaces, and places to spend an evening.</p>
        <a class="btn" href="#city-places">Explore the city <span aria-hidden="true">&darr;</span></a>
      </div>
    </div>
  </section>

  <section class="section city-guide" id="city-places" aria-labelledby="city-places-title">
    <div class="wrap">
      <div class="section-head section-head--split">
        <div>
          <p class="section-kicker">The city, your way</p>
          <h2 id="city-places-title">Find your kind of Sukabumi.</h2>
        </div>
        <p>From city landmarks to coffee and pool, use the guide to find a good next stop. Map searches show current listings and directions.</p>
      </div>

      <div class="city-toolbar">
        <div class="field city-search">
          <label for="city-search">Search city places</label>
          <input id="city-search" type="search" placeholder="Try coffee, mall, history or billiards" autocomplete="off">
        </div>
        <div class="chips" role="group" aria-label="Filter city places">
          <button class="chip" type="button" data-city-category="all" aria-pressed="true">All places</button>
          <button class="chip" type="button" data-city-category="sightseeing" aria-pressed="false">Landmarks</button>
          <button class="chip" type="button" data-city-category="shopping" aria-pressed="false">Shopping</button>
          <button class="chip" type="button" data-city-category="coffee" aria-pressed="false">Coffee</button>
          <button class="chip" type="button" data-city-category="leisure" aria-pressed="false">Billiards</button>
          <button class="chip" type="button" data-city-category="family" aria-pressed="false">Family</button>
        </div>
      </div>

      <p class="result-count" id="city-result-count" aria-live="polite"></p>
      <p class="city-gallery-note">Each place's gallery shows only its own photos. Site-owner-provided images are identified in their captions.</p>
      <div class="grid city-grid" id="city-place-list">
        <?php foreach ($cityPlaces as $place): ?>
          <article class="card city-card" data-city-category="<?= htmlspecialchars($place['category'], ENT_QUOTES, 'UTF-8') ?>">
            <?php if (!empty($place['photos'])): ?>
              <?php $featuredPhoto = $place['photos'][0]; ?>
              <figure class="city-card-photo">
                <button class="city-photo-open" type="button" data-city-photo-index="<?= (int) $place['galleryStart'] ?>" data-city-photo-count="<?= count($place['photos']) ?>" aria-label="Open photo gallery for <?= htmlspecialchars($place['name'], ENT_QUOTES, 'UTF-8') ?>">
                  <img src="<?= htmlspecialchars($featuredPhoto['src'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($featuredPhoto['alt'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy" decoding="async">
                  <span class="city-photo-hint">View photos <span aria-hidden="true">↗</span></span>
                </button>
                <figcaption>
                  <?= htmlspecialchars($featuredPhoto['caption'], ENT_QUOTES, 'UTF-8') ?>
                  <?php if (!empty($featuredPhoto['userProvided'])): ?>
                    <span><?= htmlspecialchars($featuredPhoto['credit'], ENT_QUOTES, 'UTF-8') ?></span>
                  <?php else: ?>
                    <span>Photo: <a href="<?= htmlspecialchars($featuredPhoto['source'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($featuredPhoto['credit'], ENT_QUOTES, 'UTF-8') ?></a>
                    · <a href="<?= htmlspecialchars($featuredPhoto['licenseUrl'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($featuredPhoto['license'], ENT_QUOTES, 'UTF-8') ?></a></span>
                  <?php endif; ?>
                </figcaption>
              </figure>
            <?php else: ?>
              <div class="city-card-art" aria-hidden="true"><span><?= htmlspecialchars($place['icon'], ENT_QUOTES, 'UTF-8') ?></span></div>
            <?php endif; ?>
            <div class="card-body">
              <div class="card-meta"><span class="tag"><?= htmlspecialchars($place['label'], ENT_QUOTES, 'UTF-8') ?></span></div>
              <h3><?= htmlspecialchars($place['name'], ENT_QUOTES, 'UTF-8') ?></h3>
              <p><?= htmlspecialchars($place['description'], ENT_QUOTES, 'UTF-8') ?></p>
              <a class="card-link" href="https://www.google.com/maps/search/?api=1&amp;query=<?= rawurlencode($place['search']) ?>" target="_blank" rel="noopener noreferrer">Find on Google Maps <span aria-hidden="true">&rarr;</span></a>
              <?php if (!empty($place['listingUrl'])): ?>
                <a class="card-link" href="<?= htmlspecialchars($place['listingUrl'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">Open place listing &amp; photos <span aria-hidden="true">&rarr;</span></a>
              <?php endif; ?>
              <?php if (!empty($place['socialUrl'])): ?>
                <a class="card-link" href="<?= htmlspecialchars($place['socialUrl'], ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer">View Jogja Billiard photos on Instagram <span aria-hidden="true">&rarr;</span></a>
              <?php endif; ?>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
      <p class="city-no-results" id="city-no-results" hidden>No city places match that search. Try another word or choose a different filter.</p>
    </div>
  </section>

  <dialog class="city-photo-dialog" id="city-photo-dialog" aria-label="City photo gallery">
    <div class="city-photo-dialog-head">
      <p class="section-kicker" id="city-photo-counter" aria-live="polite"></p>
      <button class="city-photo-close" id="city-photo-close" type="button" aria-label="Close photo gallery">Close <span aria-hidden="true">&times;</span></button>
    </div>
    <figure class="city-photo-viewer">
      <img id="city-photo-full" src="" alt="">
      <figcaption id="city-photo-caption"></figcaption>
    </figure>
    <div class="city-photo-controls">
      <button class="chip" id="city-photo-prev" type="button" aria-label="Previous photo">&larr; Previous</button>
      <div class="city-photo-thumbnails" id="city-photo-thumbnails" role="group" aria-label="Choose a photo"></div>
      <button class="chip" id="city-photo-next" type="button" aria-label="Next photo">Next &rarr;</button>
    </div>
  </dialog>
  <script type="application/json" id="city-photo-data"><?= json_encode($cityPhotoGallery, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>

  <section class="section section--white">
    <div class="wrap city-visitor-note">
      <div>
        <p class="section-kicker">A quick local tip</p>
        <h2>Check before you head out.</h2>
      </div>
      <p>Business hours, venue listings, and public-space access can change. Use the map links for current directions and contact the venue directly to confirm details. Kota Sukabumi is separate from the much larger Sukabumi Regency, where the coastal and nature destinations are located.</p>
      <a class="text-arrow-link" href="destination.php">Explore Sukabumi Regency destinations <span aria-hidden="true">&rarr;</span></a>
    </div>
  </section>
</main>

<?php include 'includes/footer.php'; ?>
