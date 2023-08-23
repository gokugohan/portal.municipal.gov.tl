$(window).resize(function () {
    sizeLayerControl();
});

let external_layer = "External Layer";
let internal_layer = "Internal Layer";

let GEOJSON = "geojson", PNG = "png";
let api_url = $("#api_url").val();
let base_url = $("#base_url").val();
let lang = $("#lang").val();
let area_code = $("#area_code").val();
let project_link = api_url + lang + "/all-geojson-municipality-projects";
let point_of_interest_link = api_url + lang + "/point-of-interest/geojson";


let population_legendControl, soil_ph_legendControl,
    population_dimensions = [0, 50000, 55000, 60000, 65000, 70000, 75000, 100000],
    soil_ph_dimensions = [0, 5.5, 6.5, 7.5, 8.5];

/*
    Map
 */

var map, featureList, styleControlLayer, placeSearchArray = [], foundPlaceMarker;
var circleDrawing = [];
let poi_list = '', project_list = '', totalProject = 0, totalPOI = 0,
    area_municipality_list = '';
area_post_administrative_list = '',
    area_suco_list = '';

var markerClusters = L.markerClusterGroup({
    spiderfyOnMaxZoom: true,
    showCoverageOnHover: false,
    zoomToBoundsOnClick: true,
    disableClusteringAtZoom: 16
});

var markerList = [];

let markerGreenIcon = L.icon({
    iconUrl: '/css/map/images/marker-green.png',
    iconSize: [20, 20]
});

let markerRedIcon = L.icon({
    iconUrl: '/css/map/images/marker-red.png',
    iconSize: [20, 20]
});


let contextMenuOptionItems = [

    {
        text: 'Center map here',
        callback: centerMap
    }
];


function sizeLayerControl() {
    $(".leaflet-control-layers").css("max-height", $("#map").height() - 50);
} //sizeLayerControl


$('#slide-menu').sidenav({edge: "left"});
$('.slide-show-details').sidenav({edge: "right"});

$('.tabs').tabs();
$('.modal').modal({dismissible: false});
$('.fixed-action-btn').floatingActionButton({
    hoverEnabled: true
});
// $('select').formSelect();
$(".close-me").on("click", function () {
    $(this).parent().hide();
});

$('.tooltipped').tooltip();

$('.tap-target').tapTarget();

$("body").on("click", ".btn-sidenav-trigger", function () {
    $('#slide-menu').sidenav('open');
})


$("#loading").hide();

$("body").on("click", "#btn-help-geojson", function () {
    $("#modal-help-geojson").modal('open');
});

$("#form-upload-geojson").on('submit', (event) => {
    event.preventDefault();
    let file = $("#input-upload-file").prop('files')[0];
    handleUploadedFile(file);
    $("#input-upload-file").val("");
    $(".file-path").val("");
    //
    //
    // if (file !== undefined) {
    //     var fileUrl = window.URL.createObjectURL(file);
    //     $.getJSON(fileUrl, function (data) {
    //         loadUploadedGeoJsonFile(data, file.name, external_layer);
    //     });
    //     $("#input-upload-file").val("");
    //     $(".file-path").val("");
    // } else {
    //     alert("Upload geojson file to be loaded!");
    // }
});


function handleUploadedFile(file) {
    let file_extension = file.name.split('.')[1];

    map.spin(true, {lines: 13, length: 40});

    if (file_extension === 'zip') {
        return handleZipFile(file);
    }

    let reader = new FileReader();
    reader.onload = function () {
        let fileUrl = window.URL.createObjectURL(file);
        if (reader.readyState !== 2 || reader.error) {
            return;
        }

        switch (file_extension) {
            case "geojson":
                $.getJSON(fileUrl, function (data) {
                    loadUploadedGeoJsonFile(data, file.name, external_layer);
                    map.spin(false);
                });
                break;
            case "topojson":
                loadTopoJson(fileUrl, file.name);
                map.spin(false);
                break;

            case "csv":
                loadCSV(fileUrl, file.name);
                map.spin(false);
                break;
            case "kml":
                loadKML(fileUrl, file.name);
                map.spin(false);
                break;
            default:
                M.toast({
                    html: 'We only accept file GEOJSON, TOPOJSON, CSV, KML, or Zipped Shapefile!',
                    classes: 'rounded red darken-1'
                });
                map.spin(false);
        }


    };
    reader.readAsArrayBuffer(file);
}


function loadTopoJson(url, filename) {
    let geometry_type;

    let topoMarkerClusters = L.markerClusterGroup({
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: false,
        zoomToBoundsOnClick: true,
        disableClusteringAtZoom: 16
    });

    let topoLayer = L.topoJson(null, {
        style: function (feature) {
            return {
                color: "#000",
                opacity: 1,
                weight: 1,
                fillColor: '#35495d',
                fillOpacity: 0.8
            }
        },
        onEachFeature: function (feature, layer) {

            geometry_type = feature.geometry.type;
            var properties = layer.feature.properties;

            var column = Object.keys(properties);
            var html = "<ul class='list-group'>";

            for (var i = 0; i < column.length; i++) {

                $.each(properties, function (key, value) {
                    html += "<li class='list-group-item'>" + key + " - " + value + "</li>";
                });
                break;
            }

            html += "</ul>";
            layer.bindPopup(html);
        }
    });

    addTopoData(url).then(data => {
        topoLayer.addData(data);

        topoLayer.StyledLayerControl = {
            removable: true,
            visible: false
        }

        map.flyToBounds(topoLayer.getBounds());

        if (geometry_type == "Point") {
            topoMarkerClusters.addLayer(topoLayer);
            topoMarkerClusters.addTo(map);
            layerControl.addOverlay(topoMarkerClusters, filename, external_layer);
        } else {
            layerControl.addOverlay(topoMarkerClusters, filename, external_layer);
        }

        M.toast({
            html: 'File Added',
            className: 'rounded green accent-3'
        });

        map.spin(false);
    });


}// loadTopoJson


function loadCSV(url, filename) {
    // Read markers data from data.csv
    $.get(url, function (csvString) {

        // Use PapaParse to convert string to array of objects
        let data = Papa.parse(
            csvString, {
                header: true,
                dynamicTyping: true,
                complete:function(response){
                    console.log(response);
                    // For each row in data, create a marker and add it to the map
                    // For each row, columns `lat`, `lon` are required
                    let markers = L.markerClusterGroup();
                    let html="";
                    $.each(response.data,function(i,v){
                        let row = v;

                        let latitude = row.lat;
                        let longitude = row.lon;

                        html ='<ul class="collection">';

                        $.each(response.meta['fields'], function(i) {
                            let item = response.meta['fields'][i];
                            console.log(item+': ' + row[item]);
                            html +="<li class='collection-item'><span class='popup-heading'>"+item + "</span>: " + row[item]+"</li>";
                        });
                        html +="</ul>";

                        if(row.lat !==undefined && row.lon !==undefined){
                            let marker = L.marker([latitude, longitude], {
                                opacity: 1
                            }).bindPopup(html);
                            marker.on('mouseover',function(ev) {
                                marker.openPopup();
                            });
                            marker.on('mouseout',function(ev) {
                                marker.closePopup();
                            });
                            markers.addLayer(marker);
                        }else{
                            console.log("lat:undefined, long:undefined");
                        }
                    });

                    markers.addTo(map);
                    layerControl.addOverlay(markers, filename, external_layer);
                    M.toast({
                        html: 'File Added',
                        className: 'rounded green accent-3'
                    });
                    map.spin(false);

                }
            });
        // }).data;

        // // For each row in data, create a marker and add it to the map
        // // For each row, columns `lat`, `lon`, and `title` are required
        // let markers = L.markerClusterGroup();

        // for (let i in data) {
        //     let row = data[i];

        //     // console.log(row.Latitude, row.Longitude);
        //     let latitude = row.lat;
        //     let longitude = row.lon;


        //     if(row.lat !==undefined && row.lon !==undefined){
        //         let marker = L.marker([latitude, longitude], {
        //             opacity: 1
        //         }).bindPopup(row.title);

        //         markers.addLayer(marker);
        //     }else{
        //         console.log("lat:undefined, long:undefined");
        //     }


        // }

        // markers.addTo(map);
        // layerControl.addOverlay(markers, filename, external_layer);
        // M.toast({
        //     html: 'File Added',
        //     className: 'rounded green accent-3'
        // });
        // map.spin(false);
    });

} //loadCSV


function loadKML(url, filename) {
    var markers = L.markerClusterGroup();
    // Load kml file
    fetch(url)
        .then(res => res.text())
        .then(kmltext => {
            // Create new kml overlay
            const parser = new DOMParser();
            const kml = parser.parseFromString(kmltext, 'text/xml');
            const track = new L.KML(kml);
            // map.addLayer(track);
            markers.addLayer(track);
            markers.addTo(map);
            layerControl.addOverlay(markers, filename, external_layer);
            // Adjust map to show the kml
            map.flyToBounds(track.getBounds());
            M.toast({
                html: 'File Added',
                className: 'rounded green accent-3'
            });
            map.spin(false);
        });
} //loadKML

$("body").on("click", ".btn-radius-place", function () {
    var latitude = $(this).data("lat");
    var longitude = $(this).data("lng");
    var name = $(this).data("name");


    if (foundPlaceMarker) {
        map.removeLayer(foundPlaceMarker);
    }

    foundPlaceMarker = L.circle([latitude, longitude]);

    foundPlaceMarker.setStyle({className: 'selected-marker'});
    foundPlaceMarker.addTo(map);

    var html = "<h6>" + name + "</h6>";

    var popup = L.popup().setLatLng([latitude, longitude]).setContent(html);

    foundPlaceMarker.bindPopup(popup);

    M.toast({html: name + "<br>" + latitude + ":" + longitude, className: 'rounded green accent-3'});


    map.flyTo([latitude, longitude], 15);

    $("#featureModal").modal('close');

});


