<?php
/*
  Template Name: The Map page
 */

//
$base_url = default_base_url();
$base_url_others = default_base_url();
$api_url = api_url() . '/';


?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Goku Gohan">
    <meta name="description"
          content="Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste | Ministério da Administração Estatal">
    <meta name="keywords"
          content="Municipality, Municipality Project, Municipality Point Of Interest, Point Of Interest">

    <!-- Open graph tags -->
    <meta property="og:title"
          content="Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste | Ministério da Administração Estatal">
    <meta property="og:type" content="map">
    <meta property="og:url" content="/images/municipality.png">
    <meta property="og:image" content="/images/municipality.png">
    <meta property="og:description"
          content="Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste | Ministério da Administração Estatal">
    <meta property="og:site_name"
          content="Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste | Ministério da Administração Estatal">

    <meta property="article:author" content="https://www.facebook.com/helderchebre">
    <title>Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste | Ministério da Administração Estatal</title>

    <link rel="icon" type="image/x-icon"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/img/favicon.ico' ?>">

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/leaflet.css' ?>"/>


    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/MarkerCluster.css' ?>"/>
    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/MarkerCluster.Default.css' ?>"/>

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/leaflet.draw.css' ?>">
    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/Control.FullScreen.css' ?>">

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/select2.min.css' ?>">


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/materialize.min.css' ?>">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:900,300' rel='stylesheet' type='text/css'>

    <link href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/styledLayerControl.css' ?>"
          rel="stylesheet">

    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/leaflet.groupedlayercontrol.css' ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/leaflet-measure.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.css"
          integrity="sha384-P9DABSdtEY/XDbEInD3q+PlL+BjqPCXGcF8EkhtKSfSTr/dS5PBKa9+/PMkW2xsY" crossorigin="anonymous">


    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/leaflet.contextmenu.css' ?>"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/map.css' ?>"/>
    <!--    <link rel="stylesheet" href="/css/wait.css"/>-->
    <!--        <link rel="stylesheet" href="/css/select2.min.css"/>-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>


    </style>
</head>

<body>

<div class="load-wrapper"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/sdg_circle.svg' ?>"></div>
<main>
    <input type="hidden" id="asset_location_url" value="<?php echo get_stylesheet_directory_uri() ?>">
    <div id="container-external-layer" class="hide">
        <div class="card z-depth-1">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
<!--                            <li class="tab s3"><a class="active" href="#layer-default">DEFAULT</a></li>-->
                            <li class="tab s3"><a href="#layer-institutions">INSTITUTIONS</a></li>
                            <li class="tab s3"><a href="#layer-webmap">MAP SERVICE</a></li>
                            <li class="tab s3">
                                <a href="#modal_load_file" class="modal-trigger tooltipped"
                                   id="btn_load_file" data-position="right"
                                   data-tooltip="Click to upload your own feature">
                                    UPLOAD YOUR OWN DATA
                                </a>
                            </li>
                        </ul>
                    </div>
