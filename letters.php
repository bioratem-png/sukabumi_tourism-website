<?php
require_once __DIR__ . '/includes/submissions.php';

$pageTitle = 'Letters - Sukabumi Regency';
$current = 'letters';
$errors = [];
$records = [];
$storageError = false;
$success = isset($_GET['submitted']) && $_GET['submitted'] === '1';

try {
    $token = submission_token();
} catch (RuntimeException $exception) {
    error_log($exception->getMessage());
    $token = '';
    $storageError = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($token === '' || !hash_equals($token, submission_value('csrf_token'))) {
        $errors[] = 'Your session expired. Reload the page and submit your letter again.';
    }
    if (isset($_POST['title']) && !is_string($_POST['title'])
        || isset($_POST['message']) && !is_string($_POST['message'])
        || isset($_POST['email']) && !is_string($_POST['email'])
        || isset($_POST['website']) && !is_string($_POST['website'])) {
        $errors[] = 'Please use the form fields as provided.';
    }
    if (submission_value('website') !== '') {
        $errors[] = 'Unable to submit this letter. Please try again.';
    }

    $title = submission_value('title');
    $message = submission_value('message');
    $email = submission_value('email');

    if ($title === '' || submission_length($title) > 120) {
        $errors[] = 'Enter a subject of no more than 120 characters.';
    }
    if ($message === '' || submission_length($message) < 10 || submission_length($message) > 5000) {
        $errors[] = 'Write a letter between 10 and 5,000 characters.';
    }
    if ($email !== '' && (submission_length($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $errors[] = 'Enter a valid email address, or leave the contact field blank.';
    }

    if (!$errors) {
        try {
            submission_save('letters', [
                'id' => bin2hex(random_bytes(16)),
                'created_at' => date(DATE_ATOM),
                'title' => $title,
                'message' => $message,
                'email' => $email,
            ]);
            header('Location: letters.php?submitted=1', true, 303);
            exit;
        } catch (RuntimeException $exception) {
            error_log($exception->getMessage());
            $storageError = true;
            $errors[] = 'Your letter could not be saved right now. Please try again later.';
        }
    }
}

try {
    $records = submission_list('letters');
} catch (RuntimeException $exception) {
    error_log($exception->getMessage());
    $storageError = true;
}

include __DIR__ . '/includes/header.php';
?>

<main id="main">
  <section class="hero hero--compact hero--letters">
    <div class="wrap">
      <div class="hero-body">
        <h1>Letters</h1>
        <p>Share a message with the Sukabumi community, or read letters visitors have submitted.</p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="wrap">
      <div class="section-head">
        <h2>Write a letter</h2>
        <p>Submitted letters appear publicly as soon as they are received. This independent website is not an official government communication channel.</p>
      </div>

      <?php if ($success): ?>
        <p class="notice notice--success" role="status">Your letter was submitted and is now listed below.</p>
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

      <form class="submission-form" method="post" action="letters.php">
        <input type="hidden" name="csrf_token" value="<?= submission_escape($token) ?>">
        <div class="form-honeypot" aria-hidden="true">
          <label for="letter-website">Leave this field empty</label>
          <input id="letter-website" type="text" name="website" tabindex="-1" autocomplete="off">
        </div>
        <div class="field">
          <label for="letter-title">Subject</label>
          <input id="letter-title" name="title" type="text" maxlength="120" required value="<?= submission_escape(submission_value('title')) ?>">
        </div>
        <div class="field">
          <label for="letter-message">Letter</label>
          <textarea id="letter-message" name="message" rows="7" minlength="10" maxlength="5000" required><?= submission_escape(submission_value('message')) ?></textarea>
        </div>
        <div class="field">
          <label for="letter-email">Email for follow-up (optional)</label>
          <input id="letter-email" name="email" type="email" maxlength="254" autocomplete="email" value="<?= submission_escape(submission_value('email')) ?>">
          <small>Your email is stored privately and is not shown with your letter.</small>
        </div>
        <p class="privacy-note">Your subject and letter are public. Do not include phone numbers, addresses, or other private information in the letter.</p>
        <button class="btn" type="submit"<?= $storageError || $token === '' ? ' disabled' : '' ?>>Submit letter</button>
      </form>
    </div>
  </section>

  <section class="section section--white">
    <div class="wrap">
      <div class="section-head">
        <h2>Published letters</h2>
        <p>Newest submissions appear first.</p>
      </div>
      <?php if (!$records): ?>
        <p class="empty">There are no letters yet. You can be the first to write one.</p>
      <?php else: ?>
        <div class="submission-list">
          <?php foreach ($records as $record): ?>
            <article class="submission-card">
              <div class="submission-meta">
                <time datetime="<?= submission_escape($record['created_at']) ?>"><?= submission_escape(date('F j, Y', strtotime($record['created_at']))) ?></time>
              </div>
              <h3><?= submission_escape($record['title']) ?></h3>
              <p><?= nl2br(submission_escape($record['message'])) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
