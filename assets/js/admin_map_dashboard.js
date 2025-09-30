$(document).ready(function () {


    $('body').on('submit', '#form-add-new-data', function (e) {
        e.preventDefault();

        let form = $(this);

        let data = {
            action: 'add_or_update_dashboard_map_data',
            title: $("#title").val(),
            year: $("#year").val(),
            path: $("#file_path").val(),
            is_update: $("#is_update").val(),
            id: $("#id").val(),
        };

        // console.log(data);
        // return;
        $.ajax({
            url: $("#admin-ajax-url").val(),
            type: 'post',
            data: data,
            success: function (response) {
                resetForm();
                load_table_dasboard_map_data();
            }
        });
    });

    $('body').on('click', '.btn-edit-data', function (e) {
        e.preventDefault();

        $("#title").val($(this).data("title"));
        $("#year").val($(this).data("year"));
        $("#file_path").val($(this).data("path"));
        $("#id").val($(this).data("id"));

        $("#is_update").val(1);
    });

    $('body').on('click', '.btn-delete-data', function (e) {
        e.preventDefault();

        let is_confirmed = confirm("Are you sure to delete " + $(this).data("title"));

        let id = $(this).data("id");

        if (is_confirmed) {
            $.ajax({
                url: $("#admin-ajax-url").val(),
                type: 'post',
                data: {
                    action: 'delete_dashboard_map_data',
                    id: id,
                },
                success: function (response) {
                    load_table_dasboard_map_data();
                }
            });
        }

        resetForm();
    });

    load_table_dasboard_map_data();

    function load_table_dasboard_map_data() {
        $.ajax({
            url: $("#admin-ajax-url").val(),
            type: 'post',
            data: {action: 'fetch_dashboard_map_data'},
            success: function (data) {
                $("#data-table-container").html(data);
                $("#table-dashboard-map-data").DataTable({
                    order: []
                });
            }
        });
    }

    $('body').on('click', '#file_path', function (e) {
        e.preventDefault();
        selectFile($(this));
    });

    $('body').on('click', '#btn-reset-form-map-data', function (e) {
        resetForm();
    });

    function resetForm() {
        
        $("#form-add-new-data").trigger("reset"); // reset form fields
        
        $("#form-add-new-data #is_update").val('0');
        $("#form-add-new-data #id").val('');
        // e.preventDefault();
        // $("#form-add-new-data #id").val('');
        // $("#form-add-new-data #title").val('');
        // $("#form-add-new-data #year").val('');
        // $("#form-add-new-data #file_path").val('');
    }

    function selectFile(holder) {
        let file_frame = wp.media({
            title: 'Select CSV File',
            button: {
                text: 'Use this CSV'
            },
            multiple: false,
            library: {
                type: '' // Allow all types, then validate MIME type manually
            }
        });
        file_frame.on('select', function () { // it also has "open" and "close" events
            let attachment = file_frame.state().get('selection').first().toJSON();

            if (attachment.mime !== 'text/csv') {
                alert('Please upload a valid CSV file.');
                return;
            }

            console.log(attachment.url);
            holder.val(attachment.url);
        });
        file_frame.open();
    }


});

