<?php

declare(strict_types=1);

require_once __DIR__ . '/app.php';

configureSession();

/*
 |--------------------------------------------------------------------------
 | DATABASE SETUP — FREE STACK (Neon Postgres) + MySQL fallback
 |--------------------------------------------------------------------------
 |
 | Priority:
 |   1) DATABASE_URL env (Neon Postgres, e.g. postgresql://user:pass@host/db?sslmode=require)
 |      → Render/Neon free tier. Sleeps when idle, NEVER deletes your data.
 |   2) DB_HOST / DB_PORT / DB_NAME / DB_USER / DB_PASS env (MySQL, e.g. InfinityFree)
 |   3) Placeholder fallbacks below (edit on the server only, never commit secrets)
 |
 | Neon setup: create free project → copy connection string → set as
 | DATABASE_URL env on Render (and locally in .env, which is git-ignored).
 | Then import database/schema-pg.sql once via Neon SQL editor.
 |
 */

function parseDatabaseUrl(string $url): ?array
{
    $p = parse_url($url);
    if ($p === false || empty($p['host'])) {
        return null;
    }
    $scheme = strtolower($p['scheme'] ?? '');
    $driver = (strpos($scheme, 'postgres') !== false) ? 'pgsql' : 'mysql';
    return [
        'driver' => $driver,
        'host' => $p['host'],
        'port' => $p['port'] ?? ($driver === 'pgsql' ? 5432 : 3306),
        'name' => ltrim($p['path'] ?? '', '/'),
        'user' => isset($p['user']) ? urldecode($p['user']) : '',
        'pass' => isset($p['pass']) ? urldecode($p['pass']) : '',
        'query' => $p['query'] ?? '',
    ];
}

function dbUnavailable(string $detail = ''): void
{
    if ($detail !== '') {
        error_log('Database connection failed: ' . $detail);
    }
    http_response_code(500);
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    if (strpos($accept, 'application/json') !== false || ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest') {
        header('Content-Type: application/json');
        exit(json_encode(['error' => 'Database unavailable. Check DATABASE_URL (Neon) or DB_HOST/DB_NAME/DB_USER/DB_PASS on the server.']));
    }
    exit('A system error occurred (database unavailable). Please try again later.');
}

$databaseUrl = getenv('DATABASE_URL') ?: '';
$cfg = ($databaseUrl !== '') ? parseDatabaseUrl($databaseUrl) : null;

if ($cfg === null) {
    // MySQL path (InfinityFree or local)
    $cfg = [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST') ?: 'sqlXXX.infinityfree.com',
        'port' => getenv('DB_PORT') ?: '3306',
        'name' => getenv('DB_NAME') ?: 'if0_XXXXX_firstsql',
        'user' => getenv('DB_USER') ?: 'if0_XXXXX',
        'pass' => getenv('DB_PASS') ?: 'change-me',
        'query' => '',
    ];
}

define('DB_DRIVER', $cfg['driver']);

try {
    if ($cfg['driver'] === 'pgsql') {
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $cfg['host'], $cfg['port'], $cfg['name']);
        if ($cfg['query'] !== '' && strpos($cfg['query'], 'sslmode') === false) {
            $dsn .= ';sslmode=require';
        } elseif ($cfg['query'] !== '') {
            parse_str($cfg['query'], $q);
            if (!empty($q['sslmode'])) {
                $dsn .= ';sslmode=' . $q['sslmode'];
            }
        }
        $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } else {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $cfg['host'], $cfg['port'], $cfg['name']);
        $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
} catch (Throwable $e) {
    dbUnavailable($e->getMessage());
}

// Legacy name kept so existing includes keep working; it is now a PDO instance.
$connection = $pdo;
