<?php include 'includes/modal_about_window.php' ?>
<?php include 'includes/modal_faq_window.php' ?>

<?php //include 'modal_municipality_profile_window.php'?>

<?php include 'includes/modal_datacatalog_window.php' ?>

<?php include 'includes/modal_library_window.php' ?>


<div class="modal fade" id="modal-municipality-project-detail" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <span style="text-transform:uppercase;padding-left: 15px;" id="panel_area_name">
				</span>&nbsp;<span id="project_count"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <div class="modal-body">
                <div class="container demo" id="pInfo">

                    <!-- container -->
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-login" role="dialog">
    <div class="modal-dialog" style="max-width: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><?php echo lang('login') ?></h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form action="<?= wp_login_url() ?>" method="post" name="loginform">
                    <div class="form-field">
                        <label><?= lang('Username') ?>:</label>
                        <input type="text" class="form-control" name="log"/>
                    </div>
                    <div class="form-field">
                        <label><?= lang('Password') ?>:</label>
                        <input type="password" class="form-control" name="pwd"/>
                    </div>

                    <div class="mt-4">
                        <button type="submit" name="wp-submit"
                                class="btn btn-primary btn-block m-0"><?= lang('login') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-sso-login" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><?php echo lang('login') ?></h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="mx-auto text-center">
                    <img class="img-fluid"
                         style="width: 250px"
                         src="<?= get_stylesheet_directory_uri() . '/assets/img/coursera-logo.svg' ?>" alt="">
                    <p class="text-muted my-4 text-italic">Sign in to the platform.</p>
                </div>

                <form method="post" name="loginform">
                    <div class="form-field">
                        <label><?= lang('Username') ?>:</label>
                        <input type="text" class="form-control" name="log"/>
                    </div>
                    <div class="form-field">
                        <label><?= lang('Password') ?>:</label>
                        <input type="password" class="form-control" name="pwd"/>
                    </div>

                    <div class="mt-4">
                        <button type="submit" name="wp-submit"
                                class="btn btn-primary btn-block m-0"><?= lang('login') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="scrollUp" style="bottom: 45px; right: 24px;">
    <a class="btn btn-floating">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<?php
$footer_img = get_theme_mod('municipality_footer_image');

$sponsor1_img = get_theme_mod('municipality_footer_sponsor1');
$sponsor2_img = get_theme_mod('municipality_footer_sponsor2');
$sponsor3_img = get_theme_mod('municipality_footer_sponsor3');
$sponsor4_img = get_theme_mod('municipality_footer_sponsor4');
$sponsor5_img = get_theme_mod('municipality_footer_sponsor5');


$sponsor1_url = filter_text_wpglobus(get_theme_mod('municipality_footer_sponsor1_url', '#!'));
$sponsor2_url = filter_text_wpglobus(get_theme_mod('municipality_footer_sponsor2_url', '#!'));
$sponsor3_url = filter_text_wpglobus(get_theme_mod('municipality_footer_sponsor3_url', '#!'));
$sponsor4_url = filter_text_wpglobus(get_theme_mod('municipality_footer_sponsor4_url', '#!'));
$sponsor5_url = filter_text_wpglobus(get_theme_mod('municipality_footer_sponsor5_url', '#!'));


?>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer pb-0">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-info">
                <h4 class="logo ds-flex align-items-center">
                    <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_name', 'Ministério da Administração Estatal')) ?>
                </h4>
                <p>
                    <strong><?= lang('address') ?>
                        :</strong> <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_address', 'Rua 20 de Maio, nº43, Dili, Timor-Leste')) ?>
                    <br>
                    <strong><?= lang('phone') ?>
                        :</strong> <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_phone', '(+670) 333 9077')) ?>
                    <br>
                    <strong><?= lang('email') ?>
                        :</strong> <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_email', 'portalmunicipal.mae@gmail.com')) ?>
                    <br>
                </p>
            </div>

            <div class="col-lg-2 col-md-12 footer-links">
                <h4><?= lang('Quick Link') ?></h4>
                <?php get_menu_quick_links();?>

            </div>

            <div class="col-lg-5 col-md-12 footer-contact text-md-start">
                <h4><?= lang('Sponsors') ?></h4>
                <div class="partners d-flex mt-4">
                    <a href="<?= $sponsor1_url ?>">
                        <?php
                        if ($sponsor1_img) {
                            ?>
                            <img class="sponsors-logo" alt="" src="<?= $sponsor1_img ?>">
                            <?php
                        }
                        ?>
                    </a>
                    <a href="<?= $sponsor2_url ?>">
                        <?php
                        if ($sponsor2_img) {
                            ?>
                            <img class="sponsors-logo" alt="" src="<?= $sponsor2_img ?>">
                            <?php
                        }
                        ?>
                    </a>
                    <a href="<?= $sponsor3_url ?>">
                        <?php if ($sponsor3_img) {
                            ?>
                            <img class="sponsors-logo" alt="" src="<?= $sponsor3_img ?>">
                            <?php
                        }
                        ?>
                    </a>
                    <a href="<?= $sponsor4_url ?>">
                        <?php
                        if ($sponsor4_img) {
                            ?>
                            <img class="sponsors-logo" alt="" src="<?= $sponsor4_img ?>">
                            <?php
                        }
                        ?>
                    </a>
                    <a href="<?= $sponsor5_url ?>">
                        <?php
                        if ($sponsor5_img) {
                            ?>
                            <img class="sponsors-logo" alt="" src="<?= $sponsor5_img ?>">
                            <?php
                        }
                        ?>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="container mt-4">
        <div class="copyright">
            &copy; <?= date('Y') ?><?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_name', 'Ministério da Administração Estatal')) ?>
        </div>
    </div>

</footer>
<!-- End Footer -->


<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/jquery.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/popper.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/wow.js' ?>"></script>

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/sweetalert2@10.js' ?>"></script>

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/dataTables.bootstrap4.min.js' ?>"></script>


