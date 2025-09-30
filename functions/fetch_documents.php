<?php


add_action('wp_ajax_fetch_document_by_category', 'fetch_document_by_category');
add_action('wp_ajax_nopriv_fetch_document_by_category', 'fetch_document_by_category');

function fetch_document_by_category()
{

    $args = array(
        'post_type' => 'sdm_downloads',
        'post_status' => 'publish',
//       'posts_per_page' => 5,
        'nopaging' => true,
    );
    if (esc_attr($_POST['category']) != "all") {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'sdm_categories',
                'field' => 'slug',
                'terms' => esc_attr($_POST['category']),
                'operator' => 'IN'
            ),
        );
    }


    $the_query = new WP_Query($args);
    ?>
    <div class="table-responsive">
        <table class="table table-hover datatable">
            <thead
                style="
                /*background-color: #960707; border-color: #960707;*/
"

            >
            <tr>
                <th><span class=""><?= lang("name") ?></span></th>
                <th><span class=""><?= lang('download'); ?></span></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($the_query->have_posts()) {
                ?>
                <?php
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $id = get_the_ID();
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

                ?>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <?php

    die();
}
