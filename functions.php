<?php
/*
 * Define a constant path to our single template folder
 */
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/functions/custom_function.php');
require_once(ROOT . '/functions/customizer.php');


// Register Custom Navigation Walker
require_once(dirname(__FILE__) . '/class-wp-bootstrap-navwalker.php');

require_once(dirname(__FILE__) . '/settings/setting.php');
require_once(dirname(__FILE__) . '/settings/setting_balkaun.php');

$is_faq_enabled = get_option('setting_settings_general')['setting_enable_faq'];
//$is_library_enabled = get_option('setting_settings_general')['setting_enable_library'];


require_once(dirname(__FILE__) . '/functions/cpt/municipality_cpt.php');
require_once(dirname(__FILE__) . '/functions/cpt/courses_cpt.php');


require_once(dirname(__FILE__) . '/functions/cpt/balkaun_uniku_service_cpt.php');
require_once(dirname(__FILE__) . '/functions/cpt/balkaun_uniku_poi_cpt.php');
require_once(dirname(__FILE__) . '/functions/cpt/balkaun_uniku_values_cpt.php');
require_once(dirname(__FILE__) . '/functions/function_cpt.php');

if ($is_faq_enabled) {
    require_once(dirname(__FILE__) . '/functions/cpt/faq_cpt.php');
}


require_once(dirname(__FILE__) . '/functions/create_coursera_users_table.php');
require_once(dirname(__FILE__) . '/functions/create_coursera_access_token_table.php');
require_once(dirname(__FILE__) . '/functions/coursera_user_ajax.php');

//
//if ($is_library_enabled) {
//    require_once(dirname(__FILE__) . '/functions/cpt/courses_cpt.php');
//}

//add_new_user_role();
// Add register new menu
function register_menu()
{
    register_nav_menus(
        array(
            'menu-principal-quick-links' => __('Quick links', 'municipality'),
            'menu-training-platform-external' => __('Training platform external links', 'municipality'),
            'menu-training-platform-legal' => __('Training platform legal links', 'municipality'),
            'balkaun-uniku' => __('Balkaun Uniku Menu', 'municipality'),
        )
    );
}

add_action('init', 'register_menu');


add_post_type_support('page', 'excerpt');



/*
 * Multilevel bootstrap menu
 * http://www.jeffmould.com/2014/01/09/responsive-multi-level-bootstrap-menu/
 */


function get_menu_by_name($name)
{
    wp_nav_menu(array(
            'theme_location' => $name,
            'container' => false,
            'depth' => 2, // 1 = no dropdowns, 2 = with dropdowns.
            'container_class' => 'navbar-nav mr-auto',
            'container_id' => 'bs-example-navbar-collapse-1',
            'menu_class' => 'navbar-nav mr-auto custom-menu-list',
            'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
            'walker' => new WP_Bootstrap_Navwalker(),
        )
    );
}

// bootstrap navigation menu register function for menu principal
function balkaun_uniku_nav_menu()
{
    wp_nav_menu(array(
            'theme_location' => 'balkaun-uniku',
            'container' => false,
            'depth' => 2, // 1 = no dropdowns, 2 = with dropdowns.
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'menu-primary-header-menu',
            'menu_class' => '',
            'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
            'walker' => new WP_Bootstrap_Navwalker(),
        )
    );
}

function get_menu_quick_links()
{
    wp_nav_menu(array(
            'theme_location' => 'menu-principal-quick-links',
            'container' => false,
            'menu_class' => 'menu-training-platform-external list-unstyled mb-0',
        )
    );
}
function get_menu_training_platform_external_links()
{
    wp_nav_menu(array(
            'theme_location' => 'menu-training-platform-external',
            'container' => false,
            'menu_class' => 'menu-training-platform-external list-unstyled mb-0',
        )
    );
}

function get_menu_training_platform_legal_links()
{
    wp_nav_menu(array(
            'theme_location' => 'menu-training-platform-legal',
            'container' => false,
            'menu_class' => 'menu-training-platform-legal list-unstyled mb-0',
        )
    );
}

/*
 *
 *      <nav>
            <div class="container">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>About</li>
                </ol>
            </div>
        </nav>
 */
function get_balkaun_uniku_breadcrumb() {

    echo '<nav><div class="container">';
    echo '<ol>';
    echo '<li><a href="'.home_url().'/balkaun-uniku" rel="nofollow">'.lang('home').'</a></li>';
    echo '<li>'.get_the_title().'</li>';
    echo '</ol>';
    echo '</container>';
    echo '</nav>';
}


