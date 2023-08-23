<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container-fluid">

        <div class="row justify-content-center hero-title">
            <div class="col-md-12 text-center">

                <a class="navbar-brand mb-3" href="<?php echo bloginfo('url'); ?>">
                    <?php
                    $header_logo = get_theme_mod('municipality_header_logo');
                    if ($header_logo == null) {
                        $header_logo = get_stylesheet_directory_uri() . '/assets/img/municipality_01.png';
                    }

                    $header_title = get_theme_mod('municipality_hero_title');
                    if ($header_title == null) {
                        $header_title = lang('first_heading');
                    }

                    $header_description = get_theme_mod('municipality_hero_description');
                    if ($header_description == null) {
                        $header_description = lang('first_description');
                    }
                    ?>

                    <img class="header_logo" src="<?= $header_logo ?>">
                </a>

                <div class="container">
                    <h2 class="text-white bold text-uppercase text-center">
                        <?= filter_text_wpglobus(get_theme_mod('municipality_hero_title')) ?>
                    </h2>
                </div>

                <p class="text-white" id="dash2">
                    <?= filter_text_wpglobus(get_theme_mod('municipality_hero_description')) ?>
                </p>
            </div>
        </div>

        <style>
            #hero .icon-box img{
                filter: none !important;
            }
        </style>
        <div class="row justify-content-center profile-catalog">
            <div class="col-xl-2 col-lg-3 col-md-4">
                <div class="icon-box hoverable wow fadeInLeft">
                    <img  class="img-filter"src="<?php echo get_stylesheet_directory_uri() . '/assets/img/front/perfil_municipio.png' ?>"
                         alt="">
                    <h3><a href="#perfil-dos-municipios"
                           class="btn-load-municipalities"><?= lang('municipality-profile') ?></a></h3>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4">
                <div class="icon-box hoverable wow fadeInLeft">
                    <img  class="img-filter"src="<?php echo get_stylesheet_directory_uri() . '/assets/img/front/data_catalog.png' ?>"
                         alt="">
                    <h3><a href="<?= bloginfo('url') ?>/datasearch"><?= lang('data_catalog') ?></a></h3>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4">
                <div class="icon-box hoverable wow fadeInLeft">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/front/bu_logo_1.png' ?>"
                         alt="">
                    <h3>
                        <a href="<?= bloginfo('url') ?>/balkaun-uniku"><?= lang('balkaun_uniku') ?></a>
                    </h3>
                </div>
            </div>

            <?php
            if (get_option('setting_settings_general')['setting_enable_training_platform']) {
                ?>
                <div class="col-xl-2 col-lg-3 col-md-4">
                    <div class="icon-box hoverable wow fadeInLeft">
                        <img  class="img-filter"src="<?php echo get_stylesheet_directory_uri() . '/assets/img/front/training_platform.png' ?>" alt="">
                        <h3><a href="<?= bloginfo('url') ?>/plataforma-de-treinamentu"><?= lang('training-platform') ?></a>
                        </h3>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="col-xl-2 col-lg-3 col-md-4">
                <div class="icon-box hoverable wow fadeInLeft">
                    <img  class="img-filter"src="<?php echo get_stylesheet_directory_uri() . '/assets/img/front/map.png' ?>"
                         alt="">
                    <h3><a href="<?= bloginfo('url') ?>/Mapa"><?= lang('map') ?></a></h3>
                </div>
            </div>

        </div>

    </div>

</section>
