<?php

function submission_escape($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function submission_length($value) {
    $matched = preg_match_all('/./us', $value, $characters);
    return $matched === false ? PHP_INT_MAX : $matched;
}

function submission_value($key) {
    return isset($_POST[$key]) && is_string($_POST[$key]) ? trim($_POST[$key]) : '';
}

function submission_token() {
    if (session_status() !== PHP_SESSION_ACTIVE && !session_start()) {
        throw new RuntimeException('Unable to start a submission session.');
    }

    if (empty($_SESSION['submission_token'])) {
        $_SESSION['submission_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['submission_token'];
}

function submission_path($type) {
    if (!in_array($type, ['letters', 'complaints'], true)) {
        throw new InvalidArgumentException('Unsupported submission type.');
    }

    $configuredDirectory = getenv('SUBMISSION_DATA_DIR');
    $directory = is_string($configuredDirectory) && trim($configuredDirectory) !== ''
        ? rtrim($configuredDirectory, DIRECTORY_SEPARATOR)
        : dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data';
    if (!is_dir($directory) && !mkdir($directory, 0700, true) && !is_dir($directory)) {
        error_log('Unable to create the visitor submission data directory.');
        throw new RuntimeException('Submission storage is unavailable.');
    }

    return $directory . DIRECTORY_SEPARATOR . $type . '.json';
}

function submission_decode_records($contents) {
    if (trim($contents) === '') {
        return [];
    }

    try {
        $records = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $exception) {
        error_log('Unable to decode visitor submission data: ' . $exception->getMessage());
        throw new RuntimeException('Submission storage is unavailable.', 0, $exception);
    }

    if (!is_array($records) || array_values($records) !== $records) {
        error_log('Visitor submission data must contain a JSON list.');
        throw new RuntimeException('Submission storage is unavailable.');
    }

    return $records;
}

function submission_open_locked($type, $lock) {
    $path = submission_path($type);
    $file = fopen($path, 'c+');
    if ($file === false) {
        error_log('Unable to open visitor submission storage.');
        throw new RuntimeException('Submission storage is unavailable.');
    }

    if (!flock($file, $lock)) {
        fclose($file);
        error_log('Unable to lock visitor submission storage.');
        throw new RuntimeException('Submission storage is unavailable.');
    }

    return $file;
}

function submission_read_locked($file) {
    if (!rewind($file)) {
        error_log('Unable to rewind visitor submission storage.');
        throw new RuntimeException('Submission storage is unavailable.');
    }

    $contents = stream_get_contents($file);
    if ($contents === false) {
        error_log('Unable to read visitor submission storage.');
        throw new RuntimeException('Submission storage is unavailable.');
    }

    return submission_decode_records($contents);
}

function submission_list($type) {
    $file = submission_open_locked($type, LOCK_SH);
    try {
        return submission_read_locked($file);
    } finally {
        flock($file, LOCK_UN);
        fclose($file);
    }
}

function submission_save($type, $record) {
    $file = submission_open_locked($type, LOCK_EX);
    try {
        $records = submission_read_locked($file);
        array_unshift($records, $record);
        $contents = json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

        if (!rewind($file) || !ftruncate($file, 0)) {
            error_log('Unable to prepare visitor submission storage for writing.');
            throw new RuntimeException('Submission storage is unavailable.');
        }

        $remaining = $contents;
        while ($remaining !== '') {
            $written = fwrite($file, $remaining);
            if ($written === false || $written === 0) {
                error_log('Unable to write visitor submission data.');
                throw new RuntimeException('Submission storage is unavailable.');
            }
            $remaining = substr($remaining, $written);
        }

        if (!fflush($file)) {
            error_log('Unable to flush visitor submission data to disk.');
            throw new RuntimeException('Submission storage is unavailable.');
        }
    } catch (JsonException $exception) {
        error_log('Unable to encode visitor submission data: ' . $exception->getMessage());
        throw new RuntimeException('Submission storage is unavailable.', 0, $exception);
    } finally {
        flock($file, LOCK_UN);
        fclose($file);
    }
}
