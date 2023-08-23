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
    $hero_background_image = get_theme_mod('municipality_hero_image');
    if ($hero_background_image == null) {
        $hero_background_image = get_stylesheet_directory_uri() . '/assets/img/kotalama_0.jpg';
    }

    $header_logo = get_theme_mod('municipality_header_logo');
    if($header_logo==null){
        $header_logo = get_stylesheet_directory_uri() . '/assets/img/municipality_01.png';
    }

    $header_title = get_theme_mod('municipality_hero_title');
    if($header_title==null){
        $header_title = lang('first_heading');
    }

    $header_description = get_theme_mod('municipality_hero_description');
    if($header_description==null){
        $header_description = lang('first_description');
    }
    ?>


    <style>
        .error-page,
        .image {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url("<?=$hero_background_image?>");
            background-size: cover;
            background-position: center center;
        }
        .btn-back-to-homepage{
            background: #960807;
            border-color: #960807;
        }
        .btn-back-to-homepage:hover{
            background: #ab2120;
            border-color: #960807;
        }
    </style>
</head>
<body>



<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-6 bg-light">
            <div class="error-page d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto text-center">
                            <img class="img-fluid" src="<?=$header_logo ?>">
                            <h3 class="display-1 mt-4 text-danger font-weight-bold">404!</h3>
                            <p class="text-danger mb-4"><?=lang('Page requested was not found!') ?></p>
                            <a href="<?= home_url() ?>" class="btn btn-primary text-uppercase btn-back-to-homepage"><?= lang('back to homepage') ?></a>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
</body>
</html>
<?php
//get_footer();
?>

