// Vuln #5 - Weak Session Management

Admin session IDs are auto-incrementing (1, 2, 3, 4...). Attackers can guess the next session ID and hijack admin accounts.

// File: WackoPicko/website/include/admins

// Function: login_admin($adminid) 

Vuln Code:

function login_admin($adminid)
{
    $query = sprintf("INSERT into `admin_session` (`id`, `admin_id`, `created_on`) VALUES (NULL, '%s', NOW());",
           mysql_real_escape_string($adminid));
    if ($res = mysql_query($query))
    {
        $id = mysql_insert_id();
        setcookie("session", $id);
        return mysql_insert_id();
    }
    else
    {
        return False;
    }
}

// Fixed Code:

function login_admin($adminid)
{
    $query = sprintf("INSERT into `admin_session` (`id`, `admin_id`, `created_on`) VALUES (NULL, '%s', NOW());",
           mysql_real_escape_string($adminid));
    if ($res = mysql_query($query))
    {
        $session_id = bin2hex(random_bytes(32));
        $update_query = sprintf("UPDATE `admin_session` SET `id` = '%s' WHERE `id` = '%d' LIMIT 1;",
               mysql_real_escape_string($session_id),
               mysql_insert_id());
        mysql_query($update_query);
        setcookie("session", $session_id);
        return $session_id;
    }
    else
    {
        return False;
    }
}