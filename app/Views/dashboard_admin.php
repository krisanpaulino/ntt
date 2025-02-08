<?= $this->extend('layout' . user()->user_type); ?>
<?= $this->section('main'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (session()->has('danger')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session('danger') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->has('danger')) : ?>
            <?php endif; ?>

        </div>
    </div>
    <div class="row">

        <div class="col-md-3 col-sm-6">
            <div class="widget stats-widget">
                <div class="widget-body clearfix">
                    <div class="pull-left">
                        <h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp"><?= $jumlah_balita->jumlah ?></span></h3>
                        <small class="text-color">Jumlah Balita</small>
                    </div>
                    <span class="pull-right big-icon watermark"><i class="fa fa-paperclip"></i></span>
                </div>
            </div><!-- .widget -->
        </div>

    </div>



</div>
<!-- /.container-fluid -->


<!-- End of Main Content -->


<?= $this->endSection(); ?>