jQuery(document).ready(function () {
    if (notification) {
        Swal.fire({
            title: notification.title,
            text: notification.text,
            icon: notification.icon
        });
    }

    $('.select2').select2();

    $('[data-mask]').inputmask();

    $(".datatable").DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": false
    })

    $(".datatable-no-fiter").DataTable({
        "filter": false,
        "paging": true,
        "lengthChange": false,
        "ordering": false
    })

    $('.collapse').on('show.bs.collapse', function () {
        $('#icon-' + this.id).removeClass('fa-chevron-left').addClass('fa-chevron-down');
    });

    $('.collapse').on('hide.bs.collapse', function () {
        $('#icon-' + this.id).removeClass('fa-chevron-down').addClass('fa-chevron-left');
    });

    $(".clickable_image").click(function () {
        const src = $(this).attr("src");

        $("#image_container").attr("src", src);

        $("#view_image_modal").modal("show");
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
                        location.reload();
                    } else {
                        $("#account_settings_username").addClass("is-invalid");
                        $("#error_account_settings_username").removeClass("d-none");

                        $("#account_settings_submit").text("Save changes");
                        $("#account_settings_submit").removeAttr("disabled");

                        $(".loading").addClass("d-none");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#account_settings_username").keydown(function () {
        $("#account_settings_username").removeClass("is-invalid");
        $("#error_account_settings_username").addClass("d-none");
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
        $(".loading").removeClass("d-none");

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

                var formData_2 = new FormData();

                formData_2.append('code', response.course);

                $.ajax({
                    url: 'get_course_data_by_code',
                    data: formData_2,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function (response_2) {
                        const years = parseInt(response_2.years);

                        $("#update_student_year").removeAttr("disabled");
                        $("#update_student_year").empty();

                        for (let i = 1; i <= years; i++) {
                            const optionText = getOrdinalSuffix(i);

                            $("#update_student_year").append(new Option(optionText, optionText));
                        }

                        $("#update_student_year").val(response.year);

                        $(".loading").addClass("d-none");
                    },
                    error: function (_, _, error) {
                        console.error(error);
                    }
                });
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

    $("#new_course_form").submit(function () {
        const code = $("#new_course_code").val();
        const title = $("#new_course_title").val();
        const years = $("#new_course_years").val();

        let errors = 0;

        if (parseInt(years) < 1) {
            $("#new_course_years").addClass("is-invalid");
            $("#error_new_course_years").removeClass("d-none");

            errors++;
        }

        if (!errors) {
            $("#new_course_submit").text("Please wait...");
            $("#new_course_submit").attr("disabled", true);

            $(".loading").removeClass("d-none");

            var formData = new FormData();

            formData.append('code', code);
            formData.append('title', title);
            formData.append('years', years);

            $.ajax({
                url: 'add_course',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        location.reload();
                    } else {
                        $("#new_course_submit").text("Submit");
                        $("#new_course_submit").removeAttr("disabled");

                        $(".loading").addClass("d-none");

                        $("#new_course_code").addClass("is-invalid");
                        $("#error_new_course_code").removeClass("d-none");

                        $("#new_course_code").focus();
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_course_years").keydown(function () {
        $("#new_course_years").removeClass("is-invalid");
        $("#error_new_course_years").addClass("d-none");
    })

    $("#new_course_years").change(function () {
        $("#new_course_years").removeClass("is-invalid");
        $("#error_new_course_years").addClass("d-none");
    })

    $("#new_course_code").keydown(function () {
        $("#new_course_code").removeClass("is-invalid");
        $("#error_new_course_code").addClass("d-none");
    })

    $(document).on("click", ".delete_course", function () {
        const course_id = $(this).attr("course_id");

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

                formData.append('course_id', course_id);

                $.ajax({
                    url: 'delete_course',
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

    $(document).on("click", ".edit_course", function () {
        const course_id = $(this).attr("course_id");

        $("#update_course_modal").modal("show");
        $(".loading").removeClass("d-none");

        var formData = new FormData();

        formData.append('course_id', course_id);

        $.ajax({
            url: 'get_course_data',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                $("#update_course_code").val(response.code);
                $("#update_course_title").val(response.title);
                $("#update_course_years").val(response.years);
                $("#update_course_id").val(response.id);
                $("#update_course_old_code").val(response.code);

                $(".loading").addClass("d-none");
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#update_course_form").submit(function () {
        const code = $("#update_course_code").val();
        const title = $("#update_course_title").val();
        const years = $("#update_course_years").val();
        const id = $("#update_course_id").val();
        const old_code = $("#update_course_old_code").val();

        let is_new_code = false;
        let errors = 0;

        if (parseInt(years) < 1) {
            $("#update_course_years").addClass("is-invalid");
            $("#error_update_course_years").removeClass("d-none");

            errors++;
        }

        if (code != old_code) {
            is_new_code = true;
        }

        if (!errors) {
            $("#update_course_submit").text("Please wait...");
            $("#update_course_submit").attr("disabled", true);

            $(".loading").removeClass("d-none");

            var formData = new FormData();

            formData.append('id', id);
            formData.append('code', code);
            formData.append('title', title);
            formData.append('years', years);
            formData.append('is_new_code', is_new_code);

            $.ajax({
                url: 'update_course',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        location.reload();
                    } else {
                        $("#update_course_submit").text("Submit");
                        $("#update_course_submit").removeAttr("disabled");

                        $(".loading").addClass("d-none");

                        $("#update_course_code").addClass("is-invalid");
                        $("#error_update_course_code").removeClass("d-none");

                        $("#update_course_code").focus();
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#update_course_years").keydown(function () {
        $("#update_course_years").removeClass("is-invalid");
        $("#error_update_course_years").addClass("d-none");
    })

    $("#update_course_years").change(function () {
        $("#update_course_years").removeClass("is-invalid");
        $("#error_update_course_years").addClass("d-none");
    })

    $("#update_course_code").keydown(function () {
        $("#update_course_code").removeClass("is-invalid");
        $("#error_update_course_code").addClass("d-none");
    })

    $("#new_student_course").change(function () {
        const code = $(this).val();

        var formData = new FormData();

        formData.append('code', code);

        $.ajax({
            url: 'get_course_data_by_code',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                const years = parseInt(response.years);

                $("#new_student_year").removeAttr("disabled");
                $("#new_student_year").empty();

                for (let i = 1; i <= years; i++) {
                    const optionText = getOrdinalSuffix(i);

                    $("#new_student_year").append(new Option(optionText, optionText));
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#update_student_course").change(function () {
        const code = $(this).val();

        var formData = new FormData();

        formData.append('code', code);

        $.ajax({
            url: 'get_course_data_by_code',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                const years = parseInt(response.years);

                $("#update_student_year").removeAttr("disabled");
                $("#update_student_year").empty();

                for (let i = 1; i <= years; i++) {
                    const optionText = getOrdinalSuffix(i);

                    $("#update_student_year").append(new Option(optionText, optionText));
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#new_subject_form").submit(function () {
        const code = $("#new_subject_code").val();
        const title = $("#new_subject_title").val();
        const lecture_units = $("#new_subject_lecture_units").val();
        const laboratory_units = $("#new_subject_laboratory_units").val();
        const hours_per_week = $("#new_subject_hours_per_week").val();
        const course = $("#new_subject_course").val();
        const year = $("#new_subject_year").val();
        const semester = $("#new_subject_semester").val();

        let errors = 0;

        if (parseInt(hours_per_week) < 1) {
            $("#new_subject_hours_per_week").addClass("is-invalid");
            $("#error_new_subject_hours_per_week").removeClass("d-none");

            $("#new_subject_hours_per_week").focus();

            errors++;
        }

        if (parseInt(laboratory_units) < 0) {
            $("#new_subject_laboratory_units").addClass("is-invalid");
            $("#error_new_subject_laboratory_units").removeClass("d-none");

            $("#new_subject_laboratory_units").focus();

            errors++;
        }

        if (parseInt(lecture_units) < 0) {
            $("#new_subject_lecture_units").addClass("is-invalid");
            $("#error_new_subject_lecture_units").removeClass("d-none");

            $("#new_subject_lecture_units").focus();

            errors++;
        }

        if (!errors) {
            $(".loading").removeClass("d-none");

            $("#new_subject_submit").text("Please wait...");
            $("#new_subject_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('code', code);
            formData.append('title', title);
            formData.append('lecture_units', lecture_units);
            formData.append('laboratory_units', laboratory_units);
            formData.append('hours_per_week', hours_per_week);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('semester', semester);

            $.ajax({
                url: 'add_subject',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        location.reload();
                    } else {
                        $(".loading").addClass("d-none");

                        $("#new_subject_submit").text("Submit");
                        $("#new_subject_submit").removeAttr("disabled");

                        $("#new_subject_code").addClass("is-invalid");
                        $("#error_new_subject_code").removeClass("d-none");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_subject_code").keydown(function () {
        $("#new_subject_code").removeClass("is-invalid");
        $("#error_new_subject_code").addClass("d-none");
    })

    $("#new_subject_hours_per_week").keydown(function () {
        $("#new_subject_hours_per_week").removeClass("is-invalid");
        $("#error_new_subject_hours_per_week").addClass("d-none");
    })

    $("#new_subject_hours_per_week").change(function () {
        $("#new_subject_hours_per_week").removeClass("is-invalid");
        $("#error_new_subject_hours_per_week").addClass("d-none");
    })

    $("#new_subject_laboratory_units").keydown(function () {
        $("#new_subject_laboratory_units").removeClass("is-invalid");
        $("#error_new_subject_laboratory_units").addClass("d-none");
    })

    $("#new_subject_laboratory_units").change(function () {
        $("#new_subject_laboratory_units").removeClass("is-invalid");
        $("#error_new_subject_laboratory_units").addClass("d-none");
    })

    $("#new_subject_lecture_units").keydown(function () {
        $("#new_subject_lecture_units").removeClass("is-invalid");
        $("#error_new_subject_lecture_units").addClass("d-none");
    })

    $("#new_subject_lecture_units").change(function () {
        $("#new_subject_lecture_units").removeClass("is-invalid");
        $("#error_new_subject_lecture_units").addClass("d-none");
    })

    $(document).on("click", ".delete_subject", function () {
        const subject_id = $(this).attr("subject_id");

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

                formData.append('subject_id', subject_id);

                $.ajax({
                    url: 'delete_subject',
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

    $(document).on("click", ".edit_subject", function () {
        const subject_id = $(this).attr("subject_id");

        $("#update_subject_modal").modal("show");
        $(".loading").removeClass("d-none");

        var formData = new FormData();

        formData.append('subject_id', subject_id);

        $.ajax({
            url: 'get_subject_data',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                $("#update_subject_code").val(response.code);
                $("#update_subject_title").val(response.title);
                $("#update_subject_lecture_units").val(response.lecture_units);
                $("#update_subject_laboratory_units").val(response.laboratory_units);
                $("#update_subject_hours_per_week").val(response.hours_per_week);

                $("#update_subject_id").val(response.id);
                $("#update_subject_old_code").val(response.code);

                $("#update_subject_course").val(response.course);
                $("#update_subject_semester").val(response.semester);

                var formData_2 = new FormData();

                formData_2.append('code', response.course);

                $.ajax({
                    url: 'get_course_data_by_code',
                    data: formData_2,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function (response_2) {
                        const years = parseInt(response_2.years);

                        $("#update_subject_year").removeAttr("disabled");
                        $("#update_subject_year").empty();

                        for (let i = 1; i <= years; i++) {
                            const optionText = getOrdinalSuffix(i);

                            $("#update_subject_year").append(new Option(optionText, optionText));
                        }

                        $("#update_subject_year").val(response.year);

                        $(".loading").addClass("d-none");
                    },
                    error: function (_, _, error) {
                        console.error(error);
                    }
                });

                $(".loading").addClass("d-none");
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#update_subject_form").submit(function () {
        const code = $("#update_subject_code").val();
        const title = $("#update_subject_title").val();
        const lecture_units = $("#update_subject_lecture_units").val();
        const laboratory_units = $("#update_subject_laboratory_units").val();
        const hours_per_week = $("#update_subject_hours_per_week").val();
        const course = $("#update_subject_course").val();
        const year = $("#update_subject_year").val();
        const semester = $("#update_subject_semester").val();
        const id = $("#update_subject_id").val();
        const old_code = $("#update_subject_old_code").val();

        let errors = 0;

        if (parseInt(hours_per_week) < 1) {
            $("#update_subject_hours_per_week").addClass("is-invalid");
            $("#error_update_subject_hours_per_week").removeClass("d-none");

            $("#update_subject_hours_per_week").focus();

            errors++;
        }

        if (parseInt(laboratory_units) < 0) {
            $("#update_subject_laboratory_units").addClass("is-invalid");
            $("#error_update_subject_laboratory_units").removeClass("d-none");

            $("#update_subject_laboratory_units").focus();

            errors++;
        }

        if (parseInt(lecture_units) < 0) {
            $("#update_subject_lecture_units").addClass("is-invalid");
            $("#error_update_subject_lecture_units").removeClass("d-none");

            $("#update_subject_lecture_units").focus();

            errors++;
        }

        if (!errors) {
            $("#update_subject_submit").text("Please wait...");
            $("#update_subject_submit").attr("disabled", true);

            $(".loading").removeClass("d-none");

            let is_new_code = false;

            if (code != old_code) {
                is_new_code = true;
            }

            var formData = new FormData();

            formData.append('id', id);
            formData.append('is_new_code', is_new_code);
            formData.append('code', code);
            formData.append('title', title);
            formData.append('lecture_units', lecture_units);
            formData.append('laboratory_units', laboratory_units);
            formData.append('hours_per_week', hours_per_week);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('semester', semester);

            $.ajax({
                url: 'update_subject',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        location.reload();
                    } else {
                        $(".loading").addClass("d-none");

                        $("#update_subject_submit").text("Submit");
                        $("#update_subject_submit").removeAttr("disabled");

                        $("#update_subject_code").addClass("is-invalid");
                        $("#error_update_subject_code").removeClass("d-none");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#update_subject_code").keydown(function () {
        $("#update_subject_code").removeClass("is-invalid");
        $("#error_update_subject_code").addClass("d-none");
    })

    $("#update_subject_hours_per_week").keydown(function () {
        $("#update_subject_hours_per_week").removeClass("is-invalid");
        $("#error_update_subject_hours_per_week").addClass("d-none");
    })

    $("#update_subject_hours_per_week").change(function () {
        $("#update_subject_hours_per_week").removeClass("is-invalid");
        $("#error_update_subject_hours_per_week").addClass("d-none");
    })

    $("#update_subject_laboratory_units").keydown(function () {
        $("#update_subject_laboratory_units").removeClass("is-invalid");
        $("#error_update_subject_laboratory_units").addClass("d-none");
    })

    $("#update_subject_laboratory_units").change(function () {
        $("#update_subject_laboratory_units").removeClass("is-invalid");
        $("#error_update_subject_laboratory_units").addClass("d-none");
    })

    $("#update_subject_lecture_units").keydown(function () {
        $("#update_subject_lecture_units").removeClass("is-invalid");
        $("#error_update_subject_lecture_units").addClass("d-none");
    })

    $("#update_subject_lecture_units").change(function () {
        $("#update_subject_lecture_units").removeClass("is-invalid");
        $("#error_update_subject_lecture_units").addClass("d-none");
    })

    $("#new_subject_course").change(function () {
        const code = $(this).val();

        var formData = new FormData();

        formData.append('code', code);

        $.ajax({
            url: 'get_course_data_by_code',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                const years = parseInt(response.years);

                $("#new_subject_year").removeAttr("disabled");
                $("#new_subject_year").empty();

                for (let i = 1; i <= years; i++) {
                    const optionText = getOrdinalSuffix(i);

                    $("#new_subject_year").append(new Option(optionText, optionText));
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });

        $('#new_subject_pre_requisites').empty();

        var formData_2 = new FormData();

        formData_2.append('course', code);

        $.ajax({
            url: 'get_subject_data_by_course',
            data: formData_2,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (responses) {
                if (responses) {
                    $('#new_subject_pre_requisites').append('<option value disabled selected></option>');

                    $.each(responses, function (_, response) {
                        $('#new_subject_pre_requisites').append('<option value="' + response.id + '">' + response.title + '</option>');
                    });
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#update_subject_course").change(function () {
        const code = $(this).val();

        var formData = new FormData();

        formData.append('code', code);

        $.ajax({
            url: 'get_course_data_by_code',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                const years = parseInt(response.years);

                $("#update_subject_year").removeAttr("disabled");
                $("#update_subject_year").empty();

                for (let i = 1; i <= years; i++) {
                    const optionText = getOrdinalSuffix(i);

                    $("#update_subject_year").append(new Option(optionText, optionText));
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });

        $('#update_subject_pre_requisites').empty();

        var formData_2 = new FormData();

        formData_2.append('course', code);

        $.ajax({
            url: 'get_subject_data_by_course',
            data: formData_2,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (responses) {
                if (responses) {
                    $('#update_subject_pre_requisites').removeAttr("disabled");
                    $('#update_subject_pre_requisites').append('<option value disabled selected></option>');

                    $.each(responses, function (_, response) {
                        $('#update_subject_pre_requisites').append('<option value="' + response.id + '">' + response.title + '</option>');
                    });
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#new_grade_course").change(function () {
        const code = $(this).val();
        const year = $("#new_grade_year").val();
        const semester = $("#new_grade_semester").val();

        $("#new_grade_student_id").removeClass("is-invalid");
        $("#new_grade_course").removeClass("is-invalid");
        $("#new_grade_year").removeClass("is-invalid");
        $("#new_grade_semester").removeClass("is-invalid");
        $("#new_grade_subject_id").removeClass("is-invalid");

        var formData = new FormData();

        formData.append('code', code);

        $.ajax({
            url: 'get_course_data_by_code',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                const years = parseInt(response.years);

                $("#new_grade_year").removeAttr("disabled");
                $("#new_grade_year").empty();

                for (let i = 1; i <= years; i++) {
                    const optionText = getOrdinalSuffix(i);

                    $("#new_grade_year").append(new Option(optionText, optionText));
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });

        $('#new_grade_subject_id').empty();

        if (code && year && semester) {
            var formData_2 = new FormData();

            formData_2.append('course', code);
            formData_2.append('year', year);
            formData_2.append('semester', semester);

            $.ajax({
                url: 'get_subjects',
                data: formData_2,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (responses) {
                    if (responses) {
                        $('#new_grade_subject_id').removeAttr("disabled");
                        $('#new_grade_subject_id').append('<option value disabled selected></option>');

                        $.each(responses, function (_, response) {
                            $('#new_grade_subject_id').append('<option value="' + response.id + '">' + response.title + '</option>');
                        });
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_grade_year").change(function () {
        const course = $("#new_grade_course").val();
        const year = $("#new_grade_year").val();
        const semester = $("#new_grade_semester").val();

        $("#new_grade_student_id").removeClass("is-invalid");
        $("#new_grade_course").removeClass("is-invalid");
        $("#new_grade_year").removeClass("is-invalid");
        $("#new_grade_semester").removeClass("is-invalid");
        $("#new_grade_subject_id").removeClass("is-invalid");

        $('#new_grade_subject_id').empty();

        if (course && year && semester) {
            var formData = new FormData();

            formData.append('course', course);
            formData.append('year', year);
            formData.append('semester', semester);

            $.ajax({
                url: 'get_subjects',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (responses) {
                    if (responses) {
                        $('#new_grade_subject_id').removeAttr("disabled");
                        $('#new_grade_subject_id').append('<option value disabled selected></option>');

                        $.each(responses, function (_, response) {
                            $('#new_grade_subject_id').append('<option value="' + response.id + '">' + response.title + '</option>');
                        });
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_grade_semester").change(function () {
        const course = $("#new_grade_course").val();
        const year = $("#new_grade_year").val();
        const semester = $("#new_grade_semester").val();

        $("#new_grade_student_id").removeClass("is-invalid");
        $("#new_grade_course").removeClass("is-invalid");
        $("#new_grade_year").removeClass("is-invalid");
        $("#new_grade_semester").removeClass("is-invalid");
        $("#new_grade_subject_id").removeClass("is-invalid");

        $('#new_grade_subject_id').empty();

        if (course && year && semester) {
            var formData = new FormData();

            formData.append('course', course);
            formData.append('year', year);
            formData.append('semester', semester);

            $.ajax({
                url: 'get_subjects',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (responses) {
                    if (responses) {
                        $('#new_grade_subject_id').removeAttr("disabled");
                        $('#new_grade_subject_id').append('<option value disabled selected></option>');

                        $.each(responses, function (_, response) {
                            $('#new_grade_subject_id').append('<option value="' + response.id + '">' + response.title + '</option>');
                        });
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_grade_form").submit(function () {
        const student_id = $("#new_grade_student_id").val();
        const course = $("#new_grade_course").val();
        const year = $("#new_grade_year").val();
        const semester = $("#new_grade_semester").val();
        const subject_id = $("#new_grade_subject_id").val();
        const grade = $("#new_grade_grade").val();

        if (parseFloat(grade) < 1.0) {
            $("#new_grade_grade").addClass("is-invalid");
            $("#error_new_grade_grade").removeClass("d-none");

            $("#new_grade_grade").focus();
        } else {
            $(".loading").removeClass("d-none");

            $("#new_grade_submit").text("Please wait...");
            $("#new_grade_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('student_id', student_id);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('semester', semester);
            formData.append('subject_id', subject_id);
            formData.append('grade', grade);

            $.ajax({
                url: 'add_grade',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        location.reload();
                    } else {
                        $("#new_grade_student_id").addClass("is-invalid");
                        $("#new_grade_course").addClass("is-invalid");
                        $("#new_grade_year").addClass("is-invalid");
                        $("#new_grade_semester").addClass("is-invalid");
                        $("#new_grade_subject_id").addClass("is-invalid");

                        $(".loading").addClass("d-none");

                        $("#new_grade_submit").text("Submit");
                        $("#new_grade_submit").removeAttr("disabled");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_grade_grade").keydown(function () {
        $("#new_grade_grade").removeClass("is-invalid");
        $("#error_new_grade_grade").addClass("d-none");
    })

    $("#new_grade_grade").change(function () {
        $("#new_grade_grade").removeClass("is-invalid");
        $("#error_new_grade_grade").addClass("d-none");
    })

    $("#new_grade_student_id").change(function () {
        $("#new_grade_student_id").removeClass("is-invalid");
        $("#new_grade_course").removeClass("is-invalid");
        $("#new_grade_year").removeClass("is-invalid");
        $("#new_grade_semester").removeClass("is-invalid");
        $("#new_grade_subject_id").removeClass("is-invalid");
    })

    $("#new_grade_subject_id").change(function () {
        $("#new_grade_student_id").removeClass("is-invalid");
        $("#new_grade_course").removeClass("is-invalid");
        $("#new_grade_year").removeClass("is-invalid");
        $("#new_grade_semester").removeClass("is-invalid");
        $("#new_grade_subject_id").removeClass("is-invalid");
    })

    $(document).on("click", ".delete_grade", function () {
        const grade_id = $(this).attr("grade_id");

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

                formData.append('grade_id', grade_id);

                $.ajax({
                    url: 'delete_grade',
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

    $(document).on("click", ".edit_grade", function () {
        const grade_id = $(this).attr("grade_id");

        $("#update_grade_modal").modal("show");
        $(".loading").removeClass("d-none");

        var formData = new FormData();

        formData.append('grade_id', grade_id);

        $.ajax({
            url: 'get_grade_data',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                $("#update_grade_student_id").val(response.student_id);
                $("#update_grade_course").val(response.course);

                var formData_2 = new FormData();

                formData_2.append('code', response.course);

                $.ajax({
                    url: 'get_course_data_by_code',
                    data: formData_2,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function (response_2) {
                        const years = parseInt(response_2.years);

                        $("#update_grade_year").removeAttr("disabled");
                        $("#update_grade_year").empty();

                        for (let i = 1; i <= years; i++) {
                            const optionText = getOrdinalSuffix(i);

                            $("#update_grade_year").append(new Option(optionText, optionText));
                        }

                        $("#update_grade_year").val(response.year);

                        $(".loading").addClass("d-none");
                    },
                    error: function (_, _, error) {
                        console.error(error);
                    }
                });

                $("#update_grade_semester").val(response.semester);
                $('#update_grade_subject_id').empty();

                const course = response.course;
                const year = response.year;
                const semester = response.semester;

                if (course && year && semester) {
                    var formData_3 = new FormData();

                    formData_3.append('course', course);
                    formData_3.append('year', year);
                    formData_3.append('semester', semester);

                    $.ajax({
                        url: 'get_subjects',
                        data: formData_3,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function (responses) {
                            if (responses) {
                                $('#update_grade_subject_id').removeAttr("disabled");
                                $('#update_grade_subject_id').append('<option value disabled selected></option>');

                                $.each(responses, function (_, response_3) {
                                    $('#update_grade_subject_id').append('<option value="' + response_3.id + '">' + response_3.title + '</option>');
                                });

                                $('#update_grade_subject_id').val(response.subject_id);
                            }
                        },
                        error: function (_, _, error) {
                            console.error(error);
                        }
                    });
                }

                $("#update_grade_grade").val(response.grade);
                $("#update_grade_id").val(response.id);
                $("#update_grade_old_student_id").val(response.student_id);
                $("#update_grade_old_course").val(response.course);
                $("#update_grade_old_year").val(response.year);
                $("#update_grade_old_semester").val(response.semester);
                $("#update_grade_old_subject_id").val(response.subject_id);

                $(".loading").addClass("d-none");
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $("#update_grade_course").change(function () {
        const code = $(this).val();
        const year = $("#update_grade_year").val();
        const semester = $("#update_grade_semester").val();

        $("#update_grade_student_id").removeClass("is-invalid");
        $("#update_grade_course").removeClass("is-invalid");
        $("#update_grade_year").removeClass("is-invalid");
        $("#update_grade_semester").removeClass("is-invalid");
        $("#update_grade_subject_id").removeClass("is-invalid");

        var formData = new FormData();

        formData.append('code', code);

        $.ajax({
            url: 'get_course_data_by_code',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                const years = parseInt(response.years);

                $("#update_grade_year").removeAttr("disabled");
                $("#update_grade_year").empty();

                for (let i = 1; i <= years; i++) {
                    const optionText = getOrdinalSuffix(i);

                    $("#update_grade_year").append(new Option(optionText, optionText));
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });

        $('#update_grade_subject_id').empty();

        if (code && year && semester) {
            var formData_2 = new FormData();

            formData_2.append('course', code);
            formData_2.append('year', year);
            formData_2.append('semester', semester);

            $.ajax({
                url: 'get_subjects',
                data: formData_2,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (responses) {
                    if (responses) {
                        $('#update_grade_subject_id').removeAttr("disabled");
                        $('#update_grade_subject_id').append('<option value disabled selected></option>');

                        $.each(responses, function (_, response) {
                            $('#update_grade_subject_id').append('<option value="' + response.id + '">' + response.title + '</option>');
                        });
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#update_grade_year").change(function () {
        const course = $("#update_grade_course").val();
        const year = $("#update_grade_year").val();
        const semester = $("#update_grade_semester").val();

        $("#update_grade_student_id").removeClass("is-invalid");
        $("#update_grade_course").removeClass("is-invalid");
        $("#update_grade_year").removeClass("is-invalid");
        $("#update_grade_semester").removeClass("is-invalid");
        $("#update_grade_subject_id").removeClass("is-invalid");

        $('#update_grade_subject_id').empty();

        if (course && year && semester) {
            var formData = new FormData();

            formData.append('course', course);
            formData.append('year', year);
            formData.append('semester', semester);

            $.ajax({
                url: 'get_subjects',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (responses) {
                    if (responses) {
                        $('#update_grade_subject_id').removeAttr("disabled");
                        $('#update_grade_subject_id').append('<option value disabled selected></option>');

                        $.each(responses, function (_, response) {
                            $('#update_grade_subject_id').append('<option value="' + response.id + '">' + response.title + '</option>');
                        });
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#update_grade_semester").change(function () {
        const course = $("#update_grade_course").val();
        const year = $("#update_grade_year").val();
        const semester = $("#update_grade_semester").val();

        $("#update_grade_student_id").removeClass("is-invalid");
        $("#update_grade_course").removeClass("is-invalid");
        $("#update_grade_year").removeClass("is-invalid");
        $("#update_grade_semester").removeClass("is-invalid");
        $("#update_grade_subject_id").removeClass("is-invalid");

        $('#update_grade_subject_id').empty();

        if (course && year && semester) {
            var formData = new FormData();

            formData.append('course', course);
            formData.append('year', year);
            formData.append('semester', semester);

            $.ajax({
                url: 'get_subjects',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (responses) {
                    if (responses) {
                        $('#update_grade_subject_id').removeAttr("disabled");
                        $('#update_grade_subject_id').append('<option value disabled selected></option>');

                        $.each(responses, function (_, response) {
                            $('#update_grade_subject_id').append('<option value="' + response.id + '">' + response.title + '</option>');
                        });
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#update_grade_grade").keydown(function () {
        $("#update_grade_grade").removeClass("is-invalid");
        $("#error_update_grade_grade").addClass("d-none");
    })

    $("#update_grade_grade").change(function () {
        $("#update_grade_grade").removeClass("is-invalid");
        $("#error_update_grade_grade").addClass("d-none");
    })

    $("#update_grade_student_id").change(function () {
        $("#update_grade_student_id").removeClass("is-invalid");
        $("#update_grade_course").removeClass("is-invalid");
        $("#update_grade_year").removeClass("is-invalid");
        $("#update_grade_semester").removeClass("is-invalid");
        $("#update_grade_subject_id").removeClass("is-invalid");
    })

    $("#update_grade_subject_id").change(function () {
        $("#update_grade_student_id").removeClass("is-invalid");
        $("#update_grade_course").removeClass("is-invalid");
        $("#update_grade_year").removeClass("is-invalid");
        $("#update_grade_semester").removeClass("is-invalid");
        $("#update_grade_subject_id").removeClass("is-invalid");
    })

    $("#update_grade_form").submit(function () {
        const student_id = $("#update_grade_student_id").val();
        const course = $("#update_grade_course").val();
        const year = $("#update_grade_year").val();
        const semester = $("#update_grade_semester").val();
        const subject_id = $("#update_grade_subject_id").val();
        const grade = $("#update_grade_grade").val();

        const id = $("#update_grade_id").val();
        const old_student_id = $("#update_grade_old_student_id").val();
        const old_course = $("#update_grade_old_course").val();
        const old_year = $("#update_grade_old_year").val();
        const old_semester = $("#update_grade_old_semester").val();
        const old_subject_id = $("#update_grade_old_subject_id").val();

        let is_edited = false;

        if ((student_id != old_student_id) || (course != old_course) || (year != old_year) || (semester != old_semester) || (subject_id != old_subject_id)) {
            is_edited = true;
        }

        if (parseFloat(grade) < 1.0) {
            $("#update_grade_grade").addClass("is-invalid");
            $("#error_update_grade_grade").removeClass("d-none");

            $("#update_grade_grade").focus();
        } else {
            $(".loading").removeClass("d-none");

            $("#update_grade_submit").text("Please wait...");
            $("#update_grade_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('id', id);
            formData.append('is_edited', is_edited);
            formData.append('student_id', student_id);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('semester', semester);
            formData.append('subject_id', subject_id);
            formData.append('grade', grade);

            $.ajax({
                url: 'update_grade',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        location.reload();
                    } else {
                        $("#update_grade_student_id").addClass("is-invalid");
                        $("#update_grade_course").addClass("is-invalid");
                        $("#update_grade_year").addClass("is-invalid");
                        $("#update_grade_semester").addClass("is-invalid");
                        $("#update_grade_subject_id").addClass("is-invalid");

                        $(".loading").addClass("d-none");

                        $("#update_grade_submit").text("Submit");
                        $("#update_grade_submit").removeAttr("disabled");
                    }
                },
                error: function (_, _, error) {
                    console.error(error);
                }
            });
        }
    })

    $("#new_achievement_form").submit(function () {
        const student_number = $("#new_achievement_student_number").val();
        const title = $("#new_achievement_title").val();
        const description = $("#new_achievement_description").val();
        const date_awarded = $("#new_achievement_date_awarded").val();

        $(".loading").removeClass("d-none");

        $("#new_achievement_submit").text("Please wait...");
        $("#new_achievement_submit").attr("disabled", true);

        var formData = new FormData();

        formData.append('student_number', student_number);
        formData.append('title', title);
        formData.append('description', description);
        formData.append('date_awarded', date_awarded);

        $.ajax({
            url: 'new_achievement',
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

    $("#update_achievement_form").submit(function () {
        const id = $("#update_achievement_id").val();
        const student_number = $("#update_achievement_student_number").val();
        const title = $("#update_achievement_title").val();
        const description = $("#update_achievement_description").val();
        const date_awarded = $("#update_achievement_date_awarded").val();

        $(".loading").removeClass("d-none");

        $("#update_achievement_submit").text("Please wait...");
        $("#update_achievement_submit").attr("disabled", true);

        var formData = new FormData();

        formData.append('id', id);
        formData.append('student_number', student_number);
        formData.append('title', title);
        formData.append('description', description);
        formData.append('date_awarded', date_awarded);

        $.ajax({
            url: 'update_achievement',
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

    $(document).on("click", ".update_achievement", function () {
        const id = $(this).attr("update_achievement_id");

        $(".loading").removeClass("d-none");

        $("#update_achievement_modal").modal("show");

        var formData = new FormData();

        formData.append('id', id);

        $.ajax({
            url: 'get_achievement_data',
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    $("#update_achievement_id").val(response.id);
                    $("#update_achievement_student_number").val(response.student_number);
                    $("#update_achievement_title").val(response.title);
                    $("#update_achievement_description").val(response.description);
                    $("#update_achievement_date_awarded").val(response.date_awarded);

                    $(".loading").addClass("d-none");
                }
            },
            error: function (_, _, error) {
                console.error(error);
            }
        });
    })

    $(document).on("click", ".delete_achievement", function () {
        const id = $(this).attr("update_achievement_id");

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

                formData.append('id', id);

                $.ajax({
                    url: 'delete_achievement',
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

    function getOrdinalSuffix(n) {
        const s = ["th", "st", "nd", "rd"], v = n % 100;

        return n + (s[(v - 20) % 10] || s[v] || s[0]);
    }
})