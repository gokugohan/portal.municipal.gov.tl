<?php

add_action('admin_menu', 'balkaun_options_panel');
add_action('admin_init', 'balkaun_settings_config');

function balkaun_options_panel()
{

//    add_menu_page('Balkaun Úniku', 'Balkaun Úniku', 'manage_options',
//        'balkaun-uniku-theme-options', 'balkaun_setting_options_page');
    add_submenu_page(
        'portalmunicipal-theme-options',
        'Balkaun Úniku',
        'Balkaun Úniku',
        'manage_options',
        'balkaun-uniku-setting',
        'balkaun_setting_options_page');

}


function balkaun_settings_config()
{

    register_setting('bu_theme_setting', 'bu_setting');

    add_settings_section(
        'bu_setting_section', '', 'empty_text_render', 'bu_theme_page_section'
    );

    add_balkaun_setting_fields();

}

function balkaun_setting_options_page()
{
    ?>

    <link rel="stylesheet"
          href="<?= get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css' ?>">

    <!--    <link rel="stylesheet" href="--><?//= get_template_directory_uri() . '/assets/js/jquery.min.js'
    ?><!--">-->
    <!--    <link rel="stylesheet" href="--><?//= get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js'
    ?><!--">-->

    <style>
        body {
            background: #dd5e89;
            background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
            background: linear-gradient(to left, #dd5e89, #f7bb97);
            min-height: 100vh;
        }

        p {
            color: #000;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid #198754;
            padding: .375rem .75rem;
            font-size: 1rem;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .btn-replace-image {
            color: #fff;
            background-color: #198754;
        }

        .btn-replace-image:hover {
            color: #fff;
            background-color: #157347;
            border-color: #146c43;
        }

        .reset-image {
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .reset-image:hover {
            color: #fff;
            background-color: #dda909;
            border-color: #dda909;
        }


        .table-values tbody td{
            width: auto;
        }
        table tbody td {
            width: 85%;
        }

        img.custom-upload-img {
            max-width: 500px;
        }

        img.menu-logo,
        img.front-logo {
            width: 250px;
        }
    </style>
    <section class="pb-5 header">
        <div class="container-fluid py-5 text-white">
            <div class="card border-0 shadow mx-auto" style="max-width: 100%">
                <div class="card-body p-5">


                    <div id="icon-themes" class="icon32"></div>
                    <h2>Balkaun Úniku Settings</h2>
                    <?php
                    if (isset($_GET['settings-updated'])) {
                        echo('Settings Saved');
                        add_settings_error('balkaun_mesages', 'balkaun_message',
                            esc_html__('Settings Saved', 'text_domain'),
                            'updated'
                        );
                    }
                    settings_errors('balkaun_mesages');
                    ?>
                    <h2 class="nav-tab-wrapper balkaun-tabs">
                        <a href="#" data-tab="tab-general" class="nav-tab nav-tab-active">General</a>
                        <a href="#" data-tab="tab-about" class="nav-tab nav-tab">About</a>
                        <a href="#" data-tab="tab-vision" class="nav-tab">Vision</a>
                        <a href="#" data-tab="tab-mission" class="nav-tab">Mission</a>

                    </h2>
                    <script>
                        (function () {
                            document.addEventListener('click', (event) => {
                                const target = event.target;
                                if (!target.closest('.balkaun-tabs a')) {
                                    return;
                                }
                                event.preventDefault();
                                document.querySelectorAll('.balkaun-tabs a').forEach((tablink) => {
                                    tablink.classList.remove('nav-tab-active');
                                });
                                target.classList.add('nav-tab-active');
                                targetTab = target.getAttribute('data-tab');

                                document.querySelectorAll('.form-balkaun-page .tab-item').forEach((item) => {
                                    console.log(targetTab);
                                    if (item.classList.contains(`${targetTab}`)) {
                                        item.style.display = 'block';
                                    } else {
                                        item.style.display = 'none';
                                    }
                                });
                            });
                            document.addEventListener('DOMContentLoaded', function () {
                                document.querySelector('.balkaun-tabs .nav-tab').click();
                            }, false);
                        })();
                    </script>

                    <form action='options.php' class="form-balkaun-page" method='post' enctype="multipart/form-data">
                        <input type="hidden" name="action" value="my_file_upload"/>
                        <?php
                        settings_fields('bu_theme_setting');
                        do_settings_sections('bu_theme_page_section');
                        submit_button();
                        ?>

                    </form>
                </div>
            </div>

        </div>
    </section>


    <?php
}

function add_balkaun_setting_fields()
{

    ?>
    <?php

    // General
    add_settings_field(
        'general_setting_logo',
        "Top Menu Logo",
        'add_menu_logo_setting_callback',
        'bu_theme_page_section',
        'bu_setting_section',
        [
            'label_for' => 'general_setting_logo',
            'class' => 'tab-item tab-general'
        ]
    );

    add_settings_field(
        'general_setting_front_logo',
        "Front Logo",
        'add_front_logo_setting_callback',
        'bu_theme_page_section',
        'bu_setting_section',
        [
            'label_for' => 'general_setting_front_logo',
            'class' => 'tab-item tab-general'
        ]
    );

    // About
    add_settings_field(
        'about_setting_image',
        "Image",
        'add_about_setting_image_callback',
        'bu_theme_page_section',
        'bu_setting_section',
        [
            'label_for' => 'about_setting_image',
            'class' => 'tab-item tab-about'
        ]
    );

    add_settings_field('balkaun_about_tm', 'Tétum', 'about_balkaun_tm_callback',
        'bu_theme_page_section', 'bu_setting_section',
        [
            'label_for' => 'balkaun_about_tm',
            'class' => 'tab-item tab-about'
        ]);

    add_settings_field('balkaun_about_pt', 'Portuguese', 'about_balkaun_pt_callback',
        'bu_theme_page_section', 'bu_setting_section', [
            'label_for' => 'balkaun_about_pt',
            'class' => 'tab-item tab-about'
        ]);

    add_settings_field('balkaun_about_en', 'English', 'about_balkaun_en_callback',
        'bu_theme_page_section', 'bu_setting_section', [
            'label_for' => 'balkaun_about_en',
            'class' => 'tab-item tab-about'
        ]);
//
//    add_settings_field_to_section('setting_homepage_image',
//        "Homepage Background Image", 'setting_homepage_image',
//        'bu_theme_setting', 'bu_setting_section');


//    Mission
    add_settings_field('balkaun_mission', 'Tétum', 'mission_balkaun_callback',
        'bu_theme_page_section', 'bu_setting_section', [
            'label_for' => 'balkaun_mission',
            'class' => 'tab-item tab-mission'
        ]);
    add_settings_field('balkaun_mission_pt', 'Portuguese', 'mission_balkaun_pt_callback',
        'bu_theme_page_section', 'bu_setting_section', [
            'label_for' => 'balkaun_mission_pt',
            'class' => 'tab-item tab-mission'
        ]);
    add_settings_field('balkaun_mission_en', 'English', 'mission_balkaun_en_callback',
        'bu_theme_page_section', 'bu_setting_section', [
            'label_for' => 'balkaun_mission_en',
            'class' => 'tab-item tab-mission'
        ]);
//

    // Vision

    add_settings_field('balkaun_vision', 'Tétum', 'vision_balkaun_callback',
        'bu_theme_page_section', 'bu_setting_section',
        ['label_for' => 'balkaun_vision', 'class' => 'tab-item tab-vision']);
    add_settings_field('balkaun_vision_pt', 'Portuguese', 'vision_balkaun_pt_callback',
        'bu_theme_page_section', 'bu_setting_section',
        ['label_for' => 'balkaun_vision_pt', 'class' => 'tab-item tab-vision']);
    add_settings_field('balkaun_vision_en', 'English', 'vision_balkaun_en_callback',
        'bu_theme_page_section', 'bu_setting_section',
        ['label_for' => 'balkaun_vision_en', 'class' => 'tab-item tab-vision']);


}

function add_menu_logo_setting_callback()
{

    $options = get_option('bu_setting');

    $default_bg_image = $options['bu_menu_logo'];
    if (empty($default_bg_image)) {
        $default_bg_image = get_template_directory_uri() . '/assets/img/none.png';
    }
    ?>
    <input type="hidden"
           id="default_menu_logo"
           value="<?= get_template_directory_uri() . '/assets/img/none.png' ?>">

    <img src="<?= $default_bg_image ?>" class="default-menu-logo img-fluid custom-upload-img menu-logo">
    <input type="hidden" id="setting_bu_menu_logo"
           name="bu_setting[bu_menu_logo]"
           value="<?= $options['bu_menu_logo'] ?>"/>

    <br>
    <a href="#!" class="btn btn-replace-menu-logo">Change Image</a> | <a href="#!" class="btn reset-menu-logo">Reset
    Image</a>
    <?php
}

function add_front_logo_setting_callback()
{

    $options = get_option('bu_setting');

    $default_bg_image = $options['bu_front_logo'];
    if (empty($default_bg_image)) {
        $default_bg_image = get_template_directory_uri() . '/assets/img/none.png';
    }
    ?>
    <input type="hidden"
           id="default_front_logo"
           value="<?= get_template_directory_uri() . '/assets/img/none.png' ?>">

    <img src="<?= $default_bg_image ?>" class="default-front-logo img-fluid custom-upload-img front-logo">
    <input type="hidden" id="setting_bu_front_logo"
           name="bu_setting[bu_front_logo]"
           value="<?= $options['bu_front_logo'] ?>"/>

    <br>
    <a href="#!" class="btn btn-replace-front-logo">Change Image</a> | <a href="#!" class="btn reset-front-logo">Reset
    Image</a>
    <?php
}

function add_about_setting_image_callback()
{

    $options = get_option('bu_setting');

    $default_bg_image = $options['bu_about_image'];
    if (empty($default_bg_image)) {
        $default_bg_image = get_template_directory_uri() . '/assets/img/none.png';
    }
    ?>
    <input type="hidden"
           id="default_about_image"
           value="<?= get_template_directory_uri() . '/assets/img/none.png' ?>">

    <img src="<?= $default_bg_image ?>" class="default-about-bg-img img-fluid custom-upload-img">
    <input type="hidden" id="setting_bu_about_image"
           name="bu_setting[bu_about_image]"
           value="<?= $options['bu_about_image'] ?>"/>

    <br>
    <a href="#!" class="btn btn-replace-about-image">Change Image</a> | <a href="#!" class="btn reset-about-image">Reset
    Image</a>
    <?php
}


function about_balkaun_tm_callback()
{
    $options = get_option('bu_setting');

    render_textarea('about_balkaun_tm', 'bu_setting[about_balkaun_tm]', $options['about_balkaun_tm']);
}


function about_balkaun_pt_callback()
{
    $options = get_option('bu_setting');
    render_textarea('about_balkaun_pt', 'bu_setting[about_balkaun_pt]', $options['about_balkaun_pt']);
}


function about_balkaun_en_callback()
{
    $options = get_option('bu_setting');
    render_textarea('about_balkaun_en', 'bu_setting[about_balkaun_en]', $options['about_balkaun_en']);
}

// Mission
function mission_balkaun_callback()
{
    $options = get_option('bu_setting');
    render_textarea('balkaun_mission_tm', 'bu_setting[balkaun_mission_tm]', $options['balkaun_mission_tm']);
}
function mission_balkaun_pt_callback()
{
    $options = get_option('bu_setting');
    render_textarea('balkaun_mission_pt', 'bu_setting[balkaun_mission_pt]', $options['balkaun_mission_pt']);
}
function mission_balkaun_en_callback()
{
    $options = get_option('bu_setting');
    render_textarea('balkaun_mission_en', 'bu_setting[balkaun_mission_en]', $options['balkaun_mission_en']);
}



function vision_balkaun_callback()
{
    $options = get_option('bu_setting');
    render_textarea('balkaun_visaun_tm', 'bu_setting[balkaun_visaun_tm]', $options['balkaun_visaun_tm']);
}

function vision_balkaun_pt_callback()
{
    $options = get_option('bu_setting');
    render_textarea('balkaun_visaun_pt', 'bu_setting[balkaun_visaun_pt]', $options['balkaun_visaun_pt']);
}

function vision_balkaun_en_callback()
{
    $options = get_option('bu_setting');
    render_textarea('balkaun_visaun_en', 'bu_setting[balkaun_visaun_en]', $options['balkaun_visaun_en']);
}

