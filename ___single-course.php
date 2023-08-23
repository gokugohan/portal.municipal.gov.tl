<?php if (!defined('ABSPATH')) exit();
get_header();
global $post;

$id = get_the_ID();



$list_document = get_post_meta($id, 'course_doc_list_course', true);

$trainer = get_post_meta($id,'course_doc_trainer', true);
$trainer_avatar = get_post_meta($id,'course_doc_avatar', true);
$fee = get_post_meta($id,'course_doc_fee', true);
$seat = get_post_meta($id,'course_doc_seat', true);
$schedule = get_post_meta($id,'course_doc_shecdule', true);

$post_image_feature = wp_get_attachment_url(get_post_thumbnail_id($id));

if (has_post_thumbnail($post) && $post_image_feature != null) {
    $post_image_feature_url = $post_image_feature;
} else {
    $post_image_feature_url = show_default_background_image();
}

if(empty($fee)){
    $fee=0;
}
if (empty($trainer_avatar)) {
    $trainer_avatar = show_default_avatar();
}

$args = array(
    'taxonomy' => 'course_category',
    'orderby' => 'name',
    'order' => 'ASC'
);

$categories = get_categories($args);

?>
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Course Details</h2>
            <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-8">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/course-details.jpg'?>" class="img-fluid" alt="">
                    <h3><?=the_title();?></h3>
                    <?php get_category_course_by_id($id) ?>
                    <?php if (have_posts()) : while (have_posts()) : the_post();
                        the_content();
                        ?>
                    <?php endwhile; endif;
                    wp_reset_postdata(); ?>



                </div>
                <div class="col-lg-4">

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Trainer</h5>
                        <p><a href="#"><?= $trainer?></a></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Course Fee</h5>
                        <p>$<?= $fee?></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Available Seats</h5>
                        <p><?= $seat?></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Schedule</h5>
                        <p><?= $schedule?></p>
                    </div>

                    <?php

                    if (!empty($list_document)) {
                        ?>
                        <h3 class="h2 pt-5 text-dark"><?= lang('attachced_documents');?></h3>
                        <ul class="doc-list-attachment">
                            <?php
                            foreach ($list_document as $file_id => $document) {
                                $name_file = basename($document);
                                $ext_file = pathinfo($name_file, PATHINFO_EXTENSION);

                                // Check empty $name_file
                                if (empty($name_file)) {
                                    $name_file = basename($file_dep);
                                }

                                ?>
                                <li>
								<span class="icon-attachment">
									<?php echo doc_get_icon_attachment_file($ext_file); ?>
								</span>
                                    <span class="doc-file-name-size">
									<span class="doc-file-name">
										<?php echo esc_html($name_file) ?>
									</span>
									<span class="doc-file-size">
										<span class="type">
											<?php echo esc_html($ext_file) ?>
										</span>
										<span class="file-size">
											(<?php echo doc_get_file_size($document) . 'kb' ?>)
										</span>
									</span>
								</span>
                                    <span class="doc-download">
									<a href="<?php echo $document ?>" download><i class="bi bi-download"></i></a>
								</span>
                                </li>

                                <?php
                            }

                            ?>
                        </ul>
                        <?php
                    }else{
                        ?>
                        <h3 class="h2 pt-5 text-dark"><?= lang('no_attachced_documents');?></h3>
                        <?php
                    }

                    ?>

                </div>
            </div>

        </div>
    </section><!-- End Cource Details Section -->

<?php comments_template(); ?>

<?php get_footer();
