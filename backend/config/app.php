<?php

declare(strict_types=1);

/*
 |--------------------------------------------------------------------------
 | APPLICATION CONFIGURATION
 |--------------------------------------------------------------------------
 |
 | FRONTEND_URL: Your GitHub Pages (or any frontend) URL.
 |   This is where PHP will redirect the browser after form processing.
 |   Update this to your actual frontend URL.
 |
 | BACKEND_URL: Used by JS config on the frontend.
 |   Defined here as documentation; the actual JS value is in assets/js/config.js
 |
 */

define('FRONTEND_URL', getenv('FRONTEND_URL') ?: 'https://mahfuj735.github.io/TourAndTravelTouch');
define('BACKEND_URL', getenv('BACKEND_URL') ?: '');

function setCorsHeaders(): void
{
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
    $allowedOrigins = [
        'https://mahfuj735.github.io',
        'https://mahfujul-01726.github.io',
        'http://localhost:8000',
        'http://localhost',
        'http://127.0.0.1:8000',
        'http://127.0.0.1',
    ];

    $originOk = $origin !== '' && in_array($origin, $allowedOrigins, true);
    if (!$originOk && $origin !== '') {
        // Allow any Render free-stack host (service URL chosen at deploy time).
        $host = (string)parse_url($origin, PHP_URL_HOST);
        if ($host !== '' && substr($host, -13) === '.onrender.com') {
            $originOk = true;
        }
    }

    if ($originOk) {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Vary: Origin');
    }
    // Same-origin requests (no Origin header, e.g. normal form POST
    // on InfinityFree) need no CORS header at all.

    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
        http_response_code(204);
        exit;
    }
}

function isSecureRequest(): bool
{
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        return true;
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        return true;
    }
    // Render terminates TLS in front of Apache; host-based fallback.
    $host = $_SERVER['HTTP_HOST'] ?? '';
    if ($host !== '' && substr($host, -13) === '.onrender.com') {
        return true;
    }
    return false;
}

function configureSession(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        $secure = isSecureRequest();
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        // Cross-site (GitHub Pages -> InfinityFree) needs SameSite=None + Secure.
        // Same-site (InfinityFree -> InfinityFree) works best with Lax.
        $isCrossSite = $origin !== '' && strpos($origin, 'github.io') !== false;
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '',
            'secure' => $secure,
            'httponly' => true,
            'samesite' => $isCrossSite ? 'None' : 'Lax',
        ]);
        session_start();
    }
}
