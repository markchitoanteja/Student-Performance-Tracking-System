<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= base_url() ?>public/dist/img/favicon.ico" type="image/x-icon">

    <title>Student Performance Tracking System | Login</title>

    <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/fonts.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/login.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <?php if (session()->get("notification")): ?>
            <div class="alert <?= session()->get("notification")["type"] ?> text-center"><?= session()->get("notification")["message"] ?></div>
        <?php endif ?>

        <div class="alert alert-danger text-center d-none" id="login_notification">Invalid Username or Password</div>

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="<?= base_url() ?>public/dist/img/logo.png" alt="ESSU Logo" style="width: 128px; height: 128px;">

                <div class="h3 mt-3">
                    <b>Student Performance Tracking</b>
                </div>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to continue</p>

                <form action="javascript:void(0)" id="login_form">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" id="login_username" value="<?= session()->get("username") ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-2">
                        <input type="password" class="form-control" placeholder="Password" id="login_password" value="<?= session()->get("password") ?>" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="login_remember_me">
                                <label for="login_remember_me">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" id="login_submit">Login</button>
                </form>
                <p class="mt-3 mb-0">
                    <span>Add another Admin?</span>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#new_admin_modal">Click Here</a>
                </p>
            </div>
        </div>
    </div>

    <!-- New Admin Modal -->
    <div class="modal fade" id="new_admin_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="overlay d-none loading">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">Account Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)" id="new_admin_form">
                    <div class="modal-body">
                        <div class="sign-up-form">
                            <div class="text-center mb-3">
                                <img id="new_admin_image_display" src="<?= base_url() ?>public/dist/img/uploads/admin/default-user-image.png" class="rounded-circle" alt="User Image" style="width: 100px; height: 100px;">
                            </div>
                            <div class="form-group text-center">
                                <label for="new_admin_image">Upload Image</label>
                                <input type="file" class="form-control-file" id="new_admin_image" accept="image/*">
                                <small class="text-danger d-none" id="error_new_admin_image">Image is required!</small>
                            </div>
                            <div class="form-group">
                                <label for="new_admin_name">Name</label>
                                <input type="text" class="form-control" id="new_admin_name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="new_admin_username">Username</label>
                                <input type="text" class="form-control" id="new_admin_username" placeholder="Enter your username">
                                <small class="text-danger d-none" id="error_new_admin_username">Username is already in use</small>
                            </div>
                            <div class="form-group">
                                <label for="new_admin_password">Password</label>
                                <input type="password" class="form-control" id="new_admin_password" placeholder="Enter your password">
                                <small class="text-danger d-none" id="error_new_admin_password">Passwords do not match</small>
                            </div>
                            <div class="form-group">
                                <label for="new_admin_confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="new_admin_confirm_password" placeholder="Confirm your password">
                            </div>
                        </div>
                        <div class="confirm-admin d-none">
                            <h5 class="text-center">Requires Admin Confirmation</h5>

                            <div class="form-group">
                                <label for="new_admin_confirmation_username">Username</label>
                                <input type="text" class="form-control" id="new_admin_confirmation_username">
                                <small class="text-danger d-none" id="error_new_admin_confirmation_username"></small>
                            </div>
                            <div class="form-group">
                                <label for="new_admin_confirmation_password">Password</label>
                                <input type="password" class="form-control" id="new_admin_confirmation_password">
                                <small class="text-danger d-none" id="error_new_admin_confirmation_password"></small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="new_admin_next">Next</button>
                        <button type="submit" class="btn btn-primary d-none" id="new_admin_submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var base_url = "<?= base_url() ?>";
    </script>

    <script src="<?= base_url() ?>public/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>public/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url() ?>public/dist/js/login.js?v=1.0.3"></script>
</body>

</html>

<?php session()->remove("notification") ?>