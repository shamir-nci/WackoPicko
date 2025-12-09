Vuln #6 - Directory Traversal / Path Traversal Attack

Attacker uses ../ and / characters to escape the upload folder and write PHP files to dangerous locations (like admin folder). Attacker then executes the PHP file to get Remote Code Execution (RCE).

Location:
File: WackoPicko/pictures/upload.php

// Vuln Code:
$filename = "../upload/{$_POST['tag']}/{$_POST['name']}";

// Fixed Code:
$_POST['tag'] = str_replace("..", "", $_POST['tag']);
$_POST['tag'] = str_replace("/", "", $_POST['tag']);
$_POST['tag'] = str_replace("\\", "", $_POST['tag']);

$filename = "../upload/{$_POST['tag']}/{$_POST['name']}";

// How Attack Works?

//Attacker Input:

Tag: "../../admin"
Filename: "shell.php"

// Without Fix:

Path: ../upload/../../admin/shell.php = ../admin/shell.php
File written to: /admin/shell.php ❌
Attacker can access: wackopicko.com/admin/shell.php ❌

// With Fix:
Tag cleaned: "../../admin" → "admin"
Path: ../upload/admin/shell.php
File written to: /upload/admin/shell.php ✅
Safe - attacker cannot access admin folder ✅

upload.php- Added str_replace() to remove .., /, \ from tag parameter