<?php
require_once __DIR__ . '/mysql-compat.php';
/**
 * MySQL Legacy Compatibility Layer
 * 
 * This file provides compatibility for deprecated mysql_* functions
 * that were removed in PHP 7.0
 * 
 * Include this file at the very beginning of your application:
 * require_once __DIR__ . '/mysql-compat.php';
 * 
 * Supports: mysql_error(), mysql_errno(), mysqli conversions
 */

if (!defined('MYSQL_COMPAT_LOADED')) {
    define('MYSQL_COMPAT_LOADED', true);

    // Store the last connection globally
    global $___mysql_last_connection;
    global $___mysql_last_error;
    global $___mysql_last_errno;

    /**
     * Replacement for deprecated mysql_error()
     * Returns error text from the last MySQL operation
     * 
     * @param resource $link_identifier Optional. Connection resource.
     * @return string Error message or empty string
     */
    if (!function_exists('mysql_error')) {
        function mysql_error($link_identifier = null) {
            global $___mysql_last_connection, $___mysql_last_error;
            
            if ($link_identifier === null) {
                return isset($___mysql_last_error) ? $___mysql_last_error : '';
            }
            
            if ($link_identifier instanceof mysqli) {
                return $link_identifier->error;
            }
            
            return '';
        }
    }

    /**
     * Replacement for deprecated mysql_errno()
     * Returns error number from the last MySQL operation
     * 
     * @param resource $link_identifier Optional. Connection resource.
     * @return int Error number or 0
     */
    if (!function_exists('mysql_errno')) {
        function mysql_errno($link_identifier = null) {
            global $___mysql_last_connection, $___mysql_last_errno;
            
            if ($link_identifier === null) {
                return isset($___mysql_last_errno) ? $___mysql_last_errno : 0;
            }
            
            if ($link_identifier instanceof mysqli) {
                return $link_identifier->errno;
            }
            
            return 0;
        }
    }

    /**
     * Store error information from MySQLi operations
     * Call this after your database queries for proper error tracking
     * 
     * @param mysqli $connection Database connection
     */
    function store_mysql_error($connection) {
        global $___mysql_last_connection, $___mysql_last_error, $___mysql_last_errno;
        
        if ($connection instanceof mysqli) {
            $___mysql_last_connection = $connection;
            $___mysql_last_error = $connection->error;
            $___mysql_last_errno = $connection->errno;
        }
    }

    /**
     * Modern replacement - get error safely from MySQLi
     * Use this in your new code
     * 
     * @param mysqli $connection Database connection
     * @return array ['error' => string, 'errno' => int]
     */
    function get_db_error($connection) {
        if ($connection instanceof mysqli) {
            return [
                'error' => $connection->error,
                'errno' => $connection->errno
            ];
        }
        return ['error' => '', 'errno' => 0];
    }
}
?>