function restrict_admin_access()
{
    if (!current_user_can('administrator')) {
        wp_redirect(home_url());
        exit;
    }
}

add_action('admin_init', 'restrict_admin_access');
//Only show admin bar to administrators
function hide_adminbar_for_other_user()
{
    if (!current_user_can('administrator')) {
        show_admin_bar(true);
    }
}

hide_adminbar_for_other_user();

function get_last_post_modified_date()
{
    echo the_modified_date();
}

//add_shortcode("get_modified_date", "get_last_post_modified_date");



function ipg_enqueue_script_admin()
{

    wp_enqueue_style('admin_css_bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css', false, '5.1.3', 'all');
    wp_enqueue_script('admin_jquery_bootstrap', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), '', true);
    wp_enqueue_script('admin_js_bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js', array('jquery'), '', true);
//    wp_enqueue_script('admin_data_table', get_template_directory_uri() . '/js/datatables.min.js', array('jquery'), '', true);

    wp_enqueue_script('admin_coursera_script', get_template_directory_uri() . '/assets/js/cousera.js', array('jquery'), '', true);
}

//add_action('admin_enqueue_scripts', 'ipg_enqueue_script_admin');

function custom_theme_setup()
{
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'custom_theme_setup');

function add_image_class($class)
{
    $class .= ' img-fluid';
    return $class;
}


// Adicionar classe img-responsive para imagem
add_filter('get_image_tag_class', 'add_image_class');

//https://kinsta.com/knowledgebase/wordpress-disable-rss-feed/
function disable_feed()
{
    wp_redirect(home_url());
    exit();
}

add_action('do_feed', 'disable_feed', 1);
add_action('do_feed_rdf', 'disable_feed', 1);
add_action('do_feed_rss', 'disable_feed', 1);
add_action('do_feed_rss2', 'disable_feed', 1);
add_action('do_feed_atom', 'disable_feed', 1);
add_action('do_feed_rss2_comments', 'disable_feed', 1);
add_action('do_feed_atom_comments', 'disable_feed', 1);

/**
 * Remove the additional CSS section, introduced in 4.7, from the Customizer.
 * https://robincornett.com/additional-css-wordpress-customizer/
 * @param $wp_customize WP_Customize_Manager
 */
function prefix_remove_css_section($wp_customize)
{
    $wp_customize->remove_section('custom_css');
}

add_action('customize_register', 'prefix_remove_css_section', 15);

function excerpt($limit = 100)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt); // . ' <a href='.the_permalink().'>(...)</a>';
    } else {
        $excerpt = implode(" ", $excerpt);
    }

    return $excerpt;
}

function mostrar_poucos($limit = 5)
{
    $post = wp_trim_words( strip_shortcodes( get_the_content() ), $limit );

    var_dump($post);
    return $post;

    $excerpt = explode(' ', get_the_content(), $limit);
    var_dump(count($excerpt) >= $limit);
    var_dump(count($excerpt));

    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt);
    } else {
        $excerpt = implode(" ", $excerpt);
    }

    return $excerpt;
}

if (!function_exists('post_pagination')) :

    function post_pagination()
    {
        global $wp_query;
        $pager = 999999999;
        echo paginate_links(array(
            'base' => str_replace($pager, '%#%', esc_url(get_pagenum_link($pager))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => __('<span class="btn btn-default glyphicon glyphicon-backward"></span>'),
            'next_text' => __('<span class="btn btn-default glyphicon glyphicon-forward"></span>')
        ));
    }

endif;

function show_data_on_content_page()
{
    echo "Testing..";
}

//add_action('the_content', 'show_data_on_content_page');


// Change Login logo
function custom_login_style()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/login.css" />';
    $hero_background_image = get_theme_mod('municipality_login_background_image');
    if ($hero_background_image == null) {
        $hero_background_image = get_stylesheet_directory_uri() . '/assets/img/login-bg.jpg';
    }
    ?>
    <style>
        body.login {
            background-image: url('<?=$hero_background_image?>') !important;
        }

    </style>
    <?php
}

add_action('login_head', 'custom_login_style');


/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

add_action('after_setup_theme', 'register_navwalker');

function show_default_background_image()
{
    return get_stylesheet_directory_uri() . '/assets/img/corosal1.jpg';
}

function show_default_avatar()
{
    return get_stylesheet_directory_uri() . '/assets/img/no-avatar.jpg';
}

function get_setting_value($key)
{
    return get_option('setting_settings_general')["$key"];
}

function get_bu_setting($key,$image=false){

    $content = get_option('bu_setting')[$key];

    if($image){
        return  $content;
    }
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    return $content;
}


