jQuery(document).ready(function () {

    jQuery('body').on('click', '.default-bg-upload-button', function (e) {
        e.preventDefault();
        selectImage(".default-bg-img",'#setting_homepage_image');
    });


    jQuery('body').on('click', '.default-bg-remove-button', function (e) {
        e.preventDefault();
        restoreDefaultImage("#setting_homepage_image_default", "#setting_homepage_image");
    });


    jQuery('body').on('click', '.btn-replace-menu-logo', function (e) {

        e.preventDefault();
        selectImage(".default-menu-logo",'#setting_bu_menu_logo');
    });

    jQuery('body').on('click', '.reset-menu-logo', function (e) {
        e.preventDefault();
        restoreDefaultImage('#default_menu_logo', "#setting_bu_menu_logo");
    });

    jQuery('body').on('click', '.btn-replace-front-logo', function (e) {

        e.preventDefault();
        selectImage(".default-front-logo",'#setting_bu_front_logo');
    });

    jQuery('body').on('click', '.reset-front-logo', function (e) {
        e.preventDefault();
        restoreDefaultImage('#default_front_logo', "#setting_bu_front_logo");
    });


    jQuery('body').on('click', '.btn-replace-about-image', function (e) {

        e.preventDefault();
        selectImage(".default-about-bg-img",'#setting_bu_about_image');
    });

    jQuery('body').on('click', '.reset-about-image', function (e) {
        e.preventDefault();
        restoreDefaultImage('#default_about_image', "#setting_bu_about_image");
    });


    jQuery('body').on('click', '.btn-replace-service-image', function (e) {

        e.preventDefault();
        selectImage(".default-service-bg-img",'#setting_bu_service_image');
    });

    jQuery('body').on('click', '.reset-service-image', function (e) {
        e.preventDefault();
        restoreDefaultImage('#default_service_image', "#setting_bu_service_image");
    });

    jQuery('body').on('click', '.btn-replace-location-image', function (e) {

        e.preventDefault();
        selectImage(".default-location-bg-img",'#setting_bu_location_image');
    });

    jQuery('body').on('click', '.reset-location-image', function (e) {
        e.preventDefault();
        restoreDefaultImage('#default_location_image', "#setting_bu_location_image");
    });


    function restoreDefaultImage(defaultImageHolderId, imageHolderId) {
        let default_img = jQuery(defaultImageHolderId).val();
        console.log(default_img);
        jQuery(imageHolderId).val('');
        jQuery(".default-bg-img").prop('src', default_img);
    }


    function selectImage(defaultImageHolderId,imageHolderId) {
        let custom_uploader = wp.media({
            title: 'Select Image',
            library: {
                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                type: 'image'
            },
            button: {
                text: 'Use this image' // button label text
            },
            multiple: false
        }).on('select', function () { // it also has "open" and "close" events
            let attachment = custom_uploader.state().get('selection').first().toJSON();
            jQuery(defaultImageHolderId).prop('src', attachment.url);
            jQuery(imageHolderId).val(attachment.url);
            // button.html('<img League="' + attachment.url + '">').next().show().next().val(attachment.id);
        }).open();
    }

});
