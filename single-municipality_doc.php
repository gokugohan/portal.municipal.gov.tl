<?php if (!defined('ABSPATH')) exit();
get_header();
global $post;

$id = get_the_ID();


$list_document = get_post_meta($id, 'municipality_doc_list_document', true);

$image = get_theme_mod('doc_image_sidebar', '');
$link_image = get_theme_mod('doc_link_image', '#');

$args = array(
    'taxonomy' => 'municipality_doc_category',
    'orderby' => 'name',
    'order' => 'ASC'
);

$categories = get_categories($args);

?>

    <div class="rounded container-fluid pt-0 py-5 bg-light">
        <div class="row">
            <div class="col-lg-2 col-md-3 mb-4 mb-lg-0">

                <!-- Vertical Menu-->
                <nav class="nav nav-municipality-doc flex-column bg-white shadow-sm rounded p-3">
                    <a href="<?php bloginfo('url') ?>/documents" class="nav-link px-4 rounded-pill">
                        <i class="fa fa-folder mr-2"></i>  <?= lang('all_documents') ?>
                    </a>
                    <?php
                    if ($categories) {
                        foreach ($categories as $cate) {
                            ?>
                            <a href="<?php echo esc_url(get_term_link($cate->term_id)) ?>"
                               class="nav-link px-4 ">
                                <i class="fa fa-folder mr-2"></i>
                                <?php echo esc_html($cate->cat_name) ?>

                            </a>
                            <?php
                        }
                    }
                    ?>
                </nav>
                <!-- End -->

            </div>

            <div class="col-lg-10 col-md-9 mb-5">
                <div class="align-items-stretch">
                    <article class="wow the-content-post fadeInUp" style="overflow-wrap: break-word;">
                        <h2 class="h1 text-uppercase text-dark"><?=the_title();?></h2>
                        <div class="doc-meta">
                            <span class=" doc-meta-general">
                                <?php the_time(get_option('date_format')); ?>
                            </span>
                            <span class=" doc-categories">
						<?php get_category_doc_by_id_doc($id) ?>
				    </span>
                        </div>

                        <hr>
                        <br>
                        <?php if (have_posts()) : while (have_posts()) : the_post();
                            the_content();
                            ?>
                        <?php endwhile; endif;
                        wp_reset_postdata(); ?>
                    </article>

                    <hr>

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
									<a href="<?php echo $document ?>" download>[ <?= lang('download')?> ]</a>
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

                </div><!-- /row -->

            </div>
        </div>

    </div>
<?php comments_template(); ?>

<?php get_footer();
