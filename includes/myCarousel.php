

<style>
    #myCarousel .carousel-item .mask {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-attachment: fixed;
    }

    #myCarousel h1 {
        font-size: 50px;
        margin-bottom: 15px;
        color: #FFF;
        line-height: 100%;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    #myCarousel h1 span {
        color: #d7d3d3;
        font-size: 40px;
    }

    #myCarousel p {
        font-size: 18px;
        margin-bottom: 15px;
        color: #d5d5d5;
    }

    #myCarousel .carousel-item a {
        color: #960807;
        border: 1px solid #960807;
        font-size: 14px;
        padding: 13px 32px;
        display: inline-block;
    }

    #myCarousel .carousel-item a:hover {
        background: #960807;
        text-decoration: none;
    }

    #myCarousel .carousel-item h1 {
        -webkit-animation-name: fadeInLeft;
        animation-name: fadeInLeft;
    }

    #myCarousel .carousel-item p {
        -webkit-animation-name: slideInRight;
        animation-name: slideInRight;
    }

    #myCarousel .carousel-item a {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
    }

    #myCarousel .container {
        max-width: 1430px;
    }

    #myCarousel .carousel-item {
        height: 75vh;
        min-height: 550px;
    }


    #myCarousel .btn-watch-video {
        font-size: 13px;
        transition: 0.3s;
        margin-left: 25px;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-block;
        padding: 12px 30px;
        border-radius: 50px;
        line-height: 1;
        color: white;
        border: 1px solid #960807;
        margin-top: 20px;
    }

    <?php
    $hero_background_image = get_theme_mod('municipality_education_platform_hero_image');
            if ($hero_background_image == null) {
                $hero_background_image = get_stylesheet_directory_uri() . '/assets/img/lib3.jpg';
            }
    ?>
    #myCarousel {
        position: relative;
        z-index: 0;
        background-image: url(<?=$hero_background_image?>);
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .carousel-control-next, .carousel-control-prev {
        height: 40px !important;
        width: 40px !important;
        padding: 12px;
        top: 50%;
        bottom: auto;
        transform: translateY(-50%);
        background-color: #960807;
    }


    .carousel-item {
        position: relative;
        display: none;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 100%;
        transition: -webkit-transform .6s ease;
        transition: transform .6s ease;
        transition: transform .6s ease, -webkit-transform .6s ease;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-perspective: 1000px;
        perspective: 1000px;
    }

    .carousel-fade .carousel-item {
        opacity: 0;
        -webkit-transition-duration: .6s;
        transition-duration: .6s;
        -webkit-transition-property: opacity;
        transition-property: opacity
    }

    .carousel-fade .carousel-item-next.carousel-item-left, .carousel-fade .carousel-item-prev.carousel-item-right, .carousel-fade .carousel-item.active {
        opacity: 1
    }

    .carousel-fade .carousel-item-left.active, .carousel-fade .carousel-item-right.active {
        opacity: 0
    }

    .carousel-fade .carousel-item-left.active, .carousel-fade .carousel-item-next, .carousel-fade .carousel-item-prev, .carousel-fade .carousel-item-prev.active, .carousel-fade .carousel-item.active {
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0)
    }

    @supports (transform-style:preserve-3d) {
        .carousel-fade .carousel-item-left.active, .carousel-fade .carousel-item-next, .carousel-fade .carousel-item-prev, .carousel-fade .carousel-item-prev.active, .carousel-fade .carousel-item.active {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0)
        }
    }

    .carousel-fade .carousel-item-left.active, .carousel-fade .carousel-item-next, .carousel-fade .carousel-item-prev, .carousel-fade .carousel-item-prev.active, .carousel-fade .carousel-item.active {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }


    @-webkit-keyframes fadeInLeft {
        from {
            opacity: 0;
            -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            -webkit-transform: translate3d(-100%, 0, 0);
            transform: translate3d(-100%, 0, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .fadeInLeft {
        -webkit-animation-name: fadeInLeft;
        animation-name: fadeInLeft;
    }

    @-webkit-keyframes fadeInUp {
        from {
            opacity: 0;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }

        to {
            opacity: 1;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .fadeInUp {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
    }

    @-webkit-keyframes slideInRight {
        from {
            -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
            visibility: visible;
        }

        to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes slideInRight {
        from {
            -webkit-transform: translate3d(100%, 0, 0);
            transform: translate3d(100%, 0, 0);
            visibility: visible;
        }

        to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }
    }

    .slideInRight {
        -webkit-animation-name: slideInRight;
        animation-name: slideInRight;
    }

</style>

<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="mask d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 order-md-1 order-2">
                            <h1 class="wow fadeInUp"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_title'))) ?></h1>
                            <p class="wow fadeInUp">
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description'))) ?>
                            </p>

                            <div class="btns d-flex wow fadeInUp">
                                <?php
                                add_button_get_started();
                                ?>
                                <!--                        <a href="-->
                                <?//= $video_url ?><!--" class="glightbox play-btn"></a>-->
                                <a href="<?= $video_url ?>"
                                   class="glightbox btn-watch-video d-flex align-items-center">
                                    <i class="fa fa-play"></i> <span class="pl-2"> Watch Video</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="mask d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 order-md-1 order-2">
                            <h1 class="wow fadeInUp"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_title'))) ?></h1>
                            <p class="wow fadeInUp">
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description'))) ?>
                            </p>

                            <div class="btns d-flex wow fadeInUp">
                                <?php
                                add_button_get_started();
                                ?>
                                <!--                        <a href="-->
                                <?//= $video_url ?><!--" class="glightbox play-btn"></a>-->
                                <a href="<?= $video_url ?>"
                                   class="glightbox btn-watch-video d-flex align-items-center">
                                    <i class="fa fa-play"></i> <span class="pl-2"> Watch Video</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="mask d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 order-md-1 order-2">
                            <h1 class="wow fadeInUp"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_title'))) ?></h1>
                            <p class="wow fadeInUp">
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description'))) ?>
                            </p>

                            <div class="btns d-flex wow fadeInUp">
                                <?php
                                add_button_get_started();
                                ?>
                                <!--                        <a href="-->
                                <?//= $video_url ?><!--" class="glightbox play-btn"></a>-->
                                <a href="<?= $video_url ?>"
                                   class="glightbox btn-watch-video d-flex align-items-center">
                                    <i class="fa fa-play"></i> <span class="pl-2"> Watch Video</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span
                class="carousel-control-prev-icon" aria-hidden="true"></span> <span
                class="sr-only">Previous</span>
        </a> <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span
                class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<!--slide end-->
