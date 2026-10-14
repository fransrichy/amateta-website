<?php
/**
 * Legacy handler kept only so old bookmarks and cached links keep working.
 *
 * The real contact form now lives in contact.php, which stores the enquiry in
 * the database, emails order@amateta.com and sends the visitor a branded
 * confirmation. The old Google reCAPTCHA integration was removed — the site
 * uses its own maths question, honeypot, timer and rate limiting instead, so
 * no third-party script or chat bot runs on the site.
 */
require_once __DIR__ . '/config/config.php';

header('Location: ' . url('contact.php'), true, 301);
exit;
