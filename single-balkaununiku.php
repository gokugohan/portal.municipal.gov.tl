<?php if (!defined('ABSPATH')) exit();
include "templates/balkaun_uniku_header.php";
$page_image_feature = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

if (has_post_thumbnail($post) && $page_image_feature != null) {
    $post_image_feature_url = $page_image_feature;
} else {
    $post_image_feature_url = get_template_directory_uri() . "/assets/img/front/teste.png";
}
gt_set_post_view();

$front_logo = get_bu_setting('bu_front_logo', true);

$logo = $front_logo?$front_logo:get_stylesheet_directory_uri() . '/assets/img/front/d56b07fa25b1c546b415c695ae197aef.png';

?>
    <style>
        #hero{
            background-image:url(<?=$post_image_feature_url?>);
        }
    </style>

    <main id="main">
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center" style="background-image: url(<?=$post_image_feature_url?>);">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 text-center">
                            <div class="hero-logo mb-2">
                                <img class="header-logo img-fluid mb-4"
                                     src="<?=$logo ?>"
                                     alt="<?= the_title(); ?>">
                            </div>
                            <h2><?= the_title(); ?></h2>
                            <?= the_excerpt() ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_balkaun_uniku_breadcrumb(); ?>
        </div>
    <section>
        <div class="container">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    ?>
                    <div class="text-justify">
                        <?php the_content(); ?>
                    </div>
                    <?php
                }
            }

            ?>
        </div>
    </section>
    </main>

<?php //get_footer();
include 'templates/balkaun_uniku_footer.php';