// console.log(quotes);

function getMapServiceLayer(external_source_mapserver_source, title) {

    let dynamicMapLayer = L.esri.dynamicMapLayer({
        url: external_source_mapserver_source
    }, {});

    dynamicMapLayer.addTo(map);
    // map.flyTo(dynamicMapLayer.getBounds());


    dynamicMapLayer.on('loading', function (e) {
        showPreLoader();

    });
    dynamicMapLayer.on('load', function (e) {
        hidePreLoader();
        //_showDynamicLayerLegend(dynamicMapLayer);

        $("#container-external-layer").removeClass('display-container-external-layer');
        $("#container-external-layer").addClass('hide');

        layerControl.addOverlay(dynamicMapLayer, title, external_layer);
    });
    //
    dynamicMapLayer.metadata(function (error, metadata) {
        if (error) {
            return;
        }
        //
        // console.log(metadata);
        // console.log(metadata.documentInfo.Subject);
        var htmlContent = '<ul class="collection">';
        htmlContent += '<li class="collection-item">Subject: ' + metadata.documentInfo.Subject + '</li>';
        htmlContent += '<li class="collection-item">Title: ' + metadata.documentInfo.Title + '</li>';
        htmlContent += '<li class="collection-item">Category: ' + metadata.documentInfo.Category + '</li>';
        htmlContent += '<li class="collection-item">Author: ' + metadata.documentInfo.Author + '</li>';
        htmlContent += '<li class="collection-item">Comments: ' + metadata.documentInfo.Comments + '</li>';
        htmlContent += '<li class="collection-item">Keywords: ' + metadata.documentInfo.Keywords + '</li>';

        htmlContent += '<li class="collection-item">Geometry Type: ' + metadata.geometryType + '</li>';
        htmlContent += '<li class="collection-item">Supported Query Formats: ' + metadata.supportedQueryFormats + '</li>';

        Swal.fire({
            icon: 'info',
            title: title,
            html: htmlContent
        })

        // $("#modal-detail .modal-content").html(htmlContent);
        // $("#modal-detail").modal('open');

        // $("#feature-info").html(htmlContent);

        // $(".slide-show-details").html(htmlContent);
        // $(".slide-show-details").sidenav('open');

    });

    dynamicMapLayer.bindPopup(function (error, featureCollection) {

        if (error || featureCollection.features.length === 0) {
            return false;
        } else {

            var properties = featureCollection.features[0].properties;

            var column = Object.keys(properties);

            // console.log(column);

            let html = "";

            for (var i = 0; i < column.length; i++) {

                $.each(properties, function (key, value) {
                    html += "<p><b>" + key + "</b>: " + value + " </p>";
                });
                break;
            }

            return html;
        }
    });


    _showDynamicLayerLegend(dynamicMapLayer);
}

function _showDynamicLayerLegend(dynamicMapLayer) {
    dynamicMapLayer.legend(function (error, legend) {
        if (!error) {
            var html = '<ul class="collection">';
            for (var i = 0, len = legend.layers.length; i < len; i++) {
                html += '<li class="collection-item"><strong>' + legend.layers[i].layerName + '</strong><ul>';
                for (var j = 0, jj = legend.layers[i].legend.length; j < jj; j++) {
                    html += L.Util.template('<li><img width="{width}" height="{height}" League="data:{contentType};base64,{imageData}"><span>{label}</span></li>', legend.layers[i].legend[j]);
                }
                html += '</ul></li>';
            }
            html += '</ul>';
            // document.getElementById('dynamc').innerHTML = html;
            $("#legend-info").html(html);
            $("#legend-info").css('display', 'block');
        }
    });
}


$("body").on("change", ".checkbox-load-data", function () {
    let isChecked = $(this).prop('checked');
    // let level = $(this).data("level");
    // let title = $(this).data("title");
    let external_source_mapserver = $(this).data("map-server");
    // let external_source_mapserver_source = $(this).data("source");
    // let soil_ph = $(this).data("soil-ph");
    let url = $(this).data('url');
    let layerName = $(this).data("title");
    let type = $(this).data("type");

    // console.log("external_source_mapserver " + typeof (external_source_mapserver));
    // console.log("external_source_mapserver " + external_source_mapserver);

    M.toast({html: layerName, className: 'rounded red accent-3'});
    if (isChecked) {
        $(this).attr("disabled", true);


        if (type === GEOJSON) {
            showPreLoader();
            $.getJSON(url, function (data) {
                loadUploadedGeoJsonFile(data, layerName, external_layer);
            });
        } else if (type === PNG) {
            showPreLoader();
            var imageUrl = url,
                imageBounds = [[-9.504785583554632, 124.04464721700003], [-8.126870154380823, 127.34226226826918]];
            let tiffImageLayer = L.imageOverlay(imageUrl, imageBounds);

            tiffImageLayer.addTo(map);
            layerControl.addOverlay(tiffImageLayer, layerName, external_layer);

            $("#container-external-layer").removeClass('display-container-external-layer');
            $("#container-external-layer").addClass('hide');

            tiffImageLayer.on('load', function () {
                hidePreLoader();
            });

        } else if (external_source_mapserver === 1) {
            getMapServiceLayer($(this).data("source"), layerName);
        }
    }
});


// get_external_default_maps();

function get_external_default_maps() {
    $.ajax({
        url: base_url + 'datasearch/gis/default-maps',
        //url: 'http://datasearch.test/gis/default-maps',
        type: 'get',
        success: function (response) {
            // console.log(response);
            let html = '';
            let total = response.length;
            for (let i = 0; i < total; i++) {
                let item = response[i];
                html += '<li class="collection-item">' + item.title + '<small> (source: ' + item.source + ')</small>' + '<div class="secondary-content"><div class="switch"><label>' +
                    '<input type="checkbox" class="checkbox-load-data" data-title="' + item.title + ' <small> (source: ' + item.source + ')</small>' + '" data-type="' + item.type + '" ' +
                    'data-url="' + item.attachment + '">' +
                    '<span class="lever"></span> </label></div></div></li>';
            }

            $("#list-of-default-maps").html(html);
        }
    });

}//get_external_default_maps

loadDefaultUploadedMaps();

function loadDefaultUploadedMaps() {
    $.ajax({
        url: base_url + 'datasearch/gis/default-maps',
        //url: 'http://datasearch.test/gis/default-maps',
        type: 'get',
        success: function (response) {
            // console.log(response);
            let html = '';
            let total = response.length;

            for (let i = 0; i < total; i++) {
                let item = response[i];
                let title = item.title + " (" + item.source + ")";
                if (item.type === GEOJSON) {
                    showPreLoader();
                    $.getJSON(item.attachment, function (data) {
                        var data = loadUploadedGeoJsonFile(data, title, external_layer, true, false);
                    });
                } else if (item.type === PNG) {
                    showPreLoader();
                    var imageUrl = item.attachment,
                        imageBounds = [[-9.504785583554632, 124.04464721700003], [-8.126870154380823, 127.34226226826918]];
                    let tiffImageLayer = L.imageOverlay(imageUrl, imageBounds);

                    //tiffImageLayer.addTo(map);
                    layerControl.addOverlay(tiffImageLayer, title, external_layer);

                    $("#container-external-layer").removeClass('display-container-external-layer');
                    $("#container-external-layer").addClass('hide');

                    tiffImageLayer.on('load', function () {
                        hidePreLoader();
                    });

                } else {

                }
            }

            $("#list-of-default-maps").html(html);
        }
    });
}// loadDefaultUploadedMaps

function centerMap(e) {
    map.panTo(e.latlng);
}


/* Basemap Layers */

// let osm = new L.TileLayer(
//     'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
//     {attribution: 'Timor-Leste Portal Municipal &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}
// );

var mapBoxOSM = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 20,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ',
    attribution: 'OSM - Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
});

var mapBoxSatellite = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    maxZoom: 20,
    id: 'mapbox/satellite-streets-v11',
    accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ',
    attribution: 'Satellite - Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
});


let imagery = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Imagery - Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 15,
    id: "mapbox.satellite",
    accessToken: 'pk.eyJ1IjoiaG1lbmV6ZXMiLCJhIjoiY2prYzdmcWozMDFmNzNwbzZkMWptZ3ptNSJ9.e-iIExHcob-nAATM_CFAEQ'
});


//let topographic = L.esri.basemapLayer('Topographic');
//let darkGray = L.esri.basemapLayer('DarkGray');

var southWest = L.latLng(-9.976965850016063, 123.60443115234376),
    northEast = L.latLng(-7.944996434709155, 127.99896240234376),
    mapMaxBounds = L.latLngBounds(southWest, northEast);

map = L.map("map-canvas", {
    // maxBounds: mapMaxBounds,
    zoom: 9,
    center: [-8.811796526762704, 125.82092285156251],
    layers: [mapBoxSatellite, markerClusters],
    zoomControl: true,
    attributionControl: true,
    contextmenu: true,
    contextmenuItems: contextMenuOptionItems,
    fullscreenControl: false,
    fullscreenControlOptions: {
        position: 'topleft'
    }
});


var baseLayers = {
    "Sattelite Imagery": mapBoxSatellite,
    "OpenstreetMap": mapBoxOSM
};


// styleControlLayer = L.Control.styledLayerControl(baseMaps);
// var pointOfInterestLayer = L.geoJson(null);
// var municipalityLayer = L.geoJson(null);
// var projectLayer = L.geoJson(null);

