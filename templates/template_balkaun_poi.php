<?php
/*
  Template Name: Balkaun - Point of interest page
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
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
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' ?>">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&amp;display=swap">


    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/animate.css' ?>">
    <link rel="stylesheet"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/css/font-awesome/css/font-awesome.min.css' ?>">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/leaflet.css' ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/MarkerCluster.css' ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/MarkerCluster.Default.css' ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/styledLayerControl.css' ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/leaflet.groupedlayercontrol.css' ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/map/css/map.css' ?>">

    <link rel="stylesheet"
          href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.css">
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'/>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style>

        nav.navbar {
            background: rgba(150, 7, 7, .9);
        }

        .navbar h4.title {
            display: inline;
            color: #fff;
        }

        .btn-goto-poi.active {
            color: #c0392b !important;
            font-weight: 600;
        }

        .vertical-nav {
            overflow-y: auto;
            min-width: 20rem;
            width: 20rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.4s;
        }

        .page-content {
            width: calc(100% - 20rem);
            margin-left: 20rem;
            transition: all 0.4s;
        }

        #sidebarCollapse {
            background-color: transparent !important;
            color: #fff;
            border-color: transparent;
        }

        h4.header-title {
            color: rgb(150, 7, 7);
        }

        /* for toggle behavior */

        #sidebar.active {
            margin-left: -20rem;
        }

        #content.active {
            width: 100%;
            margin: 0;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -20rem;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                width: 100%;
                margin: 0;
            }

            #content.active {
                margin-left: 20rem;
                width: calc(100% - 20rem);
            }
        }

        .vertical-nav {
            position: unset;
        }


        .list-of-poi {
            list-style: decimal inside;
            margin-bottom: 65px;
        }

        .list-of-poi li {
            display: list-item;
        }

        .list-of-poi li::marker {
            font-weight: 600;
        }

        .list-of-poi li p.poi-excerpt {
            font-size: 16px;
            margin-left: 24px;
            text-align: justify;
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .no-data{
            margin-top: 35px;
            color: #a01f1f;
            font-style: italic;
            text-align: center;
            font-size:16px;
        }

    </style>
</head>
<body>

<?php

$balkaun_logo = get_bu_setting('bu_menu_logo', true);

$balkaun_logo_path = $balkaun_logo ? $balkaun_logo : get_stylesheet_directory_uri() . '/assets/img/front/d56b07fa25b1c546b415c695ae197aef.png';

$poi_items = [];

?>


<nav class="navbar navbar-expand-lg navbar-fixed">
    <a class="navbar-brand" href="<?= bloginfo('url') ?>/balkaun-uniku">
        <h4 class="title text-uppercase"><?= the_title() ?></h4>
    </a>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <!-- Toggle button -->
                <button id="sidebarCollapse" type="button" class="btn btn-light bg-white px-4">
                    <i class="fa fa-bars mr-2"></i>
                </button>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="<?= lang("search_here") ?>"
                   id="poi-input-search" aria-label="<?= lang("search_here") ?>">

        </form>
    </div>
</nav>


<input type="hidden" id="admin-ajax-url" value="<?= admin_url('admin-ajax.php') ?>"/>

<!-- Vertical navbar -->
<div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 bg-light">

        <div class="ms-3 text-center pageheader-title-container">
            <a class="navbar-brand mx-auto" href="<?= bloginfo('url') ?>/balkaun-uniku">
                <img src="<?= $balkaun_logo_path ?>" alt="..." width="100"
                     class="img-thumbnail shadow-sm">
            </a>
            <h4 class="header-title"><?= the_title() ?></h4>
<!--            <cite class="citation" style="font-size: 12px">--><?//= the_title() ?><!--</cite>-->
        </div>

    </div>

    
        <?php

        $args = array(
            'post_type' => array('balkaun-uniku'),
            'post_status' => 'publish',
            'nopaging' => true,
        );
        $point_of_interests = new WP_Query($args);
        if ($point_of_interests->have_posts()) {
?>
<ol class="nav flex-column bg-white list-of-poi">
    <?php
            while ($point_of_interests->have_posts()) {
                $point_of_interests->the_post();
                $lat = get_post_meta($post->ID, 'balkaun_poi_latitude', true);
                $lng = get_post_meta($post->ID, 'balkaun_poi_longitude', true);


                $item = [
                    'id' => $post->id,
                    'title' => get_the_title(),
                    'content' => excerpt(),
                    'lat' => $lat,
                    'lng' => $lng,
                    'permalink' => get_the_permalink()
                ];
                $poi_items[] = $item;

                ?>
                <li class="nav-link">
                    <a href="#!" class="btn-goto-poi text-decoration-none text-dark p-0" data-lat="<?= $lat ?>"
                       data-lng="<?= $lng ?>"
                       data-title="<?= the_title() ?>">
                        <i class="fa fa-map-marker fa-fw"></i>
                        <?= the_title() ?>
                        <p class="poi-excerpt">
                            <?= excerpt(20) ?>
                        </p>
                    </a>

                </li>
                <?php

            }

            /* Restore original Post Data */
            wp_reset_postdata();
            ?>
        </ol>
        <?php
        }else{
            echo '<h5 class="px-4 no-data">No data</h5>';
        }
        ?>

    
</div>
<!-- End vertical navbar -->


<!-- Page content holder -->
<div class="page-content" id="content">
    <div id="map-canvas"></div>
</div>

<input type="hidden" id="static_path" value="<?= get_template_directory_uri() ?>">


<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/jquery.min.js' ?>"></script>

<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/popper.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet.markercluster.js' ?>"></script>
<script src="<?php echo get_stylesheet_directory_uri() . '/assets/map/js/leaflet.groupedlayercontrol.js' ?>"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
        });


        let point_of_interests_data = [];
        let marker_icon_path = $("#static_path").val() + '/assets/map/images/marker_tl.png';
        <?php
        foreach ($poi_items as $item) {
        ?>

        point_of_interests_data.push({
            "title": `<?=$item['title']?>`,
            "content": `<?=$item['content']?>`,
            "latitude": "<?=$item['lat']?>",
            "longitude": "<?=$item['lng']?>",
            "permalink": "<?=$item['permalink']?>",
        });

        console.log(point_of_interests_data);
        <?php
        }
        ?>
        let map, markers_poi = L.markerClusterGroup();


        let NewMarkerIcon = L.Icon.extend({
            options: {
                iconSize: [30, 45],
                // iconAnchor: [22, 94],
                // popupAnchor: [-3, -76]
            }
        });
        let tlsIcon = new NewMarkerIcon({
            iconUrl: marker_icon_path
        });

        var mapBoxOSM = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            // attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 20,
            id: 'mapbox/streets-v11',
            accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ',
            attribution: 'OSM - Timor-Leste Portal Municipal &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        });
        //
        var mapBoxSatellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            // attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 20,
            id: 'mapbox/satellite-streets-v11',
            accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ',
            attribution: 'Satellite - Timor-Leste Portal Municipal &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        });


        map = L.map("map-canvas", {
            center: [-8.787519, 125.946401],
            zoom: 9,
            layers: [mapBoxOSM],
            zoomControl: true,
            scrollWheelZoom: true,
            attributionControl: true,
        });


        var baseMaps = {

            "Openstreet Map": mapBoxOSM,
            "Sattelite Imagery": mapBoxSatellite
        };


        L.control.scale({
            position:'bottomleft'
        }).addTo(map);
        var info = L.control({
            position:'topleft'
        });
        info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
            this.update();
            return this._div;
        };

        // method that we will use to update the control based on feature properties passed
        info.update = function (props) {
            if (props !== undefined) {
                this._div.innerHTML = props;
            }
        }

        info.addTo(map);

        let geojson_file = $("#static_path").val() + "/assets/map/geojson/map_municipios.geojson";

        let municipalityMapGeoJson = L.geoJSON(null, {
            style: function (feature) {
                return {
                    color: "#ffb300",
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.1
                };
            },
            onEachFeature: function (feature, layer) {

                layer.on('mouseover', function (e) {


                    layer.setStyle({
                        weight: 1,
                        fillOpacity: 0
                    });

                    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                        layer.bringToFront();
                    }
                    info.update(feature.properties.TYPE_1 + ': ' + feature.properties.NAME_1);

                });
                layer.on('mouseout', function (e) {
                    municipalityMapGeoJson.resetStyle(e.target);
                    info.update('');

                });

                layer.on('click', function (e) {
                    // map.fitBounds(e.target.getBounds());
                });
            }
        });


        var layerControl = L.control.layers(baseMaps, null, {collapsed: false}).addTo(map);

        $.getJSON(geojson_file, function (data) {
            municipalityMapGeoJson.addData(data);
            municipalityMapGeoJson.addTo(map);
            layerControl.addOverlay(municipalityMapGeoJson, "Municipality Boundary");
            map.flyToBounds(municipalityMapGeoJson.getBounds());
        });

        $.each(point_of_interests_data, function (key, val) {
            var html = '<h4 class="title">' + val.title + '</h4>';
            html += `<div class="content">${val.content}</div>`;
            html += '<br/><hr/>';
            html += '<a target="_blank" href="' + val.permalink + '" class="btn btn-sm btn-outline-success"><i class="fa fa-map-marker"></i> <?=lang('details')?></a>';
            markers_poi.addLayer(L.marker([val.latitude, val.longitude], {icon: tlsIcon}).bindPopup(html));

        })


        map.addLayer(markers_poi);


        $("body").on("click", ".btn-goto-poi", function (e) {
            $(".btn-goto-poi").removeClass('active');
            $(".btn-goto-poi").addClass('text-dark');
            $(this).addClass('active');
            $(this).removeClass('text-dark');
            map.flyTo([$(this).data("lat"), $(this).data("lng")], 13);
        });

        $("body").on("keyup", "#poi-input-search", function () {
            var value = $(this).val().toLowerCase();
            $(".list-of-poi li").show().filter(function () {
                return ($(this).text().toLowerCase().trim().indexOf(value) == -1);
            }).hide();
        });

        addWaterMark(map, "bottomright", "<?php echo get_stylesheet_directory_uri() . '/assets/map/images/logo-map.svg' ?>", 50);

        function addWaterMark(the_map, position, imgpath, width = 250) {
            L.Control.Watermark = L.Control.extend({
                onAdd: function (map) {
                    var img = L.DomUtil.create('img');

                    img.src = imgpath;
                    img.style.width = width + 'px';

                    return img;
                },

                onRemove: function (map) {
                    // Nothing to do here
                }
            });

            L.control.watermark = function (opts) {
                return new L.Control.Watermark(opts);
            }

            L.control.watermark({position: position}).addTo(the_map);
        } //addWaterMark
    })
</script>
