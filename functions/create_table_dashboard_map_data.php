<?php

add_action("init", "create_table_dashboard_map");

function create_table_dashboard_map()
{
    global $wpdb;
    global $charset_collate;
    global $db_version;
    $table_name = $wpdb->prefix . "dashboard_map_data";
    $charset_collate = $wpdb->get_charset_collate();


    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
            id INT NOT NULL auto_increment,
            title varchar(250) not null,
            year varchar(250),
            path varchar(250),
            created_by varchar(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_by varchar(100),
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id))$charset_collate;";
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");

        //        var_dump($sql);
        //        die();
        dbDelta($sql);
    }
}


function dashboard_map_create($data)
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();

    $table_name = $wpdb->prefix . "dashboard_map_data";
    $today = date('Y-m-d H:i:s');
    $data = array(
        "title" => strip_tags($data["title"]),
        "year" => strip_tags($data["year"]),
        "path" => strip_tags($data["path"]),
        "created_at" => $today,
        "created_by" => $current_user->user_login
    );


    // var_dump("Inserting data:");
    // var_dump($data);
    // die(1);

    $ret = $wpdb->insert($table_name, $data);
    echo $ret;
    die();
}

function dashboard_map_update($the_data)
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();
    $table_name = $wpdb->prefix . "dashboard_map_data";
    $today = date('Y-m-d H:i:s');
    $data = array(
        "title" => strip_tags($the_data["title"]),
        "year" => strip_tags($the_data["year"]),
        "path" => strip_tags($the_data["path"]),
        "updated_at" => $today,
        "updated_by" => $current_user->user_login
    );

    // var_dump("Updating data:");
    // var_dump($data);
    // die(1);

    $wpdb->update($table_name, $data, array("id" => $the_data["id"]));
}


function dashboard_map_delete($id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "dashboard_map_data";
    $wpdb->delete($table_name, array("id" => $id));
}
