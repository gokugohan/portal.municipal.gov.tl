<?php
/*
 * INITIATE TABLE COURSERA USERS
 */

add_action('init', 'create_table_coursera_user');

function create_table_coursera_user()
{
    global $wpdb;
    global $charset_collate;
    global $db_version;
    $table_name = $wpdb->prefix . "coursera_users";
    $charset_collate = $wpdb->get_charset_collate();


    /*
     * CREATE TABLE wp_coursera_users (
     * uid VARCHAR(30) NOT NULL PRIMARY KEY,
     * firstName varchar(100) NOT NULL,
     * lastName varchar(100) NOT NULL,
     * email varchar(100) NOT NULL,
     * eduPersonPrincipalName varchar(100) NOT NULL,
     * password TEXT NOT NULL,
     * salt TEXT NOT NULL,
     * created_by varchar(100),
     * updated_by varchar(100),
     * created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
     * updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);
     */
    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
            uid VARCHAR(30) NOT NULL PRIMARY KEY,
            password VARBINARY(50) NOT NULL,
            firstName varchar(100) NOT NULL,
            lastName varchar(100) NOT NULL,
            email varchar(100) NOT NULL UNIQUE,
            eduPersonPrincipalName varchar(100) NOT NULL UNIQUE,
            created_by varchar(100),
            updated_by varchar(100),
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
