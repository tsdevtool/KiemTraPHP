<?php
/**
 * Application initialization file - include this at the very top of every page
 * This ensures session is started before any output
 */

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include necessary configuration and common functions
require_once "config/Database.php";

// Set error reporting based on environment (should be disabled in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize database connection that can be used across the application
function getDbConnection() {
    static $db = null;
    if ($db === null) {
        $db = (new Database())->getConnection();
    }
    return $db;
} 