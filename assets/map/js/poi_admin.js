jQuery(document).ready(function () {

    let map, selectedPoint;

    jQuery("#balkaun_poi_latitude").click(function () {
        displayModal();
    });

    jQuery("#balkaun_poi_longitude").click(function () {
        displayModal();
    });

    function onMapClickEventListener(ev) {


        if (selectedPoint != null) {
            map.removeLayer(selectedPoint);
            selectedPoint = null;
        }
        selectedPoint = L.marker(ev.latlng, {draggable: true});

        selectedPoint.on('drag', function (e) {
            // setLatLngToInputHtml(e.latlng);
        });
        selectedPoint.on('dragstart', function (e) {
            map.off('click', onMapClickEventListener);
        });
        selectedPoint.on('dragend', function (e) {
            setLatLngToInputHtml(e.target._latlng);
        });

        selectedPoint.addTo(map);

        setLatLngToInputHtml(ev.latlng);
    }

    function setLatLngToInputHtml(latLng) {

        Swal.fire({
            // title: 'Are you sure?',
            html: "LatLng: " + latLng + '<br/> <small>Click on the map or drag and drop marker to change the location</small>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {

                jQuery("#balkaun_poi_latitude").val(latLng.lat);
                jQuery("#balkaun_poi_longitude").val(latLng.lng);
                jQuery("#poi-map-modal").fadeOut();
            }
        })
    }

    function displayModal() {
        jQuery("#poi-map-modal").css("display", "block");

        let default_lat = jQuery("#default_municipality_lat").val();
        let default_lng = jQuery("#default_municipality_lng").val();

        if (map == null) {
            if(default_lat!=='' && default_lng !==''){
                map = L.map('poi-map-modal-map').setView([default_lat,default_lng], 12);
            }else{
                map = L.map('poi-map-modal-map').setView([-8.787519, 125.946401], 9);
            }

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        }

        // if(selectedPoint!=null){
        //     map.removeLayer(selectedPoint);
        //     selectedPoint = null;
        // }

        let cord_lat = jQuery("#balkaun_poi_latitude").val();
        let cord_lng = jQuery("#balkaun_poi_longitude").val();

        if (cord_lat !== '' && cord_lng !== '') {
            selectedPoint = L.marker([cord_lat,cord_lng], {draggable: true});
            selectedPoint.on('drag', function (e) {
                jQuery("#balkaun_poi_latitude").val(e.target._latlng.lat);
                jQuery("#balkaun_poi_longitude").val(e.target._latlng.lng);
            });
            selectedPoint.on('dragstart', function (e) {
                map.off('click', onMapClickEventListener);
            });
            selectedPoint.on('dragend', function (e) {
                setLatLngToInputHtml(e.target._latlng);
            });
            selectedPoint.addTo(map);
        }

        map.on("click", onMapClickEventListener);
    }


    jQuery(".poi-map-modal-close").click(function () {
        jQuery("#poi-map-modal").fadeOut();
    });
});
