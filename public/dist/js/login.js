jQuery(document).ready(function () {
    var is_submit = false;

    $("#login_form").submit(function () {
        const username = $("#login_username").val();
        const password = $("#login_password").val();
        const remember_me = $("#login_remember_me").prop("checked");

        var formData = new FormData();

        formData.append('username', username);
        formData.append('password', password);
        formData.append('remember_me', remember_me);

        $("#login_submit").attr("disabled", true);
        $("#login_submit").text("Please wait...");

        $("#login_notification").addClass("d-none");

        $.ajax({
            url: 'get_user_details',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.reload();
                } else {
                    $("#login_notification").removeClass("d-none");

                    $("#login_submit").removeAttr("disabled");
                    $("#login_submit").text("Login");
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#new_admin").click(function () {
        $("#new_admin_modal").modal("show");
        $(".loading").removeClass("d-none");

        var formData = new FormData();

        formData.append('user_id', user_id);

        $.ajax({
            url: 'get_admin_data',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                $("#new_admin_id").val(response.id);
                $("#new_admin_name").val(response.name);
                $("#new_admin_username").val(response.username);
                $("#new_admin_old_password").val(response.password);
                $("#new_admin_old_image").val(response.image);
                $("#new_admin_image_display").attr("src", base_url + "public/dist/img/uploads/admin/" + response.image);

                $(".loading").addClass("d-none");
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#new_admin_image").change(function (event) {
        $("#error_new_admin_image").addClass("d-none");

        var displayImage = $('#new_admin_image_display');
        var file = event.target.files[0];

        if (file) {
            var imageURL = URL.createObjectURL(file);

            displayImage.attr('src', imageURL);

            displayImage.on('load', function () {
                URL.revokeObjectURL(imageURL);
            });
        } else {
            displayImage.attr('src', base_url + "public/dist/img/uploads/admin/default-user-image.png");
        }
    })

    $("#new_admin_next").click(function () {
        const name = $("#new_admin_name").val();
        const username = $("#new_admin_username").val();
        const password = $("#new_admin_password").val();
        const confirm_password = $("#new_admin_confirm_password").val();
        const image_file = $("#new_admin_image")[0];

        let is_error = 0;

        if (!confirm_password) {
            $("#new_admin_confirm_password").addClass("is-invalid");
            $("#new_admin_confirm_password").focus();

            is_error++;
        }

        if (!password) {
            $("#new_admin_password").addClass("is-invalid");
            $("#new_admin_password").focus();

            is_error++;
        }

        if (!username) {
            $("#new_admin_username").addClass("is-invalid");
            $("#new_admin_username").focus();

            is_error++;
        }

        if (!name) {
            $("#new_admin_name").addClass("is-invalid");
            $("#new_admin_name").focus();

            is_error++;
        }

        if (image_file.files.length == 0) {
            $("#error_new_admin_image").removeClass("d-none");

            is_error++;
        }

        if (!is_error) {
            if (password != confirm_password) {
                $("#new_admin_password").addClass("is-invalid");
                $("#new_admin_confirm_password").addClass("is-invalid");
                $("#error_new_admin_password").removeClass("d-none");
            } else {
                $("#new_admin_next").attr("disabled", true);
                $("#new_admin_next").text("Please wait...");

                $(".loading").removeClass("d-none");

                var formData = new FormData();

                formData.append('username', username);

                $.ajax({
                    url: 'check_username',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response) {
                            $(".loading").addClass("d-none");

                            $("#login_notification").addClass("d-none");

                            $("#new_admin_confirmation_username").attr("required", true);
                            $("#new_admin_confirmation_password").attr("required", true);

                            $(".sign-up-form").addClass("d-none");
                            $(".confirm-admin").removeClass("d-none");

                            $("#new_admin_next").addClass("d-none");
                            $("#new_admin_submit").removeClass("d-none");

                            is_submit = true;
                        } else {
                            $("#new_admin_username").addClass("is-invalid");
                            $("#error_new_admin_username").removeClass("d-none");

                            $("#new_admin_next").removeAttr("disabled");
                            $("#new_admin_next").text("Next");

                            $(".loading").addClass("d-none");
                        }
                    },
                    error: function (_, _, error) {
                        console.error(error);
                    }
                });
            }
        }
    })

    $("#new_admin_form").submit(function () {
        const name = $("#new_admin_name").val();
        const username = $("#new_admin_username").val();
        const password = $("#new_admin_password").val();
        const image_file = $("#new_admin_image")[0].files[0];
        const confirmation_username = $("#new_admin_confirmation_username").val();
        const confirmation_password = $("#new_admin_confirmation_password").val();

        if (is_submit) {
            $("#new_admin_submit").attr("disabled", true);
            $("#new_admin_submit").text("Please wait...");

            $(".loading").removeClass("d-none");

            var formData = new FormData();

            formData.append('username', confirmation_username);
            formData.append('password', confirmation_password);

            $.ajax({
                url: 'check_admin',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        var formData_2 = new FormData();

                        formData_2.append('name', name);
                        formData_2.append('username', username);
                        formData_2.append('password', password);
                        formData_2.append('image_file', image_file);

                        $.ajax({
                            url: 'new_admin',
                            data: formData_2,
                            type: 'POST',
                            dataType: 'JSON',
                            processData: false,
                            contentType: false,
                            success: function (response_2) {
                                if (response_2) {
                                    location.reload();
                                }
                            },
                            error: function (_, _, error) {
                                console.error(error);
                            }
                        });
                    } else {
                        $("#new_admin_confirmation_username").addClass("is-invalid");
                        $("#new_admin_confirmation_password").addClass("is-invalid");

                        $("#new_admin_submit").removeAttr("disabled");
                        $("#new_admin_submit").text("Submit");

                        $(".loading").addClass("d-none");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_admin_confirmation_username").keydown(function () {
        $("#new_admin_confirmation_username").removeClass("is-invalid");
        $("#new_admin_confirmation_password").removeClass("is-invalid");
    })

    $("#new_admin_confirmation_password").keydown(function () {
        $("#new_admin_confirmation_username").removeClass("is-invalid");
        $("#new_admin_confirmation_password").removeClass("is-invalid");
    })

    $("#new_admin_name").keydown(function () {
        $("#new_admin_name").removeClass("is-invalid");
    })

    $("#new_admin_username").keydown(function () {
        $("#new_admin_username").removeClass("is-invalid");
        $("#error_new_admin_username").addClass("d-none");
    })

    $("#new_admin_password").keydown(function () {
        $("#new_admin_password").removeClass("is-invalid");
        $("#new_admin_confirm_password").removeClass("is-invalid");
        $("#error_new_admin_password").addClass("d-none");
    })

    $("#new_admin_confirm_password").keydown(function () {
        $("#new_admin_password").removeClass("is-invalid");
        $("#new_admin_confirm_password").removeClass("is-invalid");
        $("#error_new_admin_password").addClass("d-none");
    })
})