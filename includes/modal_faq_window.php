
<!-- Modal About-->
<div id="modal-faq" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title"><?php echo lang('faq'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0">
                <div class="head_bg">
                    <div id="overlay1"></div>
                    <h2 class="profile_name"><?php echo lang('faq'); ?></h2>
                </div>
                <div class="container-fluid">
<!--                    <div class="faqs-list-container"></div>-->
                    <div id="accordion_faq" class="accordion shadow mt-4">

                        <?php

                        $faqs = get_faq('portal');
                        if ($faqs->have_posts()) {
                            while ($faqs->have_posts()) {
                                $faqs->the_post();
                                ?>
                                <!-- Accordion item 1 -->
                                <div class="card">
                                    <div id="heading_<?=get_the_id()?>" class="card-header shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold">
                                            <a href="#" data-toggle="collapse"
                                               data-target="#collapse_<?=get_the_id()?>"
                                               aria-expanded="false" aria-controls="collapse_<?=get_the_id()?>"
                                               class="d-block position-relative text-uppercase collapsible-link py-2">
                                                <?= the_title() ?></a></h6>
                                    </div>
                                    <div id="collapse_<?=get_the_id()?>" aria-labelledby="heading_<?=get_the_id()?>" data-parent="#accordion_faq"
                                         class="collapse">
                                        <div class="card-body px3 py-5">
                                            <p class="font-weight-light m-0"><?= the_content() ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal About-->
