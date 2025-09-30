<?php
$hero_background_image = get_theme_mod('municipality_hero_image');
//if ($hero_background_image == null) {
//    $hero_background_image = get_stylesheet_directory_uri() . '/assets/img/kotalama_0.jpg';
//}
//
?>


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
    <head>
        <title>
            <?php
            $site_description = get_bloginfo('description', 'display');
            $site_name = get_bloginfo('name');
            if (is_front_page()) {
                echo $site_name;
            } else {
                print_custom_page_title();
            }

            echo ' | ';
            echo $site_description;
            ?>
        </title>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>


        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">


        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' ?>">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/animate.css' ?>">
        <link rel="stylesheet"
              href="<?php echo get_stylesheet_directory_uri() . '/assets/css/font-awesome/css/font-awesome.min.css' ?>">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/footer.css' ?>">


        <link rel="stylesheet"
              href="<?php echo get_stylesheet_directory_uri() . '/assets/owlcarousel/assets/owl.carousel.min.css' ?>">
        <link rel="stylesheet"
              href="<?php echo get_stylesheet_directory_uri() . '/assets/owlcarousel/assets/owl.theme.default.min.css' ?>">

        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/profile_list.css' ?>">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/home_tab.css' ?>">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">


        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/index.css' ?>" rel="stylesheet"/>

        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/top_bar_menu.css' ?>" rel="stylesheet"/>

        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/style.css' ?>" rel="stylesheet">

        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>"
              rel="stylesheet">
        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/js/highcharts/highcharts.css' ?>" rel="stylesheet">

        <style>
            .breadcrumbs-custom-path li::after {
                color: white;
            }

            #hero {
                background-image: url("<?= $hero_background_image ?>");
                background-size: cover;

                background-attachment: fixed;
                background-repeat: no-repeat;
                /*height: 50vh;*/
            }

            /* #hero img.header_logo {
                width: 150px;
            } */


            #hero .icon-box:hover img.img-filter {
                filter: brightness(0) invert(1) !important;
            }
            .cta {
                background: linear-gradient(rgba(14, 29, 52, 0.6), rgba(14, 29, 52, 0.8)), url("<?php echo get_stylesheet_directory_uri() . '/assets/img/corosal.jpg' ?>") fixed center center;
            }
        </style>


<!--        <link href="--><?php //echo get_stylesheet_directory_uri() . '/style.css' ?><!--" rel="stylesheet">-->
        <?php
        wp_head();

        if (get_theme_mod('themeslug_logo')) {
            $url_img = esc_url(get_theme_mod('themeslug_logo'));
            $alt = esc_attr(get_bloginfo('name', 'display'));
        }
        ?>

    </head>
<body>
<?php
include("includes/top_bar_menu.php");
?>

    <div class="please-wait d-none" style="display: block;">
        <div class="load-wrapper"><img
                    src="<?php echo get_stylesheet_directory_uri() . '/assets/img/sdg_circle.svg' ?>"/>
        </div>
        <div class="please-wait-bg"></div>
    </div>


<?php

if (is_front_page()) {
    include("includes/hero.php");
    ?>
    <section id="cta" class="cta">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 text-center text-lg-start mb-3">
                    <h2 class="text-uppercase text-white wow fadeInUp"><?php echo lang('second_heading'); ?></h2>
                    <p class="text-white  wow fadeInUp"> <?php echo lang('second_description'); ?></p>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <div class="stats-item text-center w-100 h-100 wow fadeInUp">
                                <span data-purecounter-start="0"
                                    data-purecounter-end="<?= get_setting_value("total_population") ?>"
                                    class="purecounter"
                                    data-purecounter-separator=","
                                    data-purecounter-duration="2"><?= get_setting_value("total_population") ?></span>
                                <p class="text-capitalize"><?= lang("total population") ?></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="stats-item text-center w-100 h-100 wow fadeInUp">
                                <span data-purecounter-start="0"
                                    data-purecounter-end="<?= get_setting_value("total_male") ?>"
                                    class="purecounter"
                                    data-purecounter-separator=","
                                    data-purecounter-duration="2">0</span>
                                <p class="text-capitalize"><?= lang("male") ?></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="stats-item text-center w-100 h-100 wow fadeInUp">
                                <span data-purecounter-start="0"
                                    data-purecounter-end="<?= get_setting_value("total_female") ?>"
                                    class="purecounter"
                                    data-purecounter-separator=","
                                    data-purecounter-duration="2">0</span>
                                <p class="text-capitalize"><?= lang("female") ?></p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                            <div class="stats-item text-center w-100 h-100 wow fadeInUp">
                                <span data-purecounter-start="0"
                                    data-purecounter-end="<?= get_setting_value("total_administrative_post") ?>"
                                    class="purecounter"
                                    data-purecounter-separator=","
                                    data-purecounter-duration="2">0</span>
                                <p class="text-capitalize"><?= lang("administrative post") ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                            <div class="stats-item text-center w-100 h-100 wow fadeInUp">
                                <span data-purecounter-start="0"
                                    data-purecounter-end='<?= get_setting_value("total_suku") ?>'
                                    class="purecounter"
                                    data-purecounter-separator=","
                                    data-purecounter-duration="2">0</span>
                                <p class="text-capitalize"><?= lang("suco") ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                            <div class="stats-item text-center w-100 h-100 wow fadeInUp">
                                <span data-purecounter-start="0"
                                    data-purecounter-end="<?= get_setting_value("total_village") ?>"
                                    class="purecounter"
                                    data-purecounter-separator=","
                                    data-purecounter-duration="2">0</span>
                                <p class="text-capitalize"><?= lang("village") ?></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12 mb-3">
                            <div class="stats-item text-center w-100 h-100 wow fadeInUp">
                                <span data-purecounter-start="0"
                                    data-purecounter-end="<?= get_setting_value("total_household") ?>"
                                    class="purecounter"
                                    data-purecounter-separator=","
                                    data-purecounter-duration="2">0</span>
                                <p class="text-capitalize"><?= lang("household") ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <?php
}


