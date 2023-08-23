
<!-- Modal About-->
<div id="modal-about" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title"><?= lang('about_municipality_portal')?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0">
                <div class="head_bg">
                    <div id="overlay1"></div>
                    <div class="corsal-div">
                        <h2 class="text-center white-text"><?= lang('about_municipality_portal') ?></h2>
                        <p><?php lang('second_description') ?></p>
                    </div>
                    <!--        <h2 class="profile_name">--><?php //echo $lang['about']['about_us']; ?><!--</h2>-->
                    <!--        <p>--><?php //echo $lang['home_page']['second_description']; ?><!--</p>-->
                </div>

                <div class="container-fluid" style="margin-top: 60px; margin-bottom: 60px;">
                    <h5 class="d1"><?php echo lang('about_question1'); ?></h5>
                    <hr class="linebold">
                    <p class="ppad30"><br>
                        <?php echo lang('about_answer1') ?>
                    </p><br><br>


                    <h5 class="d1"><?php echo lang('about_question2'); ?></h5>
                    <hr class="linebold">
                    <p class="ppad30"><br>
                        <?php echo lang('about_answer2') ?>
                    </p><br><br>

                    <h5 class="d1"><?php echo lang('about_question3'); ?></h5>
                    <hr class="linebold">
                    <p class="ppad30"><br>
                        <?php echo lang('about_answer3') ?>
                    </p><br><br>

                    </p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal About-->
