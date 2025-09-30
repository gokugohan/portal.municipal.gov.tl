<?php
/*
  Template Name: New Homepage
 */
?>
<?php
get_header();
?>

    <section id="perfil-dos-municipios" class="section bg-whites section-lg text-center pt-4 pb-0"style="background: #ebebeb;">
        <div class="container-fluid pt-5">
            <div class="section-header py-0">
                <span><?= lang('portal_municipal') ?></span>
                <h2><?= lang('municipality-profile') ?></h2>

            </div>


            <div class="row mt-4 mx-0">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
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
                                    <div class="view view-first wow fadeInUp">
                                        <img src="<?= $thumbnail ?>">
                                        <div class="mask">

                                            <a target="_blank"
                                               href="<?= $website?>" class="info">
                                                <h2>
                                                    <?=the_title()?>

                                                </h2>
                                                <div class="municipality-tooltip">
                                                    <span>
                                                        <?= lang("Population")?>: <?= $population ?> <br>
                                                        <?= lang("Area")?>: <?= $surface ?> <br>
                                                        <?= lang("Language")?>: <?= $language ?> <br>
                                                        <?= lang("Capital")?>: <?= $capital ?> <br>
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


<?php
if (is_plugin_simple_download_manager_active()) {


    $lib_category_args = array(
        'taxonomy' => 'sdm_categories',
        'orderby' => 'name',
        'order' => 'ASC',
        "hide_empty" => 0,
    );

    $lib_categories = get_categories($lib_category_args);
    ?>
    <style>

        .municipality-doc-categories a.nav-link {
            color: #3a393a;
            display: flex;
            flex-direction: column;
            text-align: center;
            background: #fff;
            height: 100%;
            border-radius: 10px;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
            padding: .9rem;
        }

        .municipality-doc-categories a.nav-link:hover {
            box-shadow: 0 0 20px rgba(65, 62, 151, .51);
        }

        .municipality-doc-categories a.nav-link > i {
            color: #960707;
            /*font-size: 80px;*/
            font-size: 40px;
            transition: 0.3s;
        }

        .btn-document-category.active{
            box-shadow: 0 0 20px rgba(65, 62, 151, .51);
            background: #960707 !important;
        }

        .btn-document-category.active i,
        .btn-document-category.active span,
        .btn-document-category:hover i,
        .btn-document-category:hover span,
        .btn-tender-category:hover i,
        .btn-tender-category:hover span
        {
            color: #ffffff !important;
        }

        .btn-document-category:hover{
            background: #960707 !important;
        }

        #document-loader {
            text-align: center;
        }

        #document-loader img {
            width: 50px;
            height: 50px;
            /*position: absolute;*/
            top: 50%;
            left: 50%;
            /*margin-left: -50px;*/
            /*margin-top: -50px;*/
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }


        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(1turn)
            }
        }

        @keyframes spin {
            to {
                transform: rotate(1turn)
            }
        }


    </style>
    <section class="section section-lg" id="biblioteka" style="background: #ebebeb;">
        <div class="container-fluid pt-5">
                <div class="section-header pb-0">
                    <span><?= lang('portal_municipal') ?></span>
                    <h2><?= lang('documents') ?></h2>
                </div>
            <div class="mt-4 mx-0 home-tab-container">
                <div class="card">
                    <div class="card-body">
                        <div class="row municipality-doc-categories">
                            <div class="col-lg-3 col-md-4 col-sm-6 mt-3 p-0">
                                <a href="#!" class="nav-link text-dark px-4 hoverable btn-document-category me-2 active"
                                   data-category="all">
                                    <i class="fa fa-folder-open mr-2"></i>
                                    <span class="d-inline"><?= lang("all") ?></span>

                                </a>
                            </div>
                            <?php
                            if ($lib_categories) {
                                ?>

                                <?php
                                foreach ($lib_categories as $cate) {
                                    ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 mt-3 p-0">
                                        <a
                                                href="#!<?php //echo esc_url(get_term_link($cate->term_id)) ?>"
                                                class="nav-link text-dark px-4 hoverable btn-document-category mx-2"
                                                data-category="<?= $cate->cat_name ?>">
                                            <i class="fa fa-folder-open mr-2"></i>
                                            <span class="doc-counter">
                                <?php echo esc_html($cate->count) ?></span>
                                            <span class="d-inline"><?php echo esc_html($cate->cat_name) ?></span>

                                        </a>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                            <div class="col-lg-12 shadow-sm py-3 px-3 mt-3 bg-white">
                                <div id="document-loader" class="document-loader">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/helm.png' ?>">
                                </div>

                                <div id="table-document-container" class="table-responsive">
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