var groupedOverlays = {
    "Internal Layer": {
        // "Projects": projectLayer,
        // "Point of interests": pointOfInterestLayer,
    }
};

var asset_location_url = $("#asset_location_url").val();
/*
var pointOfInterestLayerItem = L.geoJson(null, {
    pointToLayer: function (feature, latlng) {
        let icon = new L.icon({
            iconSize: [45, 60], // width and height of the image in pixels
            popupAnchor: [0, 0], // point from which the popup should open relative to the iconAnchor
            iconUrl: asset_location_url + "/assets/img/marker_tl.png" //feature.properties.icon
        });

        return L.marker(latlng, {icon: icon});
    },
    onEachFeature: function (feature, layer) {
        if (feature.properties) {
            let poi = feature.properties;
            let html = '<div class="card">';
            html += '<div class="card-body">';
            html += '<h3>Name:   ' + poi.name + '</h3>';
            html += '<p>Phone: ' + (poi.phone == null ? "<span class='danger'>No phone</span>" : poi.phone) + '</p>';
            html += '<p>Address: ' + (poi.address == null ? "<span class='danger'>No address</span>" : poi.address) + '</p>';
            html += '<p>Municipality: ' + poi.municipality + '</p>';
            html += '<p>Administrative Post: ' + (poi.administrative_post == null ? "<span class='danger'>No data</span>" : poi.administrative_post) + '</p>';
            html += '<p>Suco: ' + (poi.suco == null ? "<span class='danger'></span>" : poi.suco) + '</p>';
            html += '<p>Village: ' + (poi.village == null ? "<span class='danger'></span>" : poi.village) + '</p>';
            html += '<p>Website: ' + (poi.website == null ? "<span class='danger'></span>" : poi.website) + '</p>';
            html += '<p>details: ' + (poi.details == null ? "<span class='danger'></span>" : poi.details) + '</p>';
            html += '</div>';
            html += '</div>';

            let info_panel_item = '<li class="collection-item hoverable">';
            info_panel_item += '<a href="#!" class="secondary-content coordenate-point-item" data-lat="' + poi.latitude + '" ' +
                'data-lng="' + poi.longitude + '"><i class="material-icons">location_on</i></a>';
            info_panel_item += '<h5 class="title">' + poi.name + '</h5>';
            info_panel_item += '<p>Municipality: ' + poi.municipality + '</p>';
            info_panel_item += '<p>Administrative Post: ' + (poi.administrative_post == null ? "" : poi.administrative_post) + '</p>';
            info_panel_item += '<p>Suco: ' + (poi.suco == null ? "" : poi.suco) + '</p>';
            info_panel_item += '<p>Village: ' + (poi.aldeia == null ? "" : poi.aldeia) + '</p>';
            info_panel_item += '<p>Address: ' + (poi.address == null ? "<span class='danger'>No address</span>" : poi.address) + '</p>';
            info_panel_item += '<p>Phone: ' + (poi.phone == null ? "<span class='danger'>No phone</span>" : poi.phone) + '</p>';
            info_panel_item += '<p>Website: ' + (poi.website == null ? "<span class='danger'>No website</span>" : poi.website) + '</p>';

            info_panel_item += '</li>';

            poi_list += info_panel_item;

            layer.on({
                click: function (e) {
                    // html += '<p>details: ' + (poi.details == null ? "<span class='danger'></span>" : poi.details) + '</p>';
                    $("#feature-info").html(html);

                    // $("#featureModal").modal('open');
                    $(".slide-show-details").html(html);
                    $(".slide-show-details").sidenav('open');
                }
            });

            layer.bindTooltip('<h5>' + poi.name + '</h5>', {
                closeButton: false,
                offset: L.point(0, -20),
                direction: 'right',
                permanent: false,
                sticky: true,
                // offset: [10, 0],
                opacity: 0.75,
                className: 'leaflet-tooltip'
            });

            placeSearchArray.push({
                name: layer.feature.properties.name,
                address: layer.feature.properties.address,
                source: "point_of_interest",
                id: L.stamp(layer),
                lat: layer.feature.geometry.coordinates[1],
                lng: layer.feature.geometry.coordinates[0]
            });
        }
    }
});


function viewAreaProjects(feature) {
    let area_id = feature.properties.ID_;
    if (feature.properties.LEVEL == 2) {
        getProjects(area_id);
    } else if (feature.properties.LEVEL == 3) {
        // showAreaInformation(area_id);
    }
}

function viewPointOfInterests(feature) {
    let area_id = feature.properties.ID_;
    getPointOfInterests(area_id);
}


var projectLayerItem = L.geoJson(null, {
    style: function (feature) {
        return {color: "#ffb30f"};
    },
    pointToLayer: function (feature, latlng) {

        let projectIcon = feature.properties.icon;

        let icon = new L.icon({
            iconSize: [25, 25], // width and height of the image in pixels
            shadowSize: [35, 20], // width, height of optional shadow image
            iconAnchor: [12, 12], // point of the icon which will correspond to marker's location
            shadowAnchor: [12, 6],  // anchor point of the shadow. should be offset
            popupAnchor: [0, 0], // point from which the popup should open relative to the iconAnchor
            // iconUrl: "/images/marker_tl.png" //feature.properties.icon
            iconUrl: projectIcon
        });

        if (projectIcon != null) {

            return L.marker(latlng, {icon: icon});
        }
        return L.marker(latlng);
    },
    onEachFeature: function (feature, layer) {
        if (feature.properties) {
            var popupText = 'geometry type: ' + feature.geometry.type;
            if (feature.properties.color) {
                popupText += '<br/>color: ' + feature.properties.color;
            }
            let project = feature.properties;

            let html = '<div class="card">';
            if (project.photo != null) {
                html += '<img width="250px" League="' + project.photo + '" class="card-img-top" alt="' + project.name + '">';
            }

            html += '<div class="card-body">';
            html += '<h5 class="card-title">' + project.name + '</h5>';
            html += '<p>Project code:   ' + project.code + '</p>';
            html += '<p>Project Title:   ' + project.name + '</p>';
            html += '<p>Project Owner:   ' + project.owner + '</p>';
            html += '<p>Project Date:    ' + project.start_date + ' - ' + project.end_date + '</p>';
            html += '<p>Project Contact Information: ' + project.contact_information + '</p>';
            html += '<p>Status: ' + (status == 0 ? "<span>IN-ACTIVE</span>" : "ACTIVE") + '</p>';
            html += '<p>Budget:  $' + project.budget + '</p>';
            html += '</div>';

            html += '</div>';

            let project_list_item_status_class = "";
            if (project.status == 0) {
                project_list_item_status_class = 'project-in-active';
            } else {
                project_list_item_status_class = 'project-active';
            }

            let info_panel_item = '<li class="collection-item hoverable ' + project_list_item_status_class + '">';
            info_panel_item += '<a href="#!" class="secondary-content  coordenate-point-item " data-lat="' + project.latitude + '" ' +
                'data-lng="' + project.longitude + '"><i class="material-icons">location_on</i></a>';
            if (project.photo != null) {
                info_panel_item += '<img League="' + project.photo + '" class="responsive-img" alt="' + project.name + '">';
                info_panel_item += '<span class="title">' + project.name + '</span>';
                info_panel_item += '<p class="project-date">Project Date:    ' + project.start_date + ' - ' + project.end_date + '</p>';
                info_panel_item += '<br>' + project.budget + '</p>';


            } else {
                info_panel_item += '<span class="title">' + project.name + '</span>';
                info_panel_item += '<p class="project-date">Project Date:    ' + project.start_date + ' - ' + project.end_date + '</p>';
                info_panel_item += '<br>' + project.budget + '</p>';

            }

            info_panel_item += '</li>';

            project_list += info_panel_item;

            layer.bindTooltip(html, {
                closeButton: false,
                offset: L.point(0, -20),
                direction: 'right',
                permanent: false,
                sticky: true,
                // offset: [10, 0],
                opacity: 0.75,
                className: 'leaflet-tooltip'
            });


            layer.on({
                click: function (e) {
                    let html = '<div class="card">';
                    if (project.photo != null) {
                        html += '<div style="text-align: center"> <img width="50%" League="' + project.photo + '" class="card-img-top" alt="' + project.name + '"></div>';
                    }

                    html += '<div class="card-body">';
                    html += '<h5 class="card-title">' + project.name + '</h5>';
                    html += '<p>Project code:   ' + project.code + '</p>';
                    html += '<p>Project Title:   ' + project.name + '</p>';
                    html += '<p>Project Owner:   ' + project.owner + '</p>';
                    html += '<p>Project Date:    ' + project.start_date + ' - ' + project.end_date + '</p>';
                    html += '<p>Project Contact Information: ' + project.contact_information + '</p>';
                    html += '<p>Project Description</p>';
                    html += '<p>' + project.description + '</p>';
                    html += '<p>Status: ' + (status == 0 ? "<span>IN-ACTIVE</span>" : "ACTIVE") + '</p>';
                    html += '<p>Budget:  $' + project.budget + '</p>';
                    html += '</div>';

                    html += '</div>';

                    //
                    // $("#feature-title").html(project.area_name);
                    // $("#feature-info").html(html);
                    // $("#featureModal").modal();
                    // $("#featureModal").modal('open');

                    $(".slide-show-details").html(html);
                    $(".slide-show-details").sidenav('open');
                },
                remove: function (e) {
                    $("#feature-title").html("");
                    $("#feature-info").html("");
                    $("#featureModal").modal("close");
                }
            });
        }

    }
});
*/