<!--                    <div class="col s12" id="layer-default" style="max-height: 450px; overflow-y: scroll;">-->
<!--                        <ul id="list-of-default-maps" class="collection"></ul>-->
<!--                    </div>-->

                    <div class="col s12" id="layer-institutions">
                        <br>
                        <div class="input-field">
                            <select id="select-institution"></select>
                            <label>Select Institutions</label>
                        </div>
                        <br>
                        <div class="layer-institution-result"></div>
                    </div>
                    <div class="col s12" id="layer-webmap">
                        <div class="row">
                            <form class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="mapservice-name" type="text" class="validate">
                                        <label for="mapservice-name">Map service Name</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="mapservice-url" type="url" class="validate">
                                        <label for="mapservice-url">Map service url</label>
                                        <span class="helper-text" data-error="Invalid URL" data-success="right">
                                        https://[domain]/arcgis/rest/services/vector/[service_name]/MapServer
                                    </span>
                                    </div>

                                </div>
                                <button class="btn waves-effect waves-light" type="button" id="btn-load-mapservice">
                                    Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <a href="#" class="close-external-layer">Close</a>
            </div>
        </div>
    </div>


    <ul id="slide-menu" class="sidenav">
        <li>
            <div class="user-view">
                <a href="/"><img class="circle"
                                 src="<?php echo get_stylesheet_directory_uri() . '/assets/img/municipality_01.png' ?>"></a>
            </div>
        </li>
        <li><a href="#!" class="subheader">Sponsors</a></li>
        <li>
            <a target="_blank" href="http://timor-leste.gov.tl/?lang=en">
                <img alt="" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/RDLT.png' ?>"></a>
        </li>
        <li>
            <a target="_blank" href="http://undp.org/"><img alt=""
                                                            src="<?php echo get_stylesheet_directory_uri() . '/assets/img/UNDP.png' ?>"></a>
        </li>
        <li>
            <a target="_blank" href="https://europa.eu/">
                <img alt="" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/enlogo.png' ?>"
                     style="width:75px;"></a>
        </li>

    </ul>

    <div class="slide-show-details sidenav">

    </div>

    <div id="area-details-container" class="hide">
        <div class="card">
            <div class="card-image">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/corosal1.jpg' ?>"
                     class="post-banner">
                <span class="card-title area-name"></span>
            </div>
            <div class="card-content">
                <table class="table table-area-info hide">
                    <tr>
                        <th>President</th>
                        <td class="post-president"></td>

                    </tr>
                    <tr>
                        <th>Secretary</th>
                        <td class="post-secretary"></td>

                    </tr>
                    <tr>
                        <th>Accountant</th>
                        <td class="post-accountant"></td>

                    </tr>
                    <tr>
                        <th>Address</th>
                        <td class="post-address"></td>

                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td class="post-phone"></td>

                    </tr>
                    <tr>
                        <th>Email</th>
                        <td class="post-email"></td>
                    </tr>
                </table>

                <ul class="area-table-sucos">
                </ul>
            </div>
        </div>
    </div>

    <div class="info-panel">
        <a href="#!" class="close-me right white-text"> <i class="material-icons">close</i></a>
        <div class="input-field">
            <i class="material-icons prefix">search</i>
            <input id="input-search" type="text" data-length="150" autocomplete="off">
            <label for="input-search">Search Here</label>
        </div>
        <ul class="collection info-list"></ul>
    </div>

    <div id="map-canvas">
        <div class="mouse-position">&nbsp;</div>
        <!--
        <div class="portal-description">Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de
            Timor-Leste
        </div>
        -->
    </div>
</main>


<input type="hidden" id="area_code" value="<?= $_GET["area"] ?>">
<input type="hidden" id="lang" value="<?= lang_code() ?>">
<input type="hidden" id="municipalityId">
<input type="hidden" value="<?= $base_url ?>" id="base_url">
<input type="hidden" value="<?= get_stylesheet_directory_uri() ?>" id="asset_url">
<input type="hidden" value="<?= $api_url ?>" id="api_url">
<input type="hidden" id="total_population">

<div id="legend-info"></div>

<div class="modal bottom-sheet" id="modalDashboard">

    <div class="modal-content">
        <a href="#!" class="modal-close btn-close-modal btn-floating btn-large waves-effect waves-light red"><i
                    class="material-icons">close</i></a>
        <!--            <h4>Select Option</h4>-->
        <!--            <hr>-->

        <iframe id="frame-dashboard" frameborder="0"></iframe>

    </div>
    </form>
</div><!-- /.modal -->


<div id="loading">
    <div class="loading-indicator">
        <div class="progress progress-striped active blue">
            <div class="progress-bar progress-bar-info progress-bar-full indeterminate"></div>
        </div>
    </div>
</div>

<div class="modal" id="modal-detail" tabindex="-1">
    <div class="modal-content">
        <h4 class="modal-title"></h4>
        <div class="modal-body"></div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div><!-- /.modal -->

<!-- Start modal upload geojson -->
<div id="modal_load_file" class="modal">
    <form id="form-upload-geojson" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <h4>Load External File</h4>
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="jsonfile" id="input-upload-file" accept=".geojson,.topjson,.kml,.csv,.zip">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>

            <p>
                <br>(Click to Upload or Drag and Drop Anywhere)
                <br>GEOJSON, TOPOJSON, CSV, KML, or Zipped Shapefile Work
                <br>
                <span class="red-text">
                    NB: CSV file, for each row, columns `lat`, `lon` are required!
                    <br>
                    Uploaded file is considered as a temporary file!
                </span>
            </p>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn waves-effect waves-green">Upload</button>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
    </form>
