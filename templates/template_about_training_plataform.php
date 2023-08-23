<?php
/*
  Template Name: About Training Platform
 */
?>
<?php get_header(); ?>
<?php
$about_image = get_theme_mod('municipality_education_platform_about_image');
if ($about_image == null) {
    $about_image = get_stylesheet_directory_uri() . '/assets/img/lib5.jpg';
}
?>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center"
    style="background-image: url('<?=$about_image?>');
            height: 50vh;">
        <div class="container position-relative text-lg-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-8">
                    <h1><?= the_title() ?></h1>

                    <?php
                    add_button_get_started();
                    ?>
                    <?php
                    $about_education_video_url_id = (get_theme_mod('municipality_education_platform_hero_video_url'));
                    $attr = array(
                        'League' => wp_get_attachment_url($about_education_video_url_id)
                    );

//                    echo wp_video_shortcode( $attr );

                    $video_url = ($attr['League']);
                    if(strlen($video_url)==0){
                        $about_education_video_url = "https://www.youtube.com/watch?v=4Jcl_fmoxDI";
                    }


                    ?>

                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-center position-relative"
                     data-aos="zoom-in" data-aos-delay="200">

                    <a href="<?= $video_url ?>" class="glightbox play-btn"></a>
                </div>

            </div>
        </div>
    </section>
    <!-- End Hero -->

    <!-- ======= About Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-9">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            ?>
                            <div class="about-training-content">
                                <?php the_content(); ?>
                            </div>
                            <?php
                        }
                    } else {
                        echo('No content yet.');
                    }
                    ?>
                </div>
                <style>
                    .icon-box{
                        padding:20px 10px !important;
                        margin-bottom: 4px;
                    }
                    .icon-box .img-container{
                        width: 74px !important;
                        padding: 15px !important;
                        margin-bottom: 15px !important;
                    }
                    .icon-boxes .icon-box h4{
                        font-size: 18px !important;
                    }
                </style>
                <div class="col-lg-3">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="icon-box">
                            <div class="img-container">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon1.svg' ?>"
                                     alt="">
                            </div>

                            <h4><?= lang('trainings') ?></h4>
                            <p><?= lang('training_quote') ?></p>
                        </div>
                        <div class="icon-box">
                            <div class="img-container">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon2.svg' ?>"
                                     alt="">
                            </div>
                            <h4><?= lang('expert_instructors') ?></h4>
                            <p><?= lang('mark_doren_quote') ?></p>
                        </div>
                        <div class="icon-box">
                            <div class="img-container">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon3.svg' ?>"
                                     alt="">
                            </div>
                            <h4><?= lang('lifetime_access') ?></h4>
                            <p><?= lang('lifetime_access_quote') ?></p>
                        </div>
                    </div><!-- End .content-->
                </div>

            </div>

        </div>
    </section><!-- End About Section -->

   <!-- <section class="about bg-white">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 about-left-img" data-aos="fade-left" data-aos-delay="100">
                    <img src="<?php /*echo get_stylesheet_directory_uri() . '/assets/img/course-2.jpg' */?>'?>"
                         class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                    <h3>Take the next step toward your personal and professional goals with us.</h3>
                    <p>The automated process all your website tasks. Discover tools and techniques to engage
                        effectively with vulnerable children and young people.</p>
                    <a href="#" class="btn btn-join-now">Join now for Free</a>
                </div>
            </div>

        </div>
    </section>-->



    <!-- ======= Trainers Section ======= -->
    <!--<section id="trainers" class="trainers">
        <div class="container" data-aos="fade-up">

            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="<?php /*echo get_stylesheet_directory_uri() . '/assets/img/trainers/trainer-1.jpg' */ ?>"
                             class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Walter White</h4>
                            <span>Web Development</span>
                            <p>
                                Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis
                                quaerat qui aut aut aut
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="<?php /*echo get_stylesheet_directory_uri() . '/assets/img/trainers/trainer-2.jpg' */ ?>"
                             class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>Sarah Jhinson</h4>
                            <span>Marketing</span>
                            <p>
                                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum
                                rerum temporibus
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <img src="<?php /*echo get_stylesheet_directory_uri() . '/assets/img/trainers/trainer-3.jpg' */ ?>"
                             class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>William Anderson</h4>
                            <span>Content</span>
                            <p>
                                Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum
                                toro des clara
                            </p>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>-->
    <!-- End Trainers Section -->


<?php
get_footer();
