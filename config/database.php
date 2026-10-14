<?php
/**
 * PDO database connection — single shared instance via db().
 */

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // Database missing? Send the visitor to the installer.
        if (!defined('AMATETA_INSTALLER')) {
            $installer = BASE_PATH . '/install.php';
            header('Location: ' . $installer);
            exit('<h2 style="font-family:sans-serif">Database not ready.</h2>
                  <p>Please <a href="' . htmlspecialchars($installer) . '">run the installer</a>.</p>');
        }
        throw $e;
    }
    return $pdo;
}
