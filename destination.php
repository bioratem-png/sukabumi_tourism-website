<?php $pageTitle = 'Destinations - Sukabumi Regency'; $current = 'destination'; include 'includes/header.php'; ?>

  <main id="main">
    <section class="hero hero--compact hero--destination">
      <div class="wrap">
        <div class="hero-body">
          <h1>Destinations</h1>
          <p>Beaches, waterfalls and highland scenery across Sukabumi Regency. Search by name or filter by category.</p>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="wrap">
        <div class="toolbar">
          <div class="field">
            <label for="search">Search destinations</label>
            <input id="search" type="search" placeholder="Name, district or keyword" autocomplete="off">
          </div>
          <div class="chips" role="group" aria-label="Filter by category">
            <button class="chip" type="button" data-category="all" aria-pressed="true">All</button>
            <button class="chip" type="button" data-category="beach" aria-pressed="false">Beaches</button>
            <button class="chip" type="button" data-category="waterfall" aria-pressed="false">Waterfalls</button>
            <button class="chip" type="button" data-category="nature" aria-pressed="false">Nature</button>
          </div>
        </div>

        <p class="result-count" id="result-count" aria-live="polite"></p>
        <div class="grid" id="destination-list"></div>
      </div>
    </section>

    <section class="section section--white">
      <div class="wrap">
        <div class="section-head">
          <h2>Before you go</h2>
          <p>A few points that apply to most sites in the regency.</p>
        </div>
        <div class="notes">
          <div class="note">
            <h3>Check conditions</h3>
            <p>Sea state, river levels and road conditions change with the weather. Check them on the day.</p>
          </div>
          <div class="note">
            <h3>Plan for distance</h3>
            <p>Sites are far apart, especially along the southern coast. Allow extra travel time between stops.</p>
          </div>
          <div class="note">
            <h3>Respect the environment</h3>
            <p>Many sites sit inside the geopark or near protected areas. Follow local rules and take your waste with you.</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <dialog id="detail-dialog" aria-labelledby="detail-title">
    <button class="dialog-close" type="button">Close</button>
    <div class="dialog-scene"></div>
    <div class="dialog-body">
      <span class="tag dialog-tag"></span>
      <h2 id="detail-title"></h2>
      <p class="dialog-district"></p>
      <p class="dialog-summary"></p>
      <section class="detail-gallery-section" aria-labelledby="detail-gallery-title">
        <h3 id="detail-gallery-title">Photos of this destination</h3>
        <p>Select a photo to view it. Photo credits and licenses are shown below the image.</p>
        <div class="detail-gallery" role="group" aria-label="Destination photo gallery"></div>
      </section>
      <h3>Highlights</h3>
      <ul class="dialog-highlights"></ul>
      <h3>Best for</h3>
      <p class="dialog-bestfor"></p>
      <h3>Visitor tip</h3>
      <p class="dialog-tip"></p>
      <p class="dialog-credit"></p>
    </div>
  </dialog>

<?php include 'includes/footer.php'; ?>