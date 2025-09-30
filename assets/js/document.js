$(document).ready(function () {
    get_documents_by_category("all");
    $(".btn-document-category").on("click", function () {
        $(".btn-document-category").removeClass("active");
        $(this).addClass("active");
        $(".document-loader").removeClass("d-none");
        $("#table-document-container").html("");
        get_documents_by_category($(this).data("category"));
    });

    function get_documents_by_category(category) {
        $.ajax({
            url: $("#admin-ajax-url").val(),
            type: 'post',
            data: {action: 'fetch_document_by_category', category: category},
            success: function (data) {
                $("#table-document-container").html(data);
                $(".datatable").DataTable({
                    "ordering": false
                });
                $(".document-loader").addClass("d-none");
            }
        });
    }

});
