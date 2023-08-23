<?php

add_action('wp_ajax_add_new_access_token', 'add_new_access_token');
add_action('wp_ajax_nopriv_add_new_access_token', 'add_new_access_token');


function add_new_access_token()
{

    global $wpdb;
    global $current_user;
    wp_get_current_user();

    $table_name = $wpdb->prefix . "coursera_access_token";


    $access_token = esc_attr($_POST['access_token']);

    $data = array(
        "access_token" => ($access_token),
    );


    $query = "INSERT INTO $table_name(uid,access_token) values('" . $access_token . "',)";

    $results = $wpdb->get_results($query);

    die();
}//add_new_coursera_user


add_action('wp_ajax_update_access_token', 'update_access_token');
add_action('wp_ajax_nopriv_update_access_token', 'update_access_token');

function update_access_token()
{
    global $wpdb;
    global $current_user;
    wp_get_current_user();
    $table_name = $wpdb->prefix . "coursera_access_token";


    $id = esc_attr($_POST['id']);
    $access_token = esc_attr($_POST['access_token']);
    $data = array("access_token" => ($access_token));

    $wpdb->update($table_name, $data, array("id" => $id));
    die();
}//update_coursera_user

add_action('wp_ajax_get_last_access_token', 'get_last_access_token');
add_action('wp_ajax_nopriv_get_last_access_token', 'get_last_access_token');

function get_last_access_token()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "coursera_access_token";
    echo $wpdb->get_row("SELECT * FROM $table_name  ORDER BY id DESC LIMIT 1");

//    foreach ($results as $result){
//        echo $results->uid;
//        echo $results->access_token;
//        echo $results->created_at;
//        echo $results->updated_at;
//    }
    //echo $results;
    die();
}//get_coursera_users
