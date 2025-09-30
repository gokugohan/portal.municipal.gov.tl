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
//require_once(dirname(__FILE__) . '/settings/setting_balkaun.php');

//$is_faq_enabled = get_option('setting_settings_general')['setting_enable_faq'];
//$is_library_enabled = get_option('setting_settings_general')['setting_enable_library'];


require_once(dirname(__FILE__) . '/functions/cpt/municipality_cpt.php');
//require_once(dirname(__FILE__) . '/functions/cpt/courses_cpt.php');


//require_once(dirname(__FILE__) . '/functions/cpt/balkaun_uniku_service_cpt.php');
//require_once(dirname(__FILE__) . '/functions/cpt/balkaun_uniku_poi_cpt.php');
//require_once(dirname(__FILE__) . '/functions/cpt/balkaun_uniku_values_cpt.php');
require_once(dirname(__FILE__) . '/functions/function_cpt.php');
require_once(dirname(__FILE__) . '/functions/function_crud_csv_data.php');
require_once(dirname(__FILE__) . '/functions/create_table_dashboard_map_data.php');


//if ($is_faq_enabled) {
//    require_once(dirname(__FILE__) . '/functions/cpt/faq_cpt.php');
//}


//require_once(dirname(__FILE__) . '/functions/create_coursera_users_table.php');
//require_once(dirname(__FILE__) . '/functions/create_coursera_access_token_table.php');
//require_once(dirname(__FILE__) . '/functions/coursera_user_ajax.php');

//
//if ($is_library_enabled) {
//    require_once(dirname(__FILE__) . '/functions/cpt/courses_cpt.php');
//}

require_once(ROOT . '/functions/fetch_documents.php');
require_once(ROOT . '/functions/fetch_populations.php');