//Get all point of intereset of every municipalities (using datamanager, we will move all these to each municipality portal)
// getAllPointOfInterests("");

//Get all project of every municipalities (using datamanager, we will move all these to each municipality portal)
// getAllProjects("");

getMap(2, "Municipality", true);
//getMap(4, "Suco");
//getMap(3, "Administrative Post");

//
// console.log('LAYERS');
// map.eachLayer(function (layer) {
//     console.log(layer);
// });
//
// console.log('LAYERS');

function getMap(level, title, display = false) {
    //renderMunicipalityData();
    switch (level) {
        case 1:
        case 2:
        case 3:
        case 4:
            getAreaMap(level, title, display);
            break;
        case 5:
            getAllProjects(title);
            $("#searchbox").css('display', "block");
            break;
        case 6:
            // getAllPointOfInterests(title);
            // $("#searchbox").css('display', "block");
            break;
        default:
            M.toast({html: title + " Not found!", className: 'rounded red accent-3'});
            break;
    }


}

function getAreaMap(level, title, display) {
    $.getJSON(api_url + 'maps/' + level + '/geojson', function (data) {
        loadMapGeoJson(data, title, internal_layer, level, true, display);
    });
}

function getSoilPH(title) {
    $.getJSON('/map/asset/geojson/soil_ph.geojson', function (data) {
        // console.log(data);
        let soilPHLayerItem = L.geoJson(data, {
            style: function (feature) {
                return {
                    fillColor: getSoilPHColor(feature.properties.ph),
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7
                };
            },

            onEachFeature: function (feature, layer) {
                var properties = layer.feature.properties;

                var column = Object.keys(properties);

                // console.log(column);

                var html = "Soil pH<hr/><ul>";

                for (var i = 0; i < column.length; i++) {

                    $.each(properties, function (key, value) {
                        html += "<li>" + key + " - " + value + "</li>";
                    });
                    break;
                }

                html += "</ul>";


                layer.on({
                    click: function (e) {

                        // $("#feature-title").html('Soil pH');
                        //
                        // $("#feature-info").html(html);
                        layer.bindPopup(html).openPopup();
                    },
                    // mouseover: function (e) {
                    //     layer.bindPopup(html).openPopup();
                    // },
                    // mouseout: function (e) {
                    //     layer.bindPopup(html).closePopup();
                    // },
                    remove: function (e) {
                        $("#feature-title").html("");
                        $("#feature-info").html("");
                        $("#featureModal").modal("close");
                    }
                });
            }
        });


        soilPHLayerItem.addTo(map);
        map.flyToBounds(soilPHLayerItem.getBounds());

        layerControl.addOverlay(soilPHLayerItem, title, external_layer);

        if (soil_ph_legendControl == null) {
            soil_ph_legendControl = addTotallegendControl(soil_ph_dimensions, getSoilPHColor, false);
            soil_ph_legendControl.addTo(map);
            $(".soil_legend_title").html(title);
        }

        hidePreLoader();
        $("#container-external-layer").removeClass('display-container-external-layer');
        $("#container-external-layer").addClass('hide');
    });
}
/*
function getAllPointOfInterests(title) {
    $.getJSON(point_of_interest_link, function (data) {
        totalPOI = data.total;
        if (data.total > 0 && data.coordenates.features !== undefined) {
            pointOfInterestLayerItem.addData(data.coordenates);
        }

    });
}


function getAllProjects(title) {
    // Load project into layer
    $.getJSON(project_link, function (data) {
        totalProject = data.total_project;
        if (totalProject > 0) {
            projectLayerItem.addData(data.projects);
        } else {
            M.toast(
                {
                    html: 'No Projects!',
                    className: 'rounded red accent-3'
                }
            );
        }


    });
}
*/

var layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {collapsed: true}).addTo(map);


/** Add control */

// addDrawControl();

addMeasureControl();

addRulerControl();

L.control.scale({position: "bottomleft"}).addTo(this.map);


map.addControl(this.createInputButton(
    'topleft', 'btn btn-default btn-load-external-layer',
    '<i class="material-icons">cloud_upload</i>',
    'Load external Layer'));

/*
map.addControl(this.createInputButton(
    'topleft',
    'btn btn-default btn-view-dashboard',
    '<i class="material-icons">dashboard</i>',
    'View Dashboard'));
*/
let asset_url = $("#asset_url").val();

map.addControl(this.createInputButton(
    'bottomright',
    'sponsor-img',
    '<img src = "' + asset_url + '/assets/img/LOGO_TIC_OFFICIAL.jpg" class="responsive-img">',
    'TIC Timor | Agência de Tecnologias de Informação e Comunicação IP',
    'https://europa.eu/'));
map.addControl(this.createInputButton(
    'bottomright',
    'sponsor-img',
    '<img src = "' + asset_url + '/assets/img/european-union-logo.png" class="responsive-img">',
    'European Union | Empowered lives. Resilient Nations',
    'https://europa.eu/'));

map.addControl(this.createInputButton(
    'bottomright',
    'sponsor-img',
    '<img src = "' + asset_url + '/assets/img/undp-logo.svg" class="responsive-img">',
    'United Nation Development Program',
    'http://undp.org/'));
map.addControl(this.createInputButton(
    'bottomright',
    'sponsor-img',
    '<img src = "' + asset_url + '/assets/img/logo-map.svg" class="responsive-img">',
    'Ministério da Administração Estatal',
    '/'));
map.addControl(this.createInputButton(
    'bottomright',
    'sponsor-img',
    '<img src = "' + asset_url + '/assets/img/RDLT.png" class="responsive-img"> ',
    'República Democrática de Timor-Leste',
    'http://timor-leste.gov.tl/?lang=en'));

var customActionToPrint = function (context, mode) {
    return function () {
        window.alert("We are printing the MAP. Let's do Custom print here!");
        context._printCustom(mode);
    }
}

let browserPrint = L.control.browserPrint({
    title: 'Just print me!',
    documentTitle: 'Map printed using leaflet.browser.print plugin',
    closePopupsOnPrint: true,
    printModes: [
        L.control.browserPrint.mode.custom("SELECT AREA", "A4")
    ],
    manualMode: false
});
//browserPrint.addTo(map)

L.easyPrint({
    hidden: false,
    exportOnly: true,
}).addTo(map);


function addMeasureControl() {

    let measureControl = L.control.measure({
        position: 'topleft',
        primaryLengthUnit: "kilometers",
        secondaryLengthUnit: "meters",
        primaryAreaUnit: "hectares",
        secondaryAreaUnit: "sqmeters"
    })
    //measureControl.addTo(map);
}

function addRulerControl() {
    let rulerOptions = {
        position: 'topleft',         // Leaflet control position option
        circleMarker: {               // Leaflet circle marker options for points used in this plugin
            color: 'red',
            radius: 2
        },
        lineStyle: {                  // Leaflet polyline options for lines used in this plugin
            color: 'red',
            dashArray: '1,6'
        },
        lengthUnit: {                 // You can use custom length units. Default unit is kilometers.
            display: 'km',              // This is the display value will be shown on the screen. Example: 'meters'
            decimal: 2,                 // Distance result will be fixed to this value.
            factor: null,               // This value will be used to convert from kilometers. Example: 1000 (from kilometers to meters)
            label: 'Distance:'
        },
        angleUnit: {
            display: '&deg;',           // This is the display value will be shown on the screen. Example: 'Gradian'
            decimal: 2,                 // Bearing result will be fixed to this value.
            factor: null,                // This option is required to customize angle unit. Specify solid angle value for angle unit. Example: 400 (for gradian).
            label: 'Bearing:'
        }
    };
    // L.control.ruler(rulerOptions).addTo(map);
}


function addTotallegendControl(dimensions, callback, is_population_lg = true) {

    let controlname = is_population_lg ? population_legendControl : soil_ph_legendControl;
    controlname = L.control({position: 'bottomleft'});

    controlname.onAdd = function (map) {

        let div = L.DomUtil.create('div', 'population-density'), labels = [], ul = "<ul>";
        if (is_population_lg) {
            div.innerHTML += '<h6 class="total_population_legend">' + str_total_population + '</h6>';
            // loop through our density intervals and generate a label with a colored square for each interval
            // for (var i = 0; i < dimensions.length; i++) {
            //     ul +=
            //         '<li><i style="background:' + callback(dimensions[i] + 1) + '"></i> ' +
            //         dimensions[i] + (dimensions[i + 1] ? '-' + dimensions[i + 1] + '<br>' : '+')
            //         + '</li>';
            // }
        } else {
            div.innerHTML += '<h6 class="soil_legend_title"></h6>';

        }

// loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < dimensions.length; i++) {
            ul +=
                '<li><i style="background:' + callback(dimensions[i] + 1) + '"></i> ' +
                dimensions[i] + (dimensions[i + 1] ? '-' + dimensions[i + 1] + '<br>' : '+')
                + '</li>';
        }
        div.innerHTML += ul;

        return div;
    };

    return controlname;
}


/** End add control */


function renderMunicipalityData(){
    $.getJSON(api_url + 'maps/2/geojson', function (response) {
        //http://datasearch.test/tldp/en/api/dashboardapi/get-flip-rank-data/3/none/mrd/TLS003/1

        let listData = [];

        $.ajax({
            // ius, ref ius, time period, area code, sub-sector
            url:'http://datasearch.test/tldp/en/api/dashboardapi/get-flip-rank-data/3/none/mrd/TLS003/1',
            type:'get',
            success:function(res){
                renderMunicipalityDataGeoJson(response,res.data);
                $.each(res.data,function(i,v){
                    console.log(v);
                    // listData[v]
                })
            }
        });

    });

}//renderMunicipalityData


