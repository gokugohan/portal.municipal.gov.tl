<?php get_header();

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
             style="background: url('<?= $post_image_feature_url ?>');">
            <div id="overlay1"></div>
            <div class="breadcrumbs-custom-inner" style="
position: absolute;
    left: 35%;
    top: 15%;
    transform: translate(-35%, 0%);
">
                <div class="container breadcrumbs-custom-container">
                    <div class="breadcrumbs-custom-main text-left">
                        <h2 class="text-white font-weight-bold"><?= the_title(); ?>
                            <small class="text-left mt-3"><i class=" text-white "> <?= lang("posted_at") ?>: <?php the_time('j F Y'); ?></i></small>
                        </h2>
                    </div>

                    <ul class="breadcrumbs-custom-path text-left text-white">
                        <li><a href="<?= bloginfo('url') ?>" class="text-white"><?= lang("home"); ?></a></li>
                        <li class="active text-white"><?= the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <h2 class="h3 font-weight-bold"><?= the_title(); ?></h2>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

<?php //comments_template(); ?>
<?php
get_footer();