</div>
<!-- End modal upload geojson -->


<!-- Start modal help -->
<div id="modal-help-geojson" class="modal">
    <div class="modal-content">
        <h4>Help <small>Upload the geojson file format to view on the map</small></h4>
        <p class="text-justify">
            GeoJSON is a format for encoding a variety of geographic data structures.
            GeoJSON supports the following geometry types: Point, LineString, Polygon, MultiPoint,
            MultiLineString, and MultiPolygon.
            Geometric objects with additional properties are Feature objects. Sets of features are
            contained by FeatureCollection objects.
        </p>
        <pre>
{
    "type": "Feature",
    "properties": {
        "name": "Município Baucau"
    },
    "geometry": {
        "type": "Point",
        "coordinates": [125.6, 10.1]
    }
}
        </pre>
        <p class="text-info">
            The GeoJSON Specification (RFC 7946)
            <small>
                EPSG:3857 (WGSS 84/Pseudo-Mercator)
            </small>
        </p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>
<!-- End modal help -->


<!-- End modal -->
<!-- START JAVASCRIPT -->
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/jquery.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/materialize.min.js' ?>"></script>

<!-- <script src="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.js"></script> -->
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet.markercluster-src.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet.groupedlayercontrol.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet-measure.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet.contextmenu.js' ?>"></script>
<script src="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.js"
        integrity="sha384-N2S8y7hRzXUPiepaSiUvBH1ZZ7Tc/ZfchhbPdvOE5v3aBBCIepq9l+dBJPFdo1ZJ"
        crossorigin="anonymous"></script>

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/extras/spin.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/extras/leaflet.spin.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/extras/topojson.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/extras/leaflet.topojson.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/extras/L.KML.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/extras/shp.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/extras/leaflet.shpfile.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/extras/colorbrewer.js' ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/papaparse@5.3.0/papaparse.min.js"></script>


<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/easyprint.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/Control.FullScreen.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/esri-leaflet.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/esri-leaflet-legend.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet.browser.print.min.js' ?>"></script>

<!--<script src="js/select2.min.js"></script>-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/turf.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/select2.min.js' ?>"></script>


<script src=" <?php echo get_stylesheet_directory_uri() . '/assets/map/js/Leaflet-WMS.min.js' ?>"></script>


<script>
    var str_total_population = "<?= $lang['map']['total_population']?>";
    var str_internal_layers = "<?= $lang['map']['internal_layers']?>";
    var str_projects = "<?= $lang['map']['projects']?>";
    var str_poi = "<?= $lang['map']['poi']?>";
</script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/ipg_mapservice_layers.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/script.js' ?>"></script>
<!--<script src="/js/obf_script.js"></script>-->

<script>
    $(document).ready(function () {

        $.ajax({
            url:'http://datasearch.test/tldp/en/api/dashboardapi/get-flip-rank-data/3/none/mrd/TLS003/1',
            type:'get',
            success:function(res){
                console.log(res);
            }
        });

        $("body").on("focus", "#input-search", function () {
            $(".info-list").show();
        });

        // $("body").on("blur","#input-search",function(){
        //     $(".info-list").hide();
        // });

        $("body").on("keyup", "#input-search", function () {
            var value = $(this).val().toLowerCase();
            $(".info-list li").show().filter(function () {
                return ($(this).text().toLowerCase().trim().indexOf(value) == -1);
            }).hide();
        });

        $("body").on("keyup", "#input-search-poi", function () {
            var value = $(this).val().toLowerCase();
            $(".collection-poi li").show().filter(function () {
                return ($(this).text().toLowerCase().trim().indexOf(value) == -1);
            }).hide();
        });

        $("body").on("keyup", "#input-search-indicator", function () {
            var value = $(this).val().toLowerCase();
            $("#select-option-indicator li").show().filter(function () {
                return ($(this).text().toLowerCase().trim().indexOf(value) == -1);
            }).hide();
        });
    });
</script>
</body>

</html>
