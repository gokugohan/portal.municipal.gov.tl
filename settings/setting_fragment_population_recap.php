<?php
function population_recap_setting_page()
{

    $default_bg_image = get_template_directory_uri() . '/assets/img/none.png';
?>
    <link rel="stylesheet"
        href="<?= get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css' ?>">
    <link href="<?= get_template_directory_uri() . '/assets/css/dataTables.dataTables.min.css' ?>">

    <script src="<?= get_template_directory_uri() . '/assets/js/jquery.min.js' ?>"></script>

    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.min.js' ?>">
    <script src="<?= get_template_directory_uri() . '/assets/js/jquery.dataTables.min.js' ?>"></script>
    <script src="<?= get_template_directory_uri() . '/assets/map/js/papaparse.min.js' ?>"></script>
    <script src="<?= get_template_directory_uri() . '/assets/js/admin_map_dashboard.js' ?>"></script>

    <style>
        body {
            background: #dd5e89;
            background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
            background: linear-gradient(to left, #dd5e89, #f7bb97);
            min-height: 100vh;
        }
    </style>

    <section class="pb-5 header">
        <div class="container py-5">
            <header class="py-5 text-center text-white">
                <h1 class="display-4"><?= lang("mae") ?></h1>

            </header>
            <div class="card border-0 shadow mx-auto" style="max-width: 100%">
                <div class="card-body p-5">

                    <div id="nav-tab-data" class="tab-pane fade show active">

                        <h2 class="mb-3">Map CSV Data</h2>
                        <hr>
                        <form id="form-add-new-data">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title">
                                    </div>
                                </div>
                                <div class="col-lg-2">

                                    <div class="mb-3">
                                        <label for="year">Year</label>
                                        <input type="number" min="2002" class="form-control" id="year" step="1">
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label for="file_path">CSV File</label>
                                        <input type="text" class="form-control" id="file_path">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="0" id="is_update">
                            <input type="hidden" id="id">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <button type="reset" id="btn-reset-form-map-data" class="btn btn-danger btn-sm">Reset</button>
                        </form>

                        <hr>
                        <div id="data-table-container"></div>

                    </div>
                </div>
            </div>

        </div>

        <input type="hidden" id="admin-ajax-url" value="<?= admin_url('admin-ajax.php'); ?>">
    </section>
<?php
}
