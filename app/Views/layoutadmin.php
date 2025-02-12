<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="<?= base_url('assets') ?>/images/logo.png">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css <?= base_url('assets') ?>/css/app.min.css -->
    <link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/libs') ?>/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <?= $this->renderSection('cssplugins'); ?>
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/core.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/app.css">
    <!-- endbuild -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    <script src="<?= base_url('assets/libs') ?>/bower/breakpoints.js/dist/breakpoints.min.js"></script>
    <script>
        Breakpoints();
    </script>
    <style>
        .badge {
            border: none;
        }
    </style>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <!-- APP NAVBAR ==========-->
    <nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">

        <!-- navbar header -->
        <div class="navbar-header">

            <a href="<?= base_url('dashboard') ?>" class="navbar-brand">
                <span class="brand-icon"><img class="img-responsive" src="<?= base_url('assets/images/logo_big.png') ?>" alt=""></span>
                <span class="brand-name">Posyandu Ntt</span>
            </a>
        </div><!-- .navbar-header -->

        <div class="navbar-container container-fluid">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
                    <li class="hidden-float hidden-menubar-top">
                        <a href="javascript:void(0)" role="button" id="menubar-fold-btn" class="hamburger hamburger--arrowalt is-active js-hamburger">
                            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                        </a>
                    </li>
                    <li>
                        <h5 class="page-title hidden-menubar-top hidden-float"><?= $title ?></h5>
                    </li>
                </ul>
            </div>
        </div><!-- navbar-container -->
    </nav>
    <!--========== END app navbar -->

    <!-- APP ASIDE ==========-->
    <aside id="menubar" class="menubar light">
        <div class="app-user">
            <div class="media">
                <div class="media-left">
                    <div class="avatar avatar-md avatar-circle">
                        <a href="javascript:void(0)"><img class="img-responsive" src="<?= base_url('assets') ?>/images/admin.png" alt="avatar" /></a>
                    </div><!-- .avatar -->
                </div>
                <div class="media-body">
                    <div class="foldable">
                        <h5><a href="javascript:void(0)" class="username"><?= admin()->kelurahan_nama ?></a></a></h5>
                        <ul>
                            <li class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <small><?= user()->user_type ?></small>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu animated flipInY">
                                    <li>
                                        <a class="text-color" href="<?= base_url('ganti-password') ?>">
                                            <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                                            <span>Ubah Password</span>
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a class="text-color" data-toggle="modal" data-target="#logout" href="javascript:void(0)">
                                            <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div><!-- .media-body -->
            </div><!-- .media -->
        </div><!-- .app-user -->

        <div class="menubar-scroll">
            <div class="menubar-scroll-inner">
                <ul class="app-menu">
                    <li>
                        <a href="<?= base_url('admin') ?>">
                            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/periode') ?>">
                            <i class="menu-icon fa fa-clock-o"></i>
                            <span class="menu-text">Periode Ukur</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/posyandu') ?>">
                            <i class="menu-icon fa fa-institution "></i>
                            <span class="menu-text">Posyandu</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/dusun') ?>">
                            <i class="menu-icon fa fa-institution "></i>
                            <span class="menu-text">Dusun</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/balita') ?>">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text">Balita</span>
                        </a>
                    </li>
                    <li class="menu-separator">
                        <a class="text-muted">
                            <small><strong class="text-muted">USER</strong></small>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/petugas') ?>">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">Petugas Posyandu</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/petugas-desa') ?>">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">Petugas Desa/Kel.</span>
                        </a>
                    </li>

                    <li class="menu-separator">
                        <hr>
                    </li>
                </ul><!-- .app-menu -->
            </div><!-- .menubar-scroll-inner -->
        </div><!-- .menubar-scroll -->
    </aside>
    <!--========== END app aside -->


    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?= session('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->has('danger')) : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?= session('danger') ?>
                    </div>
                <?php endif; ?>
                <?= $this->renderSection('main'); ?>
                <div class="modal fade in" id="logout" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('logout') ?>" method="post">
                                <div class="modal-body">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" id="kodeitem" class="d-flex d-none">
                                    <h5>Anda yakin ingin logout?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section><!-- #dash-content -->
        </div><!-- .wrap -->
        <!-- APP FOOTER -->
        <!-- <div class="wrap p-t-0">
            <footer class="app-footer">
                <div class="clearfix">
                    <ul class="footer-menu pull-right">
                        <li><a href="javascript:void(0)">Careers</a></li>
                        <li><a href="javascript:void(0)">Privacy Policy</a></li>
                        <li><a href="javascript:void(0)">Feedback <i class="fa fa-angle-up m-l-md"></i></a></li>
                    </ul>
                    <div class="copyright pull-left">Copyright RaThemes 2016 &copy;</div>
                </div>
            </footer>
        </div> -->
        <!-- /#app-footer -->
    </main>
    <!--========== END app main -->


    <!-- build:js <?= base_url('assets') ?>/js/core.min.js -->
    <script src="<?= base_url('assets/libs') ?>/bower/jquery/dist/jquery.js"></script>
    <script src="<?= base_url('assets/libs') ?>/bower/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url('assets/libs') ?>/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
    <script src="<?= base_url('assets/libs') ?>/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
    <script src="<?= base_url('assets/libs') ?>/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?= base_url('assets/libs') ?>/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="<?= base_url('assets/libs') ?>/bower/PACE/pace.min.js"></script>
    <!-- endbuild -->
    <!-- Conditional Plugins -->
    <?= $this->renderSection('jsplugins') ?>

    <!-- build:js <?= base_url('assets') ?>/js/app.min.js -->
    <script src="<?= base_url('assets') ?>/js/library.js"></script>
    <script src="<?= base_url('assets') ?>/js/plugins.js"></script>
    <script src="<?= base_url('assets') ?>/js/app.js"></script>
    <!-- endbuild -->
    <script src="<?= base_url('assets/libs') ?>/bower/moment/moment.js"></script>
    <script src="<?= base_url('assets/libs') ?>/bower/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/fullcalendar.js"></script>
    <?= $this->renderSection('scripts'); ?>
    <script>
        function doPoll() {
            // Get the JSON

            $.ajax({
                url: '<?= base_url('notifikasi') ?>',
                type: 'get',
                success: function(data) {

                    if (data != null) {
                        // Yeah, there is a new notification! Show it to the user
                        data.forEach(row => {
                            const notification = new Notification(row.notifikasi_judul, {
                                body: row.notifikasi_isi
                            });
                            notification.onclick = function() {
                                window.open('<?= base_url('admin/pinjam/request') ?>');
                            };
                            read(row.notifikasi_id)
                        });

                    }
                    // Retry after a second
                    setTimeout(doPoll, 5000);
                },
                dataType: "json"
            });
        }

        function getUnconfirmed() {
            // Get the JSON

            $.ajax({
                url: '<?= base_url('unconfirmed') ?>',
                type: 'get',
                success: function(data) {
                    if (data.count > 0) {
                        $('#notif1').text(data.count);
                        $('#notif2').text(data.count);
                    } else {
                        $('#notif1').text('');
                        $('#notif2').text('');
                    }
                    // Retry after a second
                    setTimeout(getUnconfirmed, 5000);
                },
                dataType: "json"
            });
        }

        function read(id) {
            // Get the JSON

            $.ajax({
                url: '<?= base_url('notifikasi/read/') ?>/' + id,
                type: 'get',
                success: function(data) {
                    // Retry after a second
                    // setTimeout(doPoll, 5000);
                },
                dataType: "json"
            });
        }
        if (Notification.permission !== "granted") {
            // Request permission to send browser notifications
            Notification.requestPermission().then(function(result) {
                if (result === 'default') {
                    // Permission granted
                    doPoll();
                }
            });
        } else {
            doPoll();
        }
        getUnconfirmed();
    </script>

</body>

</html>