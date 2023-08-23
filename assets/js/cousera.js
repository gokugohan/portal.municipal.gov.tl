$(document).ready(function () {

    $("body").on("click", ".btn-edit-coursera-user", function () {
        $("#user_id_update").val($(this).data('id'));
        $("#user_firstname_update").val($(this).data('firstname'));
        $("#user_lastname_update").val($(this).data('lastname'));
        $("#user_email_update").val($(this).data('email'));

        $(".user-name").html($(this).data('firstname') + " " + $(this).data('lastname'));
        $("#modal-update-coursera-user").modal('show');
    });

    //title

    $("body").on("click", ".btn-delete-coursera-user", function () {
        $(".title").html($(this).data('title'));
        $("#cousera-user-id-delete").val($(this).data('id'));
        $("#modal-delete-coursera-user").modal("show");
    });


    $("#form-add-new-coursera-user").on("submit", function (ev) {
        ev.preventDefault();
        let user_firstname = $("#user_firstname").val();
        let user_lastname = $("#user_lastname").val();
        let user_email = $("#user_email").val();
        let user_eppn = $("#user_eppn").val();
        let user_password = $("#user_password").val();

        let data = {
            action: 'add_new_coursera_user',
            firstname: user_firstname,
            lastname: user_lastname,
            email: user_email,
            eppn: user_eppn,
            password: user_password,
        };
        $.ajax({
            url: $("#adminajaxurl").val(),
            type: 'post',
            data: data,
            success: function (response) {
                getCourseraUsers();
            },
            complete:function(){
                $("#form-add-new-coursera-user").trigger('reset');
            }
        });
    });

    $("#form-update-coursera-user").on("submit", function (ev) {
        ev.preventDefault();
        let user_id = $("#user_id_update").val();
        let user_firstname = $("#user_firstname_update").val();
        let user_lastname = $("#user_lastname_update").val();
        let user_email = $("#user_email_update").val();

        let data = {
            action: 'update_coursera_user',
            id: user_id,
            firstname: user_firstname,
            lastname: user_lastname,
            email: user_email,
        };
        $.ajax({
            url: $("#adminajaxurl").val(),
            type: 'post',
            data: data,
            success: function (response) {
                getCourseraUsers();
            },
            complete:function(){
                $("#modal-update-coursera-user").modal("hide");
                $("#form-update-coursera-user").trigger('reset');
            }
        });
    });

    $("#form-delete-coursera-user").on("submit", function (ev) {
        ev.preventDefault();
        let user_id = $("#cousera-user-id-delete").val();

        let data = {
            action: 'delete_coursera_user',
            id: user_id,
        };
        $.ajax({
            url: $("#adminajaxurl").val(),
            type: 'post',
            data: data,
            success: function (response) {
                getCourseraUsers();
            },
            complete:function(){
                $("#modal-delete-coursera-user").modal("hide");
            }
        });
    });


    $("body").on("click",".btn-change-coursera-user-password",function(){
        $(".user-title").html($(this).data("title"));
        $("#modal-change-password-coursera-user").modal("show");
    });


    $("#form-change-password-coursera-user").on("submit", function (ev) {
        ev.preventDefault();
        let user_id = $("#cousera-user-id").val();

        let data = {
            action: 'change_password_coursera_user',
            id: user_id,
        };
        $.ajax({
            url: $("#adminajaxurl").val(),
            type: 'post',
            data: data,
            success: function (response) {
                getCourseraUsers();
            },
            complete:function(){
                $("#modal-change-password-coursera-user").modal("hide");
            }
        });
    });

    getCourseraUsers();

    function getCourseraUsers() {
        $.ajax({
            url: $("#adminajaxurl").val(),
            type: 'post',
            data: {action: 'get_coursera_users'},
            success: function (data) {
                $("#table-list-coursera-user tbody").html(data);
            }
        });
    }//getCourseraUsers

})
