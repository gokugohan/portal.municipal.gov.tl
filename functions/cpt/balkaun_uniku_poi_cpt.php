<?php

add_action('init', 'register_balkaun_uniku_poi_cpt');
function register_balkaun_uniku_poi_cpt()
{


    $labels = array(
        'name' => 'All Point of interest',
//        'singular_name' => 'Balkaun Uniku Service',
        'menu_name' => 'Balkaun Uniku Point of interest',
        'name_admin_bar' => 'Balkaun Uniku Point of interest',
    );
    $args = array(
        'description' => 'Post Type Description',
        'labels' => $labels,
        'show_in_rest' => true,
        'supports' => array('title', 'editor'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
//        'menu_position'       => 5,
        'query_var' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'balkaun-uniku-poi'),
        'capability_type' => 'post',
    );
    register_post_type('balkaun-uniku', $args);
}

add_action('add_meta_boxes', 'add_balkaun_cpt_modal_map_to_metaboxes');
function add_balkaun_cpt_modal_map_to_metaboxes(){
    ?>
    <!-- Modal -->
    <div class="poi-map-modal" id="poi-map-modal">
        <div class="poi-map-modal-header">
            <h3 class="modal-title">Select Location <a href="#" class="poi-map-modal-close">X</a></h3>

        </div>
        <div class="poi-map-modal-content">
            <div id="poi-map-modal-map"></div>
        </div>
    </div>

    <input type="hidden" value="<?php echo get_option('municipality_setting_settings_general')['municipality_setting_default_latitude']; ?>" id="default_municipality_lat">
    <input type="hidden" value="<?php echo get_option('municipality_setting_settings_general')['municipality_setting_default_longitude']; ?>" id="default_municipality_lng">
    <?php
}


add_action('cmb2_init', 'balkaun_poi_metaboxes');


function balkaun_poi_metaboxes()
{

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'balkaun_poi_';

    /* Team Settings ***************************************************************************/
    /* ************************************************************************************/
    $poi_setting = new_cmb2_box(array(
        'id' => 'balkaun_poi_settings',
        'title' => 'Coordenate settings',
        'object_types' => array('balkaun-uniku'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,

    ));

    $poi_setting->add_field(array(
        'name' => 'Latitude',
        'id' => 'balkaun_poi_latitude',
        'type' => 'text',
    ));

    $poi_setting->add_field(array(
        'name' => 'Longitude',
        'id' => 'balkaun_poi_longitude',
        'type' => 'text',
    ));


}


