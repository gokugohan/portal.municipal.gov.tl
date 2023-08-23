<?php
/*
  Template Name: The Service Municipality page
 */
get_header();
?>
<div class="head_bg">
    <div id="overlay1"></div>
    <h2 class="profile_name"></h2>
</div>


<div class="muni_profile">
    <span><?php echo lang('agencies_departments'); ?></span> <span class="sector_name"></span> | <span
            class="profile_name"></span>
</div>
<section class="section bg-gray-100">
    <div class="container-fluid text-center">
        <!--        <h4 class="py-3">--><?php //echo $lang['menu']['agencies_departments']; ?><!--</h4>-->
        <!--        <hr>-->
        <div class="pt-4 table-responsive">
            <div class="row" style=" margin-left: 0px !important;
        margin-right: 0px !important;">

                <div class="col-md-8">
                    <div class="result"></div>
                </div>
                <div class="col-md-4">
                    <div id="map" class="wow slideInUp">
                        <div class="map-attribute-logo">
                            <a href="<?= $base_url ?>" class="btn-view-attribute-info"
                               title="Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/logo-map.svg'?>"
                                     class="img-responsive"/>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</section>


<input type="hidden" name="municipalityId" id="municipalityId">
<input type="hidden" name="municipalityName" id="municipalityName">

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



<!-- Modal FAQ-->
<div id="modal-faq" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h4 class="modal-title"><?php echo $lang['faq']; ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0">
                <div class="head_bg">
                    <div id="overlay1"></div>
                    <h2 class="profile_name"><?php echo $lang['faq']; ?></h2>
                </div>
                <div class="container-fluid">
                    <div class="faqs-list-container"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal FAQ-->

<!-- Modal Data Catalog-->
<div id="modal-data-catalog" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $lang['menu']['data_catalog']; ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row" id="box3">
                    <div class="col-md-6"><a class="acn-head" target="_blank"
                                             href="http://portalmunicipal.r2m.tl/datasearch">
                        </a>
                        <div class="box3">
                            <a class="acn-head" target="_blank" href="<?php echo $base_url_others; ?>datasearch">
                                <div class="box-circle"><img class="nor-icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/box22.png'?>"
                                                             style="margin: 8px 8px;">
                                    <img class="hov-icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/ii/icon-1.png'?>"
                                         style="margin: 8px 8px;display: none;">
                                </div>
                                <h2 class="hh acn-head"><?php echo lang('data_bank');?></h2>
                                <div class="hh2">
                                    <?php echo lang('data_bank_description') ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a class="acn-head" target="_blank" href="<?php echo $base_url_others; ?>dashboard">
                        </a>
                        <div class="box3">
                            <a class="acn-head" target="_blank" href="<?php echo $base_url_others; ?>dashboard">
                                <div class="box-circle"><img class="nor-icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/box33.png'?>"
                                                             style="margin: 13px 12px;"><img class="hov-icon"
                                                                                             src="<?php echo get_stylesheet_directory_uri() . '/assets/img/ii/icon-2.png'?>"
                                                                                             style="margin: 13px 12px;">
                                </div>

                                <h2 class="hh acn-head"><?php echo lang('databysector'); ?></h2>
                                <div class="hh2">
                                    <?php echo lang('databysector_description'); ?>
                                </div>
                            </a>

                        </div>
                    </div>
                    <!--<div class="col-md-4">
                        <a class="acn-head" href="project.php">
                            <div class="box3">
                                <div class="box-circle"><img class="nor-icon" src="images/box1.png"
                                                             style="margin: 8px 8px;"><img class="hov-icon"
                                                                                           src="images/ii/icon-3.png"
                                                                                           style="margin: 13px 12px;">
                                </div>
                                <h2 class="hh acn-head"><?php /*echo $lang['home_page']['municipalities']; */ ?></h2>
                                <div class="hh2"><?php /*echo $lang['home_page']['para1']; */ ?></div>
                            </div>
                        </a>
                    </div>-->
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Modal Data Catalog-->

<!-- Modal Library-->
<div id="modal-library" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $lang['menu']['library']; ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="home-tab-container">
                    <div class="home-tab-text">
                        <div class="home-tab-tabs">
                            <ul id="home-tab-tabs-link" class="home-tab-tabs-link library-tab-list with-triangle">
                                <li class="active"
                                    data-tab="tab-content-category-report">
                                    <a href="javascript:void(0)"> <?= $lang['library']['reports'] ?></a>
                                </li>
                                <li
                                        data-tab="tab-content-category-law">
                                    <a href="javascript:void(0)"> <?= $lang['library']['legislation'] ?></a>
                                </li>
                                <li
                                        data-tab="tab-content-category-portal_guidelines">
                                    <a href="javascript:void(0)"> <?= $lang['library']['portal_guidelines'] ?></a>
                                </li>
                                <li data-tab="tab-content-category-others">
                                    <a href="javascript:void(0)"> <?= $lang['library']['others'] ?></a>
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
<!-- Modal Library-->

<div class="modal fade" id="modal-municipality-project-detail" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
				<span style="padding-left: 15px;">
				 <img src="" id="areaFlag" style="width:auto;height:25px"/>
				</span>
                <span style="text-transform:uppercase;padding-left: 15px;" id="panel_area_name">


				</span>&nbsp;<span id="project_count"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <div class="modal-body">
                <div class="container demo" id="pInfo">

                    <!-- container -->
                </div>
            </div>
        </div>
    </div>
</div>

<div id="scrollUp" style="bottom: 45px; right: 24px;">
    <a class="btn btn-floating">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>
<?php
get_footer();
?>


</body>
</html>
