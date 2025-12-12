<?php require_once(__DIR__ . "/bootstrap.php"); ?>
<?php
require_once __DIR__ . '/mysql-compat.php';

$username = "wackopicko";
$pass = "webvuln!@#";
$database = "wackopicko";

require_once("database.php");
$db = new DB("localhost", $username, $pass, $database);


?>