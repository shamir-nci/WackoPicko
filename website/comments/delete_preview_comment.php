<?php
require_once __DIR__ . '/mysql-compat.php';
require_once("../include/html_functions.php");
require_once("../include/comments.php");
require_once("../include/users.php");
require_once("../include/functions.php");
require_once("../include/pictures.php");

if(session_status()==PHP_SESSION_NONE){@if(session_status()==PHP_SESSION_NONE){@session_start();}}
require_login();

if (isset($_POST['previewid']))
{
   $cur = Users::current_user();
   Comments::delete_preview($_POST['previewid'], $cur['id']);
}
http_redirect(Pictures::$VIEW_PIC_URL . "?picid=" . $_POST['picid']);


?>