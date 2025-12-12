<?php require_once(__DIR__ . "/../bootstrap.php"); ?>
<?php
error_reporting(0);
ini_set("display_errors", 0);

echo "<h1>WackoPicko App</h1>";
echo "<p>App is running!</p>";

// Try to load actual app
if (file_exists('include/database.php')) {
    echo "<p>Database file found</p>";
} else {
    echo "<p>Database file NOT found</p>";
}

// List what's available
echo "<h2>Available Pages:</h2>";
echo "<ul>";
if (file_exists('guestbook.php')) echo "<li><a href='guestbook.php'>Guestbook</a> (SQL Injection test)</li>";
if (file_exists('admin.php')) echo "<li><a href='admin.php'>Admin</a></li>";
if (file_exists('search.php')) echo "<li><a href='search.php'>Search</a> (XSS/Directory Traversal)</li>";
echo "</ul>";
?>
