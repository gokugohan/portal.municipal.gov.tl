<?php

add_action('init', 'register_faq_cpt');
add_action('init', 'register_taxonomy_faq_cpt');

function register_faq_cpt()
{


    $labels = array(
        'name' => 'Frequently Ask question',
        'singular_name' => 'Faq',
        'menu_name' => 'Faq',
        'name_admin_bar' => 'Frequently Ask question',
        'archives' => 'Item Archives',
        'attributes' => 'Item Attributes',
        'parent_item_colon' => 'Parent Item:',
        'all_items' => 'All Faq',
        'add_new_item' => 'Add New Faq',
        'add_new' => 'Add New',
        'new_item' => 'New Item',
        'edit_item' => 'Edit Faq',
        'view_item' => 'View Item',
        'view_items' => 'View Items',
        'search_items' => 'Search Item',
        'not_found' => 'Not found',
        'not_found_in_trash' => 'Not found in Trash',
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
        'rewrite' => array('slug' => 'faqs'),
        'capability_type' => 'post',
    );
    register_post_type('faq', $args);
}

function register_taxonomy_faq_cpt()
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
            'slug' => 'faq_category',
            'with_front' => false,
            'feeds' => true,
        ),
    );
    register_taxonomy('faq_category', array('faq'), $args);
}
