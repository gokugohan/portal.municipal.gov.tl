<?php
/*
  Template Name: Contact Us
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
    <title>
        <?php
        $site_description = get_bloginfo('description', 'display');
        $site_name = get_bloginfo('name');
        echo $site_name;
        echo ' | ';
        echo $site_description;
        ?>
    </title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>


    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' ?>">
    <?php

    $header_logo = get_theme_mod('municipality_header_logo');
    if ($header_logo == null) {
        $header_logo = get_stylesheet_directory_uri() . '/assets/img/municipality_01.png';
    }

    ?>


    <style>
        .detail-page,
        .image {
            min-height: 100vh;
        }

        .btn-back-to-homepage {
            background: #960807;
            border-color: #960807;
        }

        .btn-back-to-homepage:hover {
            background: #ab2120;
            border-color: #960807;
        }

        #embed-map {
            border: none;
            width: 100%;
            height: 100vh;
        }
    </style>
</head>
<body>


<div class="container-fluid">
    <div class="row no-gutter flex-lg-row-reverse">

        <!-- The content half -->
        <div class="col-md-6 bg-light">
            <div class="detail-page d-flex align-items-center py-5">
                <div class="mx-auto">
                    <p>
                        <img src="<?= $header_logo ?>"
                             style="width: 150px;"
                             alt="<?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_name', 'Ministério da Administração Estatal')) ?>">
                    </p>
                    <h3 class="text-uppercase mt-4 font-weight-bold">
                        <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_name', 'Ministério da Administração Estatal')) ?>
                    </h3>
                    <p>
                        <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_address', 'Rua 20 de Maio, nº43, Dili, Timor-Leste')) ?>
                        <br>
                        <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_phone', '(+670) 333 9077')) ?>
                        <br>
                        <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_email', 'portalmunicipal.mae@gmail.com')) ?>
                        <br>
                    </p>
                    <br>
                    <a href="<?= home_url() ?>"
                       class="btn btn-primary text-uppercase btn-back-to-homepage"><?= lang('back to homepage') ?></a>
                    <br>
                    <br>
                    <p class="credit">
                        © <?= date('Y') ?> <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_name', 'Ministério da Administração Estatal')) ?>
                </div>

            </div>
        </div><!-- End -->

        <!-- The image half -->
        <div class="col-md-6 d-md-flex p-0">
            <iframe id="embed-map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31563.092769766125!2d125.56863246201331!3d-8.558773115179156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d01e70d32288115%3A0x3d9d6ee9546912d9!2sDili!5e0!3m2!1sid!2stl!4v1657670283805!5m2!1sid!2stl"
                    allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>



    </div>
</div>
</body>
</html>
