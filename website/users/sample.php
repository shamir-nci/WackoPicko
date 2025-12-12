<?php require_once(__DIR__ . "/bootstrap.php"); ?>
<?php
require_once __DIR__ . '/mysql-compat.php';
  // Terrible hack, but allows us to get around duplicating the view code.
$usercheck = False;
include("view.php");

?>