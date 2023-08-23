<?php
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
            <div class="col-lg-8 col-md-12 footer-info">
                <a href="/balkaun-uniku" class="logo d-flex align-items-center">
                    <span><?= lang('balkaun_uniku') ?></span>
                </a>
                <p>
                    <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_name', 'Ministério da Administração Estatal')) ?> <br>
                    <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_address', 'Rua 20 de Maio, nº43, Dili, Timor-Leste')) ?>
                    <br><br>
                    <strong><?= lang('phone') ?>:</strong> <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_phone', '(+670) 333 9077')) ?><br>
                    <strong><?= lang('email') ?>:</strong> <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_email', 'portalmunicipal.mae@gmail.com')) ?><br>
                </p>
            </div>



            <div class="col-lg-4 col-md-12 footer-contact text-center text-md-start">

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

    <div class="mt-4 py-2" style="
    /*background: rgba(150, 7, 7, 1);*/
    background: rgb(33 50 76);
">
        <div class="copyright">
            &copy; <?= date('Y') ?> <?= filter_text_wpglobus(get_theme_mod('municipality_address_entity_name', 'Ministério da Administração Estatal')) ?>
        </div>
    </div>

</footer><!-- End Footer -->
<!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/assets/vendor/purecounter/purecounter.js' ?><!--"></script>-->
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js' ?><!--"></script>-->
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js' ?><!--"></script>-->
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/vendor/aos/aos.js' ?>"></script>
<!--<script src="--><?php //echo get_stylesheet_directory_uri() . '/assets/vendor/php-email-form/validate.js' ?><!--"></script>-->

<!-- Template Main JS File -->
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/balkaun_uniku/js/script.js' ?>"></script>

</body>

</html>
