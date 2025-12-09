// SQL Injection - Vulnerbility #1, #2 and #3

This file contains user authentication and management functions. It handles user login, registration, and user search operations that interact directly with the database.

// Functions In This FIle:

Check_login() - User authentication and login
Create_user() - Create a new user

**** User input (username) is used directly in a SQL query without proper escaping. An attacker can inject SQL syntax to bypass password validation.****

----------------------------------------------------------------------------------------------------

// Vuln 1 (Code + Fix)

Vuln Code:

$query = sprintf("SELECT * from `users` where `login` like '%s' and `password` = SHA1( CONCAT('%s', `salt`)) limit 1;",
                      $username,
                      mysql_real_escape_string($pass)); 

Fix: Just add “mysql_real_escape_string” before the username.

----------------------------------------------------------------------------------------------------

// Vuln 2 (Code + Fix): 

$query = "SELECT * from `users` where `firstname` like '%{$login}%' and firstname != '{$login}'";

// Fix 1 - Add Sprintf:

$query = sprintf("SELECT * from `users` where `firstname` like '%%%s%%' and firstname != '%s'",
                 $login,
                 $login);

// Fix 2 - Add escaping:
$query = sprintf("SELECT * from `users` where `firstname` like '%%%s%%' and firstname != '%s'",
                 mysql_real_escape_string($login),
                 mysql_real_escape_string($login));

----------------------------------------------------------------------------------------------------

// Vuln 3: (Code + Fix): 

Vuln Code:

  $query = "INSERT INTO `users` (`id`, `login`, `password`, `firstname`, `lastname`, `salt`, `tradebux`, `created_on`, `last_login_on`) VALUES (NULL, '{$username}', SHA1('{$pass}'), '{$firstname}', '{$lastname}','{$salt}', '{$initial_bux}', NOW(), NOW());";

Fix: Use sprintf() with mysql_real_escape_string() on ALL variables, including $username and $lastname.