<!--<script type="text/javascript"-->
<!--        src="--><?php //echo get_stylesheet_directory_uri() . '/assets/js/map/leaflet.js' ?><!--"></script>-->
<!---->
<!--<script type="text/javascript"-->
<!--        src="--><?php //echo get_stylesheet_directory_uri() . '/assets/js/map/leaflet.groupedlayercontrol.js' ?><!--"></script>-->


<?php

if (is_page('plataforma-de-treinamentu') || is_page('kona-ba-plataforma-treinamentu') || is_tax('courses-category')) {
    ?>
    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/purecounter/purecounter.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js' ?>"></script>
    <script>
        $(document).ready(function () {


            $('#hero-carousel').carousel({
                // interval: 10000,
            })
            new WOW().init();
            const glightbox = GLightbox({
                selector: '.glightbox'
            });

            /**
             * Init swiper slider with 1 slide at once in desktop view
             */
            new Swiper('.slides-why-us', {
                speed: 600,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                slidesPerView: 'auto',
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                }
            });

            $('#table-courses').dataTable({
                "pageLength": 25
            });

            $(".btn-view-course-details").on("click", function () {
                alert("It's just a sample data, not from coursera");
            });

            // let api_url='https://api.coursera.org/api/courses.v1/?start=10&limit=15&fields=id,slug,name,photoUrl,primaryLanguages,subtitleLanguages,partnerLogo,instructorIds,partnerIds,certificates,description,startDate,workload,previewLink,specializations,domainTypes,categories';
            let api_url = 'https://api.coursera.org/api/courses.v1/?fields=id,slug,name,photoUrl,primaryLanguages,subtitleLanguages,partnerLogo,instructorIds,partnerIds,certificates,description,startDate,workload,previewLink,specializations,domainTypes,categories';

            /* $.ajax({
                 url: api_url,
                 type: 'get',
                 dataType: 'json',
                 // headers: {  'Access-Control-Allow-Origin': 'https://api.coursera.org' },
                 success: function (response) {
                     console.log(response);
                 }
             })*/

            $(".btn-join-now").on("click", function () {
                window.location.href = '<?php echo home_url(); ?>/authentication';
                // $("#modal-sso-login").modal();
            })
        })
    </script>
    <?php
}

if (is_page('Services')) {
    ?>

    <script type="text/javascript"
            src="<?php echo get_stylesheet_directory_uri() . '/assets/js/map/leaflet.js' ?>"></script>

    <script type="text/javascript"
            src="<?php echo get_stylesheet_directory_uri() . '/assets/js/map/leaflet.js' ?>"></script>
    <script type="text/javascript"
            src="<?php echo get_stylesheet_directory_uri() . '/assets/js/map/leaflet.markercluster.js' ?>"></script>
    <script type="text/javascript"
            src="<?php echo get_stylesheet_directory_uri() . '/assets/js/map/leaflet.groupedlayercontrol.js' ?>"></script>
    <script type="text/javascript"
            src="<?php echo get_stylesheet_directory_uri() . '/assets/js/map/leaflet-easyPrint.js' ?>"></script>
    <script src="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js"></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>


    <?php
}
?>


<script>
    new WOW().init();

    function showPreLoader() {
        $(".please-wait").css('display', 'block');
        $(".load-wrapper").css('opacity', 1);
    }

    function hidePreLoader() {
        $(".please-wait").css('display', 'none');
        $(".load-wrapper").css('opacity', 0);
    }

    function getDate() {
        let d = new Date();
        let datestring = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear() + " " + d.getHours() + ":" + d.getMinutes();
        return (datestring.replace(':', '.'))

    } //getDate

    $(window).on('load', function () {
        hidePreLoader();
    });

    $(document).ready(function () {
        $(window).scroll(function () {

            if ($(this).scrollTop() > 100) {

                $('#scrollUp').fadeIn();
                $(".front-lang-switcher").addClass("bg-red");
                $(".fixed-top").addClass("bg-red");
            } else {
                $('#scrollUp').fadeOut();
                $(".front-lang-switcher").removeClass("bg-red");
                $(".fixed-top").removeClass("bg-red");
            }
        });
        // scroll body to 0px on click
        $('#scrollUp').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 300);
            return false;
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


        /* BEGIN ABOUT */
        let bgimg = "<?=lang_code() ?>";


        let asset_path = "<?php echo get_stylesheet_directory_uri()?>";
        // console.log(asset_path);
        //  alert("images/About-section_"+bgimg+".jpg");
        $("#modal-about .head_bg").css('background-image', 'url("' + asset_path + '/assets/img/About-section_' + bgimg + '.jpg")');
        $("#modal-faq .head_bg").css('background-image', 'url("' + asset_path + '/assets/img/About-section_' + bgimg + '.jpg")');

        /* END ABOUT */

        // BEGIN FAQ
        //$.ajax({
        //    url: "<?//=api_url(); ?>///" + bgimg + "/faqs",
        //    type: "get",
        //    success: function (res) {
        //        $(".faqs-list-container").html(res);
        //    }
        //});
        // END FAQ

        /* BEGIN LIBRARY */
        //
        $("#btn-view-library").on("click", function () {
            // loadLibrary();
        })
        // loadLibrary();
        $("body").on("click", "ul.download-list>li>a.active", function () {
            let counterHtmlItem = $(this).data("download-classname");
            download_lib_counter($(this).data("id"), counterHtmlItem);
        });

        function loadLibrary() {
            $.ajax({
                url: "<?=api_url(); ?>/library-list",
                type: "get",
                success: function (res) {
                    $(".library-content").html(res);
                    $(".table-library").DataTable({
                        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
                    });

                    // $("#bibilioteca-container").removeClass("hide");
                    // $("#modal-library").modal("show");
                }
            }).done(function () {
                hidePreLoader();
            });
        }

        function download_lib_counter(id, counterHtmlItemClassName) {
            // library-download-counter
            $.ajax({
                url: "<?=api_url(); ?>/library-download-counter",
                type: "post",
                data: {id: id},
                success: function (res) {
                    $("." + counterHtmlItemClassName).html(res.download_counter);
                }
            }).done(function () {
                hidePreLoader();
            });
        }

        /* END LIBRARY */
    });

