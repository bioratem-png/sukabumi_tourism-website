<?php
$pageTitle = 'Sukabumi Regency | Tourism and Public Information';
$pageDescription = 'Discover the coast, waterfalls, highlands, local food, and UNESCO Global Geopark of Sukabumi Regency, West Java, Indonesia.';
$current = 'home';
include 'includes/header.php';
?>

  <main id="main">
    <section class="hero hero--home">
      <div class="wrap">
        <div class="hero-body">
          <p class="hero-eyebrow"><span aria-hidden="true"></span> West Java, Indonesia</p>
          <h1>Where the mountains<br>meet the <em>ocean.</em></h1>
          <p>Find your next escape in Sukabumi: dramatic coastlines, rainforest waterfalls, and the extraordinary landscapes of a UNESCO Global Geopark.</p>
          <div class="hero-actions">
            <a class="btn" href="#home-destinations">Explore Sukabumi <span aria-hidden="true">&rarr;</span></a>
            <a class="hero-text-link" href="#trip-planner">Plan a day out <span aria-hidden="true">&darr;</span></a>
          </div>
          <div class="hero-proof">
            <span class="hero-proof-mark" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/><circle cx="12" cy="9" r="2.3"/></svg>
            </span>
            <span><strong>One remarkable regency</strong><small>Pacific coast · West Java highlands</small></span>
          </div>
        </div>
        <p class="hero-photo-caption">Palabuhanratu bay, Sukabumi</p>
      </div>
    </section>

    <section class="facts" aria-label="Sukabumi at a glance">
      <div class="wrap">
        <dl>
          <div class="fact"><dt>In the province of</dt><dd>West Java</dd></div>
          <div class="fact"><dt>Regency capital</dt><dd>Palabuhanratu</dd></div>
          <div class="fact"><dt>Southern shore</dt><dd>Indian Ocean</dd></div>
          <div class="fact"><dt>World-class nature</dt><dd>UNESCO Global Geopark</dd></div>
        </dl>
      </div>
    </section>

    <section class="section home-featured" id="home-destinations" aria-labelledby="featured-title">
      <div class="wrap">
        <div class="section-head section-head--split">
          <div>
            <p class="section-kicker">The best of Sukabumi</p>
            <h2 id="featured-title">A little bit of everything.</h2>
          </div>
          <p>From a quiet morning at the lake to the last light over the Indian Ocean, start with a place that feels like you.</p>
        </div>
        <div class="grid home-featured-grid" id="featured"></div>
        <div class="section-link-row">
          <a class="text-arrow-link" href="destination.php">Discover all destinations <span aria-hidden="true">&rarr;</span></a>
        </div>
        <div class="city-home-promo">
          <div>
            <p class="section-kicker">Prefer a city day?</p>
            <h3>Make time for Kota Sukabumi.</h3>
            <p>Find city landmarks, Citimall, coffee spots, and places to play.</p>
          </div>
          <a class="text-arrow-link" href="city.php">Explore the city guide <span aria-hidden="true">&rarr;</span></a>
        </div>
      </div>
    </section>

    <section class="trip-planner section section--white" id="trip-planner" aria-labelledby="trip-planner-title">
      <div class="wrap">
        <div class="planner-intro">
          <p class="section-kicker">A good trip starts here</p>
          <h2 id="trip-planner-title">What are you in the mood for?</h2>
          <p>Choose your pace and your kind of scenery. We’ll suggest a simple starting route you can tailor to the day.</p>
          <p class="planner-disclaimer">A starting idea, not a drive sequence. Sukabumi is large: group nearby stops, then check local weather, road, and site conditions before setting out.</p>
        </div>
        <form class="planner-form" id="trip-planner-form">
          <div class="field">
            <label for="trip-duration">How much time do you have?</label>
            <select id="trip-duration" name="duration">
              <option value="day">One day</option>
              <option value="weekend">A weekend</option>
              <option value="longer">Three days or more</option>
            </select>
          </div>
          <fieldset class="planner-interests">
            <legend>Pick your scenery</legend>
            <div class="planner-choice-grid">
              <label class="planner-choice">
                <input type="radio" name="interest" value="coast" checked>
                <span class="planner-choice-icon" aria-hidden="true">01</span>
                <span><strong>Ocean air</strong><small>Beaches &amp; coastal views</small></span>
              </label>
              <label class="planner-choice">
                <input type="radio" name="interest" value="waterfall">
                <span class="planner-choice-icon" aria-hidden="true">02</span>
                <span><strong>Into the wild</strong><small>Waterfalls &amp; green trails</small></span>
              </label>
              <label class="planner-choice">
                <input type="radio" name="interest" value="highlands">
                <span class="planner-choice-icon" aria-hidden="true">03</span>
                <span><strong>Highland calm</strong><small>Lake &amp; forest scenery</small></span>
              </label>
            </div>
          </fieldset>
          <button class="btn planner-submit" type="submit">Build my trip idea <span aria-hidden="true">&rarr;</span></button>
        </form>
        <div class="planner-result" id="trip-planner-result" aria-live="polite" hidden>
          <div class="planner-result-heading">
            <div><p class="section-kicker">Your starting point</p><h3 id="planner-result-title"></h3></div>
            <button type="button" class="planner-reset" id="planner-reset">Change my choices</button>
          </div>
          <ol class="planner-stops" id="planner-stops"></ol>
        </div>
      </div>
    </section>

    <section class="section official-indicators" aria-labelledby="official-indicators-title">
      <div class="wrap">
        <div class="section-head section-head--split">
          <div>
            <p class="section-kicker">Beyond the scenery</p>
            <h2 id="official-indicators-title">A place with a bigger story.</h2>
          </div>
          <p>Explore Sukabumi through its landscapes and communities, with a snapshot of official regional indicators for added context.</p>
        </div>
        <div class="indicator-grid">
          <article class="indicator-card">
            <p class="indicator-value">7,11%</p>
            <h3>Unemployment rate</h3>
            <p class="indicator-period">2024</p>
          </article>
          <article class="indicator-card">
            <p class="indicator-value">6,26%</p>
            <h3>Population in poverty</h3>
            <p class="indicator-period">2025</p>
          </article>
          <article class="indicator-card">
            <p class="indicator-value">3,98%</p>
            <h3>Economic growth</h3>
            <p class="indicator-period">Quarter 3, 2025</p>
          </article>
        </div>
        <p class="indicator-source">
          Source: Badan Pusat Statistik Kabupaten Sukabumi,
          <a href="https://sukabumikab.bps.go.id/id" target="_blank" rel="noopener noreferrer">“Indikator Makro Kabupaten Sukabumi”</a>,
          accessed 12 November 2026. This cited snapshot does not update automatically.
          See <a href="https://sukabumikab.bps.go.id/id/query-builder" target="_blank" rel="noopener noreferrer">BPS dynamic tables</a>
          for the latest available data.
        </p>
      </div>
    </section>

    <section class="home-editorial section">
      <div class="wrap editorial-layout">
        <div class="editorial-image" role="img" aria-label="A tropical green landscape in Sukabumi"></div>
        <div class="editorial-copy">
          <p class="section-kicker">Take the scenic route</p>
          <h2>More than a destination. A whole world to explore.</h2>
          <p>Sukabumi rewards curious travellers. Take time for a local meal, ask before entering the water, and leave the landscapes as beautiful as you found them.</p>
          <div class="editorial-links">
            <a class="editorial-link" href="culinary.php"><span>01</span><span><strong>Eat like a local</strong><small>Explore Sukabumi's dishes</small></span><span aria-hidden="true">&rarr;</span></a>
            <a class="editorial-link" href="destination.php"><span>02</span><span><strong>Explore responsibly</strong><small>Plan a thoughtful visit</small></span><span aria-hidden="true">&rarr;</span></a>
          </div>
        </div>
      </div>
    </section>

    <section class="guide-cta">
      <div class="wrap guide-cta-inner">
        <div>
          <p class="section-kicker">Your next story starts here</p>
          <h2>Ready to find your Sukabumi?</h2>
        </div>
        <a class="btn" href="destination.php">Browse the destination guide <span aria-hidden="true">&rarr;</span></a>
      </div>
    </section>
  </main>

<?php include 'includes/footer.php'; ?>