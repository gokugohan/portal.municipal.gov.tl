<?php
/*
  Template Name: Training Platform Template faq
 */

?>
<?php get_header(); ?>
<?php

?>

    <main id="main-window">
        <!-- ======= Hero Section ======= -->
        <?php
        include('hero_training_platform_01.php');
        //        if ($about_education_video_url == false || strlen($about_education_video_url) == 0) {
        //            include ('hero_training_platform_02.php');
        //        }else{
        //            include ('hero_training_platform_01.php');
        //        }

        ?>
        <!-- End Hero -->


        <div class="services-area bg-white d-none">
            <div class="container">
                <div class="row justify-content-sm-center">

                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30 wow bounceInUp" data-wow-duration="1s">
                            <div class="features-icon">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon1.svg' ?>"
                                     alt="">
                            </div>
                            <div class="features-caption">
                                <h3><?= lang('trainings') ?></h3>
                                <p>
                                    <?= lang('training_quote') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30 wow bounceInUp" data-wow-duration="1.5s">
                            <div class="features-icon">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon2.svg' ?>"
                                     alt="">
                            </div>
                            <div class="features-caption">
                                <h3><?= lang('expert_instructors') ?></h3>
                                <p><?= lang('mark_doren_quote') ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30 wow bounceInUp" data-wow-duration="2s">
                            <div class="features-icon">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon3.svg' ?>"
                                     alt="">
                            </div>
                            <div class="features-caption">
                                <h3><?= lang('lifetime_access') ?></h3>
                                <p><?= lang('lifetime_access_quote') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ======= About Section ======= -->
        <section id="about" class="about bg-white">
            <div class="container" data-aos="fade-up">
                <?php
                $about_image = get_theme_mod('municipality_education_platform_about_image');
                //            if ($about_image == null) {
                //                $about_image = get_stylesheet_directory_uri() . '/assets/img/lib5.jpg';
                //            }
                ?>

                <div class="row wow bounceInUp" data-wow-duration="2s">
                    <div class="col-md-12 section-title text-center bg-transparent">

                        <p><?= filter_text_wpglobus(get_theme_mod('municipality_education_platform_about_title')) ?></p>

                    </div>
                    <?php
                    if ($about_image == null) {
                        ?>
                        <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content text-center">
                            <h3><?= filter_text_wpglobus(get_theme_mod('municipality_education_platform_about_title')) ?></h3>
                            <p class="mb-4 lead">
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_about_description'))) ?>

                            </p>
                            <a href="#" class="btn btn-join-now"><?= lang('join now') ?></a>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="col-xl-5 text-center aos-init aos-animate" data-aos="fade-right"
                             data-aos-delay="100">
                            <img src="<?= $about_image ?>" class="img-fluid p-1" alt="">
                        </div>

                        <div class="col-xl-7 content">

                            <p class="mb-4 text-justify lead">
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_about_description'))) ?>

                            </p>

                            <ul>
                                <li class="mb-2 bi bi-check-circle">
                                    <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_about_list_1'))) ?>

                                </li>
                                <li class="mb-2 bi bi-check-circle">
                                    <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_about_list_2'))) ?>

                                </li>
                                <li class="mb-2 bi bi-check-circle">
                                    <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_about_list_3'))) ?>

                                </li>
                            </ul>

                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </section><!-- End About Section -->


        <div class="py-5 bg-light cta" style="background-image:url(<?= $about_image ?>)">
            <div class="container py-3">
                <!-- Row -->
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-7 text-center">

                        <h3 class="mb-3 font-weight-medium"
                            style="font-size: 2.2rem;"><?= lang('MAXIMIZE YOUR POTENTIALS AND POSSIBILITIES') ?></h3>
                        <p class="font-weight-light lead">
                            <?= lang('Take the next step toward your personal and professional goals with free courses.') ?>
                        </p>
                        <!--                    <a class="btn btn-danger-gradiant btn-md border-0 text-white mt-3 text-uppercase" href="#">-->
                        <!--                        <span>join us now</span></a>-->
                        <a href="#" class="btn btn-md btn-join-now"><?= lang('join now') ?></a>
                    </div>
                </div>
                <!-- Row -->
            </div>
        </div>

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us bg-white">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch wow bounceInUp">
                        <div class="content">
                            <h3>
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_what_is_training'))) ?>
                            </h3>
                            <p class="lead">
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_what_is_training_description'))) ?>
                            </p>
                            <div class="text-center mt-5 d-none">
                                <a href="<?= bloginfo('url') ?>/kona-ba-plataforma-treinamentu"
                                   class="more-btn"><?= lang('view_more') ?>
                                    <i class="bx bx-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch wow bounceInUp"
                                     data-wow-duration="1.5s">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <div class="img-container">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/books.png' ?>"
                                                 alt="">
                                        </div>

                                        <h4>
                                            <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_what_is_training_01'))) ?>
                                        </h4>
                                        <p class="lead">
                                            <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_what_is_training_01_description'))) ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch wow bounceInUp" data-wow-duration="2s">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <div class="img-container">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/teacher.png' ?>"
                                                 alt="">
                                        </div>
                                        <h4><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_what_is_training_02'))) ?></h4>
                                        <p class="lead"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_what_is_training_02_description'))) ?></p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch wow bounceInUp"
                                     data-wow-duration="2.5s">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <div class="img-container">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/lifecycle.png' ?>"
                                                 alt="">
                                        </div>
                                        <h4><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_what_is_training_03'))) ?></h4>
                                        <p class="lead"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_what_is_training_03_description'))) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->


        <!-- ======= Popular Courses Section ======= -->
        <section id="popular-courses" class="courses">
            <div class="container" data-aos="fade-up">
                <div class="section-title bg-transparent text-center section-title-container wow bounceInUp"
                     data-wow-duration="2s">
                    <h2><?= lang('popular_courses') ?></h2>
                    <p><?= lang("Let's Work Together To Help You Achieve Your Goals Today!") ?></p>

                </div>
                <div id="category-courses-carousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner row w-100 mx-auto">
                        <?php
                        $course_category_args = array(
                            'taxonomy' => 'courses-category',
                            'orderby' => 'name',
                            'order' => 'ASC',
                            "hide_empty" => 0,
                        );

                        $categories = get_categories($course_category_args);

                        $category_counter = 0;
                        foreach ($categories as $cate) {
                            if ($category_counter == 0) {
                                ?>
                                <!-- Course Block -->
                                <div class="course-block carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                                    <div class="inner-box">
                                        <div class="icon bi bi-book-half"></div>
                                        <h4><a href="<?php echo esc_url(get_term_link($cate->term_id)) ?>"
                                               title="<?php echo esc_html($cate->cat_name) ?>"><?php echo esc_html($cate->cat_name) ?></a>
                                        </h4>
                                        <div class="courses"><?= $cate->count > 1 ? $cate->count . ' courses' : $cate->count. ' course'; ?></div>
                                        <a class="arrow bi bi-arrow-right"
                                           title="<?= esc_html($cate->cat_name) ?>"
                                           href="<?php echo esc_url(get_term_link($cate->term_id)) ?>"></a>
                                    </div>
                                </div>

                                <?php
                            } else {
                                ?>
                                <!-- Course Block -->
                                <div class="course-block carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="inner-box">
                                        <div class="icon bi bi-book-half"></div>
                                        <h4><a href="<?php echo esc_url(get_term_link($cate->term_id)) ?>"
                                               title="<?php echo esc_html($cate->cat_name) ?>"><?php echo esc_html($cate->cat_name) ?></a>
                                        </h4>
                                        <div class="courses"><?= $cate->count > 1 ? $cate->count . ' courses' : $cate->count.' course'; ?></div>
                                        <a class="arrow bi bi-arrow-right"
                                           title="<?= esc_html($cate->cat_name) ?>"
                                           href="<?php echo esc_url(get_term_link($cate->term_id)) ?>"></a>
                                    </div>
                                </div>

                                <?php
                            }

                            $category_counter++;
                        }
                        ?>

                    </div>
                    <a class="carousel-control-prev" href="#category-courses-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#category-courses-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="row">

                    <?php

                    //                    getNewAccessTokenUsingOAuth2(get_general_setting('setting_api_coursera_access_code'));
                    //                    echo "<hr>";

                    //                    getNewAccessTokenUsingCurl();
                    //                    getNewAccessTokenUsingLeagueOAuth2(get_general_setting('setting_api_coursera_access_code'));
                    //                    echo "<hr>";
                    ?>


                </div>


            </div>
        </section>
        <!-- End Popular Courses Section -->

        <?php
        $is_faq_enabled = get_option('setting_settings_general')['setting_enable_faq'];
        if ($is_faq_enabled) {
            ?>
            <section id="faq" class="bg-white">
                <div class="container wow bounceInUp">
                    <div class="section-title text-center bg-transparent">
                        <p><?= lang("faq_desc") ?></p>
                    </div>
                    <!-- Accordion -->
                    <div id="accordion_faq" class="accordion shadow">

                        <?php

                        $faqs = get_faq('training-platform');
                        if ($faqs->have_posts()) {
                            while ($faqs->have_posts()) {
                                $faqs->the_post();

                                ?>
                                <!-- Accordion item 1 -->
                                <div class="card">
                                    <div id="heading_<?= get_the_id() ?>"
                                         class="card-header bg-white shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold">
                                            <a href="#" data-toggle="collapse"
                                               data-target="#collapse_<?= get_the_id() ?>"
                                               aria-expanded="false" aria-controls="collapse_<?= get_the_id() ?>"
                                               class="d-block position-relative text-dark text-uppercase collapsible-link py-2">
                                                <?= the_title() ?></a></h6>
                                    </div>
                                    <div id="collapse_<?= get_the_id() ?>" aria-labelledby="heading_<?= get_the_id() ?>"
                                         data-parent="#accordion_faq"
                                         class="collapse">
                                        <div class="card-body px-3 py-5">
                                            <p class="font-weight-light m-0"><?= the_content() ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>

            </section>
            <?php
        }
        ?>

    </main>


<?php
//get_footer();
include('footer_training_platform.php');