function filter_text_wpglobus($text)
{

    return WPGlobus_Core::text_filter($text, WPGlobus::Config()->language);
}


// replace WordPress Howdy in WordPress 3.3
function replace_howdy($wp_admin_bar)
{
    $my_account = $wp_admin_bar->get_node('my-account');
    $newtitle = str_replace('Howdy,', 'Logged in as', $my_account->title);
    $wp_admin_bar->add_node(array(
        'id' => 'my-account',
        'title' => $newtitle,
    ));
}

add_filter('admin_bar_menu', 'replace_howdy', 25);

// Change Login Logo URL
add_filter('login_headerurl', 'my_custom_login_url');

function my_custom_login_url($url)
{
    return home_url();
}


function admin_login_redirect($redirect_to, $request, $user)
{
    global $user;
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array("administrator", $user->roles) || in_array("author", $user->roles)) {
            return $redirect_to;
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

add_filter("login_redirect", "admin_login_redirect", 10, 3);


function get_general_setting($key)
{
    return get_option('setting_settings_general')[$key];
}


function default_base_url()
{
    return get_option('setting_settings_general')['setting_base_url'];
}

function api_url()
{
    return get_option('setting_settings_general')['setting_api_url'];
}

function homepage_background_image()
{
    return get_option('setting_settings_general')['setting_homepage_image'];
}

/**
 * Removes actions and filters to clean up the head
 */
function rational_head_clean()
{
// https://scotch.io/tutorials/removing-wordpress-header-junk
    remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
    remove_action('wp_head', 'wp_generator'); //removes meta name generator.
    remove_action('wp_head', 'feed_links', 2);  //removes feed links.
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); /* Removes prev and next links */
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); //removes shortlink.
// http://wordpress.stackexchange.com/a/185578/26817
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('emoji_svg_url', '__return_false');
//add_filter('tiny_mce_plugins', 'rational_tiny_mce_plugins_clean');
// http://wordpress.stackexchange.com/a/211469/26817
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);
}

//add_action('init', 'rational_head_clean');

/**
 * http://www.wpbeginner.com/wp-themes/create-custom-single-post-templates-for-specific-posts-or-sections-in-wordpress/
 * Filter the single_template with our custom function
 */


function disable_wp_json_request($access)
{
    return new WP_Error('access_denied', '@Goku has disabled it with Kamehameha Power', array(
        'status' => 403
    ));

}

require_once(ROOT . '/lang/lang.php');

function lang_code()
{
    return WPGlobus::Config()->language;
}

function lang($keyword)
{
    return get_translate(WPGlobus::Config()->language, $keyword);
}

// Remove the admin bar from the front end
add_filter('show_admin_bar', '__return_false');

function gt_get_post_view()
{
    $count = get_post_meta(get_the_ID(), 'post_views_count', true);
    if ($count <= 1) {
        return "$count " . lang('view');
    }
    return "$count " . lang('views');
}

function gt_set_post_view()
{
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int)get_post_meta($post_id, $key, true);
    $count++;
    update_post_meta($post_id, $key, $count);
}

function gt_posts_column_views($columns)
{
    $columns['post_views'] = 'Views';
    return $columns;
}

function gt_posts_custom_column_views($column)
{
    if ($column === 'post_views') {
        echo gt_get_post_view();
    }
}

add_filter('manage_posts_columns', 'gt_posts_column_views');
add_action('manage_posts_custom_column', 'gt_posts_custom_column_views');


add_action('wp_head', 'load_styles');
function load_styles()
{
    ?>

    <?php
}

function comment_list_render_callback()
{
    $rjs_comment_email = get_comment_author_email();
    $rjs_gravatar = get_avatar_url($rjs_comment_email, 160); ?>

    <li class="lol">
        <div id="comment-<?php comment_ID() ?>" class="comment-classic-group">
            <!-- Comment Classic-->
            <article class="comment-classic">
                <?php if (get_option('show_avatars', true)) : ?>
                    <figure class="comment-classic-figure">
                        <img class="comment-classic-image" src="<?php if ($rjs_gravatar) {
                            echo $rjs_gravatar;
                        } ?>" alt="" width="48" height="48">
                    </figure>
                <?php endif; ?>
                <div class="comment-classic-main">
                    <p class="comment-classic-name"><?php echo get_comment_author(); ?></p>
                    <div class="comment-classic-text">
                        <p><?php echo get_comment_text(); ?></p>
                    </div>
                    <ul class="comment-classic-meta">
                        <li>
                            <time><?php echo get_comment_date('j/M/Y'); ?></time>
                        </li>
                        <li>
                            <?php comment_reply_link([
                                'add_below' => true,
                                'depth' => 20,
                                'max_depth' => 200,
                            ]); ?>
                        </li>
                    </ul>

                </div>
            </article>
        </div>
    </li>

