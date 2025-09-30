$(document).ready(function () {

    const DEFAULT_AREA_TITLE = "Timor-Leste";
    const center = [-8.806894, 125.566735];
    const legend = L.control({position: 'bottomleft'});
    let csvData = [];
    
    //default_map_tls
    let default_map_tls;
    let totalAreaSqMeters = 0;
    let densityByArea=[];
    // A lookup of area CODE -> computed color (based on density). Built when geojson loads.
    let colorByCode = {};

    // Promise that resolves when the default geojson map has finished loading and
    // colorByCode has been built. Use this to ensure charts can pick map colors.
    let defaultMapReady = false;
    let defaultMapReadyResolve = null;
    const defaultMapReadyPromise = new Promise((res) => { defaultMapReadyResolve = res; });
    
    let latestDataItem = null;
    let total_sum_populasaun = 0, total_sum_mane = 0, total_sum_feto = 0,
        total_sum_umakain = 0, total_sum_posto = 0, total_sum_suku = 0, total_sum_aldeia = 0;

    let csv_data_source_name = "";
    let googleStreets = L.tileLayer(
        "http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
        {
            // maxZoom: 20,
            subdomains: ["mt0", "mt1", "mt2", "mt3"],
            attribution: $("#map-desc").val() + ' &copy; <a href="https://www.google.tl/maps">Google</a>',
        }
    );


    let googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: $("#map-desc").val() + ' &copy; <a href="https://www.google.tl/maps">Google</a>',
    });

    let map = L.map("map-canvas", {
        center: center,
        zoom: 9,
        layers: [googleStreets],
        zoomControl: true,
        fullscreenControl: true,
        scrollWheelZoom: false,
        attributionControl: true,
    });

    map.on("overlayadd", function (e) {
        map.flyToBounds(e.layer.getBounds());
    });

    $("#btn-switch-tls-map").on("click", function () {

        legendControl.toggle(map);
        if (map.hasLayer(default_map_tls)) {
            map.removeLayer(default_map_tls);
            $(this).removeClass("activated");
        } else {
            map.addLayer(default_map_tls);
            $(this).addClass("activated");
        }
    });

    $("#btn-reload-map").on("click", function () {
        totalAreaSqMeters = 0;
        load_data();
        $(".selected-area-title").html(DEFAULT_AREA_TITLE);
    })

    $("#basemap-street").on("click", function () {
        const isActive = $(this).toggleClass('activated').hasClass('activated');
        isActive ? map.addLayer(googleStreets) : map.removeLayer(googleStreets);

        map.removeLayer(googleHybrid);
        $("#basemap-sattelite").removeClass("activated");
    });

    $("#basemap-sattelite").on("click", function () {
        const isActive = $(this).toggleClass('activated').hasClass('activated');
        isActive ? map.addLayer(googleHybrid) : map.removeLayer(googleHybrid);
        map.removeLayer(googleStreets);
        $("#basemap-street").removeClass("activated");
    })

    $(".btn-area").on("click", function () {
        const code = $(this).data("area");
        $('.btn-area').removeClass('active');
        $(this).addClass('active');
    });

    $("body").on("change", "#list-of-data", function () {
        const url = $("#list-of-data option:selected").val();
        const title = $("#list-of-data option:selected").text();
        if (url.length > 0) {
            csv_data_source_name = title;
            $(".selected-data-source").html(csv_data_source_name);
            displayLatestData(url, csv_data_source_name);
            updateMapColors();

        }

    });

    // Load the initial data
    load_data();

    function load_data() {
        showSpinner();
        $.ajax({
            url: $("#admin-ajax-url").val(),
            type: 'post',
            data: {action: 'fetch_dashboard_map_data_list'},
            success: function (response) {
                if (response.success) {
                    hideSpinner();
                    latestDataItem = response.data[response.data.length - 1];
                    
                    let html = `<option value="">${$("#select-data-source-text").val()}</option>`;
                    $.each(response.data, (k, area_data) => {
                        html += `<option value="${area_data[2]}">${area_data[0]}</option>`;
                    });
                    $("#list-of-data").html(html);

                    
                
                if (latestDataItem != null) {
                    csv_data_source_name = latestDataItem[0];
                    $(".selected-data-source").html(csv_data_source_name);
                    // Defer displaying the CSV/chart until after the geojson map is loaded
                    // so getMapColors() can inspect polygon styles. load_default_tls_map
                    // accepts an optional callback executed after the layer is added.
                    load_default_tls_map(() => {
                        displayLatestData(latestDataItem[2], csv_data_source_name);
                    });
                } else {
                    // Still load the map even if there's no latest data
                    load_default_tls_map();
                }


                }
            }
        });
    }


    function getAreaDensity(){

    }

    function displayLatestData(url = undefined, source = undefined) {
        $('.chart-title').html(source);
        if (url !== undefined) {
            showSpinner();
            fetch(url)
                .then(res => res.text())
                .then(text => {
                    csvData = Papa.parse(text, {header: true}).data;
                    total_sum_populasaun = 0;
                    total_sum_mane = 0;
                    total_sum_feto = 0;
                    total_sum_umakain = 0;
                    total_sum_posto = 0;
                    total_sum_suku = 0;
                    total_sum_aldeia = 0;

                    let chart_labels = [];
                    let chart_data = [];
                    let chart_colors = [];
                    $.each(csvData, (k, area_data) => {
                        chart_labels.push(area_data['MUNISIPIU']);
                        chart_data.push(parseInt(area_data['TOTAL POPULASAUN']));
                        // chart_colors.push(getAreaColor(area_data['KODIGO AREA']));

                        total_sum_populasaun += safeParse(area_data['TOTAL POPULASAUN']);
                        total_sum_mane += safeParse(area_data['MANE']);
                        total_sum_feto += safeParse(area_data['FETO']);
                        total_sum_umakain += safeParse(area_data['TOTAL UMA KAIN']);
                        total_sum_posto += safeParse(area_data['TOTAL POSTO']);
                        total_sum_suku += safeParse(area_data['TOTAL SUKU']);
                        total_sum_aldeia += safeParse(area_data['TOTAL ALDEIA']);
                    });

                    const totals = {
                        'populasaun': total_sum_populasaun,
                        'mane': total_sum_mane,
                        'feto': total_sum_feto,
                        'umakain': total_sum_umakain,
                        'posto': total_sum_posto,
                        'suku': total_sum_suku,
                        'aldeia': total_sum_aldeia
                    };

                    // console.log(totals);

                    updateCardPanel(totals);

                    $(".selected-area-title").html(DEFAULT_AREA_TITLE);

                    // Recompute map polygon colors from the freshly-loaded CSV values.
                    // If the map layer isn't ready yet this will no-op; displayChartForAllMunicipality
                    // will wait for defaultMapReadyPromise below.
                    updateMapColors(true);

                    hideSpinner();

                    // Wait for the default geojson map to be ready so we can compute
                    // chart colors that match map polygon colors. If the map is already
                    // ready the promise resolves immediately.
                    const ensureMapReady = defaultMapReady ? Promise.resolve() : defaultMapReadyPromise;
                    ensureMapReady.then(() => {
                        // Build chart colors deterministically based on csv order and
                        // the colorByCode map that was filled when the geojson loaded or
                        // when updateMapColors ran.
                        const chartColorsFinal = getMapColors(chart_labels.length);
                        displayChartForAllMunicipality(DEFAULT_AREA_TITLE, source, {
                            labels: chart_labels,
                            data: chart_data,
                            colors: chartColorsFinal
                        });
                    });

                });
        }
    }

    let theChart;

    Chart.register(ChartDataLabels);
    function displayChartForAllMunicipality(title, source, data) {

        const ctx = document.getElementById('canvas-ctx').getContext('2d');
        if(theChart)theChart.destroy();

    // Request map colors for the number of labels so getMapColors can return
    // a properly sized array even if the geojson layer isn't ready yet.
    const chartColors = getMapColors(data.labels ? data.labels.length : data.data.length);

        theChart = new Chart(ctx, {
            type: 'bar', // change to 'pie', 'line', etc. if you want
            data: {
                labels: data.labels,
                datasets: [{
                    label: source,
                    data: data.data,
                    backgroundColor: chartColors.map(c => hexToRgba(c, 0.7)), // match map colors
                    // backgroundColor: data.colors,
                    // borderColor: [
                    //     'rgba(255, 99, 132, 1)',
                    //     'rgba(54, 162, 235, 1)',
                    //     'rgba(255, 206, 86, 1)',
                    //     'rgba(75, 192, 192, 1)',
                    //     'rgba(153, 102, 255, 1)'
                    // ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: false,
                        text: source
                    },

                    legend: {
                        display: false,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    },
                    datalabels: {
                        display: true,
                        color: '#000',          // label text color
                        // rotation: 90,            // rotate 90 degrees
                        anchor: 'end',           // position relative to bar
                        align: 'start',          // position relative to anchor
                        font: {
                            weight: 'bold',
                            size: 12
                        },
                        formatter: (value) => new Intl.NumberFormat('en-US', {}).format(value)
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    

    function load_default_tls_map(callback) {
        showSpinner();
        if (default_map_tls) map.removeLayer(default_map_tls);

        fetch($("#default_map_tls").val())
            .then(res => res.json())
            .then(geojson => {
                // if (default_map_tls) map.removeLayer(default_map_tls);

                // Reset the color lookup and other state before creating layer
                colorByCode = {};
                densityByArea = [];
                totalAreaSqMeters = 0;

                default_map_tls = L.geoJSON(geojson, {
                    style: function (feature) {
                        const row = csvData.find(r => r['KODIGO AREA'] === feature.properties.CODE);
                        const pop = row ? safeParse(row['TOTAL POPULASAUN']) : 0;
                        const area = turf.area(feature); // m²
                        const density = area > 0 ? pop / (area / 1e6) : 0; // people per km²
                        densityByArea.push({
                            'CODE':feature.properties.CODE,
                            'DENSITY':density
                        });

                        // Compute and store color for this feature code so charts can
                        // later read the exact color values even if they build
                        // independently.
                        const fill = getDensityColor(density);
                        colorByCode[feature.properties.CODE] = fill;

                        return {
                            weight: 2,
                            opacity: 1,
                            color: 'white',
                            dashArray: '3',
                            fillOpacity: 0.7,
                            fillColor: fill
                        };
                        
                    },
                    onEachFeature: function (feature, layer) {

                        const area = turf.area(feature); // Area in m²
                        totalAreaSqMeters += area;

                        // Bind and open the tooltip at the new anchor point
                        layer.bindTooltip(feature.properties.DISTR_NAME, {
                            permanent: true,
                            direction: 'center',
                            className: 'municipality-label'
                        }).openTooltip();
                        layer.on('mouseover', function (e) {

                            layer.setStyle({
                                weight: 1,
                                fillOpacity: 0.9
                            });

                            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                                layer.bringToFront();
                            }
                            
                        });
                        layer.on('mouseout', function (e) {
                            default_map_tls.resetStyle(e.target);
                        });
                        layer.on('click', function () {

                            // const areaKm2 = ((area / 1e6).toFixed(2)); // convert to km²

                            const areaCode = feature.properties['CODE']; // Adjust as needed
                            const area_data = csvData.find(row => row['KODIGO AREA'] === areaCode);
                            total_sum_populasaun = safeParse(area_data['TOTAL POPULASAUN']);
                            total_sum_mane = safeParse(area_data['MANE']);
                            total_sum_feto = safeParse(area_data['FETO']);
                            total_sum_umakain = safeParse(area_data['TOTAL UMA KAIN']);
                            total_sum_posto = safeParse(area_data['TOTAL POSTO']);
                            total_sum_suku = safeParse(area_data['TOTAL SUKU']);
                            total_sum_aldeia = safeParse(area_data['TOTAL ALDEIA']);
                            const totals = {
                                'populasaun': total_sum_populasaun,
                                'mane': total_sum_mane,
                                'feto': total_sum_feto,
                                'umakain': total_sum_umakain,
                                'posto': total_sum_posto,
                                'suku': total_sum_suku,
                                'aldeia': total_sum_aldeia
                            };

                            updateCardPanel(totals);

                            $(".selected-area-title").html(area_data["MUNISIPIU"]);
                            // $(".area-in-km2").html(`area: ${areaKm2} km²`);
                            // $(".total-area").html(`${areaKm2}`);
                            //
                            //
                            // const densidade_populasional = formatNumberWithThousandSeparator((total_sum_populasaun / (area / 1e6)).toFixed(2));
                            //
                            // $(".total-densidade-populasional").html(`${densidade_populasional}`);

                            updateGeographycalStatistic(area, total_sum_populasaun);

                            if (area_data) {
                            } else {
                                alert('No data for area code: ' + areaCode);
                            }

                        });
                    }
                });

                default_map_tls.addTo(map);

                updateGeographycalStatistic(totalAreaSqMeters, total_sum_populasaun);
                // map.flyToBounds(default_map_tls.getBounds());

            
                hideSpinner();

                // Mark default map as ready and resolve waiting promises so chart
                // rendering can pick up the colorByCode map.
                defaultMapReady = true;
                if (defaultMapReadyResolve) defaultMapReadyResolve();

                if (callback) callback(); // call chart update AFTER map is loaded

                // If a chart already exists (callback may have created it), update
                // its colors to match the map polygons now that the layer is ready.
                try {
                    if (typeof theChart !== 'undefined' && theChart && theChart.data && theChart.data.labels) {
                        const expected = theChart.data.labels.length;
                        theChart.data.datasets[0].backgroundColor = getMapColors(expected);
                        theChart.update();
                    }
                } catch (e) {
                    // non-fatal; if chart update fails just continue
                    console.warn('Failed to update chart colors after map load', e);
                }

            });
    }

    function getMapColors(expectedCount = 0) {
        // Always return an array. If the geojson layer exists, try to read
        // fillColor from each polygon in the same order as csvData (so chart bars
        // line up with map areas). If not available, generate fallback colors.

        const colors = [];

        // Prefer the global colorByCode built when the geojson or updateMapColors ran
        if (Object.keys(colorByCode).length) {
            if (csvData && csvData.length) {
                csvData.forEach(r => {
                    const code = r['KODIGO AREA'];
                    colors.push(colorByCode[code] || '#FFEDA0');
                });
            } else {
                for (const code in colorByCode) colors.push(colorByCode[code]);
            }
        } else if (default_map_tls) {
            // Fallback: read directly from layer options if colorByCode isn't populated yet
            const local = {};
            default_map_tls.eachLayer(function(layer) {
                if (layer.feature) {
                    const areaCode = layer.feature.properties.CODE;
                    local[areaCode] = layer.options && layer.options.fillColor ? layer.options.fillColor : '#FFEDA0';
                }
            });

            if (csvData && csvData.length) {
                csvData.forEach(r => {
                    const code = r['KODIGO AREA'];
                    colors.push(local[code] || '#FFEDA0');
                });
            } else {
                for (const code in local) colors.push(local[code]);
            }
        }

        // If colors is empty (map not loaded or no layers), generate fallback colors
        if (!colors.length) {
            const fallback = ['#4daf4a', '#377eb8', '#ff7f00', '#984ea3', '#e41a1c', '#ffff33'];
            for (let i = 0; i < Math.max(1, expectedCount); i++) {
                colors.push(fallback[i % fallback.length]);
            }
        }

        // Ensure the returned array matches expectedCount when provided.
        if (expectedCount && colors.length < expectedCount) {
            // Repeat last color to reach expected length
            const last = colors[colors.length - 1] || '#FFEDA0';
            while (colors.length < expectedCount) colors.push(last);
        } else if (expectedCount && colors.length > expectedCount) {
            colors.length = expectedCount;
        }

        return colors;
    }


    function updateMapColors(useDensity = true) {
        if (!default_map_tls) return;
        default_map_tls.eachLayer(function(layer) {
            if (layer.feature) {
                const areaCode = layer.feature.properties.CODE;
                const row = csvData.find(r => r['KODIGO AREA'] === areaCode);

                if (row) {
                    const pop = safeParse(row['TOTAL POPULASAUN']);
                    const area = layer.feature.properties.Area; // km²
                    const density = area > 0 ? pop / area : 0;

                    const fillColor = useDensity ? getDensityColor(density) : getPopulationColor(pop);

                    // Store the color in the module-level lookup so charts can reuse it
                    colorByCode[areaCode] = fillColor;

                    layer.setStyle({ fillColor: fillColor });
                }
            }
        });
    }



    function updateGeographycalStatistic(totalArea, totalPopulation) {
        const totalTlsAreaKm2 = ((totalArea / 1e6).toFixed(2));

        // $(".area-in-km2").html(`area: ${totalTlsAreaKm2} km²`);
        // $(".total-area").html(`${totalTlsAreaKm2}`);

        const densidade_populasional = ((totalPopulation / (totalArea / 1e6)).toFixed(2));

        $(".total-area").attr("data-target", totalTlsAreaKm2);
        animateCounter($(".total-area"), totalTlsAreaKm2);

        // $(".total-densidade-populasional").html(`${densidade_populasional}`);
        $(".total-densidade-populasional").attr("data-target", densidade_populasional);
        animateCounter($(".total-densidade-populasional"), densidade_populasional);
        setDensityTag(densidade_populasional)
    }
    
    function getDensityColor(density) {
        return density > 200 ? '#800026' :
            density > 150 ? '#BD0026' :
            density > 100 ? '#E31A1C' :
            density > 50  ? '#FC4E2A' :
            density > 20  ? '#FD8D3C' :
            density > 10 ? '#FEB24C' :
                            '#FFEDA0';
    }



    legend.onAdd = function (map) {

        const div = L.DomUtil.create('div', 'info legend');
        const grades = [10, 20, 50, 100, 150, 200];
        const labels = [];
        let from, to;

        // labels.push("Municipalities");
        // Object.entries(AREA_COLORS).forEach(([code, data]) => {
        //     labels.push(`<i style="background:${getAreaColor(code)}"></i> ${data.name}`);
        // });

        //labels.push("Númeru Populasaun");
	labels.push("Densidade Populasaun<br>(hab/km²)");
        for (let i = 0; i < grades.length; i++) {
            from = grades[i];
            to = grades[i + 1];
            labels.push(`<i style="background:${getDensityColor(from + 1)}"></i> ${format_number(from)}${to ? `&ndash;${to}` : '+'}`);
        }


        div.innerHTML = labels.join('<br>');
        return div;
    };

    const legendControl = {
        control: legend,
        visible: false,
        toggle(map) {
            if (this.visible) {
                map.removeControl(this.control);
            } else {
                this.control.addTo(map);
            }
            this.visible = !this.visible;
        }
    };

    legendControl.toggle(map);


    addWaterMark(map, "bottomright", $("#logo").val(), 50);

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


    function updateCardPanel(data) {
        for (const [key, value] of Object.entries(data)) {
            const $element = $(`.total-${key}`);
            // $element.html(formatNumberWithThousandSeparator(value));
            $element.attr("data-target", value);
            animateCounter($element, value);
        }

    }

    function setDensityTag(population_density) {
        let density = Number(population_density);

        let html = "<span class='tag overcrowded badge'>" + $("#evercrowded-density-text").val() + "</span>";
        if (density <= 500) {
            html = "<span class='tag low badge'>" + $("#low-density-text").val() + "</span>";
        } else if (density <= 2000) {
            html = "<span class='tag acceptable badge'>" + $("#acceptable-density-text").val() + "</span>";
        } else if (density <= 5000) {
            html = "<span class='tag dense badge'>" + $("#dense-density-text").val() + "</span>";
        }


        $(".tag-densidade-populasional").html(html);
    }


    const safeParse = (val) => isNaN(parseInt(val)) ? 0 : parseInt(val);

    function formatNumberWithThousandSeparator(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const getRandomColor = () => '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');


    function resetStatsValue() {
        total_sum_populasaun = 0;
        total_sum_mane = 0;
        total_sum_feto = 0;
        total_sum_umakain = 0;
        total_sum_posto = 0;
        total_sum_suku = 0;
        total_sum_aldeia = 0;
    }

    function animateCounter($el, target) {
        const duration = 1000; // in ms
        const frameRate = 30; // ms per frame
        const steps = Math.ceil(duration / frameRate);
        const increment = target / steps;

        let current = 0;
        const interval = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(interval);
            }
            // $el.text(Math.floor(current).toLocaleString());
            $el.text(current.toLocaleString());
        }, frameRate);
    }


    function showSpinner() {
        map.spin(true, {lines: 13, length: 40});
    }

    function hideSpinner() {
        map.spin(false);
    }


    function hexToRgba(hex, opacity) {
        const bigint = parseInt(hex.replace('#',''), 16);
        const r = (bigint >> 16) & 255;
        const g = (bigint >> 8) & 255;
        const b = bigint & 255;
        return `rgba(${r},${g},${b},${opacity})`;
    }
});
