<?php
error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 0);

// Load compatibility layer FIRST
require_once __DIR__ . '/mysql-compat.php';

// Then load other includes
$includes = [
    'database.php',
    'users.php', 
    'html_functions.php',
    'functions.php'
];

foreach ($includes as $file) {
    $path = __DIR__ . '/include/' . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}
?>
