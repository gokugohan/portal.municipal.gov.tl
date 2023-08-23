<?php
/*
  Template Name: New Homepage
 */
?>
<?php
get_header();
?>

    <section id="perfil-dos-municipios" class="section bg-white section-lg text-center pt-4 pb-0">
        <div class="container-fluid pt-5">
            <div class="section-header py-0">
                <span><?= lang('portal_municipal') ?></span>
                <h2><?= lang('municipality-profile') ?></h2>
                
            </div>
            

            <div class="row mt-4 mx-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!--                        <h5 class="card-title"-->
                            <!--                            style="color: #960707 !important;">--><?php //echo $lang['menu']['municipality']; ?>
                            <!--                        </h5>-->
                            <!--                            <div id="modal_municipality_list">Loading...</div>-->


                            <!--                            <div class="tt--map" style="border: #ccc; clear: both">-->
                            <!--                                <hr/>-->
                            <!--                                <div class="row">-->
                            <!---->
                            <!--                                    <div class="col-md-12">-->
                            <!--                                        <div id="map-container">Loading...</div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="col-md-12 map-icon pt-5 border-top">-->
                            <!--                                        <ul class="map-data add_li list-inline" style="list-style: none;"></ul>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->

                            <?php
                            $args = array(
                                'post_type' => array('municipality'),
                                'nopaging' => true,
                                'post_status' => 'publish',
                                'order' => 'ASC',
                                'orderby' => 'title',
                            );

                            $the_query = new  WP_Query($args);

                            if ($the_query->have_posts()) {
                                while ($the_query->have_posts()) {
                                    $the_query->the_post();
                                    $thumbnail = get_the_post_thumbnail_url(get_the_ID());
                                    if (!$thumbnail) {
                                        $thumbnail = get_stylesheet_directory_uri() . "/assets/img/corosall4.jpg";
                                    }

                                    if(WPGlobus::Config()->language=='tm'){
                                        $website = get_post_meta($post->ID, 'municipality_profilewebsite', true);
                                    }else{
                                        $website = get_post_meta($post->ID, 'municipality_profilewebsite', true).WPGlobus::Config()->language;
                                    }

                                    $population = get_post_meta($post->ID, 'municipality_profilepopulation', true);
                                    $surface = get_post_meta($post->ID, 'municipality_profilesurface', true);
                                    $language = get_post_meta($post->ID, 'municipality_profilelanguage', true);
                                    $capital = get_post_meta($post->ID, 'municipality_profilecapital', true);
                                    ?>
                                    <div class="view view-first">
                                        <img src="<?= $thumbnail ?>">
                                        <div class="mask">

                                            <a target="_blank"
                                               href="<?= $website?>" class="info">
                                                <h2>
                                                    <?=the_title()?>

                                                </h2>
                                                <div class="municipality-tooltip">
                                                    <span>
                                                        Population: <?= $population ?> <br>
                                                        Area: <?= $surface ?> <br>
                                                        Language: <?= $language ?> <br>
                                                        Capital: <?= $capital ?> <br>
                                                    </span>
                                                </div>
                                            </a>


                                        </div>
                                    </div>
                                    <?php
                                }

                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <section id="mapping-of-investment" class="section bg-white section-lg text-center pt-4">
        <div class="container-fluid">
            <div class="section-header pb-0">
                <span><?= lang('portal_municipal') ?></span>
                <h2><?= lang('mapping-of-investment') ?></h2>
            </div>
            <div class="container">
                <p class="text-italic mb-3"><?php echo lang('mapping-of-investment-subtitle'); ?></p>
                <p><?php echo lang('mapping-of-investment-description'); ?></p>

            </div>

            <div class="row mt-4 mx-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div style="border: #ccc; clear: both">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="map-container"><img style="width: 25px;"
                                                                     src="<?php echo get_stylesheet_directory_uri() . '/assets/img/sdg_circle.svg' ?>">
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-md-12 map-icon pt-5 border-top">-->
                                    <!--                                        <ul class="map-data add_li list-inline" style="list-style: none;">Loading...-->
                                    <!--                                        </ul>-->
                                    <!--                                    </div>-->

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

<?php
if (is_plugin_simple_download_manager_active()) {


    $lib_category_args = array(
//    'taxonomy' => 'library_category',
        'taxonomy' => 'sdm_categories',
        'orderby' => 'name',
        'order' => 'ASC',
        "hide_empty" => 0,
    );

    $lib_categories = get_categories($lib_category_args);


    ?>
    <section class="section section-lg pt-4" id="biblioteka">
        <div class="container-fluid pt-5">
                <div class="section-header pb-0">
                    <span><?= lang('portal_municipal') ?></span>
                    <h2><?= lang('library') ?></h2>
                </div>
            <div class="mt-4 mx-0 home-tab-container">
                <div class="card">
                    <div class="card-body">
                        <div class="home-tab-text">
                            <div class="home-tab-tabs">
                                <ul id="home-tab-tabs-link" class="home-tab-tabs-link library-tab-list with-triangle">
                                    <?php
                                    $cat_counter = 0;
                                    $show_active_class = ' active';

                                    foreach ($lib_categories as $category) {
                                        if ($cat_counter != 0) {
                                            $show_active_class = '';
                                        }
                                        $cat_counter++;
                                        ?>
                                        <li class="<?= $show_active_class ?>"
                                            data-tab="tab-library-category-<?= $category->slug ?>">
                                            <a href="javascript:void(0)"> <?= ($category->cat_name) ?>
                                                (<?php echo esc_html($category->count) ?>)</a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="box-dynamic-slide">
                                <!--                                                    <div class="library-content"></div>-->
                                <div class="library-content-files">
                                    <div class="box-slide tab-slide-promo">
                                        <div class="home-tab-tabs-content">
                                            <?php

                                            $cat_counter = 0;
                                            $show_active_class = ' show active';

                                            $lib_post_args = array(
//                                    'post_type' => array('library'),
                                                'post_type' => array('sdm_downloads'),
                                                'post_status' => 'publish',
                                                'orderby' => 'title',
                                                'order' => 'ASC',
                                            );
                                            foreach ($lib_categories as $category) {
                                                $lib_post_args['tax_query'] = array(
                                                    array(
//                                            'taxonomy' => 'library_category',
                                                        'taxonomy' => 'sdm_categories',
                                                        'field' => 'slug',
                                                        'terms' => $category->slug,
                                                    ),
                                                );
                                                if ($cat_counter != 0) {
                                                    $show_active_class = '';
                                                }
                                                $cat_counter++;
                                                ?>

                                                <div id="tab-library-category-<?= $category->slug ?>"
                                                     class="home-tab-item-content <?= $show_active_class ?>">
                                                    <div class="table-responsive">
                                                        <table class="table table-library">
                                                            <thead>
                                                            <tr>
                                                                <th><?= lang('title') ?></th>
                                                                <th>Total Download</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php

                                                            $lib_posts = new WP_Query($lib_post_args);
                                                            if ($lib_posts->have_posts()) {

                                                                while ($lib_posts->have_posts()) {
                                                                    $lib_posts->the_post();
//
//                                                $tm_file_path = get_post_meta($post->ID, 'library_attachment_file_tm', true);
//                                                $pt_file_path = get_post_meta($post->ID, 'library_attachment_file_pt', true);
//                                                $en_file_path = get_post_meta($post->ID, 'library_attachment_file_en', true);


                                                                    $id = $post->ID;
                                                                    $homepage = get_bloginfo('url');
                                                                    $download_url = $homepage . '/?smd_process_download=1&download_id=' . $id;


                                                                    $db_count = sdm_get_download_count_for_post($id);
                                                                    $string = ($db_count == '1') ? lang('Download') : lang('Downloads');
                                                                    $download_count_string = '<span class="font-weight-bold">' . $db_count . '</span><span class="font-weight-bold"> ' . $string . '</span>';

                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="<?= $download_url ?>"
                                                                               style="color: #960807;"
                                                                               class="py-2"
                                                                               title="<?= the_title() ?>"><?= the_title(); ?></a>
                                                                            <a class="active py-2 float-right"
                                                                               style="width: 20px;"

                                                                               href="<?= $download_url ?>"
                                                                            >
                                                                                <img class="img-fluid"
                                                                                     src="<?php echo get_stylesheet_directory_uri() . '/assets/img/activ-icons_download.svg' ?>">
                                                                            </a>
                                                                        </td>
                                                                        <td><?= $download_count_string ?></td>
                                                                    </tr>

                                                                    <?php


                                                                }
                                                                wp_reset_postdata();
                                                            }

                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php
                                            }


                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </section>

    <?php
}
?>

<?php
get_footer();
