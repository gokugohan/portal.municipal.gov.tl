<?php

$hero_background_image = get_theme_mod('municipality_balkaun_uniku_hero');

//if ($hero_background_image == null) {
//    $hero_background_image = get_stylesheet_directory_uri() . '/assets/balkaun_uniku/img/hero-bg.png';
//}
//$hero_background_image = get_stylesheet_directory_uri() . '/assets/balkaun_uniku/img/hero-bg.png';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= the_title() ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!--    <link href="-->
    <?php //echo get_stylesheet_directory_uri() . '/assets/balkaun_uniku/img/favicon.png' ?><!--" rel="icon">-->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css' ?>"
          rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>"
          rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.css' ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/balkaun_uniku/css/style.css'; ?>" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/balkaun_uniku/css/customized.css'; ?>"
          rel="stylesheet">

    <!-- =======================================================
    * Template Name: Logis - v1.2.0
    * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    <style>

        <?php
if($hero_background_image){
    ?>
        .hero {
            /*height: calc(100vh - 40px);*/
            min-height: 100vh;
            background-image: url(<?= $hero_background_image?>);
            background-attachment: fixed;
            /*background-repeat: no-repeat;*/
            /*background-position-x: center;*/
            /*background-position-y: bottom;*/
            /*background-size: unset;*/
        }

        .front-hero {
            background-image: url(<?= $hero_background_image?>);
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }

        <?php
}else{
    ?>
        .front-hero {
            background: rgb(14,29,52);
            background: linear-gradient(0deg, rgba(14, 29, 52,0) 0%, rgba(150, 8, 7 ,.57) 100%);
        }
        <?php
}
 ?>


        .hero-logo {
            width: 300px;
            margin: 0 auto;
        }

        .hero-logo img {
            margin: 0 !important;
            background: white;
            border-radius: 10px;
            transition: 0.2s ease-in;
        }

        .hero-logo img:hover {
            box-shadow: 5px 3px 20px 2px #ccc;
        }

        .breadcrumbs .page-header{
            padding:190px 0 80px 0 !important;
            min-height: 500px;
        }

        ul.nav.nav-vision-mission li:before{
            content: none !important;
        }

        .menu_item_wpglobus_menu_switch a>span>span{
            background-image: none;
            text-transform: uppercase;
        }
    </style>
    <?php
    wp_head();
    ?>
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="<?= home_url('balkaun-uniku') ?>" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <?php
            $menu_logo = get_bu_setting('bu_menu_logo', true);
            $menu_logo_path = $menu_logo ? $menu_logo : get_stylesheet_directory_uri() . '/assets/img/front/d56b07fa25b1c546b415c695ae197aef.png';
            ?>

            <img class="header-menu-logo"
                 src="<?= $menu_logo_path ?>" alt="">
            <!--            <h1>Logis</h1>-->
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <?php
            balkaun_uniku_nav_menu();
            ?>
        </nav><!-- .navbar -->

    </div>
</header>
<!-- End Header -->