function renderMunicipalityDataGeoJson(response,listData){
    console.log(listData);
    let geoJson = L.geoJson(response,{
        onEachFeature:function(feature,layer){
            let properties = feature.properties;
            console.log(properties);
            layer.bindTooltip('Hello world', {
                closeButton: false,
                // offset: L.point(0, -20),
                direction: 'right',
                permanent: false,
                sticky: true,
                offset: [10, 0],
                opacity: 1,
                className: 'leaflet-tooltip'
            });
        }
    });
    geoJson.addTo(map);
}//renderMunicipalityDataExtra

let areaGeojson;
let totalAreaOfTimorLeste = 0;
let total_population = 0;


function loadMapGeoJson(data, filename, groupName, level = 0, fitZoom = true, display = false) {
    var itemName = filename.split('.')[0];

    // console.log(data);
    totalAreaOfTimorLeste = 0;
    areaGeojson = L.geoJson(data, {
        style: function (feature) {
            // console.log(level)
            if (level == 2 || level == 3) {

                if (feature.properties.POPULATION !== undefined) {
                    return {
                        fillColor: getPopulationDensityColor(feature.properties.POPULATION.total_population),
                        weight: 2,
                        opacity: 1,
                        color: 'white',
                        dashArray: '3',
                        fillOpacity: 0.7
                    };
                }
            }

            return {color: "#ffb30f"};
        },
        onEachFeature: function (feature, layer) {

            let array_of_area = feature.geometry.coordinates;
            let total_area = 0;
            let geometry_type = feature.geometry.type;

            if (geometry_type == "Polygon") {
                let polygon = turf.polygon(feature.geometry.coordinates);
                total_area = (turf.area(polygon) / 1000000).toFixed(2);
            } else if (geometry_type == "MultiPolygon") {
                for (let i = 0; i < array_of_area.length; i++) {
                    let coordinates = array_of_area[i];
                    let polygon = turf.polygon(coordinates);
                    total_area = (turf.area(polygon) / 1000000).toFixed(2);
                }
            }

            totalAreaOfTimorLeste += parseFloat(total_area);
            /*
            layer.on('mouseover', function (e) {
                layer.setStyle({
                    weight: 3,
                    // fillOpacity: 0.1
                });

                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                }
                //info.update(layer.feature.properties);
            });
            layer.on('mouseout', function (e) {
                areaGeojson.resetStyle(e.target);
                //info.update();
            });
            */

            let info_panel_item ='';

            if (feature.properties) {
                var popupText = 'geometry type: ' + feature.geometry.type;

                if (feature.properties.color) {
                    popupText += '<br/>color: ' + feature.properties.color;
                }
                let html = '';
                let centerLayer = layer.getBounds().getCenter();

                let total_area_text = " (" + total_area + " km<sup>2</sup>)";
                if (level == 2) {
                    let population = feature.properties.POPULATION;
                    html = "<div>" +
                        feature.properties.NAME1_ +
                        "<br/>Area: " + total_area_text +
                        "<br/>Population: " + numberWithPoint(population.total_population) + " (" + population.source + " " + population.time_period + ")";
                         //+ "<br/>Project: " + feature.properties.PROJECTS + "</div>";

                    total_population += parseFloat(population.total_population);
                    info_panel_item = '<li class="collection-item hoverable">';
                    info_panel_item += '<a href="#!" class="secondary-content  coordenate-point-item-area-municipality " data-lat="' + centerLayer.lat + '" ' +
                        'data-lng="' + centerLayer.lng + '"><i class="material-icons">location_on</i></a>';
                    info_panel_item += '<span class="title">' + feature.properties.NAME1_ + total_area_text + '</span>';
                    //info_panel_item += "<p>(" + (feature.properties.PROJECTS > 1 ? feature.properties.PROJECTS + " Projects" : feature.properties.PROJECTS + " Project") + ")</p>";

                    info_panel_item += '</li>';

                    area_municipality_list += info_panel_item;

                } else {

                    if (level == 3) {
                        let population = feature.properties.POPULATION;

                        html = "<div>" +
                            feature.properties.NAME1_ +
                            "<br/>Area: " + total_area_text +
                            "<br/>Population: " + population.total_population + " (" + population.source + " " + population.time_period + ")"

                    } else {
                        html = "<div>" +
                            feature.properties.NAME1_ +
                            "<br/>Area: " + total_area_text + "</div>";
                    }


                    info_panel_item = '<li class="collection-item hoverable ">';
                    info_panel_item += '<a href="#!" class="secondary-content  coordenate-point-item-area" data-lat="' + centerLayer.lat + '" ' +
                        'data-lng="' + centerLayer.lng + '"><i class="material-icons">location_on</i></a>';
                    info_panel_item += '<span class="title">' + feature.properties.NAME1_ + total_area_text + '</span>';

                    info_panel_item += '</li>';


                    if (level == 3) {
                        area_post_administrative_list += info_panel_item;
                    } else {
                        area_suco_list += info_panel_item;
                    }

                }

                layer.bindTooltip(html, {
                    closeButton: false,
                    // offset: L.point(0, -20),
                    direction: 'right',
                    permanent: false,
                    sticky: true,
                    offset: [10, 0],
                    opacity: 1,
                    className: 'leaflet-tooltip'
                });


                layer.on({
                    click: function (e) {
                        let area_id = feature.properties.ID_;

                        // map.fitBounds(e.target.getBounds());

                        if (level == 2) {
                            getProjects(area_id);
                        } else if (level == 3) {
                            showPostoInformation(area_id);
                        } else if (level == 4) {
                            showSucoInformation(area_id);
                        }
                    },
                    remove: function (e) {
                        $("#feature-title").html("");
                        $("#feature-info").html("");
                        $("#featureModal").modal("close");
                    }
                });
            }

        }
    });


    if (display) {
        areaGeojson.addTo(map);
        M.toast({
            html: "Total area: " + totalAreaOfTimorLeste.toFixed(2) + ' km<sup>2</sup>',
            className: 'rounded green accent-3'
        })
        if (level == 2) {
            $(".info-panel").show();
            $(".info-list").html(area_municipality_list);
        } else if (level == 3) {
            $(".info-panel").show();
            $(".info-list").html(area_post_administrative_list);
        } else {
            $(".info-panel").show();
            $(".info-list").html(area_suco_list);
        }
    }

    areaGeojson.StyledLayerControl = {
        removable: true,
        visible: false
    }

    if (fitZoom) {
        map.flyToBounds(areaGeojson.getBounds());
    }
    var strGroup = "";
    if (groupName != null && groupName !== undefined) {
        strGroup = groupName;
    } else {
        strGroup = itemName;
    }

    layerControl.addOverlay(areaGeojson, itemName, strGroup);


    $(".info-list").hide();

    if (population_legendControl == null) {
        //total_population_legend
        population_legendControl = addTotallegendControl(population_dimensions, getPopulationDensityColor);
        population_legendControl.addTo(map);
        $(".total_population_legend").html(str_total_population + " <br/>(" + numberWithPoint(total_population) + ")");
        $("#total_population").val(total_population);
    }


    hidePreLoader();
    $("#container-external-layer").removeClass('display-container-external-layer');
    $("#container-external-layer").addClass('hide');

}// loadMapGeoJson

