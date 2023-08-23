<?php

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
    'nopaging' => false,
    'posts_per_page' => 10,
    'post_type' => array('post'),
    'post_status' => 'publish',
    'paged' => $paged,
);
$posts = new WP_Query($args);

?>
<?php get_header(); ?>

    <div class="pt-0 py-5 bg-light">
        <div class="container-fluid py-5">
<!--            <header class="mb-5 text-center">-->
<!--                <div class="row">-->
<!--                    <div class="col-lg-12 mx-auto">-->
<!--                        <h1 class="h1 text-center text-uppercase default-text-color">--><?//=the_title();?><!--</h1>-->
<!--                        <small><i>--><?php //the_time('j F Y'); ?><!--</i></small>-->
<!--                        <hr>-->
<!--                        <br>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </header>-->
            <div class="row align-items-stretch">
                <?php
                if ($posts->have_posts()) {
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        $post_image_feature = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

                        if (has_post_thumbnail($post)) {
                            $post_image_feature_url = $post_image_feature;
                        } else {

                            $post_image_feature_url = show_default_background_image();//get_template_directory_uri() . "/images/wave.png";
                        }
//                                $posttags = get_the_tags();

                        ?>
                        <div class="col-xl-3 col-lg-6 col-md-6 wow-outer">
                            <article class="post-modern wow slideInLeft p-2 hoverable shadow">
                                <a class="post-modern-media"
                                   href="<?= the_permalink() ?>">
                                    <img
                                            src="
                            <?= $post_image_feature_url ?>" alt="" width="570" height="352"></a>
                                <h4 class="post-modern-title">
                                    <a href="<?= the_permalink() ?>">
                                        <?= the_title() ?>
                                    </a>
                                    <small class="text-muted"><?= lang("posted_at") ?>:
                                        <?php the_time('j M Y'); ?></small>
                                </h4>
                                <!--                                <div class="excerpt mt-2">-->
                                <!--                                    --><?php //echo(excerpt()); ?><!--</div>-->
                            </article>


                        </div>
                        <?php
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                    ?>
                    <?php
                } else {
                    ?>
                    <div class="news-item">
                        <h3 class="centered text-info">No news</h3>
                    </div>
                    <?php
                }
                ?>
            </div><!-- /row -->
        </div>

    </div>
<?php
get_footer();
