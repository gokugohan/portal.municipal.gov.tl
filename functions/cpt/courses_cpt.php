<?php

add_action('init', 'register_course_cpt');
add_action('init', 'register_taxonomy_course_cpt');

function register_course_cpt()
{


    $labels = array(
        'name' => 'Courses',
        'singular_name' => 'Course',
        'menu_name' => 'Courses',
        'name_admin_bar' => 'Courses',
        'parent_item_colon' => 'Parent Item:',
    );
    $args = array(
        'description' => 'Course Type Description',
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
        'rewrite' => array('slug' => 'coursera-courses'),
        'capability_type' => 'post',
    );
    register_post_type('coursera-courses', $args);
}

function register_taxonomy_course_cpt()
{

    $labels = array(
        'name' => 'Category',
        'singular_name' => 'Category',
        'menu_name' => 'Category',
        'all_items' => 'All Categories',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'query_var'    => true,
        'publicly_queryable' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'show_in_rest' => true,
        'rewrite' => array(
            'slug' => 'courses-category',
            'with_front' => false,
            'feeds' => true,
        ),
    );
    register_taxonomy('courses-category', array('coursera-courses'), $args);
}

add_action('cmb2_init', 'courses_metaboxes');

function courses_metaboxes()
{
    // Start with an underscore to hide fields from custom fields list
    $prefix = 'course_';

    $settings = new_cmb2_box(array(
        'id' => 'course_settings',
        'title' => 'Coursera Course settings',
        'object_types' => array('coursera-courses'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,

    ));
//
//
//    $settings->add_field(array(
//        'name' => 'Course name',
//        'id' => $prefix . 'name',
//        'type' => 'text',
//    ));

    $settings->add_field(array(
        'name' => 'University / Industry Partner Name',
        'id' => $prefix . 'partner',
        'type' => 'text',
    ));


    $settings->add_field(array(
        'name' => 'Difficulty',
        'id' => $prefix . 'difficulty',
        'type' => 'radio_inline',
        'options' => array(
            'Beginner' => 'Beginner',
            'Intermediate' => 'Intermediate',
            'Advanced' => 'Advanced',
        ),
        'default' => 'Beginner',
    ));

    $settings->add_field(array(
        'name' => 'Course URL',
        'id' => $prefix . 'url',
        'type' => 'text_url',
        'protocols' => array('http', 'https'), // Array of allowed protocols
    ));
    $settings->add_field(array(
        'name' => 'Skill Learned',
        'id' => $prefix . 'skill_learned',
        'type' => 'text',
    ));
    $settings->add_field(array(
        'name' => 'Specialization',
        'id' => $prefix . 'specialization',
        'type' => 'text',
    ));
    $settings->add_field(array(
        'name' => 'Course Language',
        'id' => $prefix . 'language',
        'type' => 'text',
    ));
    $settings->add_field(array(
        'name' => 'Subtitle Language',
        'id' => $prefix . 'subtitle',
        'type' => 'text',
    ));

}
