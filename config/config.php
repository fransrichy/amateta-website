<?php
/**
 * AMATETA Techs & Designs — Global Configuration
 * Loaded by every public page and admin script.
 */

/* ----------  Environment (local XAMPP vs live host)  ----------
 * Detection is by install path/hostname so the same code works in both places. */
$__h = strtolower($_SERVER['HTTP_HOST'] ?? '');
$__isLocal = (stripos(__DIR__, 'xampp') !== false)         // local XAMPP install path
          || strpos($__h, 'localhost') !== false
          || strpos($__h, '127.0.0.1') !== false
          || $__h === '::1';

// Errors are shown while developing locally and always hidden (but logged) live.
define('AMATETA_DEV', $__isLocal);
error_reporting(E_ALL);
ini_set('display_errors', AMATETA_DEV ? '1' : '0');
ini_set('log_errors', '1');
date_default_timezone_set('Africa/Windhoek');

/* ----------  Hardened session + security headers  ---------- */
$__https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,          // JavaScript can never read the session cookie
        'secure'   => $__https,      // HTTPS-only on the live site
        'samesite' => 'Lax',         // blocks cross-site request forgery
    ]);
    session_name('AMATETASESS');
    session_start();
}

if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    header_remove('X-Powered-By');
}

if ($__isLocal) {
    define('DB_HOST', getenv('AMATETA_DB_HOST') ?: '127.0.0.1');
    define('DB_NAME', getenv('AMATETA_DB_NAME') ?: 'amateta_db');
    define('DB_USER', getenv('AMATETA_DB_USER') ?: 'root');
    define('DB_PASS', getenv('AMATETA_DB_PASS') ?: '');
} else {
    // Production secrets must be configured in cPanel/Apache, never committed.
    define('DB_HOST', getenv('AMATETA_DB_HOST') ?: 'localhost');
    define('DB_NAME', getenv('AMATETA_DB_NAME') ?: '');
    define('DB_USER', getenv('AMATETA_DB_USER') ?: '');
    define('DB_PASS', getenv('AMATETA_DB_PASS') ?: '');
}
define('DB_CHARSET', 'utf8mb4');

/* ----------  Filesystem paths  ---------- */
define('APP_ROOT',   dirname(__DIR__));
define('UPLOAD_PATH', APP_ROOT . '/uploads');

/* ----------  Base URL (auto-detected, handles sub-folder + spaces)  ---------- */
$__scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$__host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
$__docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'], '/')) : '';
$__appWeb  = str_replace('\\', '/', APP_ROOT);
$__basePath = '';
if ($__docRoot && stripos($__appWeb, $__docRoot) === 0) {
    $__basePath = substr($__appWeb, strlen($__docRoot));
}
$__basePath = trim($__basePath, '/');
$__encodedBase = $__basePath
    ? '/' . implode('/', array_map('rawurlencode', explode('/', $__basePath)))
    : '';
define('BASE_PATH', $__encodedBase);                       // e.g. /Amateta%20Main%20Website
define('APP_URL', $__scheme . '://' . $__host . $__encodedBase);

/* ----------  Company defaults (overridable from Admin → Settings)  ---------- */
define('COMPANY_NAME',   'AMATETA Techs & Designs');
define('DEFAULT_WHATSAPP', '264853441248');
define('DEFAULT_EMAIL',  'info@amateta.com');
define('ORDER_EMAIL',    'order@amateta.com');   // main inbox: enquiries + sender address

/* ----------  Load core libraries  ---------- */
require_once APP_ROOT . '/config/database.php';
require_once APP_ROOT . '/includes/functions.php';
require_once APP_ROOT . '/includes/security.php';
require_once APP_ROOT . '/includes/mailer.php';
require_once APP_ROOT . '/includes/layout.php';
