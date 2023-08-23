<?php

add_action('init', 'register_balkaun_uniku_values_cpt');
function register_balkaun_uniku_values_cpt()
{


    $labels = array(
        'name' => 'Balkaun Uniku - Values',
//        'singular_name' => 'Balkaun Uniku Service',
        'menu_name' => 'Balkaun Uniku Values',
        'name_admin_bar' => 'Balkaun Uniku-Values',
        'all_items' => 'All Values',
        'add_new_item' => 'Add Value',
    );
    $args = array(
        'description' => 'Post Type Description',
        'labels' => $labels,
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
//        'menu_position'       => 5,
        'query_var' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'balkaun-uniku-values'),
        'capability_type' => 'post',
    );
    register_post_type('balkaun-uniku-values', $args);
}