<?php }

function comment_reply_text($link)
{
    $link = str_replace('Reply', lang('replay'), $link);
    return $link;
}

function move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;

    return $fields;
}

add_filter('comment_reply_link', 'comment_reply_text');
add_filter('comment_form_fields', 'move_comment_field_to_bottom');

add_filter('learn-press/override-templates', function () {
    return true;
});

add_filter('comment_form_field_cookies', function () {
    return '<hr/>';
});


function add_logout_menu($redirect = '')
{
    if (!is_user_logged_in()) {
        ?>

        <li class="nav-item pl-0">
            <a href="<?= bloginfo('url') ?>/authentication" title="<?= lang('login') ?>" class="nav-link"
               style="font-size: 20px; padding-top: 10px"><span class="fa fa-sign-in"></span></a>

        </li>

        <?php
    } else {
        ?>
        <li class="nav-item dropdown ">
            <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown"
               aria-expanded="true">
                <?php echo lang('hello') . ' ' . wp_get_current_user()->display_name; ?>
            </a>


            <ul class="dropdown-menu dropdown-menu-md-right login-logout-menu">
                <?php
                if (current_user_can('administrator')) {
                    ?>
                    <li>
                        <a class="aa text-capitalize" href="/wp-admin">
                            Admin <span class="fa fa-dashboard"></span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a class="aa text-capitalize" title="<?= lang('logout') ?>"
                       href="<?php echo wp_logout_url(get_permalink()); ?>">
                        <?= lang('logout') ?> <span class="fa fa-sign-out"></span>
                    </a>
                </li>
            </ul>
        </li>
        <?php
    }

}

add_action('wp_logout', 'auto_redirect_after_logout');
function auto_redirect_after_logout()
{
    wp_safe_redirect(home_url());
    exit();
}

function get_users_by_role($role, $orderby, $order)
{
    $args = array(
        'role' => $role,
        'orderby' => $orderby,
        'order' => $order
    );

    return get_users($args);

}

/*
 * Change WP Login file URL using "login_url" filter hook
 * https://developer.wordpress.org/reference/hooks/login_url/
 */
add_filter('login_url', 'custom_login_url', PHP_INT_MAX);
function custom_login_url($login_url)
{
    $login_url = site_url('authentication.php', 'login');
    return $login_url;
}

add_filter('logout_url', 'custom_logout_url');
function custom_logout_url($default)
{
    return str_replace('wp-login', 'authentication', $default);
}


add_filter('register_url', 'custom_register_url');
function custom_register_url($default)
{
    return str_replace('wp-login', 'authentication', $default);
}

add_filter('lostpassword_url', 'custom_lostpassword_url');
function custom_lostpassword_url($default)
{
    return str_replace('wp-login', 'authentication', $default);
}


function print_custom_page_title()
{
    $title = wp_title("", false);
    switch ($title) {
        case '  Courses':
            echo lang('training-platform');
            break;

        default:
            echo $title;
    }
}


function add_button_get_started()
{
//    if (!is_user_logged_in()) {
    ?>
    <a href="https://www.coursera.org/programs/sso-integration-testing-7mi06?authProvider=timorleste" class="btn-join-now animated fadeInUp"><?= lang('join now') ?></a>
    <?php
//    }
}


function get_faq($category = 'portal')
{
    $args = array(
        'post_type' => array('faq'),
        'nopaging' => true,
        'post_status' => 'publish',
        'order' => 'asc',
        'tax_query' => array(
            array(
                'taxonomy' => 'faq_category',
                'field' => 'slug',
                'terms' => array($category),
                'operator' => 'IN'
            ),
        ),
    );

    return new WP_Query($args);
}
function getCourses($category = 'business',$post_per_page=null)
{
    if($post_per_page){
        $args = array(
            'post_type' => array('coursera-courses'),
            'nopaging' => false,
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
        );
    }else{
        $args = array(
            'post_type' => array('coursera-courses'),
            'nopaging' => true,
            'post_status' => 'publish',
        );
    }


    return new WP_Query($args);


}


function is_plugin_simple_download_manager_active()
{
    if (!function_exists('is_plugin_active')) {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    if (is_plugin_active('simple-download-monitor/main.php')) {
        return true;
    }
    return false;
}


