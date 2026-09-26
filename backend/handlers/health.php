<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

$ok = true;
$db = 'up';
try {
    if (!isset($connection) || !$connection || $connection->query('SELECT 1') === false) {
        $ok = false;
        $db = 'down';
    }
} catch (Throwable $e) {
    $ok = false;
    $db = 'down';
}

http_response_code($ok ? 200 : 500);
echo json_encode([
    'ok' => $ok,
    'db' => $db,
    'driver' => defined('DB_DRIVER') ? DB_DRIVER : 'unknown',
    'time' => gmdate('c'),
]);
