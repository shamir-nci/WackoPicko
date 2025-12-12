<?php
// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load mysql compatibility layer
require_once(__DIR__ . '/website/include/mysql-compat.php');
?>
