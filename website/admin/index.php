<?php
require_once __DIR__ . '/mysql-compat.php';

$page = $_GET['page'] . '.php';
require_once($page);

?>