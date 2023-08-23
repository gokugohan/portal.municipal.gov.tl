<?php
/*
  Template Name: The Document page
 */
?>
<?php get_header(); ?>


<?php
if (have_posts()) {
//    the_post();
    $post_image_feature = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

    if (has_post_thumbnail($post) && $post_image_feature != null) {
        $post_image_feature_url = $post_image_feature;
    } else {
        $post_image_feature_url = show_default_background_image(); //get_template_directory_uri() . "/img/wave.png";
    }
}

$args = array(
    'taxonomy' => 'municipality_doc_category',
    'orderby' => 'name',
    'order' => 'ASC',
    "hide_empty" => 0,
);


$categories = get_categories($args);
?>

    <div class="second" style="margin-top:0px;">
        <div class="head_bg"
             style="background: url('<?= $post_image_feature_url ?>');">
            <div id="overlay1"></div>
            <div class="breadcrumbs-custom-inner">
                <div class="container breadcrumbs-custom-container">
                    <div class="breadcrumbs-custom-main text-left">
                        <h1 class="breadcrumbs-custom-subtitle title-decorated text-white"><?= lang("documents"); ?></h1>
                    </div>
                    <ul class="breadcrumbs-custom-path text-left text-white">
                        <li><a href="<?= bloginfo('url') ?>" class="text-white"><?= lang("home"); ?></a></li>
                        <li class="active"><?= lang("documents"); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="section section-lg section-home-tab">
        <div class="container w-85 wow-outer wow slideInRight">
            <?php
            if ($categories) {
                ?>
                <div class="row municipality-doc-categories">
                    <?php
                    foreach ($categories as $cate) {
                        ?>
                        <div class="col-md-6">
                            <a href="<?php echo esc_url(get_term_link($cate->term_id)) ?>"
                               class="nav-link text-dark px-4 hoverable" style="font-size: 22px">
                                <i class="fa fa-folder-open mr-2"></i>
                                <span style="font-size: 22px" class="d-inline"><?php echo esc_html($cate->cat_name) ?></span>
                                <span class="badge bg-secondary d-inline pull-right" style="font-size: 12px;"><?php echo esc_html($cate->count) ?></span>

                            </a>
                        </div>

                        <?php
                    }
                    }
                    ?>

                </div>

        </div>
    </section>
    <input type="hidden" id="municipalityId">
<?php
get_footer();
