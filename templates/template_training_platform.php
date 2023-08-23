<?php
/*
  Template Name: Training Platform Template faq
 */
?>
<?php get_header(); ?>
<?php
$about_education_video_url_id = (get_theme_mod('municipality_education_platform_hero_video_url'));
$attr = array(
    'League' => wp_get_attachment_url($about_education_video_url_id)
);
$about_education_video_url = ($attr['League']);
if ($about_education_video_url == false || strlen($about_education_video_url) == 0) {
    $about_education_video_url = "https://www.youtube.com/watch?v=4Jcl_fmoxDI";
}


?>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
        <div class="container position-relative text-lg-start">
            <div class="row">
                <div class="col-lg-8">

                    <h1 class="wow fadeInUp"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_title'))) ?></h1>


                    <!-- Bootstrap carousel-->
                    <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">
                        <!-- Bootstrap carousel indicators [nav] -->
                        <ol class="carousel-indicators mb-0">
                            <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>


                        <!-- Bootstrap inner [slides]-->
                        <div class="carousel-inner pb-4">
                            <!-- Carousel slide-->
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

                            <!-- Carousel slide-->
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

                            <!-- Carousel slide-->
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
                        <!--                        <a href="-->

                        <!--                        <a href="-->
                        <?//= $video_url ?><!--" class="glightbox btn-watch-video d-flex align-items-center">-->
                        <!--                            <i class="fa fa-play"></i> <span class="pl-2"> Watch Video</span>-->
                        <!--                        </a>-->
                    </div>

                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-center position-relative wow fadeInUp">
                    <a href=" <?= $about_education_video_url ?>" class="glightbox play-btn"></a>
                </div>

            </div>
        </div>

    </section>
    <!-- End Hero -->


    <div class="services-area bg-white d-none">
        <div class="container">
            <div class="row justify-content-sm-center">

                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services mb-30 wow bounceInUp" data-wow-duration="1s">
                        <div class="features-icon">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon1.svg' ?>" alt="">
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
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon2.svg' ?>" alt="">
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
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/icon3.svg' ?>" alt="">
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
                    <div class="col-xl-5 text-center aos-init aos-animate" data-aos="fade-right" data-aos-delay="100">
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
                            <div class="col-xl-4 d-flex align-items-stretch wow bounceInUp" data-wow-duration="1.5s">
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
                            <div class="col-xl-4 d-flex align-items-stretch wow bounceInUp" data-wow-duration="2.5s">
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

            <style>

                /* Rounded tabs */

                @media (min-width: 576px) {
                    .rounded-nav {
                        border-radius: 50rem !important;
                    }
                }

                @media (min-width: 576px) {
                    .rounded-nav .nav-link {
                        border-radius: 50rem !important;
                    }
                }

                /* With arrow tabs */

                .with-arrow .nav-link.active {
                    position: relative;
                }

                .with-arrow .nav-link.active::after {
                    content: '';
                    border-left: 6px solid transparent;
                    border-right: 6px solid transparent;
                    border-top: 6px solid #960807;
                    position: absolute;
                    bottom: -6px;
                    left: 50%;
                    transform: translateX(-50%);
                    display: block;
                }

                /* lined tabs */

                #courses-tab li.nav-item:hover a.nav-link {
                    color: #fff !important;
                }

                .lined .nav-link {
                    border: none;
                    border-bottom: 3px solid transparent;
                }

                .lined .nav-link:hover {
                    border: none;
                    border-bottom: 3px solid transparent;

                }

                .lined .nav-link.active {
                    background: none;
                    color: #555;
                    border-color: #960807;
                }
            </style>

            <div class="py-5 bg-light rounded shadow  wow bounceInUp">
                <div class="row">
                    <div class="col-lg-3 mb-lg-0">
                        <!-- Lined tabs-->
                        <ul id="courses-tab" role="tablist"
                            class="nav nav-tabs nav-pills with-arrow lined ds-flex flex-column flex-sm-row text-left">
                            <li class="nav-item flex-sm-fill">
                                <a id="data-science-tab" data-toggle="tab" href="#data-science" role="tab"
                                   aria-controls="data-science"
                                   aria-selected="true"
                                   class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0 active">DATA
                                    SCIENCE</a>
                            </li>
                            <li class="nav-item flex-sm-fill">
                                <a id="programming-tab" data-toggle="tab" href="#programming" role="tab"
                                   aria-controls="programming"
                                   aria-selected="false"
                                   class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0">PROGRAMMING</a>
                            </li>
                            <li class="nav-item flex-sm-fill">
                                <a id="gis-tab" data-toggle="tab" href="#gis" role="tab" aria-controls="gis"
                                   aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0">GEOGRAPHIC
                                    INFORMATION SYSTEM (GIS)</a>
                            </li>
                            <li class="nav-item flex-sm-fill">
                                <a id="mobile-tab" data-toggle="tab" href="#mobile" role="tab" aria-controls="mobile"
                                   aria-selected="false" class="nav-link text-uppercase font-weight-bold rounded-0">MOBILE</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div id="courses-tab-content" class="tab-content">
                            <div id="data-science" role="tabpanel" aria-labelledby="home-tab"
                                 class="tab-pane fade px-4 show active">
                                <!-- Bootstrap carousel-->
                                <div class="carousel slide" id="carouselCourseIndicators" data-ride="carousel">
                                    <!-- Bootstrap carousel indicators [nav] -->
                                    <ol class="carousel-indicators mb-0">
                                        <li class="active" data-target="#carouselCourseIndicators"
                                            data-slide-to="0"></li>
                                        <li data-target="#carouselCourseIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselCourseIndicators" data-slide-to="2"></li>
                                    </ol>


                                    <!-- Bootstrap inner [slides]-->
                                    <div class="carousel-inner px-5 pb-4">
                                        <!-- Carousel slide-->
                                        <div class="carousel-item active">
                                            <div class="row">

                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Introduction to Data Science in Python</a>
                                                            </h3>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Data Analysis & Visualization</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Python Pandas: Handling & Analyzing Data</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Statistic with Python</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <!-- Carousel slide-->
                                        <div class="carousel-item">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Introduction to Data Science in Python</a>
                                                            </h3>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Data Analysis & Visualization</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Python Pandas: Handling & Analyzing Data</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Statistic with Python</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Carousel slide-->
                                        <div class="carousel-item">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Introduction to Data Science in Python</a>
                                                            </h3>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Data Analysis & Visualization</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Python Pandas: Handling & Analyzing Data</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                                    <div class="course-item">
                                                        <img src="https://d1rytvr7gmk1sx.cloudfront.net/wp-content/uploads/2021/10/data-science.jpg"
                                                             class="img-fluid" alt="...">
                                                        <div class="course-content">

                                                            <h3><a href="#!" class="btn-view-course-details">Statistic with Python</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    <!-- Bootstrap controls [dots]-->
                                    <a class="carousel-control-prev width-auto" href="#carouselCourseIndicators"
                                       role="button" data-slide="prev">
                                        <i class="fa fa-angle-left text-dark text-lg"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next width-auto" href="#carouselCourseIndicators"
                                       role="button" data-slide="next">
                                        <i class="fa fa-angle-right text-dark text-lg"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div id="programming" role="tabpanel" aria-labelledby="profile-tab"
                                 class="tab-pane fade px-4">

                                <div class="row">
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mt-lg-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://cdn.mos.cms.futurecdn.net/9QTpESGBXa32D29J77VR3d-970-80.jpg.webp"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Clasic game pong with Javascript</a></h3>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mt-lg-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://cdn.mos.cms.futurecdn.net/9QTpESGBXa32D29J77VR3d-970-80.jpg.webp"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Programming Object Oriented with C#</a></h3>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mt-lg-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://cdn.mos.cms.futurecdn.net/9QTpESGBXa32D29J77VR3d-970-80.jpg.webp"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Internet of things</a></h3>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mt-lg-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://cdn.mos.cms.futurecdn.net/9QTpESGBXa32D29J77VR3d-970-80.jpg.webp"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">ASP.NET Core Rest APIs</a></h3>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="gis" role="tabpanel" aria-labelledby="gis-tab" class="tab-pane fade px-4">
                                <div class="row">

                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://gisgeography.com/wp-content/uploads/2014/07/What-Is-Geographic-Information-Systems-Featured-1265x727.jpg"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Search Engine
                                                        Optimization</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://gisgeography.com/wp-content/uploads/2014/07/What-Is-Geographic-Information-Systems-Featured-1265x727.jpg"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Search Engine
                                                        Optimization</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://gisgeography.com/wp-content/uploads/2014/07/What-Is-Geographic-Information-Systems-Featured-1265x727.jpg"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Search Engine
                                                        Optimization</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://gisgeography.com/wp-content/uploads/2014/07/What-Is-Geographic-Information-Systems-Featured-1265x727.jpg"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3 class="display-1"><a href="#!" class="btn-view-course-details">Search
                                                        Engine Optimization</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="mobile" role="tabpanel" aria-labelledby="mobile-tab" class="tab-pane fade px-4">
                                <div class="row">

                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://matheusrumetna.com/wp-content/uploads/2022/03/mobile.png"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Flutter</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://matheusrumetna.com/wp-content/uploads/2022/03/mobile.png"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Android</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://matheusrumetna.com/wp-content/uploads/2022/03/mobile.png"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3><a href="#!" class="btn-view-course-details">Android Architecture</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0 mb-md-4">
                                        <div class="course-item">
                                            <img src="https://matheusrumetna.com/wp-content/uploads/2022/03/mobile.png"
                                                 class="img-fluid" alt="...">
                                            <div class="course-content">

                                                <h3 class="display-1"><a href="#!" class="btn-view-course-details">IOS</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- End lined tabs -->
            </div>


        </div>
    </section>
    <!-- End Popular Courses Section -->

<?php
//get_footer();
include(ROOT . '/footer_training_platform.php');