//loadUploadedGeoJsonFile(data, layerName, external_layer);
function loadUploadedGeoJsonFile(data, layerName, groupName, level = 0, fitZoom = true, addToMap = true) {

    //var itemName = data.name == undefined ? filename.split('.')[0] : data.name;
    var geojsonPointMarkerClusters = L.markerClusterGroup({
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: false,
        zoomToBoundsOnClick: true,
        disableClusteringAtZoom: 16
    });

    totalAreaOfTimorLeste = 0;
    geometry_type = "";
    let geoJsonFileResult = L.geoJson(data, {
        style: function (feature) {
            // console.log("feature.properties.color: " + feature.properties.color);
            if (feature.properties.color != null) {
                return {
                    color: "#960707",
                    fillOpacity: 1,
                    stroke: "#000",
                    weight: 2,
                    dashArray: '3',
                    fillColor: feature.properties.color
                };
            } else if (feature.properties.ph != null) {
                return {
                    fillColor: getSoilPHColor(feature.properties.ph),
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.35
                };
            } else {
                // return {color: "#960707"};
                return {color: getRandomColor()};
            }
        },

        pointToLayer: function (feature, latlng) {
            if (feature.geometry.type == "Point") {
                let icon = new L.icon({
                    iconSize: [45, 60], // width and height of the image in pixels
                    popupAnchor: [0, 0], // point from which the popup should open relative to the iconAnchor
                    iconUrl: asset_location_url + "/assets/img/marker_tl.png" //feature.properties.icon
                });

                return L.marker(latlng, {icon: icon});
            }

        },
        onEachFeature: function (feature, layer) {

            let array_of_area = feature.geometry.coordinates;
            let total_area = 0;
            geometry_type = feature.geometry.type;


            if (geometry_type == "Polygon") {
                let polygon = turf.polygon(feature.geometry.coordinates);
                total_area = (turf.area(polygon) / 1000000).toFixed(2);

                // console.log(total_area);
                // console.log('Total area of ' + feature.properties.NAME1_ + ' : ' + total_area + ' area in square meters');

                // console.log('Total area of ' + feature.properties.NAME1_ + ' : ' + total_area + ' area in square kilometers');

            } else if (geometry_type == "MultiPolygon") {
                // console.log("Begin MultiPolygon");
                for (let i = 0; i < array_of_area.length; i++) {
                    let coordinates = array_of_area[i];
                    let polygon = turf.polygon(coordinates);
                    //
                    total_area = (turf.area(polygon) / 1000000).toFixed(2);
                }
                // console.log("End MultiPolygon");
                // console.log('Total area of ' + feature.properties.NAME1_ + ' : ' + total_area + ' area in square meters');

                // console.log('Total area of ' + feature.properties.NAME1_ + ' : ' + total_area + ' area in square kilometers');
            }

            totalAreaOfTimorLeste += parseFloat(total_area);

            var popupText = 'geometry type: ' + feature.geometry.type;

            if (feature.properties.color) {
                popupText += '<br/>color: ' + feature.properties.color;
            }
            //
            if (feature.properties.ID_Area !== undefined) {
                layer.bindTooltip('<p>' + feature.properties.ID_Area + '</p>', {
                    closeButton: false,
                    // offset: L.point(0, -20),
                    // direction: 'right',
                    permanent: false,
                    sticky: true,
                    // offset: [10, 0],
                    opacity: 0.75,
                    // className: 'leaflet-tooltip'
                });
            }

            var properties = layer.feature.properties;

            var column = Object.keys(properties);

            // console.log(column);

            var html = layerName.toUpperCase() + "<hr/>" +
                "<ul>";

            if ((geometry_type == "Polygon") || (geometry_type == "MultiPolygon")) {
                html += "<li>Area: " + total_area + " km<sup>2</sup></li>";
            }


            for (var i = 0; i < column.length; i++) {

                $.each(properties, function (key, value) {
                    html += "<li>" + key + " - " + value + "</li>";
                });
                break;
            }

            html += "</ul>";


            layer.on({
                click: function (e) {

                    $("#feature-title").html(layerName.toUpperCase());

                    $("#feature-info").html(html);
                    $("#featureModal").modal();
                    $("#featureModal").modal('open');
                },
                mouseover: function (e) {
                    layer.bindPopup(html).openPopup();
                    layer.setStyle({
                        weight: 4,
                        fillOpacity: 0.7
                    });

                    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                        layer.bringToFront();
                    }
                },
                mouseout: function (e) {
                    layer.bindPopup(html).closePopup();
                    geoJsonFileResult.resetStyle(e.target);
                },
                remove: function (e) {
                    $("#feature-title").html("");
                    $("#feature-info").html("");
                    $("#featureModal").modal("close");
                }
            });

        }
    });

    // geoJsonFileResult.addTo(map);

    // Add to map
    //if (geometry_type == "Point") {
    geojsonPointMarkerClusters.addLayer(geoJsonFileResult);
    //}

    if (addToMap) {
        //    geoJsonFileResult.addTo(map);
    }

    geoJsonFileResult.StyledLayerControl = {
        removable: true,
        visible: false
    }


    if (fitZoom) {
        map.flyToBounds(geoJsonFileResult.getBounds());
    }
    var strGroup = "";
    if (groupName != null && groupName !== undefined) {
        strGroup = groupName;
    } else {
        strGroup = layerName;
    }

    if (geometry_type == "Point") {
        layerControl.addOverlay(geojsonPointMarkerClusters, layerName, strGroup);
    } else {
        layerControl.addOverlay(geoJsonFileResult, layerName, strGroup);
    }


    if (geometry_type == "Polygon" && geometry_type == "MultiPolygon") {
        M.toast({
            html: "Total area: " + totalAreaOfTimorLeste.toFixed(2) + ' km<sup>2</sup>',
            className: 'rounded green accent-3'
        })
    }

    hidePreLoader();


    $("#container-external-layer").removeClass('display-container-external-layer');
    $("#container-external-layer").addClass('hide');


}// loadUploadedGeoJsonFile

$("body").on("click", '.coordenate-point-item', function () {
    let lat = $(this).data('lat');
    let lng = $(this).data('lng');

    map.flyTo([lat, lng], 17);
});

$("body").on("click", '.coordenate-point-item-area', function () {
    let lat = $(this).data('lat');
    let lng = $(this).data('lng');

    map.flyTo([lat, lng], 15);
});

$("body").on("click", '.coordenate-point-item-area-municipality', function () {
    let lat = $(this).data('lat');
    let lng = $(this).data('lng');

    map.flyTo([lat, lng], 12);
});


$("body").on("click", '.coordenate-point-item-poi', function () {
    let lat = $(this).data('lat');
    let lng = $(this).data('lng');

    let tempMarker = L.marker([lat, lng]);

    tempMarker.addTo(map);

    tempMarker.on("click", function () {
        map.removeLayer(tempMarker);
    })

    map.flyTo([lat, lng], 13);

    $(".modal").model('close');

});

function load_project_by_area(area_id) {
    $.ajax({
        url: api_url + lang + '/project-by-location/' + area_id,
        type: "get",
        success: function (res) {

            $("#feature-info").html(html);
            $("#featureModal").modal();
            $("#featureModal").modal('open');

            // $("#feature-title").html(feature.properties.name);
            // $("#feature-info").html(html);
            // $("#featureModal").modal();
            // $("#featureModal").modal('open');

        }
    })
}//load_project_by_area

function getProjects(area_id, showModal = true) {
    $.ajax({
        url: api_url + lang + "/municipality-projects-" + area_id,
        type: "get",
        success: function (res) {

            // let mMarker;
            let counter = 0;
            let municipalityName = $("h5.municipality-name").text();

            // console.log(res);
            let table = '<table class="table"><thead><tr><th>Project Name</th><th>Project Location</th><th>Project Budget</th><th>Date</th><th>Status</th></thead><tbody>';

            if (res.length > 0) {

                for (let i = 0; i < res.length; i++) {

                    let item = res[i];
                    if (item != null) {
                        counter++;
                        table += '<tr>';

                        if (item.latitude !== null && item.longitude !== null) {
                            table += '<td><a href="#!" data-latitude="' + item.latitude + '" data-longitude="' + item.longitude + '" class="btn-view-project" data-id="' + item.id + '">' + item.title + '</a></td>';
                        } else {
                            table += '<td> ' + item.project.title + '</td>';
                        }

                        if (item.latitude !== null && item.longitude !== null) {
                            table += '<td>' + item.location.area_name + ' (' + item.latitude + '-' + item.longitude + ')' + '</td>';
                        } else {
                            table += '<td>' + item.location.area_name + ' (No coordinates)' + '</td>';
                        }


                        table += '<td>' + item.budget + '</td>';
                        table += '<td>' + item.start_date + ' - ' + item.end_date + '</td>';
                        if (item.status == 1) {
                            table += '<td><span class="text-info">ACTIVE</span></td>';
                            // if (item.project.latitude !== null && item.project.longitude !== null) {
                            //     mMarker = L.marker([item.project.latitude, item.project.longitude], {icon: markerGreenIcon});//.bindPopup(legend)
                            // }

                        } else {
                            table += '<td><span class="text-warning">IN-ACTIVE</span></td>';
                            // if (item.project.latitude !== null && item.project.longitude !== null) {
                            //     mMarker = L.marker([item.project.latitude, item.project.longitude], {icon: markerRedIcon});//.bindPopup(legend)
                            // }

                        }
                        table += '</tr>';

                        // if (mMarker !== undefined) {
                        //     // console.log(mMarker);
                        //     // console.log(item.project);
                        //     // mMarker.projectId = item.project.id;
                        //     // mMarker.on("click", showModalInfo);
                        //     markerClusters.addLayer(mMarker);
                        // }
                        //
                        //

                    }
                }

                // map.addLayer(markerClusters);
                //
                // console.log(markerClusters.getBounds().N);
                // if (markerClusters.getBounds().N !== undefined) {
                //     map.flyToBounds(markerClusters.getBounds());
                // }

            }

            table += '</tbody></table>';

            if (counter > 1) {
                $("h5.municipality-name").html(municipalityName + ": " + counter + " projects");
            } else {
                $("h5.municipality-name").html(municipalityName + ": " + counter + " project");
            }

            if (showModal) {
                // $("#feature-info").html(table);
                // $("#featureModal").modal();
                // $("#featureModal").modal('open');

                $(".slide-show-details").html(table);
                $(".slide-show-details").sidenav('open');
            }

        }
    })
} //getProjects


function getPointOfInterests(area_id) {
    $.ajax({
        url: api_url + lang + "/municipality/" + area_id + "/point-of-interest",
        type: "get",
        success: function (res) {
            if (res.point_of_interests != null) {
                let point_of_interests = res.point_of_interests;

                if (point_of_interests.length > 0) {
                    let html = '<div class="input-field"><i class="material-icons prefix">search</i>';
                    html += '<input id="input-search-poi" type="text" data-length="150">';
                    html += '</div>';

                    html += '<ul class="collection collection-poi">';
                    for (let i = 0; i < point_of_interests.length; i++) {
                        let poi = point_of_interests[i];

                        let poi_list_item = '<li class="collection-item hoverable">';
                        poi_list_item += '<a href="#!" class="secondary-content  coordenate-point-item-poi" data-lat="' + poi.latitude + '" ' +
                            'data-lng="' + poi.longitude + '"><i class="material-icons">location_on</i></a>';
                        poi_list_item += '<h5 class="title">' + poi.name + '</h5>';

                        poi_list_item += '<p>Municipality: ' + poi.municipality + '</p>';
                        poi_list_item += '<p>Administrative Post: ' + (poi.administrative_post == null ? "<span class='danger'>No data</span>" : poi.administrative_post) + '</p>';
                        poi_list_item += '<p>Suco: ' + (poi.suco == null ? "<span class='danger'></span>" : poi.suco) + '</p>';
                        poi_list_item += '<p>Village: ' + (poi.aldeia == null ? "<span class='danger'></span>" : poi.aldeia) + '</p>';
                        poi_list_item += '<p>Address: ' + (poi.address == null ? "<span class='danger'>No address</span>" : poi.address) + '</p>';
                        poi_list_item += '<p>Phone: ' + (poi.phone == null ? "<span class='danger'>No phone</span>" : poi.phone) + '</p>';
                        poi_list_item += '<p>Website: ' + (poi.website == null ? "<span class='danger'></span>" : poi.website) + '</p>';


                        poi_list_item += '</li>';

                        html += poi_list_item;
                    }
                    html += '</ul>';
                    // console.log(html);
                    // $("#feature-info").html(html);
                    // $("#featureModal").modal();
                    // $("#featureModal").modal('open');
                    $(".slide-show-details").html(html);
                    $(".slide-show-details").sidenav('open');
                } else {
                    M.toast({html: "No Point of interests", classes: 'rounded green accent-3 project-toast'});
                }
            } else {
                M.toast({html: "No Point of interests", classes: 'rounded green accent-3 project-toast'});

            }


        }
    })
} //getProjects


