<?php get_header(); ?>
    <div class="py-5 bg-light">
        <div class="section-container py-5">
            <div class="row">
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
    </div>
<?php
get_footer();
