<?php
/**
 * Guestbook Class - Fixed for PHP 8.x compatibility
 * Works with mysql-compat.php PDO layer
 */

// Load compatibility layer
require_once __DIR__ . '/mysql-compat.php';

// Load database connection
require_once __DIR__ . '/ourdb.php';

class Guestbook {
    static public $GUESTBOOK_URL = "/guestbook.php";
    
    private $to_return = array();
    
    /**
     * Get all guestbook entries
     * Fixed: Initialize array before use
     */
    public function get_all_guestbooks() {
        $this->to_return = array();
        
        $query = "SELECT `id`, `name`, `comment`, `created_on` FROM `guestbook` ORDER BY `created_on` DESC;";
        
        $res = mysql_query($query);
        
        if ($res) {
            while ($row = mysql_fetch_assoc($res)) {
                $this->to_return[] = $row;
            }
            return $this->to_return;
        } else {
            return array(); // Return empty array instead of False
        }
    }
    
    /**
     * Add guestbook entry
     * Fixed: Both name and comment are properly escaped
     * $vuln parameter can demonstrate XSS vulnerability when True
     */
    public function add_guestbook($name, $comment, $vuln = false) {
        // Sanitize inputs
        $name = trim((string)$name);
        $comment = trim((string)$comment);
        
        if (empty($name) || empty($comment)) {
            return false;
        }
        
        // Build query with proper escaping
        if ($vuln) {
            // VULNERABLE: Name is NOT escaped (XSS vulnerability)
            $query = sprintf(
                "INSERT INTO `guestbook` (`id`, `name`, `comment`, `created_on`) VALUES (NULL, '%s', '%s', NOW());",
                $name,
                mysql_real_escape_string($comment)
            );
        } else {
            // SAFE: Both name and comment are escaped
            $query = sprintf(
                "INSERT INTO `guestbook` (`id`, `name`, `comment`, `created_on`) VALUES (NULL, '%s', '%s', NOW());",
                mysql_real_escape_string($name),
                mysql_real_escape_string($comment)
            );
        }
        
        $result = mysql_query($query);
        return $result !== false ? true : false;
    }
    
    /**
     * Get guestbook entries (non-static version for flexibility)
     */
    public function getAllEntries() {
        return $this->get_all_guestbooks();
    }
    
    /**
     * Add entry with option to demonstrate vulnerabilities
     */
    public function addEntry($name, $comment, $demonstrate_xss = false) {
        return $this->add_guestbook($name, $comment, $demonstrate_xss);
    }
}

?>