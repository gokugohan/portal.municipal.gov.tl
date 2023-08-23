<?php if (!defined('ABSPATH')) exit();
get_header();
$page_image_feature = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

if (has_post_thumbnail($post) && $page_image_feature != null) {
    $post_image_feature_url = $page_image_feature;
} else {
    $post_image_feature_url = show_default_background_image(); //get_template_directory_uri() . "/img/wave.png";
}
gt_set_post_view();

?>

    <div class="second" style="margin-top:0px;">
        <div class="head_bg"
             style="background: url('<?= $post_image_feature_url ?>'); height: 330px !important;">
            <div id="overlay1"></div>
            <div class="breadcrumbs-custom-inner" style="
position: absolute;
    left: 35%;
    top: 15%;
    transform: translate(-35%, 0%);
">
                <div class="container breadcrumbs-custom-container text-center">
                    <div class="breadcrumbs-custom-main">
                        <h2 class="text-white font-weight-bold"><?= the_title(); ?></h2>
                    </div>

                    <ul class="breadcrumbs-custom-path text-white">
                        <li><a href="<?= bloginfo('url') ?>" class="text-white"><?= lang("home"); ?></a></li>
                        <li class="active text-white"><?= the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <?php the_content(); ?>
    </div>

<?php get_footer();
