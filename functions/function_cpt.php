<?php

require_once('custom_function.php');

function admin_enqueue_styles()
{
    if(get_current_screen()->id == 'balkaun-uniku'){
        wp_enqueue_style('leaflet_css', get_template_directory_uri(). '/assets/map/css/leaflet.css',true);
        wp_enqueue_style('leaflet_css_map', get_template_directory_uri(). '/assets/map/css/leaflet_map.css',true);
    }
}

add_action('admin_enqueue_scripts', 'admin_enqueue_styles');

function admin_enqueue_scripts()
{
    if(get_current_screen()->id == 'balkaun-uniku'){
        wp_enqueue_script('leafelt_js', get_template_directory_uri(). '/assets/map/js/leaflet.js', array('jquery'), '', true);
        wp_enqueue_script('leafelt_js_load_map', get_template_directory_uri(). '/assets/map/js/poi_admin.js', array('jquery'), '', true);
        wp_enqueue_script('leafelt_js_swall', get_template_directory_uri(). '/assets/js/sweetalert2@10.js', array('jquery'), '', true);
    }
}

add_action('admin_enqueue_scripts', 'admin_enqueue_scripts');

/*
 * +++++++++++++++++++++++++++++++++++++++++++++
 * */

flush_rewrite_rules(false);

// Change default "Enter Title Here" text for admin area based on CPT
function change_default_title($title)
{
    $screen = get_current_screen();
    if ('events' == $screen->post_type) {
        $title = 'Enter new event name here';
    }
    return $title;
}
//add_filter( 'enter_title_here', 'change_default_title' );
