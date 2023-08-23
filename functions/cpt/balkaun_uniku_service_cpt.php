<?php

add_action('init', 'register_balkaun_uniku_cpt');
//add_action('init', 'register_taxonomy_balkaun_uniku_cpt');
function register_balkaun_uniku_cpt()
{


    $labels = array(
        'name' => 'Balkaun Uniku Service',
//        'singular_name' => 'Balkaun Uniku Service',
        'menu_name' => 'Balkaun Uniku Service',
        'name_admin_bar' => 'Balkaun Uniku-Service',
//        'archives' => 'Item Archives',
//        'attributes' => 'Item Attributes',
//        'parent_item_colon' => 'Parent Item:',
        'all_items' => 'All Services',
        'add_new_item' => 'Add New Service',
//        'add_new' => 'Add New',
//        'new_item' => 'New Item',
//        'edit_item' => 'Edit Faq',
//        'view_item' => 'View Item',
//        'view_items' => 'View Items',
//        'search_items' => 'Search Item',
//        'not_found' => 'Not found',
//        'not_found_in_trash' => 'Not found in Trash',
    );
    $args = array(
        'description' => 'Post Type Description',
        'labels' => $labels,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
//        'menu_position'       => 5,
        'query_var' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'balkaun-uniku-service'),
        'capability_type' => 'post',
    );
    register_post_type('balkaununiku', $args);
}

function register_taxonomy_balkaun_uniku_cpt()
{

    $labels = array(
        'name' => 'Category',
        'singular_name' => 'Category',
        'menu_name' => 'Category',
        'all_items' => 'All Categories',
        'parent_item' => 'Parent Item',
        'parent_item_colon' => 'Parent Item:',
        'new_item_name' => 'New Item Name',
        'add_new_item' => 'Add Category',
        'add_new' => 'Add Category',
        'edit_item' => 'Edit Category',
        'view_item' => 'View Item',
        'separate_items_with_commas' => 'Separate items with commas',
        'add_or_remove_items' => 'Add or remove items',
        'choose_from_most_used' => 'Choose from the most used',
        'popular_items' => 'Popular Items',
        'search_items' => 'Search Items',
        'not_found' => 'Not Found',
        'no_terms' => 'No items',
        'items_list' => 'Items list',
        'items_list_navigation' => 'Items list navigation',

    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'publicly_queryable' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'show_in_rest' => true,
        'rewrite' => array(
            'slug' => 'balkaun-uniku-service-category',
            'with_front' => false,
            'feeds' => true,
        ),
    );
    register_taxonomy('balkaun_category', array('balkaununiku'), $args);
}
