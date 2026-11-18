<?php
require_once __DIR__ . '/includes/submissions.php';

$pageTitle = 'Complaints - Sukabumi Regency';
$current = 'complaint';
$errors = [];
$records = [];
$storageError = false;
$success = isset($_GET['submitted']) && $_GET['submitted'] === '1';
$categories = [
    'cleanliness' => 'Cleanliness',
    'safety' => 'Safety',
    'facilities' => 'Facilities',
    'access' => 'Access or road conditions',
    'other' => 'Other',
];

try {
    $token = submission_token();
} catch (RuntimeException $exception) {
    error_log($exception->getMessage());
    $token = '';
    $storageError = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($token === '' || !hash_equals($token, submission_value('csrf_token'))) {
        $errors[] = 'Your session expired. Reload the page and submit your report again.';
    }
    if (isset($_POST['place']) && !is_string($_POST['place'])
        || isset($_POST['category']) && !is_string($_POST['category'])
        || isset($_POST['message']) && !is_string($_POST['message'])
        || isset($_POST['email']) && !is_string($_POST['email'])
        || isset($_POST['website']) && !is_string($_POST['website'])) {
        $errors[] = 'Please use the form fields as provided.';
    }
    if (submission_value('website') !== '') {
        $errors[] = 'Unable to submit this report. Please try again.';
    }

    $place = submission_value('place');
    $category = submission_value('category');
    $message = submission_value('message');
    $email = submission_value('email');

    if ($place === '' || submission_length($place) > 120) {
        $errors[] = 'Enter a place name of no more than 120 characters.';
    }
    if (!isset($categories[$category])) {
        $errors[] = 'Choose a valid issue type.';
    }
    if ($message === '' || submission_length($message) < 10 || submission_length($message) > 5000) {
        $errors[] = 'Describe the problem in 10 to 5,000 characters.';
    }
    if ($email !== '' && (submission_length($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $errors[] = 'Enter a valid email address, or leave the contact field blank.';
    }

    if (!$errors) {
        try {
            submission_save('complaints', [
                'id' => bin2hex(random_bytes(16)),
                'created_at' => date(DATE_ATOM),
                'place' => $place,
                'category' => $category,
                'message' => $message,
                'email' => $email,
            ]);
            header('Location: complaint.php?submitted=1', true, 303);
            exit;
        } catch (RuntimeException $exception) {
            error_log($exception->getMessage());
            $storageError = true;
            $errors[] = 'Your report could not be saved right now. Please try again later.';
        }
    }
}

try {
    $records = submission_list('complaints');
} catch (RuntimeException $exception) {
    error_log($exception->getMessage());
    $storageError = true;
}

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="hero hero--compact hero--complaints">
    <div class="wrap">
      <div class="hero-body">
        <h1>Complaints and place reports</h1>
        <p>Report cleanliness, safety, facilities, or access problems at beaches and other visitor places around Sukabumi.</p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="wrap">
      <div class="section-head">
        <h2>Report a problem</h2>
        <p>Reports appear publicly as soon as they are received, with the status “Received.” This independent website is not an official government complaint service and does not forward reports to local authorities.</p>
      </div>

      <?php if ($success): ?>
        <p class="notice notice--success" role="status">Your report was received and is now listed below.</p>
      <?php endif; ?>
      <?php if ($storageError): ?>
        <p class="notice notice--error" role="alert">Submission storage is currently unavailable. Please try again later.</p>
      <?php endif; ?>
      <?php if ($errors): ?>
        <div class="notice notice--error" role="alert">
          <p>Please correct the following:</p>
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?= submission_escape($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form class="submission-form" method="post" action="complaint.php">
        <input type="hidden" name="csrf_token" value="<?= submission_escape($token) ?>">
        <div class="form-honeypot" aria-hidden="true">
          <label for="complaint-website">Leave this field empty</label>
          <input id="complaint-website" type="text" name="website" tabindex="-1" autocomplete="off">
        </div>
        <div class="field">
          <label for="complaint-place">Place</label>
          <input id="complaint-place" name="place" type="text" maxlength="120" placeholder="For example, Palabuhanratu Beach" required value="<?= submission_escape(submission_value('place')) ?>">
        </div>
        <div class="field">
          <label for="complaint-category">Issue type</label>
          <select id="complaint-category" name="category" required>
            <option value="">Choose an issue type</option>
            <?php foreach ($categories as $value => $label): ?>
              <option value="<?= submission_escape($value) ?>"<?= submission_value('category') === $value ? ' selected' : '' ?>><?= submission_escape($label) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field">
          <label for="complaint-message">What is the problem?</label>
          <textarea id="complaint-message" name="message" rows="7" minlength="10" maxlength="5000" required><?= submission_escape(submission_value('message')) ?></textarea>
        </div>
        <div class="field">
          <label for="complaint-email">Email for follow-up (optional)</label>
          <input id="complaint-email" name="email" type="email" maxlength="254" autocomplete="email" value="<?= submission_escape(submission_value('email')) ?>">
          <small>Your email is stored privately and is not shown with your report.</small>
        </div>
        <p class="privacy-note">The place, issue type, and description are public. Do not include personal or sensitive information in your report.</p>
        <button class="btn" type="submit"<?= $storageError || $token === '' ? ' disabled' : '' ?>>Submit report</button>
      </form>
    </div>
  </section>

  <section class="section section--white">
    <div class="wrap">
      <div class="section-head">
        <h2>Public reports</h2>
        <p>Newest reports appear first. “Received” is the status recorded by this website; it does not mean the problem has been resolved.</p>
      </div>
      <?php if (!$records): ?>
        <p class="empty">There are no reports yet. Submit a report to help document a problem.</p>
      <?php else: ?>
        <div class="submission-list">
          <?php foreach ($records as $record): ?>
            <article class="submission-card">
              <div class="submission-meta">
                <span><?= submission_escape($categories[$record['category']] ?? 'Other') ?></span>
                <time datetime="<?= submission_escape($record['created_at']) ?>"><?= submission_escape(date('F j, Y', strtotime($record['created_at']))) ?></time>
                <span class="submission-status">Received</span>
              </div>
              <h3><?= submission_escape($record['place']) ?></h3>
              <p><?= nl2br(submission_escape($record['message'])) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
