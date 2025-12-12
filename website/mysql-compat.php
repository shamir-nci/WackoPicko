<?php require_once(__DIR__ . "/bootstrap.php"); ?>
<?php
/**
 * MySQL Legacy Compatibility Layer - Using PDO (Extended)
 * Supports mysql_connect, mysql_select_db, mysql_query, mysql_fetch_array, mysql_set_charset, etc.
 */

if (!defined('MYSQL_COMPAT_LOADED')) {
    define('MYSQL_COMPAT_LOADED', true);

    global $___mysql_connection;
    global $___mysql_result;
    global $___mysql_last_error;
    global $___mysql_last_errno;

    if (!function_exists('mysql_connect')) {
        function mysql_connect($server = 'localhost', $username = 'root', $password = '', $new_link = false, $client_flags = 0) {
            global $___mysql_connection, $___mysql_last_error, $___mysql_last_errno;
            try {
                $dsn = "mysql:host=$server";
                $___mysql_connection = new PDO($dsn, $username, $password);
                $___mysql_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $___mysql_connection;
            } catch (PDOException $e) {
                $___mysql_last_error = $e->getMessage();
                $___mysql_last_errno = $e->getCode();
                return false;
            }
        }
    }

    if (!function_exists('mysql_select_db')) {
        function mysql_select_db($database_name, $link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return false;
            try {
                $conn->exec("USE `$database_name`");
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
    }

    if (!function_exists('mysql_set_charset')) {
        function mysql_set_charset($charset_name, $link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return false;
            try {
                $conn->exec("SET NAMES '$charset_name'");
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
    }

    if (!function_exists('mysql_query')) {
        function mysql_query($query, $link_identifier = null) {
            global $___mysql_connection, $___mysql_result, $___mysql_last_error, $___mysql_last_errno;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) {
                $___mysql_last_error = 'No connection';
                return false;
            }
            try {
                $result = $conn->query($query);
                $___mysql_result = $result;
                return $result;
            } catch (PDOException $e) {
                $___mysql_last_error = $e->getMessage();
                $___mysql_last_errno = $e->getCode();
                return false;
            }
        }
    }

    if (!function_exists('mysql_fetch_array')) {
        function mysql_fetch_array($result, $result_type = MYSQLI_BOTH) {
            if (!$result || !($result instanceof PDOStatement)) return false;
            return $result->fetch(PDO::FETCH_BOTH);
        }
    }

    if (!function_exists('mysql_fetch_assoc')) {
        function mysql_fetch_assoc($result) {
            if (!$result || !($result instanceof PDOStatement)) return false;
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }

    if (!function_exists('mysql_fetch_row')) {
        function mysql_fetch_row($result) {
            if (!$result || !($result instanceof PDOStatement)) return false;
            return $result->fetch(PDO::FETCH_NUM);
        }
    }

    if (!function_exists('mysql_num_rows')) {
        function mysql_num_rows($result) {
            if (!$result || !($result instanceof PDOStatement)) return 0;
            return $result->rowCount();
        }
    }

    if (!function_exists('mysql_affected_rows')) {
        function mysql_affected_rows($link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return -1;
            return $conn->lastRowCount ?? 0;
        }
    }

    if (!function_exists('mysql_insert_id')) {
        function mysql_insert_id($link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return 0;
            return $conn->lastInsertId() ?? 0;
        }
    }

    if (!function_exists('mysql_error')) {
        function mysql_error($link_identifier = null) {
            global $___mysql_last_error;
            return isset($___mysql_last_error) ? $___mysql_last_error : '';
        }
    }

    if (!function_exists('mysql_errno')) {
        function mysql_errno($link_identifier = null) {
            global $___mysql_last_errno;
            return isset($___mysql_last_errno) ? $___mysql_last_errno : 0;
        }
    }

    if (!function_exists('mysql_close')) {
        function mysql_close($link_identifier = null) {
            global $___mysql_connection;
            $___mysql_connection = null;
            return true;
        }
    }

    if (!function_exists('mysql_real_escape_string')) {
        function mysql_real_escape_string($unescaped_string, $link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return addslashes($unescaped_string);
            return substr($conn->quote($unescaped_string), 1, -1);
        }
    }

    if (!function_exists('mysql_result')) {
        function mysql_result($result, $row = 0, $field = 0) {
            if (!$result || !($result instanceof PDOStatement)) return false;
            $data = $result->fetchAll(PDO::FETCH_BOTH);
            if (!isset($data[$row])) return false;
            return $data[$row][$field] ?? false;
        }
    }

    if (!function_exists('mysql_num_fields')) {
        function mysql_num_fields($result) {
            if (!$result || !($result instanceof PDOStatement)) return 0;
            return $result->columnCount();
        }
    }

    if (!function_exists('mysql_fetch_object')) {
        function mysql_fetch_object($result, $class_name = 'stdClass', $constructor_args = array()) {
            if (!$result || !($result instanceof PDOStatement)) return false;
            return $result->fetchObject($class_name);
        }
    }

    if (!function_exists('mysql_list_tables')) {
        function mysql_list_tables($database_name, $link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return false;
            try {
                $result = $conn->query("SHOW TABLES FROM `$database_name`");
                return $result;
            } catch (PDOException $e) {
                return false;
            }
        }
    }

    if (!function_exists('mysql_field_name')) {
        function mysql_field_name($result, $field_offset = 0) {
            if (!$result || !($result instanceof PDOStatement)) return false;
            $colMeta = $result->getColumnMeta($field_offset);
            return $colMeta ? $colMeta['name'] : false;
        }
    }

    if (!function_exists('mysql_list_fields')) {
        function mysql_list_fields($database_name, $table_name, $link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return false;
            try {
                $result = $conn->query("SHOW COLUMNS FROM `$database_name`.`$table_name`");
                return $result;
            } catch (PDOException $e) {
                return false;
            }
        }
    }

    if (!function_exists('mysql_db_query')) {
        function mysql_db_query($database_name, $query, $link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!mysql_select_db($database_name, $conn)) return false;
            return mysql_query($query, $conn);
        }
    }

    if (!function_exists('mysql_list_dbs')) {
        function mysql_list_dbs($link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return false;
            try {
                $result = $conn->query("SHOW DATABASES");
                return $result;
            } catch (PDOException $e) {
                return false;
            }
        }
    }

    if (!function_exists('mysql_get_server_info')) {
        function mysql_get_server_info($link_identifier = null) {
            global $___mysql_connection;
            $conn = ($link_identifier !== null) ? $link_identifier : $___mysql_connection;
            if (!$conn) return false;
            try {
                $result = $conn->query("SELECT VERSION() as version");
                $data = $result->fetch(PDO::FETCH_ASSOC);
                return $data['version'] ?? false;
            } catch (PDOException $e) {
                return false;
            }
        }
    }

    if (!function_exists('mysql_get_client_info')) {
        function mysql_get_client_info() {
            return phpversion('pdo_mysql') ?: 'unknown';
        }
    }
}
?>
