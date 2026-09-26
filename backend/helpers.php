<?php

declare(strict_types=1);

function getCsrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCsrfToken(string $token): bool
{
    return !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function setFlashMessage(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlashMessage(): ?array
{
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function frontendUrl(string $path = ''): string
{
    return rtrim(FRONTEND_URL, '/') . '/' . ltrim($path, '/');
}

function redirectWithFlash(string $url, string $type, string $message): void
{
    setFlashMessage($type, $message);
    header('Location: ' . frontendUrl($url));
    exit;
}

function validateDate(string $date, string $format = 'Y-m-d'): bool
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function validatePositiveInt(string $value): bool
{
    return ctype_digit($value) && (int)$value > 0;
}

function redirect(string $url): void
{
    header('Location: ' . frontendUrl($url));
    exit;
}

function bookingExists(PDO $connection, string $name): bool
{
    try {
        $stmt = $connection->prepare('SELECT textdata FROM information WHERE textdata = ? LIMIT 1');
        $stmt->execute([$name]);
        return (bool)$stmt->fetchColumn();
    } catch (Throwable $e) {
        error_log('bookingExists failed: ' . $e->getMessage());
        return false;
    }
}

function userExists(PDO $connection, string $email): bool
{
    try {
        $stmt = $connection->prepare('SELECT email FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        return (bool)$stmt->fetchColumn();
    } catch (Throwable $e) {
        error_log('userExists failed: ' . $e->getMessage());
        return false;
    }
}

function getUserByEmail(PDO $connection, string $email): ?array
{
    try {
        $stmt = $connection->prepare('SELECT id, fullname, email, password_hash FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user ?: null;
    } catch (Throwable $e) {
        error_log('getUserByEmail failed: ' . $e->getMessage());
        return null;
    }
}

function isUserLoggedIn(): bool
{
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0;
}

function getLoggedInUser(): ?array
{
    if (!isUserLoggedIn()) {
        return null;
    }

    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'] ?? '',
        'email' => $_SESSION['user_email'] ?? '',
    ];
}

function requireLogin(): void
{
    if (!isUserLoggedIn()) {
        redirectWithFlash('/pages/login.html', 'error', 'Please log in first to make a booking.');
    }
}

function ensureBookingUserColumn(PDO $connection): void
{
    // Schema files (schema.sql / schema-pg.sql) already include user columns.
    // This is a best-effort backfill for old MySQL installs only.
    try {
        if (defined('DB_DRIVER') && DB_DRIVER === 'pgsql') {
            return;
        }
        $result = $connection->query("SHOW COLUMNS FROM information LIKE 'user_id'");
        if ($result && $result->fetch() === false) {
            $connection->exec("ALTER TABLE information
                ADD COLUMN user_id INT DEFAULT NULL AFTER textdata,
                ADD COLUMN user_name VARCHAR(255) DEFAULT NULL AFTER user_id,
                ADD COLUMN user_email VARCHAR(255) DEFAULT NULL AFTER user_name,
                ADD INDEX idx_user_id (user_id),
                ADD INDEX idx_user_email (user_email)");
        }
    } catch (Throwable $e) {
        error_log('ensureBookingUserColumn failed: ' . $e->getMessage());
    }
}
