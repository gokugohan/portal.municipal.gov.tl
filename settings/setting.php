<?php

add_action('admin_menu', 'theme_options_panel');
add_action('admin_init', 'settings_config');

function theme_options_panel()
{

    add_menu_page('Portal', 'Portal', 'manage_options', 'portalmunicipal-theme-options', 'setting_options_page');
    add_submenu_page('portalmunicipal-theme-options', 'Coursera Users', 'Coursera Users', 'manage_options', 'coursera-user', 'coursera_user_setting_page');

}

// add_settings_field( $id, $title, $callback, $page, $section, $args )
function add_settings_field_to_section($id, $title, $callback, $page, $section)
{
    add_settings_field($id, __($title, 'goku-setting'), $callback, $page, $section);
}

//slider_theme_setting
function add_setting_fields_the_president()
{
    //add_settings_field_to_section('setting_president_name', 'Email', 'setting_contact_email', 'the_president_theme_setting', 'setting_the_president_section');
}

function settings_config()
{

    register_setting('general_theme_setting', 'setting_settings_general');

    add_settings_section(
        'setting_general_section', __('General Settings', 'setting'), 'empty_text_render', 'general_theme_setting'
    );

    add_setting_fields_general_info();

}

function empty_text_render()
{
//    $options = get_option('setting_settings_general');
//    var_dump(trim($options['setting_visao']));
}


function render_textarea($id, $name, $content)
{
    $settings =   array(
        'wpautop' => true, // enable auto paragraph?
        'media_buttons' => false, // show media buttons?
        'textarea_name' => $name, // id of the target textarea
        'textarea_rows' => get_option('default_post_edit_rows', 10), // This is equivalent to rows="" in HTML
        'tabindex' => '',
        'editor_css' => '', //  additional styles for Visual and Text editor,
        'editor_class' => '', // sdditional classes to be added to the editor
        'teeny' => true, // show minimal editor
        'dfw' => false, // replace the default fullscreen with DFW
        'tinymce' => array(
            // Items for the Visual Tab
            'toolbar1'=> 'bold,italic,underline,bullist,numlist,link,unlink,forecolor,undo,redo,',
        ),
        'quicktags' => array(
            // Items for the Text Tab
            'buttons' => 'strong,em,underline,ul,ol,li,link,code'
        )
    );
    wp_editor($content, $id, $settings);
}


//
include_once 'setting_fragment_general.php';

//$current_page = get_current_screen()->base;
//
//var_dump($current_page);

function enqueue_script_admin($hook)
{
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/assets/css/admin_setting.css', false, '1.0.0', 'all');


//    wp_enqueue_script('admin_jquery_bootstrap', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), '', true);

    wp_enqueue_script('adming_upload_image', get_template_directory_uri() . '/assets/js/admin_setting.js', array('jquery'), '', true);
    if (!did_action('wp_enqueue_media')) {
        wp_enqueue_media();
    }

}

add_action('admin_enqueue_scripts', 'enqueue_script_admin');

