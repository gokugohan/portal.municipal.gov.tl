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
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/colors.css' ?>">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/homepage.css' ?>">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/footer.css' ?>">


        <link rel="stylesheet"
              href="<?php echo get_stylesheet_directory_uri() . '/assets/owlcarousel/assets/owl.carousel.min.css' ?>">
        <link rel="stylesheet"
              href="<?php echo get_stylesheet_directory_uri() . '/assets/owlcarousel/assets/owl.theme.default.min.css' ?>">

        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/profile_list.css' ?>">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/home_tab.css' ?>">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet"
              href="<?php echo get_stylesheet_directory_uri() . '/assets/css/service-to-citizen-municipality.css' ?>">

        <?php
        if (is_page('Services')) {
            ?>

            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/map/leaflet.css' ?>" rel="stylesheet"/>
            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/map/MarkerCluster.css' ?>"
                  rel="stylesheet"/>
            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/map/MarkerCluster.Default.css' ?>"
                  rel="stylesheet"/>
            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/map/styledLayerControl.css' ?>"
                  rel="stylesheet"/>
            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/map/leaflet.groupedlayercontrol.css' ?>"
                  rel="stylesheet"/>
            <link rel="stylesheet"
                  href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.css">
            <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
                  rel='stylesheet'/>

            <?php
        }
        ?>
        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/map/map.css' ?>" rel="stylesheet"/>

        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/index.css' ?>" rel="stylesheet"/>

        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/top_bar_menu.css' ?>" rel="stylesheet"/>

        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/style.css' ?>" rel="stylesheet">

        <link href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>"
              rel="stylesheet">

        <style>
            .breadcrumbs-custom-path li::after {
                color: white;
            }
        </style>

        <?php

        if (is_page('plataforma-de-treinamentu') || is_page('kona-ba-plataforma-treinamentu') || is_tax('courses-category')) {

            ?>
            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/animate.css/animate.min.css' ?>"
                  rel="stylesheet">

            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/education_platform.css' ?>"
                  rel="stylesheet">

            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/glightbox/css/glightbox.min.css' ?>"
                  rel="stylesheet">
            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css' ?>"
                  rel="stylesheet">

            <link href="<?php echo get_stylesheet_directory_uri() . '/assets/css/course_carousel.css' ?>"
                  rel="stylesheet">
            <?php
        }

        ?>

        <style>
            <?php



            if(is_page('plataforma-de-treinamentu')){
                 $hero_background_image = get_theme_mod('municipality_education_platform_hero_image');
        if ($hero_background_image == null) {
            $hero_background_image = get_stylesheet_directory_uri() . '/assets/img/lib3.jpg';
        }
?>
            #hero{
                background-image: url("<?= $hero_background_image ?>");
                background-size: cover;
                background-attachment: fixed;
                background-repeat: no-repeat;

            }


            <?php
                        }else if(is_page('service-to-citizen')){
                ?>
            #hero {
                background-image: url("<?= $hero_background_image ?>");
                background-size: cover;

                background-attachment: fixed;
                background-repeat: no-repeat;
                /*height: 50vh;*/
            }

            #hero img.header_logo{
                width: 150px;
            }



            <?php

                    }else{
                ?>
            #hero {
                <?php
                if($hero_background_image){
                    ?>
                background-image: url("<?= $hero_background_image ?>");
                background-size: cover;

                background-attachment: fixed;
                background-repeat: no-repeat;
                /*height: 100vh;*/
                    <?php
                }else{
                    ?>
                background: rgb(14,29,52);
                background: linear-gradient(0deg, rgba(14, 29, 52,0) 0%, rgba(150, 8, 7 ,.57) 100%);
                    <?php
                }
                ?>

            }
                <?php
                    }
                    ?>
            @media (max-width: 576px) {
                .title a {
                    font-size: 12px;
                }
            }

            @media (max-width: 767px) {
                .title a {
                    font-size: 13px;
                }
            }

            @media (min-width: 768px) {
                .title a {
                    font-size: 14px;
                }
            }

            @media (min-width: 992px) {
                .title a {
                    font-size: 16px;
                }
            }

            #hero .icon-box:hover img.img-filter{
                filter: brightness(0) invert(1) !important;
            }

        </style>

        <?php
        if (is_page('Services')) {
            ?>
            <style>
                #map {
                    height: 70vh !important;
                }


                .breadcrumbs-custom-inner .breadcrumbs-custom-title {
                    color: white;
                }

                #news-list-container .post-modern > p {
                    text-align: justify;
                }

                .post-modern p, .post-modern .post-modern-title {
                    padding-right: 0px;
                }

                #map .leaflet-top.leaflet-left {
                    top: 0px;
                }

                .head_bg {
                    height: auto;
                }

                ul.population_ul li img {
                    height: 40px !important;
                }

                ul.population_ul li .fnt-wgt {
                    padding: 0px !important;
                }

                .agency-marker-icon {
                    background-color: #d0d2d0;
                    padding: 2px;
                    border-radius: 5px;
                }


            </style>
            <?php
        }
        ?>


        <link href="<?php echo get_stylesheet_directory_uri() . '/style.css' ?>"
              rel="stylesheet">
        <?php
        wp_head();

        if (get_theme_mod('themeslug_logo')) {
            $url_img = esc_url(get_theme_mod('themeslug_logo'));
            $alt = esc_attr(get_bloginfo('name', 'display'));
        }
        ?>

        <style>
            .cta {
                background: linear-gradient(rgba(14, 29, 52, 0.6), rgba(14, 29, 52, 0.8)), url("<?php echo get_stylesheet_directory_uri() . '/assets/img/corosal.jpg' ?>") fixed center center;
            }


        </style>
    </head>
<body>
    <!-- NAVBAR-->
<?php
//var_dump(WPGlobus::Config()->language_name["pt"]);
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
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center text-lg-start">
                    <h2 class="text-uppercase text-white wow fadeInUp"><?php echo lang('second_heading'); ?></h2>
                    <p class="text-white  wow fadeInUp"> <?php echo lang('second_description'); ?></p></div>
            </div>
        </div>
    </section>
    <?php
}


