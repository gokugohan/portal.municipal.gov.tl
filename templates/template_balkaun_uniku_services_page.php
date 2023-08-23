<?php
/*
  Template Name: Balkaun Úniku Page - Services page
 */
include "balkaun_uniku_header.php";
?>

<main id="main">
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url(<?= $hero_background_image?>);">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">

                    <div class="col-lg-12 text-center">
                        <h2><?= the_title() ?></h2>
                        <p><?= the_excerpt() ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php get_balkaun_uniku_breadcrumb(); ?>
    </div>
    <section id="service" class="services bg-light">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <?php
                $services = array(
                    'post_type' => 'balkaununiku',
                    'post_status' => 'publish',
                    'nopaging' => true

                );

                $service_query = new WP_Query($services);

                if ($service_query->have_posts()) {
                    ?>
                    <?php
                    while ($service_query->have_posts()) {
                        $service_query->the_post();
                        $feature_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                        if (has_post_thumbnail($post) && $feature_image != null) {
                            $post_image_feature_url = $feature_image;
                        } else {
                            $post_image_feature_url = get_template_directory_uri() . "/assets/img/front/teste.png";
                        }
                        ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="card">
                                <div class="card-img">
                                    <img src="<?php echo $post_image_feature_url; ?>" alt="" class="img-fluid">
                                </div>
                                <h3><a href="<?php echo the_permalink() ?>"
                                       class="stretched-link"><?= the_title() ?></a></h3>
                                <p><?= excerpt(25) ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php

                }
                wp_reset_postdata();
                ?>

            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php
include "balkaun_uniku_footer.php";
