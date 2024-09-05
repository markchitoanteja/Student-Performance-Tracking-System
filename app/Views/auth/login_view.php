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
    <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/login.css">
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
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>public/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>public/dist/js/adminlte.min.js"></script>
    <!-- <script src="<?= base_url() ?>public/dist/js/login.min.js"></script> -->
    <script src="<?= base_url() ?>public/dist/js/login.js"></script>
</body>

</html>

<?php session()->remove("notification") ?>