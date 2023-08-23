<?php
/*
  Template Name: Coursera Authentication Training Platform
 */
if (!is_user_logged_in()) {
    ?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
    <html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
    <head>
        <title>
            <?php
            $site_description = get_bloginfo('description', 'display');
            $site_name = get_bloginfo('name');
            if (is_front_page()) {
                echo $site_name;
            } else {
                print_custom_page_title();
            }

            echo ' | ';
            echo $site_description;
            ?>
        </title>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>


        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">


        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' ?>">
        <?php
        $hero_background_image = get_theme_mod('municipality_login_background_image');
        if ($hero_background_image == null) {
            $hero_background_image = get_stylesheet_directory_uri() . '/assets/img/login-bg.jpg';
        }

//        $login_link_separator = apply_filters( 'login_link_separator', ' | ' );
        ?>

        <style>
            .login,
            .image {
                min-height: 100vh;
            }

            .bg-image {
                background-image: url('<?= $hero_background_image ?>');
                background-size: cover;
                background-position: center center;
            }
        </style>
    </head>
    <body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 d-none d-md-flex bg-image"></div>


            <!-- The content half -->
            <div class="col-md-6 bg-light">
                <div class="login d-flex align-items-center py-5">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class=" text-center"><?php echo $site_name; ?></h3>
                                <p class="text-muted mb-4 text-center text-italic">
                                    <?php echo lang('Authenticate yourself to access the training platform'); ?></p>
                                <form action="<?= wp_login_url() ?>" method="post" name="loginform">
                                    <div class="form-group mb-3">
                                        <input type="text" placeholder="<?= lang('Username') ?>" name="log" required=""
                                               autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" placeholder="<?= lang('Password') ?>" name="pwd" required=""
                                               class="form-control rounded-pill border-0 shadow-sm px-4">
                                    </div>
                                    <br>
                                    <button type="submit"
                                            class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm"
                                    style="background-color: #960707; border:none;">
                                        <?= lang('login') ?>
                                    </button>
                                    <div class=" d-flex justify-content-between mt-4">
                                        <p id="backtoblog">
                                            <?php
                                            $html_link = sprintf(
                                                '<a href="%s" class="font-italic text-muted">%s</a>',
                                                esc_url( home_url( '/' ) ),
                                                sprintf(
                                                /* translators: %s: Site title. */
                                                    _x( '&larr; '. lang('go to') . ' %s', 'site' ),
                                                    get_bloginfo( 'title', 'display' )
                                                )
                                            );

                                            echo apply_filters( 'login_site_html_link', $html_link );
                                            ?>
                                        </p>
                                    </div>


                                </form>

                            </div>
                        </div>
                    </div><!-- End -->

                </div>
            </div><!-- End -->

        </div>
    </div>
    </body>
    </html>
    <?php
}else{

    $html_link = sprintf(
        '<a href="%s" class="font-italic text-muted">%s</a>',
        esc_url(home_url('/')),
        sprintf(
            _x('&larr; '. lang('go to') . ' %s', 'site'),
            get_bloginfo('title', 'display')
        )
    );

    echo apply_filters('login_site_html_link', $html_link);

}
?>
