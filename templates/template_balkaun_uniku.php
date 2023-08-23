<?php
/*
  Template Name: Balkaun Úniku Page
 */

include "balkaun_uniku_header.php";
?>
    <style>

        .image-localizasaun {
            max-height: 500px;
        }

        #hero-overlay {
            position: absolute;
            height: 100vh;
            width: 100%;
            background: #0000006b;
            z-index: 0;
            top: 0;
        }

        .index-0 {
            z-index: 0;
        }

        .index-1 {
            z-index: 1;
        }

    </style>
<?php
$front_logo = get_bu_setting('bu_front_logo', true);

$logo = $front_logo ? $front_logo : get_stylesheet_directory_uri() . '/assets/img/front/d56b07fa25b1c546b415c695ae197aef.png';


?>
    <div class="breadcrumbs front-hero">
        <div class="page-header d-flex align-items-center">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="hero-logo">
                            <img class="header-logo img-fluid mb-4" src="<?= $logo ?>" alt="MAE">
                        </div>
                        <!--                        <h2 data-aos="fade-up">Balkaun Úniku</h2>-->
                        <p data-aos="fade-up" data-aos-delay="100">
                            <?php
                            if (have_posts()) {
                            while (have_posts()) {
                            the_post();
                                the_content();
                            }
                        }

                        ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
        </g>
    </svg>

    <!-- ======= Hero Section ======= -->

    <!--    <section id="hero" class="hero d-flex align-items-center">-->
    <!--        <div id="hero-overlay" class="index-0"></div>-->
    <!--        <div class="container index-1">-->
    <!--            <div class="row gy-4 d-flex justify-content-between">-->
    <!--                <div class="col-lg-12 order-lg-1 d-flex flex-column justify-content-center">-->
    <!--                    <div class="text-center">-->
    <!--                        <div class="hero-logo">-->
    <!---->
    <!--                            <img class="header-logo img-fluid mb-4"-->
    <!--                                 src="--><?//= $logo ?><!--"-->
    <!--                                 alt="MAE">-->
    <!--                        </div>-->
    <!---->
    <!--                        <h2 data-aos="fade-up">Balkaun Úniku</h2>-->
    <!--                        <p data-aos="fade-up" data-aos-delay="100">-->
    <!--                            --><?//= the_excerpt() ?>
    <!--                        </p>-->
    <!---->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </section>-->
    <!-- End Hero Section -->

    <main id="main">

        <section class="bg-light">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <span>Balkaun Úniku</span>
                    <h2><?=lang('what_is_balkaun_uniku')?></h2>
                </div>
                <div class="row gy-4 features-item">
                    <?php
                    $about_image = get_bu_setting('bu_about_image', true);
                    if ($about_image) {
                        ?>
                        <div class="col-md-6 order-1 order-md-2"
                             data-aos="fade-left">
                            <div class="wp-block-image">
                                <img src="<?= $about_image ?>" class="img-fluid" alt="">
                            </div>

                        </div>
                        <div class="col-md-6 text-justify order-2 order-md-1"
                             data-aos="fade-right"
                        >
                            <?= get_bu_setting('about_balkaun_' . WPGlobus::Config()->language) ?>
                        </div>
                        <?php

                    } else {
                    ?>
                    <div class="col-md-12 text-justify aos-init aos-animate" data-aos="zoom-in-up" data-aos-delay="100"
                    ">
                    <?= get_bu_setting('about_balkaun_' . WPGlobus::Config()->language) ?>
                </div>
                <?php
                }

                ?>

            </div>
            </div>


        </section>


        <section>
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <span>Balkaun Úniku</span>
                    <h2><?=lang('vision_and_mission_institutional')?></h2>
                </div>
                <div class="row">
                    <div class="col-md-6" data-aos="fade-right">
                        <div class="text-justify">
                            <h3>Visaun</h3>
                            <?= get_bu_setting('balkaun_visaun_' . WPGlobus::Config()->language) ?>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left">
                        <div class="text-justify">
                            <h3>Misaun</h3>
                            <?= get_bu_setting('balkaun_mission_' . WPGlobus::Config()->language) ?>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <section class="bg-wave">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <span>Balkaun Uniku</span>
                    <h2><?=lang('values')?> <br>
                        <!--                    <small>We believe in Transparency, Inclusion, Excellence</small>-->
                    </h2>
                </div>


                <ol class="list-numbers row px-3 mb-4">
                    <?php
                    $valores_query = array(
                        'post_type' => 'balkaun-uniku-values',
                        'post_status' => 'publish',
                        'nopaging' => true,

                    );

                    $valores_query = new WP_Query($valores_query);

                    if ($valores_query->have_posts()) {
                        ?>
                        <?php
                        while ($valores_query->have_posts()) {
                            $valores_query->the_post();
                            ?>
                            <li class="col-lg-4 mb-2 on-hover">
                                <h5><?= the_title() ?></h5>
                                <p class="text-small text-muted"><?= the_content() ?></p>
                            </li>

                            <?php
                        }
                        ?>
                        <?php

                    }
                    wp_reset_postdata();
                    ?>


                </ol>
            </div>
        </section>

        <!-- ======= Services Section ======= -->
        <section id="service" class="services bg-light">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <span>Balkaun Úniku</span>
                    <h2><?=lang('services')?></h2>

                </div>

                <div class="row gy-4">
                    <?php
                    $services = array(
                        'post_type' => 'balkaununiku',
                        'post_status' => 'publish',
                        'nopaging' => false,
                        'posts_per_page' => 6,

                    );

                    $service_query = new WP_Query($services);

                    if ($service_query->have_posts()) {
                        ?>
                        <?php
                        while ($service_query->have_posts()) {
                            $service_query->the_post();
                            $feature_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                            if (has_post_thumbnail($post) && $feature_image != null) {
                                $post_image_feature_url = $feature_image;
                            } else {
                                $post_image_feature_url = get_template_directory_uri() . "/assets/img/front/teste.png";
                            }
                            ?>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="<?php echo $post_image_feature_url; ?>" alt="" class="img-fluid">
                                    </div>
                                    <h3><a href="<?php echo the_permalink() ?>"
                                           class="stretched-link"><?= the_title() ?></a></h3>
                                    <p><?= excerpt(25) ?></p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php

                    }
                    wp_reset_postdata();
                    ?>

                </div>

            </div>
        </section><!-- End Services Section -->


        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <span>Balkaun Úniku</span>
                    <h2><?=lang('faq')?></h2>

                </div>

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-10">

                        <div class="accordion accordion-flush" id="faqlist">

                            <?php

                            $faqs = get_faq('balkaun-uniku');
                            if ($faqs->have_posts()) {
                                while ($faqs->have_posts()) {
                                    $faqs->the_post();

                                    ?>

                                    <div class="accordion-item">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#faq-content-<?= get_the_id() ?>">
                                                <i class="bi bi-question-circle question-icon"></i>
                                                <?= the_title() ?>
                                            </button>
                                        </h3>
                                        <div id="faq-content-<?= get_the_id() ?>" class="accordion-collapse collapse"
                                             data-bs-parent="#faqlist">
                                            <div class="accordion-body">
                                                <?= the_content() ?>
                                            </div>
                                        </div>
                                    </div><!-- # Faq item-->

                                    <?php
                                }
                                wp_reset_postdata();
                            } else {
                                ?>
                                <span class="text-warning"><?= lang('no_data') ?></span>
                                <?php

                            }
                            ?>


                        </div>

                    </div>
                </div>

            </div>
        </section><!-- End Frequently Asked Questions Section -->


    </main><!-- End #main -->

<?php
include "balkaun_uniku_footer.php";
