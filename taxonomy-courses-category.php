<?php if (!defined('ABSPATH')) exit();
get_header();
global $post;

$term = get_queried_object();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$id = get_the_ID();

$args = array(
    'taxonomy' => 'courses-category',
    'orderby' => 'name',
    'order' => 'ASC',
    "hide_empty" => false,
);

$categories = get_categories($args);

$term_id = get_queried_object_id();


$about_image = get_theme_mod('municipality_education_platform_about_image');
if ($about_image == null) {
    $about_image = get_stylesheet_directory_uri() . '/assets/img/lib5.jpg';
}

?>

    <main id="main-window">
        <?php
        //    include('templates/hero_training_platform_01.php');
        //        if ($about_education_video_url == false || strlen($about_education_video_url) == 0) {
        //            include ('hero_training_platform_02.php');
        //        }else{
        //            include ('hero_training_platform_01.php');
        //        }
        $page_image_feature = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

        if (has_post_thumbnail($post) && $page_image_feature != null) {
            $post_image_feature_url = $page_image_feature;
        } else {
            $post_image_feature_url = show_default_background_image(); //get_template_directory_uri() . "/img/wave.png";
        }
        //
        //    echo $term->name; // will show the name
        //    echo $term->taxonomy; // will show the taxonomy
        //    echo $term->slug; // will show taxonomy slug
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
                            <h2 class="text-white font-weight-bold"><?= $term->name; ?>
                            </h2>
                        </div>

                        <ul class="breadcrumbs-custom-path text-left text-white">
                            <li><a href="<?= bloginfo('url') ?>/plataforma-de-treinamentu"
                                   class="text-white"><?= lang("training-platform"); ?></a></li>
                            <li class="active text-white"><?= $term->name; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .nav-courses-category a.nav-link {
                color: #fff !important;
                background: #960807c7;
                font-weight: normal;
            }

            .nav-courses-category a.nav-link span.badge {
                background-color: white !important;
                color: #ad3e3d !important;
            }

            .nav-courses-category li.nav-item:hover {
                background: transparent;
            }

            .nav-courses-category a.nav-link:hover,
            .nav-courses-category a.nav-link.active {
                color: #fff !important;
                border-radius: 10px;
                border: none;
                background: #960807;
            }


        </style>

        <div class="rounded container-fluid pt-0 py-5">
            <div class="card rounded shadow border-0">
                <div class="card-body p-5 bg-white rounded">
                    <div class="row">
                        <div class="col-md-12">

                            <ul class="nav-courses-category mb-3 nav nav-tabs
                            nav-pills d-flex flex-column flex-sm-row text-center
                                border-0 rounded-nav aos-init aos-animate">
                                <?php
                                if ($categories) {
                                    foreach ($categories as $cate) {
                                        ?>
                                        <?php
                                        if ($cate->term_id == $term_id) {
                                            ?>
                                            <li class="nav-item flex-sm-fill mb-1 pl-0 pr-1" role="presentation">
                                                <a href="<?php echo esc_url(get_term_link($cate->term_id)) ?>"
                                                   class="nav-link px-4 active">
                                                    <i class="bi bi-book-half mr-2"></i>

                                                    <?php echo esc_html($cate->cat_name) ?>
                                                    <span class="badge bg-white text-white"><?php echo esc_html($cate->count) ?></span>

                                                </a>
                                            </li>
                                            <?php
                                        } else {
                                            ?>
                                            <li class="nav-item flex-sm-fill mb-1 pl-0 pr-1" role="presentation">
                                                <a href="<?php echo esc_url(get_term_link($cate->term_id)) ?>"
                                                   class="nav-link px-4">
                                                    <i class="bi bi-book-half mr-2"></i>

                                                    <?php echo esc_html($cate->cat_name) ?>
                                                    <span class="badge bg-white text-white"><?php echo esc_html($cate->count) ?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="table-courses">
                                    <thead>
                                    <tr>
                                        <th><?= lang('name') ?></th>
                                        <th><?= lang('University/Industry Partner') ?></th>
                                        <th><?= lang('Difficulty') ?></th>
                                        <th><?= lang('Skill Learned') ?></th>
                                        <th><?= lang('Specialization') ?></th>
                                        <th><?= lang('Course Language') ?></th>
                                        <th><?= lang('Subtitle Language') ?></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $course_by_category_args = array(
                                        'post_type' => 'coursera-courses',
                                        'post_status' => 'publish',
                                        'nopaging' => true,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => $term->taxonomy,
                                                'field' => 'slug',
                                                'terms' => array($term->slug),
                                                'operator' => 'IN'
                                            ),
                                        ),
                                    );

                                    $course_query = new WP_Query($course_by_category_args);

                                    if ($course_query->have_posts()) {
                                        ?>
                                        <?php
                                        while ($course_query->have_posts()) {
                                            $course_query->the_post();
                                            $partner = get_post_meta($post->ID, 'course_partner', true);
                                            $difficulty_level = get_post_meta($post->ID, 'course_difficulty', true);
                                            $course_url = get_post_meta($post->ID, 'course_url', true);
                                            $skill_learned = get_post_meta($post->ID, 'course_skill_learned', true);
                                            $specialization = get_post_meta($post->ID, 'course_specialization', true);
                                            $subtitle_language = get_post_meta($post->ID, 'course_subtitle', true);
                                            $course_language = get_post_meta($post->ID, 'course_language', true);
                                            ?>
                                            <tr>
                                                <td><a href="<?= $course_url ?>" target="_blank"><?= the_title() ?></a>
                                                </td>
                                                <td><?= $partner ?></td>
                                                <td><?= $difficulty_level ?></td>
                                                <td><?= $skill_learned ?></td>
                                                <td><?= $specialization ?></td>
                                                <td><?= $course_language ?></td>
                                                <td><?= $subtitle_language ?></td>
                                                <td><a href="#!" data-toggle="modal"
                                                       data-target="#course<?= $post->ID ?>" class="font-weight-bold">
                                                        <i class="bi bi-chevron-double-right"></i>
                                                    </a></td>
                                            </tr>


                                            <div class="modal fade" id="course<?= $post->ID ?>" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Description
                                                                of <?= the_title() ?></h5>
                                                            <button type="button"
                                                                    class="close bg-transparent position-static"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= the_content() ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary "
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="button" class="btn btn-primary">Save changes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--                                    </div>-->
                                            <?php
                                        }
                                        ?>
                                        <?php

                                    }
                                    wp_reset_postdata();
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </main>



<?php
//get_footer();
include('templates/footer_training_platform.php');
