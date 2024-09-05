jQuery(document).ready(function () {
    if (notification) {
        Swal.fire({
            title: notification.title,
            text: notification.text,
            icon: notification.icon
        });
    }

    $('[data-mask]').inputmask();

    $("#datatable").DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": false
    })

    $("#mode").click(function () {
        let new_mode = "";

        if (mode == "dark") {
            new_mode = "light";
        } else {
            new_mode = "dark";
        }

        var formData = new FormData();

        formData.append('mode', new_mode);

        $.ajax({
            url: 'change_mode',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.reload();
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $(".logout").click(function () {
        $.ajax({
            url: 'logout',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    location.href = base_url;
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#account_settings").click(function () {
        $("#account_settings_modal").modal("show");
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
                $("#account_settings_id").val(response.id);
                $("#account_settings_name").val(response.name);
                $("#account_settings_username").val(response.username);
                $("#account_settings_old_password").val(response.password);
                $("#account_settings_old_image").val(response.image);
                $("#account_settings_image_display").attr("src", base_url + "public/dist/img/uploads/admin/" + response.image);

                $(".loading").addClass("d-none");
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#account_settings_image").change(function (event) {
        var displayImage = $('#account_settings_image_display');
        var file = event.target.files[0];

        if (file) {
            var imageURL = URL.createObjectURL(file);

            displayImage.attr('src', imageURL);

            displayImage.on('load', function () {
                URL.revokeObjectURL(imageURL);
            });
        } else {
            displayImage.attr('src', base_url + "public/dist/img/uploads/admin/" + $("#account_settings_old_image").val());
        }
    })

    $("#account_settings_form").submit(function () {
        const id = $("#account_settings_id").val();
        const name = $("#account_settings_name").val();
        const username = $("#account_settings_username").val();
        let password = $("#account_settings_password").val();
        const confirm_password = $("#account_settings_confirm_password").val();
        const old_password = $("#account_settings_old_password").val();
        const image_input = $("#account_settings_image")[0];
        const image = $("#account_settings_old_image").val();

        let errors = 0;
        let is_new_image = false;

        if (image_input.files.length > 0) {
            var image_file = image_input.files[0];

            is_new_image = true;
        }

        if (password != confirm_password) {
            $("#account_settings_password").addClass("is-invalid");
            $("#account_settings_confirm_password").addClass("is-invalid");
            $("#error_account_settings_password").removeClass("d-none");

            errors++;
        }

        if (!errors) {
            $("#account_settings_submit").text("Please wait...");
            $("#account_settings_submit").attr("disabled", true);
            $(".loading").removeClass("d-none");

            let is_new_password = true;

            if (!password) {
                password = old_password;

                is_new_password = false;
            }

            var formData = new FormData();

            formData.append('id', id);
            formData.append('name', name);
            formData.append('username', username);
            formData.append('password', password);
            formData.append('is_new_password', is_new_password);
            formData.append('image', image);
            formData.append('image_file', image_file);
            formData.append('is_new_image', is_new_image);

            $.ajax({
                url: 'update_admin',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#account_settings_password").keydown(function () {
        $("#account_settings_password").removeClass("is-invalid");
        $("#account_settings_confirm_password").removeClass("is-invalid");
        $("#error_account_settings_password").addClass("d-none");
    })

    $("#account_settings_confirm_password").keydown(function () {
        $("#account_settings_password").removeClass("is-invalid");
        $("#account_settings_confirm_password").removeClass("is-invalid");
        $("#error_account_settings_password").addClass("d-none");
    })

    $("#new_student_image").change(function (event) {
        var displayImage = $('#new_student_image_display');
        var file = event.target.files[0];

        if (file) {
            var imageURL = URL.createObjectURL(file);

            displayImage.attr('src', imageURL);

            displayImage.on('load', function () {
                URL.revokeObjectURL(imageURL);
            });
        } else {
            displayImage.attr('src', base_url + "public/dist/img/default-user-image.png");
        }
    })

    $("#new_student_form").submit(function () {
        const student_number = $("#new_student_student_number").val();
        const course = $("#new_student_course").val();
        const year = $("#new_student_year").val();
        const section = $("#new_student_section").val();
        const first_name = $("#new_student_first_name").val();
        const middle_name = $("#new_student_middle_name").val();
        const last_name = $("#new_student_last_name").val();
        const birthday = $("#new_student_birthday").val();
        const mobile_number = $("#new_student_mobile_number").val().replace(/\D/g, '');
        const email = $("#new_student_email").val();
        const address = $("#new_student_address").val();
        const image = $("#new_student_image")[0];

        let errors = 0;

        if (image.files.length > 0) {
            var image_file = image.files[0];
        }

        if (mobile_number.length != 11) {
            $("#new_student_mobile_number").addClass("is-invalid");
            $("#error_new_student_mobile_number").removeClass("d-none");

            $("#new_student_mobile_number").focus();

            errors++;
        }

        if (!errors) {
            $("#new_student_submit").text("Please wait...");
            $("#new_student_submit").attr("disabled", true);

            $(".loading").removeClass("d-none");

            var formData = new FormData();

            formData.append('student_number', student_number);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('section', section);
            formData.append('first_name', first_name);
            formData.append('middle_name', middle_name);
            formData.append('last_name', last_name);
            formData.append('birthday', birthday);
            formData.append('mobile_number', mobile_number);
            formData.append('email', email);
            formData.append('address', address);
            formData.append('image_file', image_file);

            $.ajax({
                url: 'save_student',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    } else {
                        $("#new_student_submit").text("Submit");
                        $("#new_student_submit").removeAttr("disabled");

                        $(".loading").addClass("d-none");

                        $("#new_student_student_number").addClass("is-invalid");
                        $("#error_new_student_student_number").removeClass("d-none");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_student_mobile_number").keydown(function () {
        $("#new_student_mobile_number").removeClass("is-invalid");
        $("#error_new_student_mobile_number").addClass("d-none");
    })

    $("#new_student_student_number").keydown(function () {
        $("#new_student_student_number").removeClass("is-invalid");
        $("#error_new_student_student_number").addClass("d-none");
    })

    $(document).on("click", ".delete_student", function () {
        const student_id = $(this).attr("student_id");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData();

                formData.append('student_id', student_id);

                $.ajax({
                    url: 'delete_student',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response) {
                            location.reload();
                        }
                    },
                    error: function (_, _, error) {
                        console.error(error);
                    }
                });
            }
        });
    })

    $(document).on("click", ".edit_student", function () {
        const student_id = $(this).attr("student_id");

        $("#update_student_modal").modal("show");

        var formData = new FormData();

        formData.append('student_id', student_id);

        $.ajax({
            url: 'get_student_data',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                $("#update_student_student_number").val(response.student_number);
                $("#update_student_course").val(response.course);
                $("#update_student_year").val(response.year);
                $("#update_student_section").val(response.section);
                $("#update_student_first_name").val(response.first_name);
                $("#update_student_middle_name").val(response.middle_name);
                $("#update_student_last_name").val(response.last_name);
                $("#update_student_birthday").val(response.birthday);
                $("#update_student_mobile_number").val(response.mobile_number);
                $("#update_student_email").val(response.email);
                $("#update_student_address").val(response.address);
                $("#update_student_image_display").attr("src", "public/dist/img/uploads/students/" + response.image);

                $("#update_student_id").val(response.id);
                $("#update_student_old_student_number").val(response.student_number);
                $("#update_student_old_image").val(response.image);
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#update_student_image").change(function (event) {
        var displayImage = $('#update_student_image_display');
        var file = event.target.files[0];

        if (file) {
            var imageURL = URL.createObjectURL(file);

            displayImage.attr('src', imageURL);

            displayImage.on('load', function () {
                URL.revokeObjectURL(imageURL);
            });
        } else {
            displayImage.attr('src', base_url + "public/dist/img/default-user-image.png");
        }
    })

    $("#update_student_mobile_number").keydown(function () {
        $("#update_student_mobile_number").removeClass("is-invalid");
        $("#error_update_student_mobile_number").addClass("d-none");
    })

    $("#update_student_student_number").keydown(function () {
        $("#update_student_student_number").removeClass("is-invalid");
        $("#error_update_student_student_number").addClass("d-none");
    })

    $("#update_student_form").submit(function () {
        const student_number = $("#update_student_student_number").val();
        const course = $("#update_student_course").val();
        const year = $("#update_student_year").val();
        const section = $("#update_student_section").val();
        const first_name = $("#update_student_first_name").val();
        const middle_name = $("#update_student_middle_name").val();
        const last_name = $("#update_student_last_name").val();
        const birthday = $("#update_student_birthday").val();
        const mobile_number = $("#update_student_mobile_number").val().replace(/\D/g, '');
        const email = $("#update_student_email").val();
        const address = $("#update_student_address").val();
        const image = $("#update_student_image")[0];

        const id = $("#update_student_id").val();
        const old_student_number = $("#update_student_old_student_number").val();
        const old_image = $("#update_student_old_image").val();

        let is_new_student_number = false;
        let is_new_image = false;

        let errors = 0;

        if (image.files.length > 0) {
            var image_file = image.files[0];

            is_new_image = true;
        }

        if (student_number != old_student_number) {
            is_new_student_number = true;
        }

        if (mobile_number.length != 11) {
            $("#update_student_mobile_number").addClass("is-invalid");
            $("#error_update_student_mobile_number").removeClass("d-none");

            $("#update_student_mobile_number").focus();

            errors++;
        }

        if (!errors) {
            $("#update_student_submit").text("Please wait...");
            $("#update_student_submit").attr("disabled", true);

            $(".loading").removeClass("d-none");

            var formData = new FormData();

            formData.append('student_number', student_number);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('section', section);
            formData.append('first_name', first_name);
            formData.append('middle_name', middle_name);
            formData.append('last_name', last_name);
            formData.append('birthday', birthday);
            formData.append('mobile_number', mobile_number);
            formData.append('email', email);
            formData.append('address', address);
            formData.append('image_file', image_file);
            formData.append('id', id);
            formData.append('old_image', old_image);
            formData.append('is_new_student_number', is_new_student_number);
            formData.append('is_new_image', is_new_image);

            $.ajax({
                url: 'update_student',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    } else {
                        $("#update_student_submit").text("Submit");
                        $("#update_student_submit").removeAttr("disabled");

                        $(".loading").addClass("d-none");

                        $("#update_student_student_number").addClass("is-invalid");
                        $("#error_update_student_student_number").removeClass("d-none");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })
})