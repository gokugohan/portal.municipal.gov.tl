<?php
/*
  Template Name: Map
 */

$header_logo = get_theme_mod('municipality_header_logo');
if ($header_logo == null) {
    $header_logo = get_stylesheet_directory_uri() . '/assets/img/estatal.png';
}
wp_head();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        <?php

        $site_description = get_bloginfo('description', 'display');
        $site_name = get_bloginfo('name');
        //for home page
        if ($site_description && (is_home() || is_front_page())) {
            echo $site_name;
            echo ' | ';
            echo $site_description;
        } else {
            the_title();
            echo ' | ';
            echo $site_name;
        }

        ?>
    </title>
    <meta property="og:title" content="Mapa : <?= $site_name ?>">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <style>

        #main {
            background-image: url(<?php echo get_stylesheet_directory_uri() . '/assets/img/bg-pattern.png' ?>) !important;
            /*background: rgba(150, 8, 7, .57);*/
        }
        .logo-wrapper{
            max-width: 50px;
            max-height: 50px;
        }
        .logo-wrapper img{
            width: 100%;
        }

        .card h6{
            border-bottom: 1px solid #ccc;
            padding-bottom: 8px;
        }
    </style>
</head>
<body>
<main id="main">
    <div class="dashboard-header d-flex justify-content-between align-items-center mt-3">
        <div class="d-flex flex-column">
            <div class="d-flex gap-1">

                <a href="/" class="logo-wrapper">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/municipality_01.png' ?>"
                         alt="<?= $site_name ?>">
                </a>
                <div>
                    <h4 class="mb-0"><span class="selected-area-title">Timor-Leste</span> 👥 <span
                                class="counter total-populasaun" data-target="">0</span></h4>
                    <p class="text-muted"><span class="source"><?= lang("Source") ?>: </span><span
                                class="selected-data-source"></span></p>
                </div>
            </div>

        </div>
        <div class="d-flex switcher-buttons">
            <button class="btn btn-outline-dark me-2" id="btn-reload-map">
                <i class="bi bi-arrow-repeat"></i>
            </button>
            <button class="btn btn-outline-dark me-2 activated" id="btn-switch-tls-map">
                <i class="bi bi-pin-map"></i> Timor-Leste
            </button>
            <button class="btn btn-outline-dark text-capitalize text-dark me-2 btn-switch-basemap"
                    id="basemap-sattelite">
                <i class="bi bi-map"></i> <?= lang("sattelite") ?>
            </button>
            <button class="btn btn-outline-dark text-capitalize text-dark me-2 btn-switch-basemap activated"
                    id="basemap-street">
                <i class="bi bi-map"></i> <?= lang("streets") ?>
            </button>

            <div class="form-group " style="width: 200px;">
                <select id="list-of-data" class="form-select"></select>
            </div>
        </div>
    </div>

    <!-- Map -->
    <div class="map-container my-4" id="map-canvas"></div>

    <!-- Stats Panels -->
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card p-4 card-style mb-3">
                <h6 class="mb-3 fw-bold"><?= lang("Population Statistics") ?></h6>
                <ul class="list-group list-group-flush border-0">
                    <li class="list-group-item">👥 <?= lang("Total Population") ?>: <span
                                class="counter total-populasaun" data-target="">0</span>
                    </li>
                    <li class="list-group-item">👨 <?= lang("Male Population") ?>: <span class="counter total-mane"
                                                                                        data-target="">0</span>
                    </li>
                    <li class="list-group-item">👩 <?= lang("Female Population") ?>: <span class="counter total-feto"
                                                                                          data-target="">0</span>
                    </li>
                    <li class="list-group-item">🏠 <?= lang("Total Households") ?>: <span class="counter total-umakain"
                                                                                         data-target="">0</span>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card p-4 card-style mb-3">
                        <h6 class="mb-3 fw-bold"><?= lang("Administrative Divisions") ?></h6>
                        <ul class="list-group list-group-flush border-0">
                            <li class="list-group-item">🏛️ <?= lang("Administrative Posts") ?>: <span
                                        class="counter total-posto" data-target="">0</span>
                            </li>
                            <li class="list-group-item">🗺️ <?= lang("Villages (Sucos)") ?>: <span class="counter total-suku"
                                                                                                  data-target="">0</span>
                            </li>
                            <li class="list-group-item">🏡 <?= lang("Aldeias") ?>: <span class="counter total-aldeia"
                                                                                        data-target="">0</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-4 card-style mb-3">
                        <h6 class="mb-3 fw-bold"><?= lang("Geographic Statistics") ?></h6>
                        <ul class="list-group list-group-flush border-0">
                            <li class="list-group-item">🌐 <?= lang("Total Area") ?>: <span class="counter total-area"
                                                                                           data-target="">0</span> km²
                            </li>
                            <li class="list-group-item">
                                📏 <?= lang("Population Density") ?><span class="tag-densidade-populasional mx-1"></span>: <span
                                        class="counter total-densidade-populasional" data-target="">0</span>
                                per km²
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-8">
            <div class="card p-4 card-style mb-3">
                <h6 class="mb-3 fw-bold chart-title"></h6>

                <canvas id="canvas-ctx" width="400" height="170"></canvas>
            </div>

        </div>

    </div>
</main>


<input type="hidden" id="map-desc" value="<?= $site_name ?>">
<input type="hidden" id="legend-text" value="<?= lang("legend"); ?>">
<input type="hidden" id="total-population-text" value="<?= lang("Total Population") ?>">
<input type="hidden" id="low-density-text" value="<?= lang("Low"); ?>">
<input type="hidden" id="acceptable-density-text" value="<?= lang("Acceptable"); ?>">
<input type="hidden" id="dense-density-text" value="<?= lang("Dense"); ?>">
<input type="hidden" id="evercrowded-density-text" value="<?= lang("Overcrowded"); ?>">
<input type="hidden" id="select-data-source-text" value="<?= lang("Select Data Source"); ?>">
<input type="hidden" id="admin-ajax-url" value="<?= admin_url('admin-ajax.php'); ?>">
<input type="hidden" id="lang-municipalities" value="<?= lang('municipalities'); ?>">
<input type="hidden" id="logo" value="<?php echo get_stylesheet_directory_uri() . '/assets/img/municipality_01.png' ?>">
<input type="hidden" id="default_map_tls" data-id="99999999"
       value="<?= get_setting_value("municipality_setting_upload_file") ?>">



<?php

wp_footer();
?>
<script>
    $(document).ready(function () {
        $(".toggle-sidebar-btn").on("click", function () {
            $("body").toggleClass("toggle-sidebar");
        });

    });
</script>

</body>
</html>
