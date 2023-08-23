<?php

function setting_options_page()
{
    ?>
    <link rel="stylesheet"
          href="<?= get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css' ?>">

    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/js/jquery.min.js' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/js/cousera.js' ?>">

    <style>
        body {
            background: #dd5e89;
            background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
            background: linear-gradient(to left, #dd5e89, #f7bb97);
            min-height: 100vh;
        }
    </style>
    <section class="pb-5 header text-center">
        <div class="container py-5 text-white">
            <header class="py-5">
                <h1 class="display-4">Portal Settings</h1>

            </header>
            <div class="card border-0 shadow mx-auto" style="max-width: 100%">
                <div class="card-body p-5">
                    <form action='options.php' method='post' enctype="multipart/form-data">
                        <input type="hidden" name="action" value="my_file_upload"/>
                        <?php
                        settings_fields('general_theme_setting');
                        do_settings_sections('general_theme_setting');
                        submit_button();
                        ?>

                    </form>
                </div>
            </div>

        </div>
    </section>


    <?php
}

function add_setting_fields_general_info()
{
    add_settings_field_to_section('setting_base_url', "Portal Base URL", 'setting_base_url', 'general_theme_setting', 'setting_general_section');
    add_settings_field_to_section('setting_api_url', "API Url", 'setting_api_url', 'general_theme_setting', 'setting_general_section');
    add_settings_field_to_section('setting_enable_faq', "Enable FAQ", 'setting_enable_faq', 'general_theme_setting', 'setting_general_section');
    add_settings_field_to_section('setting_enable_training_platform', "Enable Training Platform", 'setting_enable_training_platform', 'general_theme_setting', 'setting_general_section');
    add_settings_field_to_section('setting_api_coursera_access_code', "Coursera One-Time Access Code", 'setting_api_coursera_access_code', 'general_theme_setting', 'setting_general_section');
    add_settings_field_to_section('setting_api_coursera_program_id', "Coursera Program Id", 'setting_api_coursera_program_id', 'general_theme_setting', 'setting_general_section');
//    add_settings_field_to_section('setting_api_coursera_api_token', "Coursera API Token", 'setting_api_coursera_api_token', 'general_theme_setting', 'setting_general_section');
    add_settings_field_to_section('setting_api_coursera_refresh_token', "Coursera Refresh Token", 'setting_api_coursera_refresh_token', 'general_theme_setting', 'setting_general_section');
    add_settings_field_to_section('setting_api_coursera_client_id', "Coursera Client Id", 'setting_api_coursera_client_id', 'general_theme_setting', 'setting_general_section');
    add_settings_field_to_section('setting_api_coursera_client_secret', "Coursera Client Secret", 'setting_api_coursera_client_secret', 'general_theme_setting', 'setting_general_section');

    //    add_settings_field_to_section('setting_enable_library', "Check to enable Library(Reports)", 'setting_enable_library', 'general_theme_setting', 'setting_general_section');

//    add_settings_field_to_section('setting_homepage_image', "Homepage Background Image", 'setting_homepage_image', 'general_theme_setting', 'setting_general_section');
}

function setting_homepage_image()
{

    $options = get_option('setting_settings_general');
    ?>
    <!--    <input type='text' name='municipality_setting_settings_general[municipality_default_background_image]'-->
    <!--           class="regular-text form-control"-->
    <!--           value='--><?php //echo $options['municipality_default_background_image'];
    ?><!--'/>-->


    <?php

    $default_bg_image = $options['setting_homepage_image'];
    if (empty($default_bg_image)) {
        $default_bg_image = get_template_directory_uri() . '/assets/img/corosal1.jpg';
    }
    ?>

    <img src="<?= $default_bg_image ?>" class="default-bg-img img-fluid">
    <input type="hidden"
           id="setting_homepage_image_default"
           value="<?= get_template_directory_uri() . '/assets/img/corosal1.jpg' ?>">

    <input type="hidden" id="setting_homepage_image"
           name="setting_settings_general[setting_homepage_image]"
           value="<?php if (!empty($default_bg_image)) echo $default_bg_image; ?>"/>

    <br>
    <a href="#!" class="default-bg-upload-button">Replace Image</a> | <a href="#!" class="default-bg-remove-button">Reset
    to default</a>
    <?php
}


function setting_base_url()
{

    $options = get_option('setting_settings_general');
    ?>
    <input type='text' name='setting_settings_general[setting_base_url]'
           class="regular-text form-control" placeholder="https://portal.municipio.gov.tl/"
           value='<?php echo $options['setting_base_url']; ?>'/>

    <?php
}


function setting_api_url()
{

    $options = get_option('setting_settings_general');
    ?>
    <input type='text' name='setting_settings_general[setting_api_url]'
           class="regular-text form-control" placeholder="https://portal.municipio.gov.tl/datasearch/homepage"
           value='<?php echo $options['setting_api_url']; ?>'/>
    <?php
}


function setting_enable_faq()
{

    $options = get_option('setting_settings_general');
    ?>
    <input type='checkbox' name='setting_settings_general[setting_enable_faq]'
           class="regular-text form-control"
           style="float:left"
           value="1" <?php checked(1, $options['setting_enable_faq'], true); ?>/>

    <?php
}

function setting_enable_training_platform()
{

    $options = get_option('setting_settings_general');
    ?>
    <input type='checkbox' name='setting_settings_general[setting_enable_training_platform]'
           class="regular-text form-control"
           style="float:left"
           value="1" <?php checked(1, $options['setting_enable_training_platform'], true); ?>/>

    <?php
}

function setting_enable_library()
{

    $options = get_option('setting_settings_general');
    ?>
    <input type='checkbox' name='setting_settings_general[setting_enable_library]'
           class="regular-text form-control"
           style="float:left"
           value="1" <?php checked(1, $options['setting_enable_library'], true); ?>/>


    <?php
}


function setting_api_coursera_access_code()
{

    $options = get_option('setting_settings_general');
    ?>
    <input type='text' name='setting_settings_general[setting_api_coursera_access_code]'
           class="regular-text form-control" value="<?= $options['setting_api_coursera_access_code'] ?>" />


    <p class="text-danger" style="text-align: left; font-style: italic;">
        Do not update this code.
        To get new Access code, please type url "http://portalmunicipal.test/get_new_access_code.php" on the browser.
    </p>
    <?php
}


function setting_api_coursera_program_id()
{

    $options = get_option('setting_settings_general');
    ?>
    <input type='text' name='setting_settings_general[setting_api_coursera_program_id]'
           class="regular-text form-control" value="<?= $options['setting_api_coursera_program_id'] ?>" />
    <?php
}

function setting_api_coursera_api_token()
{

    $options = get_option('setting_settings_general');
    ?>
    <input type='text' name='setting_settings_general[setting_api_coursera_api_token]'
           class="regular-text form-control" value="<?= $options['setting_api_coursera_api_token'] ?>"/>

    <?php
}

function setting_api_coursera_refresh_token()
{

    $options = get_option('setting_settings_general');

    if($options['setting_api_coursera_refresh_token_last_update']){
        echo "Hello world";
    }else{
        echo "No Hello world";
    }
    ?>
    <input type='text' name='setting_settings_general[setting_api_coursera_refresh_token]'
           class="regular-text form-control" value="<?= $options['setting_api_coursera_refresh_token'] ?>" />


    <input type='hidden' name='setting_settings_general[setting_api_coursera_refresh_token_last_update]'
           class="regular-text form-control" value="<?= date('d-m-Y') ?>" />

    <p class="text-info" style="text-align: left; font-style: italic;">
        Last Update:
    </p>
    <?php
}


function setting_api_coursera_client_id()
{

    $options = get_option('setting_settings_general');

    ?>
    <input type='text' name='setting_settings_general[setting_api_coursera_client_id]'
           class="regular-text form-control" value="<?= $options['setting_api_coursera_client_id'] ?>" />

    <p class="text-info" style="text-align: left; font-style: italic;">

    </p>
    <?php
}

function setting_api_coursera_client_secret()
{

    $options = get_option('setting_settings_general');

    ?>
    <input type='text' name='setting_settings_general[setting_api_coursera_client_secret]'
           class="regular-text form-control" value="<?= $options['setting_api_coursera_client_secret'] ?>" />

    <p class="text-info" style="text-align: left; font-style: italic;">

    </p>
    <?php
}


///////////////////////////////////////////////////////////////

function coursera_user_setting_page()
{
    $options = get_option('coursera_user_setting');
    ?>
    <link rel="stylesheet"
          href="<?= get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css' ?>">
    <script src="<?= get_template_directory_uri() . '/assets/js/jquery.min.js' ?>"></script>
    <script src="<?= get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js' ?>"></script>
    <link rel="stylesheet"
          href="<?= get_template_directory_uri() . '/assets/css/font-awesome/css/font-awesome.min.css' ?>">

    <script src="<?= get_template_directory_uri() . '/assets/js/cousera.js' ?>"></script>
    <style>
        body {
            background: #dd5e89;
            background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
            background: linear-gradient(to left, #dd5e89, #f7bb97);
            min-height: 100vh;
        }

        .coursera-section .card {
            max-width: unset !important;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem !important;
            font-size: 1rem !important;
            font-weight: 400;
            line-height: 1.5 !important;
            min-height: unset !important;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da !important;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem !important;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        th, td {
            text-align: left !important;
        }
    </style>


    <input type="hidden" id="adminajaxurl" value="<?php echo admin_url('admin-ajax.php'); ?>">
    <div class="coursera-section">
        <section class="pb-5 header text-center">
            <div class="container py-5 text-white">
                <header class="py-5">
                    <h1 class="display-4">Coursera Training Platform Users</h1>
                    <p class="font-italic mb-1">To access to training platform content, user below users to authenticate
                        to the platform.</p>

                </header>

                <div class="card border-0 shadow mx-auto">
                    <div class="card-body p-5">
                        <!-- Responsive table -->
                        <div class="table-responsive">
                            <!--                            --><?//= display_table_coursera_user();
                            ?>

                            <table id="table-list-coursera-user" class="table m-0 table-striped display">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>ePPN</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <hr style="color: green">
                        <fieldset>
                            <legend class="text-dark" style="text-align: left; font-size: 15px;">Add New User Form
                            </legend>
                            <form id="form-add-new-coursera-user" method="post" class="mt-3">
                                <input type="hidden" value="111" id="input-insert" name="input-insert"/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="user_firstname"
                                                   placeholder="Firstname"
                                                   required
                                                   name="user_firstname"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control datepicker" id="user_lastname"
                                                   autocomplete="off"
                                                   placeholder="Lastname"
                                                   required
                                                   name="user_lastname"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="user_email" autocomplete="off"
                                                   placeholder="email"
                                                   required
                                                   name="user_email"/>
                                            <small class="text-info">Email should be unique</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="user_eppn" name="user_eppn"
                                                   placeholder="eduPersonPrincipalName" required/>
                                            <small class="text-info">eppn should be unique (one time set)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="user_password"
                                                   name="user_password" placeholder="password" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary rounded-0 btn-block mt-3" type="submit"
                                           value="Add new user"/>
                                </div>
                            </form>
                        </fieldset>

                    </div>
                </div>
            </div>
        </section>


        <form method="post" id="form-update-coursera-user">
            <div id="modal-update-coursera-user" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update <span class="user-name"></span></h5>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="user_id_update"/>

                            <div class="form-group">
                                <label for="user_firstname_update">Firstname</label>
                                <input type="text" class="form-control" id="user_firstname_update"
                                       name="user_firstname_update" placeholder="Firstname" required>
                            </div>

                            <div class="form-group">
                                <label for="user_lastname_update">Lastname</label>
                                <input type="text" class="form-control" id="user_lastname_update"
                                       name="user_lastname_update" placeholder="Lastname" required>
                            </div>
                            <div class="form-group">
                                <label for="user_email_update">Lastname</label>
                                <input type="email" class="form-control" id="user_email_update" name="user_email_update"
                                       placeholder="Email" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="post" id="form-delete-coursera-user">
            <div id="modal-delete-coursera-user" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="user-name">Delete training platform user</span></h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="" id="input-delete" name="input-delete"/>
                            <input type="hidden" id="cousera-user-id-delete" name="coursera-user-id-delete"/>
                            <h5 class="text-warning">The "<span class="title"></span>" is about to delete, are you
                                sure?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn-delete-coursera-user" class="btn btn-danger"><span
                                        class="glyphicon glyphicon-remove"></span> Delete
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>

        <form method="post" id="form-change-password-coursera-user">
            <div id="modal-change-password-coursera-user" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><span class="user-name">Change user(<span class="user-title"></span>) password</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="cousera-user-id" name="coursera-user-id"/>
                            <div class="form-group">
                                <label for="coursera-user-new-password">New Password</label>
                                <input type="password" id="coursera-user-new-password" class="form-control"
                                       placeholder="Enter Password"/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btn-delete-coursera-user" class="btn btn-primary"><span
                                        class="glyphicon glyphicon-remove"></span> Change Password
                            </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>
    </div>
    <?php
}

