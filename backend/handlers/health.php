<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

$ok = true;
$db = 'up';
if (!isset($connection) || !$connection || !mysqli_ping($connection)) {
    $ok = false;
    $db = 'down';
}

http_response_code($ok ? 200 : 500);
echo json_encode([
    'ok' => $ok,
    'db' => $db,
    'time' => gmdate('c'),
]);
