<?php


add_action('wp_ajax_fetch_population', 'fetch_population');
add_action('wp_ajax_nopriv_fetch_population', 'fetch_population');

function fetch_population()
{

    $args = array(
        'post_type' => array('municipality'),
        'nopaging' => true,
        'post_status' => 'publish',
        'order' => 'ASC',
        'orderby' => 'title',
    );
    $the_query = new WP_Query($args);
    
    $data=null;
    if ($the_query->have_posts()) {
            ?>
            <?php
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $total_population = get_post_meta(get_the_ID(), 'municipality_profilepopulation', true);
                $data[] = ["name"=>get_the_title(),"population"=>str_replace(",","",$total_population)];
            }
    }
    wp_reset_postdata();
    header('Content-Type: application/json');
    echo json_encode(array('success' => true, 'data' => $data));
    
    die();
}
