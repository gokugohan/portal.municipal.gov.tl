<?php

add_action('init', 'register_municipality_cpt');
//add_action('init', 'register_taxonomy_municipality_cpt');

function register_municipality_cpt()
{


    $labels = array(
        'name' => 'Municipalities',
        'singular_name' => 'Municipality',
        'menu_name' => 'Municipality',
        'name_admin_bar' => 'Municipalities',
        'archives' => 'Item Archives',
        'attributes' => 'Item Attributes',
        'parent_item_colon' => 'Parent Item:',
        'all_items' => 'All Municipalities',
        'add_new_item' => 'Add New Municipality',
        'add_new' => 'Add New',
        'new_item' => 'New Item',
        'edit_item' => 'Edit Municipality',
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
        'supports' => array('title', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
//        'menu_position'       => 5,
        'query_var' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'municipalities'),
        'capability_type' => 'post',
    );
    register_post_type('municipality', $args);
}


add_action('cmb2_init', 'municipality_metaboxes');

function municipality_metaboxes()
{
    // Start with an underscore to hide fields from custom fields list
    $prefix = 'municipality_profile';

    $settings = new_cmb2_box(array(
        'id' => 'municipality_profile_settings',
        'title' => 'Settings',
        'object_types' => array('municipality'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,

    ));

    $settings->add_field(array(
        'name' => 'Website url',
        'id' => $prefix . 'website',
        'type' => 'text_url',
        'desc'    => 'Municipality homepage url',
    ));

    $settings->add_field(array(
        'name' => 'Total Population',
        'id' => $prefix . 'population',
        'type' => 'text',
        'desc'    => 'Number of population',
        'default' => '0',
    ));
    $settings->add_field(array(
        'name' => 'Surface Area',
        'id' => $prefix . 'surface',
        'type' => 'text',
        'desc'    => 'Total surface area',
        'default' => '0',
    ));
    $settings->add_field(array(
        'name' => 'Language',
        'id' => $prefix . 'language',
        'type' => 'text',
    ));
    $settings->add_field(array(
        'name' => 'Capital',
        'id' => $prefix . 'capital',
        'type' => 'text',
        'desc'    => 'Capital of municipal',
    ));
}
