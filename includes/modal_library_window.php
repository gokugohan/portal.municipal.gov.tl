<div id="modal-library" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('library') ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="home-tab-container">
                    <div class="home-tab-text">
                        <div class="home-tab-tabs">
                            <ul id="home-tab-tabs-link" class="home-tab-tabs-link library-tab-list with-triangle">
                                <li class="active"
                                    data-tab="tab-content-category-report">
                                    <a href="javascript:void(0)"> <?= lang('reports') ?></a>
                                </li>
                                <li
                                        data-tab="tab-content-category-law">
                                    <a href="javascript:void(0)"> <?= lang('legislation')?></a>
                                </li>
                                <li
                                        data-tab="tab-content-category-portal_guidelines">
                                    <a href="javascript:void(0)"> <?= lang('portal_guidelines') ?></a>
                                </li>
                                <li data-tab="tab-content-category-others">
                                    <a href="javascript:void(0)"> <?= lang('others') ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="box-dynamic-slide">
                            <div class="library-content"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