require_once(ROOT . '/functions/function_restrict_delete_attachment.php');

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
    wp_nav_menu(
        array(
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
    wp_nav_menu(
        array(
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
    wp_nav_menu(
        array(
            'theme_location' => 'menu-principal-quick-links',
            'container' => false,
            'menu_class' => 'menu-training-platform-external list-unstyled mb-0',
        )
    );
}
function get_menu_training_platform_external_links()
{
    wp_nav_menu(
        array(
            'theme_location' => 'menu-training-platform-external',
            'container' => false,
            'menu_class' => 'menu-training-platform-external list-unstyled mb-0',
        )
    );
}

function get_menu_training_platform_legal_links()
{
    wp_nav_menu(
        array(
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
function get_balkaun_uniku_breadcrumb()
{

    echo '<nav><div class="container">';
    echo '<ol>';
    echo '<li><a href="' . home_url() . '/balkaun-uniku" rel="nofollow">' . lang('home') . '</a></li>';
    echo '<li>' . get_the_title() . '</li>';
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

//add_action('admin_init', 'restrict_admin_access');
//Only show admin bar to administrators
function hide_adminbar_for_other_user()
{
    if (!current_user_can('administrator')) {
        show_admin_bar(true);
    }
}

//hide_adminbar_for_other_user();

function get_last_post_modified_date()
{
    echo the_modified_date();
}

//add_shortcode("get_modified_date", "get_last_post_modified_date");



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
    $post = wp_trim_words(strip_shortcodes(get_the_content()), $limit);

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


add_action('wp_enqueue_scripts', 'wp_enqueue_assets');
function wp_enqueue_assets()
{

    $version = date("YmdHi", filemtime(get_stylesheet_directory() . '/style.css'));
    wp_register_style(
        'style',
        get_stylesheet_directory_uri() . '/style.css',
        [],
        $version
    );
    wp_enqueue_style('style');

    if (is_front_page()) {

        $version = date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/js/document.js'));
        wp_enqueue_script(
            'document',
            get_stylesheet_directory_uri() . '/assets/js/document.js',
            [],
            $version,
            true
        );
    }
}

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
            background-image: url('<?= $hero_background_image ?>') !important;
        }
    </style>
<?php
}

//add_action('login_head', 'custom_login_style');

add_action('login_enqueue_scripts', 'login_page_customization');
function login_page_customization()
{
    $hero_background_image = get_theme_mod('municipality_login_background_image');
    if ($hero_background_image == null) {
        $hero_background_image = get_stylesheet_directory_uri() . '/assets/img/login-bg.jpg';
    }
    $menu_logo = get_theme_mod("municipality_header_logo");
    $menu_logo_path = $menu_logo != "" ? $menu_logo : get_stylesheet_directory_uri() . '/assets/img/bu_logo.png';
?>
    <style type="text/css">
        body.login {
            background-image: url('<?= $hero_background_image ?>') !important;
            background-size: cover;
            display: flex;
            flex-direction: row-reverse;
        }

        body.login div#login {
            width: 30%;
            margin: 0;
            padding-top: 10%;
            background: #004f71b3;
        }

        body.login div#login h1 a {
            background-image: url('<?= $menu_logo_path ?>') !important;
        }

        body.login div#login form {
            box-shadow: 0 0 50px #ccc;
            border-radius: 14px;
            background: transparent;
            border: none;
            margin-left: 8px;
            margin-right: 8px;
        }

        body.login div#login form label,
        .login #backtoblog a,
        .login #nav a {
            color: #ffffff !important;
        }

        @media (max-width: 720px) {
            body.login div#login {
                width: 100%;
                background: #004f717a;
                padding-left: 60px;
                padding-right: 60px;
            }
        }

        @media (max-width: 330px) {
            body.login div#login {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    </style>
<?php }




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

function get_bu_setting($key, $image = false)
{

    $content = get_option('bu_setting')[$key];

    if ($image) {
        return  $content;
    }
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);

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

//add_filter('admin_bar_menu', 'replace_howdy', 25);

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

            <a href="<?= wp_login_url() ?>" title="<?= lang('login') ?>" class="nav-link"
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
                <li>
                    <a class="aa text-capitalize" href="/wp-admin">
                        Admin <span class="fa fa-dashboard"></span>
                    </a>
                </li>
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
//add_filter('login_url', 'custom_login_url', PHP_INT_MAX);
function custom_login_url($login_url)
{
    $login_url = site_url('authentication.php', 'login');
    return $login_url;
}

//add_filter('logout_url', 'custom_logout_url');
function custom_logout_url($default)
{
    return str_replace('wp-login', 'authentication', $default);
}


// add_filter('register_url', 'custom_register_url');
function custom_register_url($default)
{
    return str_replace('wp-login', 'authentication', $default);
}

// add_filter('lostpassword_url', 'custom_lostpassword_url');
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
function getCourses($category = 'business', $post_per_page = null)
{
    if ($post_per_page) {
        $args = array(
            'post_type' => array('coursera-courses'),
            'nopaging' => false,
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
        );
    } else {
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

add_action('wp_enqueue_scripts', 'map_enqueue_styles');
function map_enqueue_styles()
{

    if (is_page_template('templates/template_map.php')) {

        $version = date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/vendor/bootstrap/css/bootstrap.min.css'));
        wp_register_style(
            'bootstrap',
            get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css',
            [],
            $version
        );
        wp_enqueue_style('bootstrap');


        $version = date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css'));
        wp_register_style(
            'bootstrap-icon',
            get_stylesheet_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css',
            [],
            $version
        );
        wp_enqueue_style('bootstrap-icon');


        $version = date('dmYhi', filemtime(get_stylesheet_directory() . '/assets/map/css/leaflet.css'));
        wp_enqueue_style(
            'leaflet',
            get_stylesheet_directory_uri() . '/assets/map/css/leaflet.css',
            [],
            $version
        );

        wp_enqueue_style('leaflet');

        $version = date('dmYhi', filemtime(get_stylesheet_directory() . '/assets/map/css/map.css'));
        wp_enqueue_style(
            'leaflet-map',
            get_stylesheet_directory_uri() . '/assets/map/css/map.css',
            [],
            $version
        );

        wp_enqueue_style('leaflet-map');

        $version = date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/map/css/leaflet.fullscreen.css'));
        wp_register_style(
            'leaflet.fullscreen',
            get_stylesheet_directory_uri() . '/assets/map/css/leaflet.fullscreen.css',
            [],
            $version
        );
        wp_enqueue_style('leaflet.fullscreen');
    }
}

add_action('wp_enqueue_scripts', 'map_enqueue_script');
function map_enqueue_script()
{




    if (is_page_template('templates/template_map.php')) {

        wp_enqueue_script(
            'bootstrap',
            get_stylesheet_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')),
            true
        );

        wp_enqueue_script(
            'jquery_',
            get_stylesheet_directory_uri() . '/assets/js/jquery.min.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/js/jquery.min.js')),
            true
        );
        wp_enqueue_script(
            'leaflet',
            get_stylesheet_directory_uri() . '/assets/map/js/leaflet.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/map/js/leaflet.js')),
            true
        );
        wp_enqueue_script(
            'leaflet.fullscreen',
            get_stylesheet_directory_uri() . '/assets/map/js/Leaflet.fullscreen.min.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/map/js/Leaflet.fullscreen.min.js')),
            true
        );
        wp_enqueue_script(
            'papaparse',
            get_stylesheet_directory_uri() . '/assets/map/js/papaparse.min.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/map/js/papaparse.min.js')),
            true
        );
        wp_enqueue_script(
            'turf',
            get_stylesheet_directory_uri() . '/assets/map/js/turf.min.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/map/js/turf.min.js')),
            true
        );

        wp_enqueue_script(
            'spin',
            get_stylesheet_directory_uri() . '/assets/map/js/spin.min.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/map/js/spin.min.js')),
            true
        );
        wp_enqueue_script(
            'spin-leaflet',
            get_stylesheet_directory_uri() . '/assets/map/js/leaflet.spin.min.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/map/js/leaflet.spin.min.js')),
            true
        );


        wp_enqueue_script(
            'leaflet-map',
            get_stylesheet_directory_uri() . '/assets/map/js/map.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/map/js/map.js')),
            true
        );

        wp_enqueue_script(
            'chart-map',
            get_stylesheet_directory_uri() . '/assets/js/chart.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/js/chart.js')),
            true
        );

        wp_enqueue_script(
            'chart-datalable-map',
            get_stylesheet_directory_uri() . '/assets/js/chartjs-plugin-datalabels.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '/assets/js/chartjs-plugin-datalabels.js')),
            true
        );

        wp_enqueue_script(
            'chart-pop-map',
            get_stylesheet_directory_uri() . '/assets/js/populations.js',
            [],
            date("YmdHi", filemtime(get_stylesheet_directory() . '//assets/js/populations.js')),
            true
        );
    }
}


// Custom mime type
// 1. Allow .geojson in the upload MIME types
add_filter('upload_mimes', function ($mimes) {
    $mimes['geojson'] = 'application/geo+json';
    return $mimes;
});

// 2. Bypass WordPress strict file type check for .geojson
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if ($ext === 'geojson') {
        $data['ext']  = 'geojson';
        $data['type'] = 'application/geo+json';
        $data['proper_filename'] = $filename;
    }

    return $data;
}, 10, 4);
