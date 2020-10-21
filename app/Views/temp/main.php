<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Latihan</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.ico">

    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet" type="text/css">


    <!-- Fontawesome -->
    <link href="<?= base_url() ?>/assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="<?= base_url() ?>/assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- SweetAlert -->
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2/dist/sweetalert2.min.css" type="text/css">

    <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/datatables/new/responsive.dataTables.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/datatables/new/rowReorder.dataTables.min.css" rel="stylesheet"
        type="text/css" />

    <link href="<?= base_url() ?>/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <!-- Required datatable js -->
    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/new/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/new/dataTables.rowReorder.min.js"></script>


</head>


<body>

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">
                    <!-- Text Logo -->
                    <!--<a href="index.html" class="logo">-->
                    <!--Annex-->
                    <!--</a>-->
                    <!-- Image Logo -->
                    <a href="index.html" class="logo">
                        <img src="<?= base_url() ?>/assets/images/jn.png" alt="" height="22" class="logo-small">
                        <img src="<?= base_url() ?>/assets/images/jn.png" alt="" height="50" class="logo-large">
                    </a>

                </div>
                <!-- End Logo container-->


                <div class="menu-extras topbar-custom">

                    <ul class="list-inline float-right mb-0">

                        <!-- User-->
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url() ?>/assets/images/user-avatar.png" alt="user"
                                    class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5>Selamat Datang</h5>
                                </div>
                                <?php
                                $session = \Config\Services::session();

                                if ($session->get('login') == TRUE) {
                                ?>
                                <a class="dropdown-item" href="<?= site_url('/login/keluar') ?>"><i
                                        class="mdi mdi-logout m-r-5 text-muted"></i>
                                    Logout</a>
                                <?php
                                }
                                ?>
                            </div>
                        </li>

                    </ul>
                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <!-- MENU Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">

                        <li class="has-submenu">
                            <a href="<?= site_url('/home') ?>"><i class="mdi mdi-airplay"></i>Beranda</a>
                        </li>

                        <?php
                        $session = \Config\Services::session();

                        if ($session->get('login') == TRUE) {
                        ?>
                        <li class="has-submenu">
                            <a href="<?= site_url('/pasien') ?>"><i class="fa fa-users"></i> Pasien</a>
                        </li>

                        <li class="has-submenu">
                            <a href="<?= site_url('/penyakit') ?>"><i class="fa fa-tasks"></i> Penyakit</a>
                        </li>
                        <li class="has-submenu">
                            <a href="<?= site_url('/kamar') ?>"><i class="fa fa-hospital"></i> Kamar</a>
                        </li>
                        <li class="has-submenu">
                            <a href="<?= site_url('/rawatinap/input') ?>"><i class="fa fa-procedures"></i> Rawat
                                Inap</a>
                        </li>
                        <?php } ?>
                    </ul>
                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->


    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">
                            <?= $this->renderSection('judul') ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <?= $this->renderSection('isi') ?>
            </div>
            <!-- end page title end breadcrumb -->

        </div> <!-- end container -->
    </div>
    <!-- end wrapper -->


    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    © 2020, Create By : Novinaldi
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


    <!-- jQuery  -->
    <script src="<?= base_url() ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/modernizr.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/waves.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.nicescroll.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>

</html>