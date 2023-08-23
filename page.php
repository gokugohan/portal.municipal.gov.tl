<?php get_header();
?>
    <style>
        #learn-press-profile>div.lp-content-area, #learn-press-profile>div.lp-content-area .wrapper-profile-header>div.lp-content-area {
            margin-top: 0px !important;
        }
        #learn-press-profile>div.lp-content-area .wrapper-profile-header{
            background: #960807;
        }
    </style>
    <section id="hero" class="d-flex align-items-center justify-content-center" style="height: 35vh">
        <div class="container-fluid">

            <div class="row justify-content-center hero-title">
                <div class="col-md-12 text-center">


                    <div class="container">
                        <h2 class="text-white bold text-uppercase">
                            <?= the_title() ?>
                        </h2>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <div class="container-fluid">
        <div class="row align-items-stretch">
            <div class="col-sm-12">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        ?>
                        <div class="news-content">
                            <?php the_content(); ?>
                        </div>
                        <?php
                    }
                } else {
                    echo('No content yet.');
                }
                ?>
            </div>
        </div><!-- /row -->
    </div>
<?php
get_footer();
