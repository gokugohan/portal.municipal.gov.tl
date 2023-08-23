
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative text-lg-start">
        <div class="row">
            <div class="col-lg-12">

                <h1 class="wow fadeInUp"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_title'))) ?></h1>
                <h2 class="wow fadeInUp">
                    <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description'))) ?>
                </h2>

                <div class="btns d-flex wow fadeInUp">
                    <?php
                    add_button_get_started();
                    ?>
                    <!--                        <a href="-->
                    <?//= $video_url ?><!--" class="glightbox play-btn"></a>-->
                    <a href="<?= $video_url ?>" class="glightbox btn-watch-video d-flex align-items-center">
                        <i class="fa fa-play"></i> <span class="pl-2"> Watch Video</span>
                    </a>
                </div>

            </div>
            <div class="col-lg-12 d-flex align-items-center justify-content-center position-relative wow fadeInUp">

            </div>

        </div>
    </div>

</section>
<!-- End Hero -->
