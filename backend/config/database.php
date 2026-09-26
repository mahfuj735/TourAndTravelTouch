<?php

declare(strict_types=1);

require_once __DIR__ . '/app.php';

configureSession();

/*
 |--------------------------------------------------------------------------
 | INFINITYFREE SETUP INSTRUCTIONS
 |--------------------------------------------------------------------------
 |
 | 1. Go to InfinityFree control panel → MySQL Databases
 | 2. Create a new database
 | 3. Copy the credentials (hostname, database name, username, password)
 | 4. Open phpMyAdmin, select your database, import database/schema.sql
 | 5. Set the values below via ONE of these methods (first match wins):
 |      a) Environment variables DB_HOST / DB_PORT / DB_NAME / DB_USER / DB_PASS
 |         (e.g. via .htaccess `SetEnv DB_HOST ...` on InfinityFree), or
 |      b) Edit the fallback values directly in this file on the server only.
 |
 | ⚠️  Do NOT commit real passwords to GitHub. This file ships with
 |     placeholder fallbacks; deployment uses your private values.
 |
 | Example InfinityFree values (replace with your own on the server):
 |   DB_HOST = 'sqlXXX.infinityfree.com'
 |   DB_NAME = 'if0_XXXXX_firstsql'
 |   DB_USER = 'if0_XXXXX'
 |   DB_PASS = 'your_password_here'
 |
 */

define('DB_HOST', getenv('DB_HOST') ?: 'sqlXXX.infinityfree.com');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'if0_XXXXX_firstsql');
define('DB_USER', getenv('DB_USER') ?: 'if0_XXXXX');
define('DB_PASS', getenv('DB_PASS') ?: 'change-me');

mysqli_report(MYSQLI_REPORT_OFF);
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, (int)DB_PORT);

if (mysqli_connect_errno()) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    http_response_code(500);
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    if (strpos($accept, 'application/json') !== false || ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest') {
        header('Content-Type: application/json');
        exit(json_encode(['error' => 'Database unavailable. Check DB_HOST/DB_NAME/DB_USER/DB_PASS on the server.']));
    }
    exit('A system error occurred (database unavailable). Please try again later.');
}

mysqli_set_charset($connection, 'utf8mb4');
