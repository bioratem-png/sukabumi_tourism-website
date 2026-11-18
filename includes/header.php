<?php
$pageTitle = $pageTitle ?? 'Sukabumi Regency | Tourism and Public Information';
$pageDescription = $pageDescription ?? 'Explore destinations, local cuisine, and visitor information for Sukabumi Regency in West Java, Indonesia.';
$current = $current ?? '';

function nav_link($key, $file, $label, $current) {
    $attr = $key === $current ? ' aria-current="page"' : '';
    echo '<li><a href="' . $file . '"' . $attr . '>' . $label . '</a></li>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
  <meta name="theme-color" content="#0b326a">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&family=Source+Serif+4:wght@600;700&display=swap">
  <link rel="stylesheet" href="style.css?v=20261119-4">
</head>
<body>
  <a class="skip-link" href="#main">Skip to main content</a>

  <div class="topbar">
    <div class="wrap">Discover Sukabumi City &amp; Regency &middot; West Java, Indonesia</div>
  </div>

  <header class="site-header" id="site-header">
    <div class="wrap">
      <a class="brand" href="index.php">
        <img class="brand-mark" src="images/sukabumi-profile.jpg" alt="Sukabumi Regency emblem">
        <span class="brand-name">Sukabumi Regency<small>West Java, Indonesia</small></span>
      </a>

      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav">Menu</button>
      <nav class="main-nav" id="site-nav" aria-label="Main">
        <ul>
          <?php
          nav_link('home', 'index.php', 'Home', $current);
          nav_link('destination', 'destination.php', 'Destination', $current);
          nav_link('city', 'city.php', 'Kota Sukabumi', $current);
          nav_link('culinary', 'culinary.php', 'Culinary', $current);
          nav_link('letters', 'letters.php', 'Letters', $current);
          nav_link('complaint', 'complaint.php', 'Complaints', $current);
          ?>
        </ul>
      </nav>
      <button class="signup-trigger" type="button" aria-haspopup="dialog" aria-controls="signup-dialog">Sign up</button>
    </div>
  </header>

  <dialog class="signup-dialog" id="signup-dialog" aria-labelledby="signup-title">
    <button class="dialog-close signup-close" type="button" aria-label="Close signup form">Close</button>
    <div class="signup-content">
      <p class="signup-eyebrow">Stay in the loop</p>
      <h2 id="signup-title">Get more Sukabumi</h2>
      <p class="signup-intro">Be the first to hear about places to visit, local food, and travel inspiration.</p>
      <form class="signup-form" id="signup-form">
        <div class="field">
          <label for="signup-name">Your name</label>
          <input id="signup-name" name="name" type="text" autocomplete="name" maxlength="100" required>
        </div>
        <fieldset class="signup-method">
          <legend>How should we reach you?</legend>
          <div class="signup-method-options">
            <button type="button" data-signup-method="email" aria-pressed="true">Email</button>
            <button type="button" data-signup-method="phone" aria-pressed="false">Phone</button>
          </div>
        </fieldset>
        <div class="field">
          <label id="signup-contact-label" for="signup-contact">Email address</label>
          <input id="signup-contact" name="contact" type="email" autocomplete="email" maxlength="254" required>
        </div>
        <label class="signup-consent">
          <input name="consent" type="checkbox" required>
          <span>I agree to receive occasional Sukabumi travel updates.</span>
        </label>
        <button class="btn signup-submit" type="submit">Sign me up</button>
        <p class="signup-note" id="signup-status" role="status" aria-live="polite">Signup is a preview and isn't connected to a mailing list yet. Your details won't be saved.</p>
      </form>
    </div>
  </dialog>