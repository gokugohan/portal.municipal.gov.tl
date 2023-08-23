<?php

$bg1 = get_theme_mod('municipality_education_platform_hero_bg_1');
$bg2 = get_theme_mod('municipality_education_platform_hero_bg_2');
$bg3 = get_theme_mod('municipality_education_platform_hero_bg_3');


$bg1 = strlen($bg1)>0?$bg1:get_stylesheet_directory_uri() . '/assets/img/lib6.jpg';
$bg2 = strlen($bg2)>0?$bg2:get_stylesheet_directory_uri() . '/assets/img/lib6.jpg';
$bg3 = strlen($bg3)>0?$bg3:get_stylesheet_directory_uri() . '/assets/img/lib6.jpg';


?>
<style>
    /* Carousel styling */
    #introCarousel,
    .carousel-inner,
    .carousel-item,
    .carousel-item.active {
        height: 100vh;
    }

    .carousel-item .mask {
        background: linear-gradient(
                50deg,
                rgba(0, 0, 7, 0.48),
                rgba(0, 0, 0, 0.13) 100%
        );


    }

    .carousel-item .mask h3 {
        font-size: 2rem;
        font-weight: 500;
        text-shadow: none;
    }

    .carousel-item{
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }

    .carousel-item:nth-child(1) {
        background-image: url('<?php echo $bg1?>');

    }

    .carousel-item:nth-child(2) {
        background-image: url('<?php echo $bg2 ?>');
    }

    .carousel-item:nth-child(3) {
        background-image: url('<?php echo $bg3 ?>');
    }

    /* Height for devices larger than 576px */
    @media (min-width: 992px) {
        #introCarousel {
            margin-top: -58.59px;
        }

        #introCarousel,
        .carousel-inner,
        .carousel-item,
        .carousel-item.active {
            height: 75vh;
        }


    }

    @media (max-width: 992px) {
        .carousel-item .mask h3 {
            /*font-size: 36px;*/
        }
    }
    @media (max-width: 600px) {
        .carousel-container .carousel-static-top h1{
            font-size: 36px;
        }
        .carousel-item .mask h3 {
            font-size: 24px;
        }
    }

    @media (max-width: 384px) {
        .carousel-container .carousel-static-top h1{
            font-size: 24px !important;
        }
        .carousel-item .mask h3 {
            font-size: 18px !important;
        }
    }

    @media (max-width: 360px) {
        .carousel-container .carousel-static-top h1{
            font-size: 20px !important;
        }
        .carousel-item .mask h3 {
            font-size: 18px !important;
        }
    }

    @media (max-width: 320px) {
        nav.navbar .navbar-brand{
            width: 50px;
        }
        .navbar-dark .navbar-toggler-icon{
            font-size: 18px;
        }
    }

    .carousel-control-next, .carousel-control-prev {
        width: 5% !important;
        color: #960707;
        background: transparent;
        border: none;
    }


    .carousel-container .carousel-static-top {
        position: absolute;
        width: 100%;
        top: 25%;
        left: 50%;
        transform: translate(-50%,-50%);
    }

    .carousel-container .carousel-static-top h1{
        color: #fff;
        text-align: center;
        font-size: 2.5rem;
    }

    .carousel-container .carousel-static-bottom {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translate(-50%,-50%);
    }

    .carousel-container .carousel-static-bottom .play-btn {
        width: 94px;
        height: 94px;
        background: radial-gradient(#960807 50%, rgba(150, 8, 7, 0.4) 52%);
        border-radius: 50%;
        display: block;
        position: relative;
        overflow: hidden;
        margin: 0 auto;
    }

    .carousel-container .carousel-static-bottom .play-btn::before {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        -webkit-animation-delay: 0s;
        animation-delay: 0s;
        -webkit-animation: pulsate-btn 2s;
        animation: pulsate-btn 2s;
        -webkit-animation-direction: forwards;
        animation-direction: forwards;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        -webkit-animation-timing-function: steps;
        animation-timing-function: steps;
        opacity: 1;
        border-radius: 50%;
        border: 5px solid rgba(150, 8, 7, 0.7);
        top: -15%;
        left: -15%;
        background: rgba(198, 16, 0, 0);
    }

    .carousel-container .carousel-static-bottom .play-btn::after {
        content: "";
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translateX(-40%) translateY(-50%);
        width: 0;
        height: 0;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-left: 15px solid #fff;
        z-index: 100;
        transition: all 400ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
    }


</style>

<div class="carousel-container">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="mask">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="container">
                            <h3 class="text-white text-center"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description3'))) ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="mask">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="container">
                            <h3 class="text-white text-center">
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description2'))) ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div
                        class="mask">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="container">
                            <h3 class="text-white text-center">
                                <?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_description'))) ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>

        <div class="carousel-static-top">
            <h1 class="wow fadeInUp"><?= htmlspecialchars_decode(filter_text_wpglobus(get_theme_mod('municipality_education_platform_hero_title'))) ?></h1>
        </div>

        <div class="carousel-static-bottom">
            <a href="https://www.youtube.com/watch?v=4Jcl_fmoxDI" class="glightbox play-btn"></a>
        </div>
    </div>

</div>