function showPostoInformation(area_id) {
    $.ajax({
        url: api_url + lang + "/post-admin/" + area_id + "/sucos",
        type: "get",
        success: function (res) {
            // console.log(res);
            clearAreaProfileModal();
            $("#area-details-container .area-name").html(res.area_name);
            var html = '';

            if (res.sucos.length > 0) {
                $.each(res.sucos, function (index, value) {
                    html += "<li>" + value.area_name + "</li>";
                });
            }

            $(".card-area-profile-info").removeClass('hide');
            $(".card-area-profile-info").addClass('show');

            if (res.profile.length > 0) {

                $(".table-area-info").removeClass('hide');
                $("#area-details-container .post-president").html(res.profile[0].president);
                $("#area-details-container .post-secretary").html(res.profile[0].accountant);
                $("#area-details-container .post-accountant").html(res.profile[0].accountant);
                $("#area-details-container .post-address").html(res.profile[0].address);
                $("#area-details-container .post-phone").html(res.profile[0].phone);
                $("#area-details-container .post-email").html(res.profile[0].email);
                $("#area-details-container .post-profile_information").html(res.profile[0].profile_information);
                if (res.profile[0].banner_img != null || res.profile[0].banner_img != undefined) {
                    $("#area-details-container .post-banner").attr("src", res.profile[0].banner_img);
                }


                $("#area-details-container .area-border").removeClass('hide');
                $("#area-details-container .area-border").addClass('show');

            } else {
                $(".card-area-profile-info").addClass('hide');
                $(".card-area-profile-info").removeClass('show');
            }

            $("#area-details-container .area-table-sucos").html(html);
            $("#area-details-container").removeClass('hide');
            let container = $("#area-details-container");
            $(".slide-show-details").html(container);
            $(".slide-show-details").sidenav('open');
        }
    })
} //showPostoInformation


function showSucoInformation(area_id) {
    $.ajax({
        url: api_url + lang + "/suco/" + area_id + '/profile',
        type: "get",
        success: function (res) {
            // console.log(res);
            clearAreaProfileModal();
            $("#area-details-container .area-name").html(res.suco);
            var html = '';

            if (res.profile != null) {
                $("#area-details-container .post-president-title").html("");
                $("#area-details-container .post-president").html(res.profile.president);
                $("#area-details-container .post-secretary").html(res.profile.accountant);
                $("#area-details-container .post-accountant").html(res.profile.accountant);
                $("#area-details-container .post-address").html(res.profile.address);
                $("#area-details-container .post-phone").html(res.profile.phone);
                $("#area-details-container .post-email").html(res.profile.email);
                $("#area-details-container .post-profile_information").html(res.profile.profile_information);
                if (res.profile.banner_img != null || res.profile.banner_img != undefined) {
                    $("#area-details-container .post-banner").attr("src", res.profile.banner_img);
                }

                let container = $("#area-details-container");
                $(".card-area-profile-info").addClass('show');
                $(".card-area-profile-info").removeClass('hide');
                $("#area-details-container .area-border").addClass('hide');
                $(".slide-show-details").html(container);
                $(".slide-show-details").sidenav('open');

            } else {
                M.toast({html: '<h3>' + res.suco + '</h3>', className: 'rounded green accent-3'})
            }


        }
    })
} //showSucoInformation

function showModalInfo(ev) {
    let projectId = ev.target.projectId;
    let latLng = ev.target._latlng;
    $.ajax({
        url: api_url + lang + "/project/" + projectId,
        type: "get",
        success: function (res) {

            $("#feature-info").html(res);
            $("#featureModal").modal();
            $("#featureModal").modal('open');
        }
    });

} //showModalInfo

$("body").on("click", ".btn-view-project", function () {
    let id = $(this).data("id");
    let latitude = $(this).data('latitude');
    let longitude = $(this).data('longitude');


    if ((latitude !== null || latitude !== undefined) && (longitude !== null || longitude !== undefined)) {

        if (foundPlaceMarker) {
            map.removeLayer(foundPlaceMarker);
        }

        foundPlaceMarker = L.circle([latitude, longitude], {
            iconUrl: '/css/map/images/marker-green.png',
            iconSize: [20, 20]
        });

        foundPlaceMarker.setStyle({className: 'selected-marker'});
        foundPlaceMarker.addTo(map);
        foundPlaceMarker.projectId = id;
        foundPlaceMarker.on("click", showModalInfo);

        map.flyTo([latitude, longitude], 17);
        $("#featureModal").modal('close');
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Coordenates error',
        })
    }

});


map.on("mousemove", function (e) {
    $(".mouse-position").html(e.latlng.lat + "," + e.latlng.lng);
});

map.on("mouseout", function (e) {
    $(".mouse-position").addClass('hide');
});
map.on("mouseover", function (e) {
    $(".mouse-position").removeClass('hide');
});


/* Layer control listeners that allow for a single markerClusters layer */
map.on("overlayadd", function (e) {

    /*if (e.layer === pointOfInterestLayer) {
        markerClusters.addLayer(pointOfInterestLayerItem);
        $(".info-panel").show();
        $(".info-list").hide();
        $(".info-list").html(poi_list);

        if (totalPOI > 0) {
            map.flyToBounds(pointOfInterestLayerItem.getBounds());
        }
    } else if (e.layer === projectLayer) {
        markerClusters.addLayer(projectLayerItem);
        var toastHTML = 'Total Project: ' + totalProject;
        M.toast({html: toastHTML, classes: 'rounded green accent-3 project-toast'});
        $(".info-panel").show();
        $(".info-list").hide();
        $(".info-list").html(project_list);
        if (totalProject > 1) {
            map.flyToBounds(projectLayerItem.getBounds());
        }
    }*/

    if (e.name === "Municipality") {
       $(".info-panel").show();
        $(".info-list").hide();
        $(".info-list").html(area_municipality_list);

        if (population_legendControl !== undefined) {
            this.removeControl(population_legendControl);
        }

        population_legendControl.addTo(this);
        M.toast({
            html: "Total area: " + totalAreaOfTimorLeste.toFixed(2) + ' km<sup>2</sup>',
            className: 'rounded green accent-3'
        });

        $(".total_population_legend").html("Total Population <br>(" + numberWithPoint(total_population) + ")");
    } else if (e.name === "Administrative Post" || e.name == 'Posto administrativos' || e.name == 'Postu administrativu') {
        $(".info-panel").show();
        $(".info-list").hide();
        $(".info-list").html(area_post_administrative_list);
        this.removeControl(population_legendControl);
        population_legendControl.addTo(this);
        M.toast({
            html: "Total area: " + totalAreaOfTimorLeste.toFixed(2) + ' km<sup>2</sup>',
            className: 'rounded green accent-3'
        });

        $(".total_population_legend").html("Total Population <br>(" + numberWithPoint(total_population) + ")");
    } else if (e.name === "Suco" || e.name == 'Suku') {
        $(".info-panel").show();
        $(".info-list").hide();
        $(".info-list").html(area_suco_list);
        M.toast({
            html: "Total area: " + totalAreaOfTimorLeste.toFixed(2) + ' km<sup>2</sup>',
            className: 'rounded green accent-3'
        })
    } else {

        $("#legend-info").css('display', 'block');
    }


});


map.on("overlayremove", function (e) {

    // if (e.layer === pointOfInterestLayer) {
    //     // markerClusters.removeLayer(pointOfInterestLayerItem);
    // } else if (e.layer === projectLayer) {
    //     // markerClusters.removeLayer(projectLayerItem);
    // } else

    if ((e.name === "Municipality") | (e.name === "Administrative Post") | (e.name === "Suco")) {
        this.removeControl(population_legendControl);

    } else {
        $("#legend-info").css('display', 'none');
    }

    $(".info-panel").hide();
    $(".info-list").html('');
});


function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getPopulationDensityColor(d) {
    return d > 100000 ? '#f6d1c1' :
        d > 75000 ? '#fc9b7d' :
            d > 70000 ? '#fb7453' :
                d > 65000 ? '#f24634' :
                    d > 60000 ? '#d11f26' :
                        d > 55000 ? '#ae151b' :
                            d > 50000 ? '#710013' :
                                '#fdb210'//'#012128';
}

//
// function getPopulationDensityColor(d) {
//     return d > 100000 ? '#07f20f' :
//         d > 75000 ? '#88d300' :
//             d > 70000 ? '#acbc00' :
//                 d > 65000 ? '#c1a700' :
//                     d > 60000 ? '#cf9700' :
//                         d > 55000 ? '#dc8200' :
//                             d > 50000 ? '#e86b00' :
//                                 '#f54300';
// }

