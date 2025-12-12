<?php require_once(__DIR__ . "/../bootstrap.php"); ?>


$page = $_GET['page'] . '.php';
require_once($page);

?>