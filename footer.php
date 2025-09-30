<?php include 'includes/modal_about_window.php' ?>
<?php //include 'includes/modal_faq_window.php' ?>

<?php //include 'modal_municipality_profile_window.php'?>

<?php //include 'includes/modal_datacatalog_window.php' ?>

<?php //include 'includes/modal_library_window.php' ?>


<div id="scrollUp" style="bottom: 45px; right: 24px;">
    <a class="btn btn-floating">
        <i class="fa fa-chevron-up"></i>
    </a>
</div><?php
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


<input type="hidden" id="admin-ajax-url" value="<?= admin_url('admin-ajax.php'); ?>">
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
<!--<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=e7e913ca-51ac-4a32-96d7-bad7d87e76f9"> </script>-->

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/jquery.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/popper.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/wow.js' ?>"></script>

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/sweetalert2@10.js' ?>"></script>

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/jquery.dataTables.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/dataTables.bootstrap4.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/purecounter_vanilla.js' ?>"></script>
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/assets/js/highcharts/highcharts.js' ?><!--"></script>-->
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/assets/js/populations.js' ?><!--"></script>-->

<script>
    new WOW().init();
    new PureCounter({
        pulse: false,
        separator: ","
    });

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

        })


        /* BEGIN ABOUT */
        let bgimg = "<?=lang_code() ?>";


        let asset_path = "<?php echo get_stylesheet_directory_uri()?>";
        // console.log(asset_path);
        //  alert("images/About-section_"+bgimg+".jpg");
        $("#modal-about .head_bg").css('background-image', 'url("' + asset_path + '/assets/img/About-section_' + bgimg + '.jpg")');
        $("#modal-faq .head_bg").css('background-image', 'url("' + asset_path + '/assets/img/About-section_' + bgimg + '.jpg")');

        /* END ABOUT */

    });

</script>

<?php
if (is_front_page()) {
    ?>


    <script>
        $(document).ready(function () {
            $(".table-library").DataTable({
                // "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
            });

        })
    </script>


    <?php
}
?>

<?php wp_footer(); ?>
</body>
</html>
