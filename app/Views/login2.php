<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Posyandu</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin, Dashboard, Bootstrap" />
    <link rel="shortcut icon" sizes="196x196" href="<?= base_url('assets') ?>/images/logo.png">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/core.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/misc-pages.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>

<body class="simple-page">
    <!-- <div id="back-to-home">
        <a href="index.html" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
    </div> -->
    <div class="simple-page-wrap">
        <div class="simple-page-logo animated swing">
            <a href="index.html">
                <span><img src="<?= base_url('assets/images/logo_big.png') ?>" alt=""></span>
                <span>Posyandu NTT</span>
            </a>
        </div><!-- logo -->
        <div class="simple-page-form" id="login-form">
            <h4 class="form-title m-b-xl text-center">Silahkan Sign In Menggunakan Akun Anda</h4>
            <?php if (session()->has('danger')) : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span><?= session('danger') ?></span>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <input id="sign-in-email" name="email" type="email" class="form-control" placeholder="username">
                </div>

                <div class="form-group">
                    <input id="sign-in-password" type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <!-- <div class="form-group m-b-xl">
                    <div class="checkbox checkbox-primary">
                        <input type="checkbox" id="keep_me_logged_in" />
                        <label for="keep_me_logged_in">Keep me signed in</label>
                    </div>
                </div> -->
                <input type="submit" class="btn btn-primary" value="SIGN IN">
            </form>
        </div><!-- #login-form -->

        <div class="simple-page-footer">
            <p><a href="#">Lupa Password ? Hubungi admin</a></p>
            <!-- <p>
                <small>Don't have an account ?</small>
                <a href="signup.html">CREATE AN ACCOUNT</a>
            </p> -->
        </div><!-- .simple-page-footer -->


    </div><!-- .simple-page-wrap -->
</body>

</html>