function getSoilPHColor(d) {
    return d > 8.5 ? '#0617d6' :
        d > 7.5 ? '#5bcf01' :
            d > 6.5 ? '#2adb06' :
                d > 5.5 ? '#E6E407' :
                    '#ff0000'//'#012128';
}

function clearAreaProfileModal() {
    $("#myModalPostAdmin .post-president").html('');
    $("#myModalPostAdmin .post-secretary").html('');
    $("#myModalPostAdmin .post-accountant").html('');
    $("#myModalPostAdmin .post-address").html('');
    $("#myModalPostAdmin .post-phone").html('');
    $("#myModalPostAdmin .post-email").html('');
    $("#myModalPostAdmin .post-profile_information").html('');
    $(".card-area-profile-info").addClass('hide');
    $("#myModalPostAdmin .area-table-sucos").html('');

    $(".card-area-profile-info").addClass('hide');
    $(".card-area-profile-info").removeClass('show');

    $(".table-area-info").removeClass('show');
    $(".table-area-info").addClass('hide');
}

function numberWithPoint(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


function showPreLoader() {
    $(".load-wrapper").css('display', 'block');
}

function hidePreLoader() {
    $(".load-wrapper").css('display', 'none');
}

hidePreLoader();


function createInputButton(position, classname, faviconHtml, title, link = '#!') {
    BtnControl = L.Control.extend({
        options: {
            position: position
            //control position - allowed: 'topleft', 'topright', 'bottomleft', 'bottomright'
        },
        onAdd: function (map) {
            button = L.DomUtil.create('a', 'leaflet-bar leaflet-control ' + classname);
            button.href = link;
            button.title = title;
            button.innerHTML = faviconHtml;
            return button;
        },
    });

    return new BtnControl();
} //createInputButton

/*
function showDashboard(e) {

    $("#frame-dashboard").prop('League', base_url + 'dashboard');
    $("#frame-dashboard").prop('display', 'block');
    $("#modalDashboard").modal('open');

} //showDashboard


$("body").on("click", ".btn-view-dashboard", function () {
    showDashboard();
    $("#modalDashboard").modal('open');
});
*/
$(".btn-load-external-layer").on("click", function () {

    if ($(".display-container-external-layer")[0] === undefined) {
        $("#container-external-layer").addClass('display-container-external-layer');
        $("#container-external-layer").removeClass('hide');
    } else {
        $("#container-external-layer").removeClass('display-container-external-layer');
        $("#container-external-layer").addClass('hide');

    }
});


$(".close-external-layer").on('click', function () {
    $("#container-external-layer").removeClass('display-container-external-layer');
    $("#container-external-layer").addClass('hide');
});
get_gis_institutions();

function get_gis_institutions() {
    $.ajax({
        url: base_url + 'datasearch/gis/institutions',
        //url: 'http://datasearch.test/gis/institutions',
        type: 'get',
        success: function (response) {
            // console.log(response);
            let html = '<option value="" disabled selected>Select institution</option>';
            let total = response.length;
            for (let i = 0; i < total; i++) {
                let item = response[i];
                html += '<option value="' + item.id + '">' + item.name + '</option>';
            }

            $("#select-institution").html(html);
            $("#select-institution").formSelect();
        }
    });
}


$("#select-institution").on("change", function () {

    let selected_option = $("#select-institution option:selected").val();

    let html = '';
    $.ajax({
        url: base_url + 'datasearch/gis/institutions/' + selected_option,
        //url: 'http://datasearch.test/gis/institutions/' + selected_option,
        type: 'get',
        success: function (response) {
            html = get_mapservice_layers(response);
            $(".layer-institution-result").html(html);
        }
    });
});

function get_mapservice_layers(layers) {
    let html = '<ul class="collection">';
    if (layers.length > 0) {
        for (let i = 0; i < layers.length; i++) {
            let layer = layers[i];
            html += '<li class="collection-item">';
            html += layer.title;
            html += '<div class="switch right"><label>';
            html += '<div class="right-align">';
            html += '<input type="checkbox" class="checkbox-load-data"' +
                'data-map-server="1" ' +
                'data-source="' + layer.url + '" ' +
                'data-title="' + layer.title + '">';
            html += '<span class="lever"></span>';
            html += '</div>';
            html += '</label></div>';
            html += '</li>';
        }

    } else {
        html += '<li class="collection-item"><span class="red-text">No map service!</span></li>';
    }

    html += '</ul>';
    return html;
}

$("#btn-load-mapservice").on("click", function () {
    let mapservice_url = $("#mapservice-url").val();
    let mapservice_name = $("#mapservice-name").val();

    showPreLoader();
    getMapServiceLayer(mapservice_url, mapservice_name);

});

$(".btn-load-srtm-tl").on('change', function () {
    showPreLoader();
    let title = $(this).data('title');

    var imageUrl = base_url + '/map/asset/images/srtm.png',
        imageBounds = [[-9.504785583554632, 124.04464721700003], [-8.126870154380823, 127.34226226826918]];
    let tiffImageLayer = L.imageOverlay(imageUrl, imageBounds);

    tiffImageLayer.addTo(map);
    layerControl.addOverlay(tiffImageLayer, title, external_layer);

    $("#container-external-layer").removeClass('display-container-external-layer');
    $("#container-external-layer").addClass('hide');

    tiffImageLayer.on('load', function () {
        hidePreLoader();
    });

});


function loadZipShp(bufferFile, filename) {
    let shpFile = new L.Shapefile(bufferFile, {
        style: function (feature) {
            return {
                color: "#960707",
                fillOpacity: 1,
                stroke: "#000",
                weight: 2,
                dashArray: '3',
                fillColor: colorbrewer.Spectral[11][
                Math.abs(JSON.stringify(feature).split("").reduce(
                    function (a, b) {
                        a = ((a << 5) - a) + b.charCodeAt(0);
                        return a & a
                    }, 0)) % 11]
            };
        },

        onEachFeature: function (feature, layer) {
            if (feature.properties) {
                layer.bindPopup(Object.keys(feature.properties).map(function (k) {
                    return k + ": " + feature.properties[k];
                }).join("<br />"), {
                    maxHeight: 200
                });
            }
        }
    });

    shpFile.addTo(map);
    layerControl.addOverlay(shpFile, filename, {
        groupName: "External Layer",
        expanded: true
    });

    shpFile.once('data:loaded', function () {
        map.spin(false);
    })
} //loadZipShp

function handleZipFile(file) {

    var reader = new FileReader();
    reader.onload = function () {
        loadZipShp(this.result, file.name);
    };
    reader.readAsArrayBuffer(file);
} //handleZipFile

function handleFile(file) {
    let file_extension = file.name.split('.')[1];

    map.spin(true, {lines: 13, length: 40});

    if (file_extension === 'zip') {
        return handleZipFile(file);
    }

    var reader = new FileReader();
    reader.onload = function () {
        var fileUrl = window.URL.createObjectURL(file);
        if (reader.readyState !== 2 || reader.error) {
            return;
        }

        switch (file_extension) {
            case "geojson":
                $.getJSON(fileUrl, function (data) {
                    loadGeojson(data, file.name);
                });
                break;
            case "topojson":
                loadTopJson(fileUrl, file.name);
                break;

            case "csv":
                loadCSV(fileUrl, file.name);
                break;
            case "kml":
                loadKML(fileUrl, file.name);
                break;
            default:
                map.spin(false);
        }

    };
    reader.readAsArrayBuffer(file);
} //handleFile

var dropbox = document.getElementById("map");
dropbox.addEventListener("dragenter", function (e) {
    e.stopPropagation();
    e.preventDefault();
    map.scrollWheelZoom.disable();
}, false);
dropbox.addEventListener("dragover", function (e) {
    e.stopPropagation();
    e.preventDefault();
}, false);
dropbox.addEventListener("drop", function (e) {
    e.stopPropagation();
    e.preventDefault();
    map.scrollWheelZoom.enable();
    var dt = e.dataTransfer;
    var files = dt.files;

    var i = 0;
    var len = files.length;
    if (!len) {
        return
    }
    while (i < len) {
        handleUploadedFile(files[i]);
        i++;
    }
}, false);
dropbox.addEventListener("dragleave", function () {
    map.scrollWheelZoom.enable();
}, false);
//getMunicipalityProjects();
function getMunicipalityProjects(municipality=null){
    //https://[municipality].gov.tl/wp-admin/admin-ajax.php
    if(municipality!=null){
        $.ajax({
            url: 'http://portalmunicipal.baucau.test/wp-admin/admin-ajax.php',
            type: 'post',
            crossDomain: true,
            data: {action: 'fetch_projects'},
            success: function (response) {
                console.log(response);
            }
        });
    }

} //getMunicipalityProjects



// Create & add WMS-layer.
// var tasmania = new L.TileLayer.WMS('https://webgis.ipg.tl/arcgis/services/vector/Administrasaun_Timor_Leste/MapServer/WmsServer', {
//     layers: '3',
//     version:'1.1.0',
//     srs:'EPSG:4326',
// }).addTo(map);
//
// // Perform 'GetCapabilities' request.
// tasmania.getCapabilities({
//     done: function (capabilities) {
//         console.log('getCapabilitiessucceed: ', capabilities);
//     },
//     fail: function (errorThrown) {
//         console.log('getCapabilitiesfailed: ', errorThrown);
//     },
//     always: function () {
//         console.log('getCapabilitiesfinished');
//     }
// });
