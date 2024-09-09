<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= base_url() ?>public/dist/img/favicon.ico" type="image/x-icon">

    <title>Student Performance Tracking System | <?= session()->get("title") ?></title>

    <link rel="stylesheet" href="<?= base_url() ?>public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/plugins/sweetalert2/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/plugins/select2/css/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/fonts.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed <?= session()->get("mode") == "dark" ? "dark-mode" : null ?>">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url() ?>public/dist/img/logo.png" alt="ESSU Logo" height="60" width="60">
            <span>ESSU Can-Avid</span>
        </div>

        <nav class="main-header navbar navbar-expand <?= session()->get("mode") == "dark" ? "navbar-dark" : "navbar-light" ?>">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)">
                        <i class="fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item" id="account_settings">
                            <i class="fas fa-user mr-2"></i> Account Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item" id="mode">
                            <i class="fas fa-<?= session()->get("mode") == "dark" ? "sun" : "moon" ?> mr-2"></i> <?= session()->get("mode") == "dark" ? "Light Mode" : "Dark Mode" ?>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item logout">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-<?= session()->get("mode") == "dark" ? "dark" : "light" ?>-primary elevation-4">
            <a href="<?= base_url() ?>" class="brand-link">
                <img src="<?= base_url() ?>public/dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Performance Tracking</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>public/dist/img/uploads/admin/<?= $user_data["image"] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <span class="d-block text-truncate"><?= $user_data["name"] ?></span>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>dashboard" class="nav-link <?= session()->get("current_page") == "dashboard" ? "active" : null ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>manage_student_records" class="nav-link <?= session()->get("current_page") == "manage_student_records" ? "active" : null ?>">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>Manage Student Records</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>course_management" class="nav-link <?= session()->get("current_page") == "course_management" ? "active" : null ?>">
                                <i class="nav-icon fas fa-book-open"></i>
                                <p>Course Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>subject_management" class="nav-link <?= session()->get("current_page") == "subject_management" ? "active" : null ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Subject Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>grade_management" class="nav-link <?= session()->get("current_page") == "grade_management" ? "active" : null ?>">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Grade Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link logout">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>