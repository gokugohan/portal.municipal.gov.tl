<?php
/*
  Template Name: The Service to Citizen page
 */
$base_url = default_base_url();
$base_url_others = default_base_url();
$api_url = api_url() . '/';
get_header();

?>

<style>
    ul.imgg-ull li:nth-child(1) {
        background: url("<?php echo get_stylesheet_directory_uri() . '/assets/img/sector/Administrative.png'?>") top center no-repeat;
    }

    ul.imgg-ull li:nth-child(2) {
        background: url("<?php echo get_stylesheet_directory_uri() . '/assets/img/sector/Economic-Sector.png'?>") top right no-repeat;
    }

    ul.imgg-ull li:nth-child(3) {
        background: url("<?php echo get_stylesheet_directory_uri() . '/assets/img/sector/Infrastructure.png'?>") top center no-repeat;
    }

    ul.imgg-ull li:nth-child(4) {
        background: url("<?php echo get_stylesheet_directory_uri() . '/assets/img/sector/social-sector.png'?>") top center no-repeat;
    }

    ul.imgg-ull li:nth-child(5) {
        background: url("<?php echo get_stylesheet_directory_uri() . '/assets/img/sector/health.png'?>") top center no-repeat;
    }
    .find-your-municipality>div{
        padding-left: 2.5rem;
        padding-right: 2.5rem;
        width: 50%;
        margin: 0 auto;
    }
    @media (max-width: 992px) {
        .find-your-municipality>div{
            width: 75%;
        }
    }
    @media (max-width: 767px) {
        .find-your-municipality>div{
            width: 100%;
            padding-right: 0;
        }
    }
</style>

<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container-fluid my-5">
        <div class="row justify-content-center hero-title my-3">
            <div class="col-md-12 text-center">
                <a class="navbar-brand " href="<?php echo bloginfo('url'); ?>">
                    <?php
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

                    <img class="header_logo" src="<?=$header_logo ?>">
                </a>

                <div class="container">
                    <h2 class="text-white bold text-uppercase">
                        <?= lang('service-to-citizen') ?>
                    </h2>
                </div>
                <br>
            </div>
        </div>

        <ul class="imgg-ull mb-5">
            <li class="btn-view-administrative-procedures hoverable">
                <div class="title"><a href="#"><?php echo lang('Sector1')?></a>
                </div>
            </li>
            <li class="btn-view-economic-sector hoverable">
                <div class="title"><a href="#"><?php echo lang('Sector2') ?></a>
                </div>
            </li>
            <li class="btn-view-infrastructure hoverable">
                <div class="title"><a href="#"><?php echo lang('Sector3')?></a>
                </div>
            </li>
            <li class="btn-view-social-sector hoverable">
                <div class="title"><a href="#"><?php echo lang('Sector4') ?></a>
                </div>
            </li>
            <li class="btn-view-health-post-center hoverable">
                <div class="title"><a href="#"><?php echo lang('Sector5') ?></a>
                </div>
            </li>
        </ul>

    </div>
</section>


<div>


    <?php
    $area = $_GET["area"];

    ?>

<!--    <div class="second" style="margin-top:0px;">-->
<!---->
<!--        <div class="head_bg municipality-gradient-bgcolor">-->
<!--            <div id="overlay1">-->
<!--                <div style="width:100%;overflow: hidden;">-->
<!--                    <svg viewBox="0 0 500 150" preserveAspectRatio="none"-->
<!--                         style="height: 100%; width: 100%;position: absolute; bottom:0;">-->
<!--                        <path d="M-35.83,-108.05 C443.28,318.25 382.34,74.50 510.44,-5.42 L500.00,150.00 L0.00,150.00 Z"-->
<!--                              style="stroke: none; fill: rgba(150,7,7,.5);"></path>-->
<!--                    </svg>-->
<!--                    </svg>-->
<!--                </div>-->
<!---->
<!--                <div class="container header-agencies-container">-->
<!--                    <div class="wrap">-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
    <!-- slide begin -->
    <?php //include("_partial_sector_slider.php") ?>
    <!--slide end-->

    <section class="section section-lg section-home-tab pt-5 pb-3">
        <div class="container-fluid" id="service-tab-container">
        </div>
    </section>
    <?php
get_footer();
?>
    <script type="text/javascript">


        $(document).ready(function () {


            $('ul.imgg-ull li').mouseover(function (e) {
                $('ul.imgg-ull li').css({'width': '16.66%', 'opacity': '0.6'})
                $(e.currentTarget).css({'width': '32%', 'opacity': '1'})

            });

            $("body").on('click', '#home-tab-tabs-link li', function () {
                var tab_id = $(this).attr('data-tab');

                // console.log(tab_id);
                $('#home-tab-tabs-link li').removeClass('active');
                $('.home-tab-item-content').removeClass('show active');

                $(this).addClass('active');
                $("#" + tab_id).addClass('show active');
                // $("#" + tab_id).toggleClass('animated');

            })

            $("body").on('click', '.library-tab-list li', function () {
                var tab_id = $(this).attr('data-tab');

                // console.log(tab_id);
                $('.library-tab-list li').removeClass('active');
                $('.home-tab-item-content').removeClass('show active');

                $(this).addClass('active');
                $("#" + tab_id).addClass('show active');
                // $("#" + tab_id).toggleClass('animated');

            })



            String.prototype.trimToLength = function (m) {
                return (this.length > m)
                    ? jQuery.trim(this).substring(0, m).split(" ").slice(0, -1).join(" ") + "..."
                    : this;
            };

            let lang = "<?=lang_code() ?>";
            $('body').on('click', '.open-modal1', function () {
                let link = $(this).children('a').attr('href');
                let arr1 = link.replace("#", "");
                console.log(arr1);
                $('.area-border').removeClass('redbg')
                $("[id='" + arr1 + "']").children('.area-border').addClass('redbg');

            });


            let area_code = "<?= $_GET["area"] ?>";

            getSectorServices(1);

            $("body").on("click", ".btn-view-administrative-procedures", function () {
                getSectorServices(1);
            });
            $("body").on("click", ".btn-view-economic-sector", function () {
                getSectorServices(2);
            });
            $("body").on("click", ".btn-view-infrastructure", function () {
                getSectorServices(3);
            });
            $("body").on("click", ".btn-view-social-sector", function () {
                getSectorServices(4);
            });
            $("body").on("click", ".btn-view-health-post-center", function () {
                getSectorServices(5);
            });

            function getSectorServices(sector) {
                showPreLoader();
                $.ajax({
                    //url: "<?//=$api_url; ?>///" + lang + "/" + sector + "-categories",
                    url: "<?=api_url(); ?>/" + lang + "/" + sector + "-services",
                    type: "get",
                    success: function (res) {
                        $("#service-tab-container").html(res);
                    }
                }).done(function () {
                    hidePreLoader();
                });
            }

            $("body").on("change", ".municipality_sector_service", function () {

                let selected = $("option:selected", this);
                let area_code = selected.val();

                let service_type = selected.data('service-type');
                //
                // console.log(selected);
                // console.log(service_type, area_code);

                showPreLoader();

                window.location.href = "<?= $base_url?>Services?area=" + area_code + "&sector=" + service_type;
            });


        });
    </script>

</div>


</body>
</html>


