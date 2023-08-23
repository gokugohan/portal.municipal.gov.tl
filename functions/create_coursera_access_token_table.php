<?php
/*
 * INITIATE TABLE COURSERA USERS
 */

add_action('init', 'create_table_coursera_access_token');

function create_table_coursera_access_token()
{
    global $wpdb;
    global $charset_collate;
    global $db_version;
    $table_name = $wpdb->prefix . "coursera_access_token";
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
            id autoincrement NOT NULL PRIMARY KEY,
            access_token text,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)$charset_collate;";
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");

//        var_dump($sql);
//        die();
        dbDelta($sql);
//
//        if (!isset($wpdb->coursera_table)) {
//            $wpdb->coursera_table = $table_name;
//            //add the shortcut so you can use $wpdb->stats
//            $wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
//        }
    }

}//create_table_coursera_user
