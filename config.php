<?php
// FUHSA DIRD - Database Configuration
// Update these credentials to match your MySQL server

define('DB_HOST', 'localhost');
define('DB_NAME', 'fuhsa_dird');
define('DB_USER', 'root');
define('DB_PASS', '');

// Admin credentials (change in production)
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'Fuhsa@DIRD2025');

// Upload directory
define('UPLOAD_DIR', 'uploads/');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Get PDO database connection
 */
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            error_log("DB Connection Error: " . $e->getMessage());
            return null;
        }
    }
    return $pdo;
}

/**
 * Check if user is admin
 */
function isAdmin() {
    return isset($_SESSION['fuhsa_admin']) && $_SESSION['fuhsa_admin'] === true;
}

/**
 * Sanitize input
 */
function clean($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}

/**
 * Format currency (Naira)
 */
function formatNaira($amount) {
    return '₦' . number_format($amount, 2);
}
?>