</script>

<?php
if (is_front_page()) {
    ?>

    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/highcharts/highmaps.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/highcharts/exporting.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/highcharts/offline-exporting.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/highcharts/export-data.js' ?>"></script>
    <script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/highcharts/tl_all.js' ?>"></script>

    <script>
        $(document).ready(function () {
            $(".table-library").DataTable({
                // "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
            });
            /* BEGIN MUNICIPALITY PROFILES AND PROJECT MAP */
            let lang = "<?=lang_code() ?>";
            let area_data = [];
            var download_map = "";

            let projects = null;
            let data = [];


            $("body").on("click", ".btn-load-municipalities", function () {

                // showPreLoader();

                // load_municipality_profile();

            })

            let municipality_project_data = [];
            let municipality_project_data_values = [];


            getMunicipalityProject();

            // Get from wordpress page
            function getMunicipalityProject() {

                let municipalities_web_name = [
                    // 'aileu','ainaro','baucau','bobonaro','covalima','dili','ermera',
                    // 'lautem','liquica','manatuto','manufahi','viqueque'
                    'baucau', 'dili'
                ];

                let result_responses = [];


                let ajax_aileu = $.ajax({
                    url: 'https://aileu.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });

                let ajax_ainaro = $.ajax({
                    url: 'https://ainaro.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });


                let ajax_baucau = $.ajax({
                    url: 'https://baucau.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });

                let ajax_bobonaro = $.ajax({
                    url: 'https://bobonaro.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });
                let ajax_covalima = $.ajax({
                    url: 'https://covalima.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });

                let ajax_dili = $.ajax({
                    url: 'https://dili.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });
                let ajax_ermera = $.ajax({
                    url: 'https://ermera.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });
                let ajax_lautem = $.ajax({
                    url: 'https://lautem.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });
                let ajax_liquica = $.ajax({
                    url: 'https://liquica.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });
                let ajax_manatuto = $.ajax({
                    url: 'https://manatuto.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });
                let ajax_manufahi = $.ajax({
                    url: 'https://manufahi.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });
                let ajax_viqueque = $.ajax({
                    url: 'https://viqueque.gov.tl/wp-admin/admin-ajax.php',
                    type: 'post',
                    crossDomain: true,
                    data: {action: 'fetch_total_project'},
                    success: function (response) {
                        result_responses.push(response.data);
                    }
                });

                $.when(ajax_aileu, ajax_ainaro, ajax_baucau,
                    ajax_bobonaro, ajax_covalima,
                    ajax_dili, ajax_ermera, ajax_lautem, ajax_liquica,
                    ajax_manatuto, ajax_manufahi, ajax_viqueque
                ).then(function (result_aileu, result_ainaro, result_baucau, result_bobonaro, result_covalima, result_dili,
                                 result_ermera, result_lautem, result_liquica, result_manatuto, result_manufahi, result_viqueque) {

                    municipality_project_data.push([result_aileu[0].data.code, result_aileu[0].data.total]);
                    municipality_project_data_values[result_aileu[0].data.code] = result_aileu[0].data.total;

                    municipality_project_data.push([result_ainaro[0].data.code, result_ainaro[0].data.total]);
                    municipality_project_data_values[result_ainaro[0].data.code] = result_ainaro[0].data.total;

                    municipality_project_data.push([result_baucau[0].data.code, result_baucau[0].data.total]);
                    municipality_project_data_values[result_baucau[0].data.code] = result_baucau[0].data.total;

                    municipality_project_data.push([result_bobonaro[0].data.code, result_bobonaro[0].data.total]);
                    municipality_project_data_values[result_bobonaro[0].data.code] = result_bobonaro[0].data.total;

                    municipality_project_data.push([result_covalima[0].data.code, result_covalima[0].data.total]);
                    municipality_project_data_values[result_covalima[0].data.code] = result_covalima[0].data.total;

                    municipality_project_data.push([result_dili[0].data.code, result_dili[0].data.total]);
                    municipality_project_data_values[result_dili[0].data.code] = result_dili[0].data.total;

                    municipality_project_data.push([result_ermera[0].data.code, result_ermera[0].data.total]);
                    municipality_project_data_values[result_ermera[0].data.code] = result_ermera[0].data.total;

                    municipality_project_data.push([result_lautem[0].data.code, result_lautem[0].data.total]);
                    municipality_project_data_values[result_lautem[0].data.code] = result_lautem[0].data.total;

                    municipality_project_data.push([result_liquica[0].data.code, result_liquica[0].data.total]);
                    municipality_project_data_values[result_liquica[0].data.code] = result_liquica[0].data.total;

                    municipality_project_data.push([result_manatuto[0].data.code, result_manatuto[0].data.total]);
                    municipality_project_data_values[result_manatuto[0].data.code] = result_manatuto[0].data.total;

                    municipality_project_data.push([result_manufahi[0].data.code, result_manufahi[0].data.total]);
                    municipality_project_data_values[result_manufahi[0].data.code] = result_manufahi[0].data.total;

                    municipality_project_data.push([result_viqueque[0].data.code, result_viqueque[0].data.total]);
                    municipality_project_data_values[result_viqueque[0].data.code] = result_viqueque[0].data.total;

                    municipality_project_data.push(['TLS012', 0]);
                    municipality_project_data_values['TLS012'] = 0;

                    renderMap();
                })

            }//getMunicipalityProject

            // Get from laravel
            function get_municipality_projects(lang) {
                //showPreLoader();
                //$.ajax({
                //    url: "<?//=api_url() ?>///" + lang + "/all-projects-map-data",
                //    type: "get",
                //    success: function (res) {
                //        projects = res;
                //        for (const resKey in res) {
                //            data.push([resKey,res[resKey].total])
                //        }
                //        // renderMap();
                //    }
                //}).done(function () {
                //    hidePreLoader();
                //});
            }


            let projectDetails = {};

            function renderMap() {

                console.log(municipality_project_data);
                Highcharts.setOptions({
                    lang: {
                        zoomIn: "Zoom in",
                        zoomOut: "Zoom out"
                    }
                });
                Highcharts.mapChart('map-container', {
                    chart: {
                        map: 'countries/tl/tl-all'
                    },
                    exporting: {
                        enabled: true,
                        buttons: {
                            contextButton: {
                                enabled: false,
                                symbol: null,
                            },
                            exportButton: {
                                text: 'Download',
                                // Use only the download related menu items from the default
                                // context button
                                menuItems: [
                                    'downloadPNG',
                                    'downloadJPEG',
                                    // 'downloadPDF',
                                    'downloadSVG',
                                    'Fullscreen'
                                ]
                            }
                        },

                        chartOptions: {
                            chart: {
                                height: 650,
                                width: 1250,
                                marginBottom: 70,

                                // events: {
                                //   load: function () {
                                //     var renderer = this.renderer;
                                //     renderer.text('<i>source : ' + objdata['data_source'] + '</i>', 1150, 640).css({
                                //       width: '400px',
                                //       align: 'center',
                                //     }).add();
                                //   }
                                // }
                            },
                        },
                        filename: "<?php echo lang('Municiplities_With_Projects');?>" + getDate()

                    },

                    title: {
                        text: ''
                    },

                    subtitle: {
                        text: ''
                    },
                    mapNavigation: {
                        enabled: false,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },

                    colorAxis: {
                        min: 0,
                        // dataClasses: [{
                        //     to: 100,
                        //     color: "#ffb30f"
                        // }],
                        stops: [
                            [0, '#fdb210'],
                            [5, '#710013'],
                            [10, '#ae151b'],
                            [15, '#d11f26'],
                            [20, '#f24634'],
                            [25, '#fb7453'],
                            [30, '#f6d1c1'],
                        ],
                    },
                    plotOptions: {
                        series: {
                            allowPointSelect: true,
                            states: {
                                select: {
                                    color: '#e5190a',
                                    lineWidth: 2
                                }
                            },
                            point: {
                                events: {
                                    click: function () {
                                        let area_name = this.properties.name;
                                        // console.log(this.properties);
                                        let project = projects[this.properties.code];
                                        // console
                                        listInfo(area_name, project.location_id, project.total);
                                    }
                                }
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '',
                        formatter: function () {

                            let prStr = '<?php echo lang('project'); ?>';
                            let area_code = this.point.properties.code;
                            let li_data = "";

                            if (area_data[area_code] != undefined) {
                                if (area_data[area_code].length > 0) {

                                    area_data[area_code].forEach(function (ele) {
                                        if (ele.key != 'null') {
                                            li_data += '<li class=""><img src="' + ele.image_url + '" class="img-responsive img-data"> <span><p class="fnt-wgt">' + ele.key + '</p> <p class="fnt-wgt1" id="population">' + ele.value + '</p><span></li>';
                                        } else {
                                            $(".add_li").html("<li><?php echo lang('no_data'); ?></li>");
                                        }

                                    });

                                    $(".add_li").html(li_data);
                                } else {
                                    $(".add_li").html("<li><?php echo lang('no_data'); ?></li>");
                                }
                            } else {
                                $(".add_li").html("<li><?php echo lang('no_data'); ?></li>");
                            }


                            let totalProject = municipality_project_data_values[this.point.properties.code];

                            if (totalProject === undefined) {
                                totalProject = 0;
                            } else {
                                if (totalProject > 1) {
                                    prStr = '<?php echo lang('projects'); ?>';
                                }

                            }


                            return '<h6>' + this.point.properties.name + '</h6><br>' + prStr + ': ' + totalProject;

                        }
                    },

                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        itemMarginTop: 10,
                        itemMarginBottom: 10
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        data: municipality_project_data,
                        name: '<?php echo lang('projects');?>',
                        color: Highcharts.getOptions().colors[2],
                        states: {
                            hover: {
                                color: '#e5190a'
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            allowOverlap: true,
                            color: 'black',
                            style: {
                                textOutline: false,
                                width: "80px"
                            },
                            // format: '{point.name}',
                            formatter: function () {
                                // console.log(this.point.properties);
                                if (this.point.properties !== undefined) {
                                    // let totalProject = projects[this.point.properties.code].total;
                                    let totalProject = municipality_project_data_values[this.point.properties.code];

                                    if (totalProject === undefined) {
                                        totalProject = 0;
                                    }
                                    return this.point.name + " : " + totalProject;
                                }

                            }
                        }
                    }]
                });

            } //renderMap


            function listInfo(areaName, locationId, totalProject) {

                if (projectDetails == null) {
                    Swal.fire({
                        icon: 'error',
                        title: areaName + " " + totalProject + " <?= lang('project')?>",
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }
                var str = '';
                $('#pInfo').html(str);
                // console.log(projectDetails);
                $('#panel_area_name').html(areaName);
                // $('#areaFlag').attr('src', 'images/flags/dflags/' + jsUcfirst(areaName) + '.png');

                let strProject = "<?php echo lang('project');?>";

                if (totalProject > 1) {
                    strProject = "<?php echo lang('projects');?>";
                    $('#project_count').html("(" + totalProject + ' ' + strProject + ")");
                } else {
                    strProject = "<?php echo lang('project');?>";
                    $('#project_count').html("(" + totalProject + ' ' + strProject + ")");
                }

                var i = 0;
                str += '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';

                if (locationId === null) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: areaName + " " + totalProject + " <?= lang('project')?>",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return;
                }

                showPreLoader();

                $.ajax({
                    url: "<?=api_url(); ?>/" + lang + "/project-by-location/" + locationId,
                    type: "get",
                    success: function (res) {
                        // console.log(res.projects);

                        if (res.projects !== null) {
                            for (let i = 0; i < res.projects.length; i++) {
                                let projectItem = res.projects[i];
                                console.log('//////////////');
                                console.log(projectItem);
                                let clickable = '#collapseOne' + i, collapseChild = 'collapseOne' + i,
                                    id = "headingOne" + i;
                                if (projectItem.project != null) {
                                    str += '<div class="panel panel-default">';
                                    str += '<div class="panel-heading" role="tab" id="' + id + '">';
                                    str += '<h4 class="panel-title">';
                                    str += '<a role="button" data-toggle="collapse" data-parent="#accordion" href="' + clickable + '" aria-expanded="true" aria-controls="' + collapseChild + '">';
                                    str += '<i class="more-less fa fa-angle-down"> ';
                                    str += '</i>' + '<span style="font-size:17px;"><?php echo lang('project');?>: </span>' + projectItem.project.title;

                                    str += '</a>';
                                    str += '</h4>';
                                    str += '</div>';
                                    str += '<div id="' + collapseChild + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="' + id + '">';
                                    str += '<div class="panel-body">';
                                    str += '<table class="table"  style="padding:25px">';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('area');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    str += '<td style="width: 75%;">' + areaName;
                                    str += '</td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('description');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    // str += '<td>' + projectItem.project.description;
                                    str += '<td>';
                                    if (projectItem.project.description == null) {
                                        str += 'No data';
                                    } else {
                                        str += projectItem.project.description;
                                    }
                                    str += '</td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('budget');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    // str += '<td>' + projectItem.project.budget;
                                    str += '<td>';
                                    if (projectItem.project.budget == null) {
                                        str += 'No data';
                                    } else {
                                        str += projectItem.project.budget;
                                    }
                                    str += '</td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('lead_ministry');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    // str += '<td>' + projectItem.project.lead_ministry_or_department;
                                    str += '<td>';
                                    if (projectItem.project.lead_ministry_or_department == null) {
                                        str += 'No data';
                                    } else {
                                        str += projectItem.project.lead_ministry_or_department;
                                    }
                                    str += '</td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('project_startDate');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    // str += '<td>' + projectItem.project.start_date;
                                    str += '<td>';
                                    if (projectItem.project.start_date == null) {
                                        str += 'No data';
                                    } else {
                                        str += projectItem.project.start_date;
                                    }
                                    str += '</td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('project_endDate');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    // str += '<td>' + projectItem.project.end_date;
                                    str += '<td>';
                                    if (projectItem.project.end_date == null) {
                                        str += 'No data';
                                    } else {
                                        str += projectItem.project.end_date;
                                    }
                                    str += '</td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('project_url');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    // str += '<td>' + projectItem.project.url;
                                    str += '<td>';
                                    if (projectItem.project.url == null) {
                                        str += 'No data';
                                    } else {
                                        str += projectItem.project.url;
                                    }
                                    str += '</td>';
                                    str += '</tr>';

                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('project_coordenates');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    // str += '<td>' + projectItem.project.url;
                                    str += '<td>';
                                    str += 'Lat: ' + projectItem.project.latitude + ' | Lon: ' + projectItem.project.longitude;
                                    str += '</td>';
                                    str += '</tr>';

                                    str += '<td>';
                                    str += "<b><?php echo lang('sectors');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    if (projectItem.associates.sectors !== null) {
                                        let html = "";
                                        for (let j = 0; j < projectItem.associates.sectors.length; j++) {
                                            let item = projectItem.associates.sectors[j];
                                            html += "<span class='btn btn-secondary btn-sm mr-1'>" + item.name + "</span>";
                                        }
                                        str += '<td>' + html + '</td>';
                                    }
                                    str += '<td></td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('partners');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    if (projectItem.associates.partners !== null) {
                                        let html = "";
                                        for (let j = 0; j < projectItem.associates.partners.length; j++) {
                                            let item = projectItem.associates.partners[j];
                                            html += "<span class='btn btn-secondary btn-sm mr-1'>" + item.name + "</span>";
                                        }
                                        str += '<td>' + html + '</td>';
                                    }
                                    str += '<td></td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('donors');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    if (projectItem.associates.donors !== null) {
                                        let html = "";
                                        for (let j = 0; j < projectItem.associates.donors.length; j++) {
                                            let item = projectItem.associates.donors[j];
                                            html += "<span class='btn btn-secondary btn-sm mr-1'>" + item.name + "</span>";
                                        }
                                        str += '<td>' + html + '</td>';
                                    }
                                    str += '<td></td>';
                                    str += '</tr>';
                                    str += '<tr>';
                                    str += '<td>';
                                    str += "<b><?php echo lang('contact_information');?>";
                                    str += '</b>';
                                    str += '</td>';
                                    // str += '<td>' + projectItem.project.contact_information==Null?"No contact":projectItem.project.contact_information;
                                    str += '<td>';
                                    if (projectItem.project.contact_information == null) {
                                        str += 'No data';
                                    } else {
                                        str += projectItem.project.contact_information;
                                    }

                                    str += '</td>';
                                    str += '</tr>';
                                    str += '</table>';
                                    str += '</div>';
                                    str += '</div>';
                                    str += '</div>';
                                }


                            }

                            str += '</div>';
                            $('#pInfo').html(str);
                            $('#modal-municipality-project-detail').modal('show');
                        }
                    }

                }).done(function () {
                    hidePreLoader();
                })


            } //listInfo

            /* END MUNICIPALITY PROFILES AND PROJECT MAP */
        })
    </script>


    <?php
}
?>

<?php
if (is_page('Services')) {

    $base_url = default_base_url();
    $base_url_others = default_base_url();
    $api_url = api_url() . '/';


    $area = $_GET["area"];
    $sector = $_GET["sector"];
    if (!isset($area) || strlen($area) <= 0 || !isset($sector) || strlen($sector) <= 0) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }

    ?>
    <script>
        function showPreLoader() {
            $(".please-wait").css('display', 'block');
            $(".load-wrapper").css('opacity', 1);
        }

        function hidePreLoader() {
            $(".please-wait").css('display', 'none');
            $(".load-wrapper").css('opacity', 0);
        }

        $(window).on('load', function () {
            hidePreLoader();
        });

        $(document).ready(function () {

            $(window).scroll(function () {
                // if ($(this).scrollTop() > 400) {
                //     $('#scrollUp').fadeIn();
                //     $(".front-lang-switcher").addClass("bg-red");
                // } else {
                //     $('#scrollUp').fadeOut();
                //     $(".front-lang-switcher").removeClass("bg-red");
                // }
            });
            // scroll body to 0px on click
            $('#scrollUp').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 300);
                return false;
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


            let lang = "<?=lang_code() ?>";
            let area_code = "<?= $area?>";
            let service_type = "<?= $sector?>";

            /* BEGIN ABOUT */
            let bgimg = "<?=lang_code() ?>";

            function getDate() {
                let d = new Date();
                let datestring = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear() + " " + d.getHours() + ":" + d.getMinutes();
                return (datestring.replace(':', '.'))

            } //getDate

            let asset_path = "<?php echo get_stylesheet_directory_uri()?>";
            console.log(asset_path);
            //  alert("images/About-section_"+bgimg+".jpg");
            $("#modal-about .head_bg").css('background-image', 'url("' + asset_path + '/assets/img/About-section_' + bgimg + '.jpg")');
            $("#modal-faq .head_bg").css('background-image', 'url("' + asset_path + '/assets/img/About-section_' + bgimg + '.jpg")');

            /* END ABOUT */


            function get_sector_type(sector) {
                let ret = "N/A";
                switch (sector) {
                    case "1":
                        ret = "<?php echo lang('Sector1')?>";
                        break;
                    case "2":
                        ret = "<?php echo lang('Sector2') ?>";
                        break;
                    case "3":
                        ret = "<?php echo lang('Sector3') ?>";
                        break;
                    case "4":
                        ret = "<?php echo lang('Sector4') ?>";
                        break;
                    case "5":
                        ret = "<?php echo lang('Sector5') ?>";
                        break;
                }


                return ret;
            }//get_sector_type

            let map, markerClusters;


            // console.log(area_code, service_type);
            let markerOption = {
                closeButton: false,
                // offset: L.point(0, -20),
                direction: 'top',
                permanent: false,
                sticky: true,
                offset: [10, 0],
                opacity: 0.75,
                className: 'leaflet-tooltip'
            };


            getMunicipalityId(area_code);

            function getMunicipalityId(area_code) {

                $.ajax({
                    url: "<?=$api_url; ?>" + lang + "/municipality/" + area_code,
                    type: "get",
                    success: function (res) {
                        // console.log(res);
                        if (res.id != null) {
                            $("#municipalityId").val(res.id);

                            $("#municipalityName").val(res.name);
                            $(".profile_name").html(res.name);
                            $('.head_bg').css('background', 'url(' + res.banner_img + ')');
                            initializeMap();
                            getAgencies(res.id, service_type);
                        } else {
                            Swal.fire({
                                title: "<?= lang('municipality_not_found'); ?>",
                                allowOutsideClick: false,
                                position: 'top-end',
                                icon: 'warning',
                                confirmButtonText: 'Close',
                                backdrop: `
                                    rgba(150,7,7,0.5)
                                    url("/images/nyan-cat.gif")
                                    left top
                                    no-repeat`
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "<?= $base_url ?>/servicetocitizen.php";
                                }
                            });
                        }

                    }
                }).done(function () {
                    hidePreLoader();
                });
            }


            function initializeMap() {
                markerClusters = L.markerClusterGroup({
                    spiderfyOnMaxZoom: true,
                    showCoverageOnHover: false,
                    zoomToBoundsOnClick: true,
                    disableClusteringAtZoom: 16
                });

                sizeLayerControl();

                /* Basemap Layers */


                let osm = new L.TileLayer(
                    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    {attribution: 'Map data &copy; OpenStreetMap contributors'}
                );


                // let imagery = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                //     attribution: 'Timor-Leste Portal Municipal &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                //     maxZoom: 15,
                //     id: "mapbox.satellite",
                //     accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ'
                // });

                var mapBoxSatellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    maxZoom: 20,
                    id: 'mapbox/satellite-streets-v11',
                    accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ',
                    attribution: 'Satellite - Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                });

                var southWest = L.latLng(-9.976965850016063, 123.60443115234376),
                    northEast = L.latLng(-7.944996434709155, 127.99896240234376),
                    mapMaxBounds = L.latLngBounds(southWest, northEast);

                map = L.map("map", {
                    maxBounds: mapMaxBounds,
                    zoom: 8,
                    center: [-8.703548, 125.943446],
                    layers: [mapBoxSatellite, markerClusters],
                    zoomControl: true,
                    fullscreenControl: true,
                    attributionControl: false,
                    scrollWheelZoom: false
                });

                // addPrintControl();


                var baseLayers = {
                    'Satellite': mapBoxSatellite,
                    'OpenStreet Map': osm
                };
                var layerControl = L.control.groupedLayers(baseLayers, {collapsed: false}).addTo(map);

                /* GPS enabled geolocation control set to follow the user's location */
                var locateControl = L.control.locate({
                    position: "topleft",
                    drawCircle: true,
                    follow: true,
                    setView: true,
                    keepCurrentZoomLevel: true,
                    markerStyle: {
                        weight: 1,
                        opacity: 0.8,
                        fillOpacity: 0.8
                    },
                    circleStyle: {
                        weight: 1,
                        clickable: false
                    },
                    icon: "fa fa-location-arrow",
                    metric: true,
                    strings: {
                        title: "My location",
                        popup: "You are within {distance} {unit} from this point",
                        outsideMapBoundsMsg: "You seem located outside the boundaries of the map"
                    },
                    locateOptions: {
                        maxZoom: 18,
                        watch: true,
                        enableHighAccuracy: true,
                        maximumAge: 10000,
                        timeout: 10000
                    }
                }).addTo(map);

                /** End add control */

                map.on('click', function (e) {
                    // console.log(e.latlng);
                });


                // getCoordenates();

                let geojson_file = "<?php echo get_stylesheet_directory_uri() . '/assets/js/map/'?>" + area_code + ".geojson";
                $.getJSON(geojson_file, function (data) {
                    let municipalityMap = L.geoJson(data, {
                        style: function (feature) {
                            return {
                                // color: "#ffb30fff",
                                fillColor: "transparent",
                                weight: 2,
                                color: '#ffb30fff',
                                fillOpacity: 0.7
                            };
                        },
                        onEachFeature: function (feature, layer) {
                            layer.on({
                                click: function (e) {
                                    var properties = layer.feature.properties;
                                    var column = Object.keys(properties);

                                    // console.log(layer.feature);
                                }
                            });
                            layer.on('mouseover', function (e) {
                                layer.setStyle({
                                    weight: 3,
                                    fillOpacity: 0.1
                                });

                                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                                    layer.bringToFront();
                                }
                                //info.update(layer.feature.properties);
                            });
                            layer.on('mouseout', function (e) {
                                municipalityMap.resetStyle(e.target);
                                //info.update();
                            });
                        }
                    });


                    municipalityMap.addTo(map);

                    map.flyToBounds(municipalityMap.getBounds());
                });

            } // initializeMap

            var pois;
            var markerList = [];

            $(window).resize(function () {
                sizeLayerControl();
            });

            function sizeLayerControl() {
                $(".leaflet-control-layers").css("max-height", $("#map").height() - 50);
            } //sizeLayerControl


            function addPrintControl() {
                L.easyPrint({
                    position: 'topleft',
                    tileLayer: this.baseMap,
                    title: 'Export map',
                    // position: 'bottomright',
                    exportOnly: true,
                    hideControlContainer: true,
                    sizeModes: ['Current', 'A4Portrait', 'A4Landscape']
                }).addTo(map);
            }//addPrintControl


            function getAgencies(id, service_type) {

                let sector_name = get_sector_type(service_type);
                console.log("sector_name: " + sector_name);
                $(".sector_name").html(" | " + sector_name);
                $.ajax({
                    url: "<?=$api_url; ?>" + lang + "/municipality/" + id + "/agency/" + service_type,
                    type: "get",
                    success: function (res) {
                        let html = '', topNavTab = '', bottomNavTab = '';

                        if (res.length > 0) {

                            /* Top Nav*/

                            topNavTab += '<div class="row">';
                            topNavTab += '<div class="col-md-12">';
                            topNavTab += '<div style="margin: 20px;margin-bottom: 30px;">';
                            topNavTab += '<ul class="population_ul">';

                            for (let i = 0; i < res.length; i++) {
                                let category = res[i];
                                topNavTab += '<li class="open-modal1">';
                                topNavTab += '<a href="#upper-rack-' + category.id + '">';
                                topNavTab += '<img src="' + category.icon + '">';
                                topNavTab += '<p class="fnt-wgt ">' + category.name + '</p>';
                                topNavTab += '</a>';
                                topNavTab += '</li>';
                                // console.log(category);
                            }
                            topNavTab += '</ul>';
                            topNavTab += '</div>';
                            topNavTab += '</div>';
                            topNavTab += '</div>';


                            /* Bottom nav */

                            bottomNavTab += '<div class="scroll col-md-12">';
                            for (let i = 0; i < res.length; i++) {
                                let category = res[i];
                                bottomNavTab += '<div class="col-md-12" id="upper-rack-' + category.id + '">';
                                bottomNavTab += '<div class="area-border"><h4>' + category.name + '</h4>';

                                if (category.service_type == 5) {
                                    bottomNavTab += '<div class="table-responsive" style="padding: 10px;">';
                                    bottomNavTab += '<table id="table-municipal-administrative-procedure" class="table">';
                                    bottomNavTab += '<thead>';
                                    bottomNavTab += '<tr>';
                                    bottomNavTab += '<th style="    width: 40%;"><?= lang('Administrative-Post'); ?></th>';
                                    bottomNavTab += '<th style="    width: 25%;"><?= lang('Suco'); ?></th>';
                                    if (category.id == 23) {
                                        bottomNavTab += '<th><?= lang('Managed by'); ?></th>';
                                    } else {
                                        bottomNavTab += '<th><?= lang('Name'); ?></th>';
                                    }
                                    bottomNavTab += '<th><?= lang('Contact'); ?></th>';
                                    bottomNavTab += '</tr>';
                                    bottomNavTab += '</thead>';

                                    bottomNavTab += '<tbody>';

                                    if (category.agencies.length > 0) {
                                        for (let j = 0; j < category.agencies.length; j++) {
                                            let agency = category.agencies[j];

                                            let splitName = agency.name.split('|');
                                            bottomNavTab += '<tr>';
                                            bottomNavTab += '<td>' +
                                                '<a href="#!" class="btn-view-agency-location" ' +
                                                'data-latitude="' + agency.latitude + '" data-longitude="' + agency.longitude + '">' +
                                                splitName[0] +
                                                '</a>' +
                                                '</td>';
                                            bottomNavTab += '<td>' +
                                                '<a href="#!" class="btn-view-agency-location" ' +
                                                'data-latitude="' + agency.latitude + '" data-longitude="' + agency.longitude + '">' +
                                                splitName[1] +
                                                '</a>' +
                                                '</td>';
                                            bottomNavTab += '<td>' +
                                                '<a href="#!" class="btn-view-agency-location" ' +
                                                'data-latitude="' + agency.latitude + '" data-longitude="' + agency.longitude + '">' +
                                                splitName[2] +
                                                '</a>' +
                                                '</td>';
                                            bottomNavTab += '<td>' + agency.phone + '</td>';
                                            bottomNavTab += '</tr>';

                                            addMarkerIconOfAgency(category.icon, agency);

                                        }

                                    } else {
                                        bottomNavTab += '<tr><td class="text-center" colspan="5"><span class="text-info">No Data</span></td></tr>';
                                    }
                                    bottomNavTab += '</tbody>';
                                    bottomNavTab += '</table>';

                                    bottomNavTab += '</div>';
                                } else {
                                    bottomNavTab += '<div class="table-responsive" style="padding: 10px;">';
                                    bottomNavTab += '<table id="table-municipal-administrative-procedure" class="table">';
                                    bottomNavTab += '<thead>';
                                    bottomNavTab += '<tr>';
                                    bottomNavTab += '<th style="    width: 40%;"><?= lang('Agency/Department'); ?></th>';
                                    bottomNavTab += '<th style="    width: 25%;"><?= lang('Phone'); ?> </th>';
                                    bottomNavTab += '<th><?= lang('Contact Person'); ?></th>';
                                    bottomNavTab += '</tr>';
                                    bottomNavTab += '</thead>';
                                    bottomNavTab += '<tbody>';
                                    // console.log(category.agencies.length);
                                    if (category.agencies.length > 0) {
                                        for (let k = 0; k < category.agencies.length; k++) {
                                            let agency = category.agencies[k];
                                            bottomNavTab += '<tr>';
                                            bottomNavTab += '<td><a href="#!" class="btn-view-agency-location"';
                                            bottomNavTab += ' data-latitude="' + agency.latitude + '" data-longitude="' + agency.longitude + '">' + agency.name + ' </a></td>';
                                            bottomNavTab += '<td>' + agency.phone + '</td>';
                                            bottomNavTab += '<td>' + agency.contact_person + '</td>';
                                            bottomNavTab += '<tr>';
                                            bottomNavTab += '<tr>';
                                            bottomNavTab += '<tr>';
                                            bottomNavTab += '</tr>';

                                            addMarkerIconOfAgency(category.icon, agency);
                                        }
                                    } else {
                                        bottomNavTab += '<td class="text-center" colspan="3"><span class="text-info">No Data</span></td>';
                                    }
                                    bottomNavTab += '</tbody>';
                                    bottomNavTab += '</table>';
                                    bottomNavTab += '</div>';
                                }
                                bottomNavTab += '</div>';
                                bottomNavTab += '</div>';
                            }
                            bottomNavTab += '</div>';


                            html = topNavTab + bottomNavTab;

                        } else {
                            html = 'No data';
                        }


                        $(".result").html(html);
                    }
                });
            } //getAgencies


            function addMarkerIconOfAgency(icon, agency) {

                let html = '<div>';
                html += '<h6>' + $("#municipalityName").val() + '</h6>';
                html += '<strong>' + agency.name + '</strong>';
                html += '</br>' + agency.contact_person;
                html += '</br>' + agency.phone;
                html += '</div>';


                if (icon != null && icon != undefined) {
                    let sectorIcon = new L.icon({
                        iconSize: [25, 25], // width and height of the image in pixels
                        shadowSize: [35, 20], // width, height of optional shadow image
                        iconAnchor: [12, 12], // point of the icon which will correspond to marker's location
                        shadowAnchor: [12, 6],  // anchor point of the shadow. should be offset
                        popupAnchor: [0, 0], // point from which the popup should open relative to the iconAnchor
                        iconUrl: icon,
                        className: 'agency-marker-icon'
                    });
                    mMarker = L.marker([agency.latitude, agency.longitude], {icon: sectorIcon}).bindTooltip(html, markerOption);
                } else {
                    mMarker = L.marker([agency.latitude, agency.longitude]).bindTooltip(html, markerOption);
                }

                if (mMarker !== undefined) {
                    mMarker.agencyId = agency.id;
                    mMarker.on("click", showAgencyDetails);
                    mMarker.on('mouseover', function (ev) {
                        // console.log("ONMOUSEOVER")
                        ev.target.openPopup();
                    });
                    markerClusters.addLayer(mMarker);
                }
            }

            function showAgencyDetails(ev) {
                let agencyId = ev.target.agencyId;
                let latLng = ev.target._latlng;
                $.ajax({
                    url: "<?=$api_url; ?>" + lang + "/agency/details/" + agencyId,
                    type: "get",
                    success: function (res) {
                        // console.log(res);
                        let html = '<div>';
                        html += '<strong>' + res.agency.name + '</strong>';
                        html += '</br>' + res.agency.contact_person;
                        html += '</br>' + res.agency.phone;
                        html += '</div>';
                        if (res.agency != null) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: $("#municipalityName").val(),
                                icon: 'info',
                                html: html,
                                showCloseButton: true,
                                showCancelButton: false,
                                focusConfirm: true,
                            })
                        }


                    }
                })
            }

            $("body").on("click", ".btn-view-agency-location", function () {
                var id = $(this).data('id');
                var latitude = $(this).data("latitude");
                var longitude = $(this).data("longitude");
                // let marker = L.marker([latitude, longitude]).addTo(map);
                map.flyTo([latitude, longitude], 17);
            });

            $('body').on('click', '.open-modal1', function () {
                let link = $(this).children('a').attr('href');
                let arr1 = link.replace("#", "");
                $('.area-border').removeClass('redbg')
                $("[id='" + arr1 + "']").children('.area-border').addClass('redbg');

            });


        });
    </script>
    <?php
}
?>

<?php wp_footer(); ?>
</body>
</html>
