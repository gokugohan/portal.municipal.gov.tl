<?php

$about_education_video_url_id = (get_theme_mod('municipality_education_platform_hero_video_url'));
$attr = array(
    'League' => wp_get_attachment_url($about_education_video_url_id)
);

$about_education_video_url = ($attr['League']);
$col_left = 'col-md-8';
$col_right = 'col-md-4';
$hide_me = '';
if ($about_education_video_url == false || strlen($about_education_video_url) == 0) {
    $col_left = 'col-md-12';
    $col_right = 'd-none';
    $hide_me = 'style="display:none !important;"';
} else {
//    include('hero_training_platform_01.php');
}

?>
<section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative text-lg-start">
        <div class="row">
            <div class="<?= $col_left ?>">
                <h1 class="wow fadeInUp"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_title'))) ?></h1>

                <?php
                if (!is_tax('coursera-courses-category')) {
                    ?>

                    <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">
                        <ol class="carousel-indicators mb-0">
                            <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner pb-4">
                            <div class="carousel-item active">
                                <div class="media">
                                    <div class="media-body">
                                        <blockquote class="blockquote border-0 p-0">
                                            <p class="font-italic lead">
                                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description3'))) ?>
                                            </p>

                                        </blockquote>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="media">
                                    <div class="media-body">
                                        <blockquote class="blockquote border-0 p-0">
                                            <p class="font-italic lead">
                                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description2'))) ?>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="media">
                                    <div class="media-body">
                                        <blockquote class="blockquote border-0 p-0">
                                            <p class="font-italic lead">
                                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description'))) ?>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="btns d-flex wow fadeInUp">
                        <?php
                        add_button_get_started();
                        ?>
                    </div>
                    <?php
                } else {

                }
                ?>


            </div>
            <div class="<?= $col_right ?> d-flex align-items-center justify-content-center position-relative wow fadeInUp" <?= $hide_me ?> >
                <a href=" <?= $about_education_video_url ?>" class="glightbox play-btn"></a>
            </div>

        </div>
    </div>

</section>
