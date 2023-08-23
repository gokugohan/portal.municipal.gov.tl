<?php

class Heading_Custom_control extends WP_Customize_Control
{
    public $type = 'info';

    public function render_content()
    {
        ?>
        <h1 style="border-bottom: 1px solid #cdcdcd;"><?php echo esc_html($this->label); ?></h1>
        <?php
    }
}


if (!function_exists('municipality_panel_wp_customize_register')) {

    add_action('customize_register', 'municipality_panel_wp_customize_register');

    function municipality_panel_wp_customize_register($wp_customize)
    {
        // Panel: Basic.
        // Theme Options Panel
        $wp_customize->add_panel('municipality_theme_panel',
            array(
                'priority' => 1,
                'title' => 'Portal Settings',
                'theme_supports' => '',
                'description' => __('Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'nd_dosth'),
            )
        );


//municipality_login_background_image
        section_header($wp_customize, 'municipality_theme_panel', 'municipality_header_section', 3);
        section_login($wp_customize, 'municipality_theme_panel', 'login_section', 4);

        section_header_education_platform($wp_customize, 'municipality_theme_panel', 'education_platform_header_section', 4);

        section_balkaun_uniku($wp_customize, 'municipality_theme_panel', 'balkaun_uniku_section', 4);

        section_footer($wp_customize, 'municipality_theme_panel', 'municipality_footer_section', 5);
        section_address($wp_customize, 'municipality_theme_panel', 'municipality_address_section', 6);


    }


    function section_header($wp_customize, $panel, $section, $priority)
    {
        $wp_customize->add_section($section, array(
            'title' => 'Frontpage',
            'priority' => $priority,
            'panel' => $panel
        ));

        $wp_customize->add_setting('municipality_header_logo', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_header_logo', array(
            'label' => 'Logo',
            'description' => 'Top Header Menu Logo. Upload one here! Site logo should be rectangular and at least 320 × 112 pixels',
            'section' => $section,
            'settings' => 'municipality_header_logo',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Logo',
                'remove' => 'Remove Logo',
                'change' => 'Change Logo',
            )
        )));

        $wp_customize->add_setting('municipality_hero_image', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'diwp_logo_control_hero_image', array(
            'label' => 'Background Image',
            'description' => 'Hero Background Image. Upload one Here! Image should be at least 1024 x 250 pixels',
            'section' => $section,
            'settings' => 'municipality_hero_image',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Image',
                'remove' => 'Remove Image',
                'change' => 'Change Image',
            )
        )));


        // Setting: Hero Title
        $wp_customize->add_setting('municipality_hero_title', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Hero Title
        $wp_customize->add_control('municipality_hero_title', array(
            'label' => 'Title',
            'description' => 'Hero Title. Change Here!',
            'section' => $section,
            'settings' => 'municipality_hero_title',
            'type' => 'text'
        ));

        // Setting: Hero Description
        $wp_customize->add_setting('municipality_hero_description', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Hero Description
        $wp_customize->add_control('municipality_hero_description', array(
            'label' => 'Description',
            'description' => 'Hero Description. Change Here!',
            'section' => $section,
            'settings' => 'municipality_hero_description',
            'type' => 'textarea'
        ));
    } // section_header

    function section_login($wp_customize, $panel, $section, $priority)
    {
        $wp_customize->add_section($section, array(
            'title' => 'Login Image',
            'priority' => $priority,
            'panel' => $panel
        ));

        $wp_customize->add_setting('municipality_login_background_image', array(
//            'default' => get_theme_file_uri('img/corosal1.jpg'), // Add Default Image URL
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_login_background_image', array(
            'label' => 'Background Image',
            'description' => 'Hero Background Image. Upload one Here! Image should be at least 1024 x 250 pixels',
            'section' => $section,
            'settings' => 'municipality_login_background_image',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Image',
                'remove' => 'Remove Image',
                'change' => 'Change Image',
            )
        )));
    } // section_login


    function section_header_education_platform($wp_customize, $panel, $section, $priority)
    {
        $wp_customize->add_section($section, array(
            'title' => 'Training platform',
            'priority' => $priority,
            'panel' => $panel
        ));

        /**
         * Info
         **/
        $wp_customize->add_setting('hero_section', array(
            'default' => '',
            'sanitize_callback' => 'mytheme_text_sanitization',

        ));
        $wp_customize->add_control(new Heading_Custom_control($wp_customize, 'hero_section', array(
            'label' => 'Hero Section',
//            'description' 	=> 'Update top section of the frontpage',
            'settings' => 'hero_section',
            'section' => $section,
        )));

        $wp_customize->add_setting('municipality_education_platform_logo', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_education_platform_logo', array(
            'label' => 'Logo',
            'description'=>'Training platform Logo. Upload one here! Site logo should be rectangular and at least 320 × 112 pixels',
            'section' => $section,
            'settings' => 'municipality_education_platform_logo',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Logo',
                'remove' => 'Remove Logo',
                'change' => 'Change Logo',
            )
        )));

        $wp_customize->add_setting('municipality_education_platform_hero_image', array(
//            'default' => get_theme_file_uri('img/corosal1.jpg'), // Add Default Image URL
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'diwp_logo_control_education_platform_hero_image', array(
            'label' => 'Background Image',
            'description' => 'Hero Background Image. Upload one Here! Image should be at least 1024 x 250 pixels',
            'section' => $section,
            'settings' => 'municipality_education_platform_hero_image',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Image',
                'remove' => 'Remove Image',
                'change' => 'Change Image',
            )
        )));


        // Setting: Hero Title
        $wp_customize->add_setting('municipality_education_platform_hero_title', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Hero Title
        $wp_customize->add_control('municipality_education_platform_hero_title', array(
            'label' => 'Title',
            'description' => 'Hero Title. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_hero_title',
            'type' => 'text'
        ));

        // Setting: Hero Description 1
        $wp_customize->add_setting('municipality_education_platform_hero_description', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Hero Description 1
        $wp_customize->add_control('municipality_education_platform_hero_description', array(
            'label' => 'quote 01',
            'description' => 'Insert quote here. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_hero_description',
            'type' => 'textarea'
        ));

        $wp_customize->add_setting('municipality_education_platform_hero_bg_1', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_education_platform_hero_bg_1', array(
            'label' => 'Quote 01 Image',
            'description' => 'About Image. Upload one Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_hero_bg_1',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Image',
                'remove' => 'Remove Image',
                'change' => 'Change Image',
            )
        )));


        // Setting: Hero Description 2
        $wp_customize->add_setting('municipality_education_platform_hero_description2', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Hero Description 2
        $wp_customize->add_control('municipality_education_platform_hero_description2', array(
            'label' => 'quote 02',
            'description' => 'Insert quote here. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_hero_description2',
            'type' => 'textarea'
        ));

        $wp_customize->add_setting('municipality_education_platform_hero_bg_2', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_education_platform_hero_bg_2', array(
            'label' => 'Quote 02 Image',
            'description' => 'About Image. Upload one Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_hero_bg_2',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Image',
                'remove' => 'Remove Image',
                'change' => 'Change Image',
            )
        )));



    // Setting: Hero Description 3
        $wp_customize->add_setting('municipality_education_platform_hero_description3', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Hero Description 3
        $wp_customize->add_control('municipality_education_platform_hero_description3', array(
            'label' => 'quote 03',
            'description' => 'Insert quote here. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_hero_description3',
            'type' => 'textarea'
        ));

        $wp_customize->add_setting('municipality_education_platform_hero_bg_3', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_education_platform_hero_bg_3', array(
            'label' => 'Quote 03 Image',
            'description' => 'About Image. Upload one Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_hero_bg_3',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Image',
                'remove' => 'Remove Image',
                'change' => 'Change Image',
            )
        )));

        // Setting: Intro video
        $wp_customize->add_setting('municipality_education_platform_hero_video_url',
            array(
                'default' => '',
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
                'type' => 'theme_mod',
            )
        );

        // Control: Intro video
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'municipality_education_platform_hero_video_url',
            array(
                'label' => __('Training introduction video'),
                'description' => esc_html__('Upload the summary video for the training platform'),
                'section' => $section,
                'mime_type' => 'video',  // Required. Can be image, audio, video, application, text
                'button_labels' => array( // Optional
                    'select' => __('Select Video'),
                    'change' => __('Change Video'),
                    'default' => __('Default'),
                    'remove' => __('Remove'),
                    'placeholder' => __('No file selected'),
                    'frame_title' => __('Select Video'),
                    'frame_button' => __('Choose Video'),

                )
            )
        ));


        /**
         * Info
         **/
        $wp_customize->add_setting('about_section', array(
            'default' => '',
            'sanitize_callback' => 'mytheme_text_sanitization',

        ));
        $wp_customize->add_control(new Heading_Custom_control($wp_customize, 'about_section', array(
            'label' => 'About Section',
//            'description' 	=> 'Update top section of the frontpage',
            'settings' => 'about_section',
            'section' => $section,
        )));

        // Setting: About Title
        $wp_customize->add_setting('municipality_education_platform_about_title', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: About Title
        $wp_customize->add_control('municipality_education_platform_about_title', array(
            'label' => 'About Title',
            'description' => 'About Title. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_about_title',
            'type' => 'text'
        ));

        // Setting: About Description
        $wp_customize->add_setting('municipality_education_platform_about_description', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
//            'sanitize_callback' => 'sanitize_text'
        ));

        // Control: About Description
        $wp_customize->add_control('municipality_education_platform_about_description', array(
            'label' => 'About Description',
            'description' => 'About Description. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_about_description',
            'type' => 'textarea',

        ));

        // Setting: About description list 01
        $wp_customize->add_setting('municipality_education_platform_about_list_1', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: About description list 01
        $wp_customize->add_control('municipality_education_platform_about_list_1', array(
            'label' => 'List item 1',
            'description' => 'Add item form about description. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_about_list_1',
            'type' => 'textarea'
        ));
        // Setting: About description list 02
        $wp_customize->add_setting('municipality_education_platform_about_list_2', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: About description list 01
        $wp_customize->add_control('municipality_education_platform_about_list_2', array(
            'label' => 'List item 2',
            'description' => 'Add item form about description. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_about_list_2',
            'type' => 'textarea'
        ));
        // Setting: About description list 03
        $wp_customize->add_setting('municipality_education_platform_about_list_3', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: About description list 01
        $wp_customize->add_control('municipality_education_platform_about_list_3', array(
            'label' => 'List item 3',
            'description' => 'Add item form about description. Change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_about_list_3',
            'type' => 'textarea'
        ));


        $wp_customize->add_setting('municipality_education_platform_about_image', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'diwp_logo_control_education_platform_about_image', array(
            'label' => 'About Image',
            'description' => 'About Image. Upload one Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_about_image',
            'button_labels' => array(// All These labels are optional
                'select' => 'Select Image',
                'remove' => 'Remove Image',
                'change' => 'Change Image',
            )
        )));


//        WHAT IS TRAINING
        $wp_customize->add_setting('what_is_training_section', array(
            'default' => '',
            'sanitize_callback' => 'mytheme_text_sanitization',

        ));
        $wp_customize->add_control(new Heading_Custom_control($wp_customize, 'what_is_training_section', array(
            'label' => 'What is training section',
//            'description' 	=> 'Update top section of the frontpage',
            'settings' => 'what_is_training_section',
            'section' => $section,
        )));


        // Setting: What is training
        $wp_customize->add_setting('municipality_education_platform_what_is_training', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: What is training title
        $wp_customize->add_control('municipality_education_platform_what_is_training', array(
            'label' => 'What is training',
            'description' => 'Title change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_what_is_training',
            'type' => 'text'
        ));

        // Setting: What is training Description
        $wp_customize->add_setting('municipality_education_platform_what_is_training_description', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
//            'sanitize_callback' => 'sanitize_text'
        ));

        // Control: What is training Description
        $wp_customize->add_control('municipality_education_platform_what_is_training_description', array(
            'label' => 'What is training description',
            'description' => 'Description change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_what_is_training_description',
            'type' => 'textarea',

        ));

        // Setting: What is training 01
        $wp_customize->add_setting('municipality_education_platform_what_is_training_01', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: What is training 01
        $wp_customize->add_control('municipality_education_platform_what_is_training_01', array(
            'label' => 'What is training. 1st column title',
            'description' => 'Title change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_what_is_training_01',
            'type' => 'text'
        ));

        // Setting: What is training Description
        $wp_customize->add_setting('municipality_education_platform_what_is_training_01_description', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
//            'sanitize_callback' => 'sanitize_text'
        ));

        // Control: What is training Description
        $wp_customize->add_control('municipality_education_platform_what_is_training_01_description', array(
            'label' => 'What is training 1st column description',
            'description' => 'Description change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_what_is_training_01_description',
            'type' => 'textarea',

        ));

        // Setting: What is training 02
        $wp_customize->add_setting('municipality_education_platform_what_is_training_02', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: What is training 02
        $wp_customize->add_control('municipality_education_platform_what_is_training_02', array(
            'label' => 'What is training. 2st column title',
            'description' => 'Title change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_what_is_training_02',
            'type' => 'text'
        ));

        // Setting: What is training Description
        $wp_customize->add_setting('municipality_education_platform_what_is_training_02_description', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
//            'sanitize_callback' => 'sanitize_text'
        ));

        // Control: What is training Description
        $wp_customize->add_control('municipality_education_platform_what_is_training_02_description', array(
            'label' => 'What is training 2st column description',
            'description' => 'Description change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_what_is_training_02_description',
            'type' => 'textarea',

        ));

        // Setting: What is training 03
        $wp_customize->add_setting('municipality_education_platform_what_is_training_03', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: What is training 03
        $wp_customize->add_control('municipality_education_platform_what_is_training_03', array(
            'label' => 'What is training. 3st column title',
            'description' => 'Title change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_what_is_training_03',
            'type' => 'text'
        ));

        // Setting: What is training Description
        $wp_customize->add_setting('municipality_education_platform_what_is_training_03_description', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
//            'sanitize_callback' => 'sanitize_text'
        ));

        // Control: What is training Description
        $wp_customize->add_control('municipality_education_platform_what_is_training_03_description', array(
            'label' => 'What is training 3st column description',
            'description' => 'Description change Here!',
            'section' => $section,
            'settings' => 'municipality_education_platform_what_is_training_03_description',
            'type' => 'textarea',

        ));


        // FOOTER LOGO
//        $wp_customize->add_setting('municipality_footer_education_platform_image', array(
//            'sanitize_callback' => 'esc_url_raw',
//            'transport' => 'refresh', // Options: refresh or postMessage.
//            'capability' => 'edit_theme_options',
//        ));

        /*
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_image', array(
            'label' => 'Background Image',
            'description'=>'Footer Background Image. Upload one here! Image should be rectangular and at least 1024 × 112 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_image',
        )));
        */

        $wp_customize->add_setting('sponsors', array(
            'default' => '',
            'sanitize_callback' => 'mytheme_text_sanitization',

        ));
        $wp_customize->add_control(new Heading_Custom_control($wp_customize, 'sponsors', array(
            'label' => 'Sponsors',
//            'description' 	=> 'Update top section of the frontpage',
            'settings' => 'sponsors',
            'section' => $section,
        )));

        // Sponsor 1
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor1', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_education_platform_sponsor1', array(
            'label' => 'Sponsor 1 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor1',
        )));

        // Setting: Sponsor 1 Url
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor1_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 1 Url
        $wp_customize->add_control('municipality_footer_education_platform_sponsor1_url', array(
            'label' => 'Website of sponsor 1',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor1_url',
            'type' => 'text'
        ));


        // Sponsor 2
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor2', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_education_platform_sponsor2', array(
            'label' => 'Sponsor 2 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor2',
        )));

        // Setting: Sponsor 2 Url
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor2_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 2 Url
        $wp_customize->add_control('municipality_footer_education_platform_sponsor2_url', array(
            'label' => 'Website of sponsor 2',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor2_url',
            'type' => 'text'
        ));


        // Sponsor 3
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor3', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_education_platform_sponsor3', array(
            'label' => 'Sponsor 3 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor3',
        )));

        // Setting: Sponsor 3 Url
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor3_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 2 Url
        $wp_customize->add_control('municipality_footer_education_platform_sponsor3_url', array(
            'label' => 'Website of sponsor 3',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor3_url',
            'type' => 'text'
        ));


        // Sponsor 4
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor4', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_education_platform_sponsor4', array(
            'label' => 'Sponsor 4 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor4',
        )));

        // Setting: Sponsor 4 Url
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor4_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 4 Url
        $wp_customize->add_control('municipality_footer_education_platform_sponsor4_url', array(
            'label' => 'Website of sponsor 4',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor4_url',
            'type' => 'text'
        ));

        // Sponsor 5
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor5', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_education_platform_sponsor5', array(
            'label' => 'Sponsor 5 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor5',
        )));

        // Setting: Sponsor 5 Url
        $wp_customize->add_setting('municipality_footer_education_platform_sponsor5_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 5 Url
        $wp_customize->add_control('municipality_footer_education_platform_sponsor5_url', array(
            'label' => 'Website of sponsor 5',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_education_platform_sponsor5_url',
            'type' => 'text'
        ));


    } // section_header_education_platform


    function section_balkaun_uniku($wp_customize, $panel, $section, $priority)
    {
        $wp_customize->add_section($section, array(
            'title' => 'Balkaun Úniku',
            'priority' => $priority,
            'panel' => $panel
        ));



        // Setting: Sponsor 1 Url
        $wp_customize->add_setting('municipality_balkaun_uniku_hero', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_balkaun_uniku_hero', array(
            'label' => 'Image',
            'description' => 'Hero Image. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_balkaun_uniku_hero',
        )));

    } // section_balkaun_uniku

    function section_footer($wp_customize, $panel, $section, $priority)
    {
        $wp_customize->add_section($section, array(
            'title' => 'Footer',
            'priority' => $priority,
            'panel' => $panel
        ));


        $wp_customize->add_setting('municipality_footer_image', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        /*
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_image', array(
            'label' => 'Background Image',
            'description'=>'Footer Background Image. Upload one here! Image should be rectangular and at least 1024 × 112 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_image',
        )));
        */

        // Sponsor 1
        $wp_customize->add_setting('municipality_footer_sponsor1', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options'
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_sponsor1', array(
            'label' => 'Sponsor 1 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor1',
        )));

        // Setting: Sponsor 1 Url
        $wp_customize->add_setting('municipality_footer_sponsor1_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 1 Url
        $wp_customize->add_control('municipality_footer_sponsor1_url', array(
            'label' => 'Website of sponsor 1',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor1_url',
            'type' => 'text'
        ));

//--------------------------------------------------------------------

        // Sponsor 2
        $wp_customize->add_setting('municipality_footer_sponsor2', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_sponsor2', array(
            'label' => 'Sponsor 2 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor2',
        )));

        // Setting: Sponsor 2 Url
        $wp_customize->add_setting('municipality_footer_sponsor2_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 2 Url
        $wp_customize->add_control('municipality_footer_sponsor2_url', array(
            'label' => 'Website of sponsor 2',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor2_url',
            'type' => 'text'
        ));

//--------------------------------------------------------------------

        // Sponsor 3
        $wp_customize->add_setting('municipality_footer_sponsor3', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_sponsor3', array(
            'label' => 'Sponsor 3 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor3',
        )));

        // Setting: Sponsor 3 Url
        $wp_customize->add_setting('municipality_footer_sponsor3_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 3 Url
        $wp_customize->add_control('municipality_footer_sponsor3_url', array(
            'label' => 'Website of sponsor 3',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor3_url',
            'type' => 'text'
        ));

//--------------------------------------------------------------------
        // Sponsor 4
        $wp_customize->add_setting('municipality_footer_sponsor4', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_sponsor4', array(
            'label' => 'Sponsor 4 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor4',
        )));

        // Setting: Sponsor 4 Url
        $wp_customize->add_setting('municipality_footer_sponsor4_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 4 Url
        $wp_customize->add_control('municipality_footer_sponsor4_url', array(
            'label' => 'Website of sponsor 4',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor4_url',
            'type' => 'text'
        ));

//--------------------------------------------------------------------
        // Sponsor 4
        $wp_customize->add_setting('municipality_footer_sponsor5', array(
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'municipality_footer_sponsor5', array(
            'label' => 'Sponsor 5 Logo',
            'description' => 'Footer Sponsor Logo. Upload one here! Logo should be at least 150 × 150 pixels',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor5',
        )));

        // Setting: Sponsor 4 Url
        $wp_customize->add_setting('municipality_footer_sponsor5_url', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        // Control: Sponsor 4 Url
        $wp_customize->add_control('municipality_footer_sponsor5_url', array(
            'label' => 'Website of sponsor 5',
            'description' => 'Add website url of the sponsor!',
            'section' => $section,
            'settings' => 'municipality_footer_sponsor5_url',
            'type' => 'text'
        ));
    } // section_footer

    function section_address($wp_customize, $panel, $section, $priority)
    {
        $wp_customize->add_section($section, array(
            'title' => 'Address',
            'priority' => $priority,
            'panel' => $panel
        ));

        $wp_customize->add_setting('municipality_address_entity_name', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control('municipality_address_entity_name', array(
            'label' => 'Entity Name',
            'description' => 'Add entity or owner of the website here!',
            'section' => $section,
            'settings' => 'municipality_address_entity_name',
            'type' => 'text'
        ));

        $wp_customize->add_setting('municipality_address_entity_address', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control('municipality_address_entity_address', array(
            'label' => 'Address',
            'section' => $section,
            'settings' => 'municipality_address_entity_address',
            'type' => 'text'
        ));

        $wp_customize->add_setting('municipality_address_entity_phone', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control('municipality_address_entity_phone', array(
            'label' => 'Phone',
            'section' => $section,
            'settings' => 'municipality_address_entity_phone',
            'type' => 'text'
        ));

        $wp_customize->add_setting('municipality_address_entity_email', array(
            'type' => 'theme_mod',
            'transport' => 'refresh', // Options: refresh or postMessage.
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr'
        ));

        $wp_customize->add_control('municipality_address_entity_email', array(
            'label' => 'Email',
            'section' => $section,
            'settings' => 'municipality_address_entity_email',
            'type' => 'text'
        ));
    } // section_address

}

