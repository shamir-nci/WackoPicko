<?php

require_once("../include/users.php");
require_once("../include/functions.php");

if(session_status()==PHP_SESSION_NONE){@session_start();}
require_login();

Users::logout();

http_redirect("/");


?>