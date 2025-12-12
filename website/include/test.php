<?php require_once(__DIR__ . "/bootstrap.php"); ?>
<?php
require_once("users.php");
phpinfo();
$res = Users::get_user(3);
print_r($res);
?>