<?= $this->extend('layout' . user()->user_type); ?>
<?= $this->section('main'); ?>
<!-- Begin Page Content -->
<div class="row">
    <div class="col-md-12">
        <h2><?= $title ?></h2>
    </div>
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Data Bayi Belum Diperiksa</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg row">
                    <!-- <small>
                        Data Arsip
                    </small> -->

                    <div class="col-md-12">
                        <div class="table-responsive mt-2">
                            <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nama Balita</th>
                                        <th>JK</th>
                                        <th>Tgl Lahir</th>
                                        <th>Nama Orangtua</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($belum_periksa as $b) : ?>
                                        <tr>
                                            <td><?= $b->balita_nama ?></td>
                                            <td><?= $b->balita_jk ?></td>
                                            <td><?= $b->balita_tgllahir ?></td>
                                            <td><?= $b->balita_orangtua ?></td>
                                            <td>
                                                <a href="<?= base_url(session('user')->user_type . '/periksa/' . $b->balita_id) ?>" class="badge bg-primary">Periksa</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Data Bayi Sudah Diperiksa</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg row">
                    <!-- <small>
                        Data Arsip
                    </small> -->

                    <div class="col-md-12">
                        <div class="table-responsive mt-2">
                            <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nama Balita</th>
                                        <th>JK</th>
                                        <th>Tgl Lahir</th>
                                        <th>Nama Orangtua</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($sudah_periksa as $b) : ?>
                                        <tr>
                                            <td><?= $b->balita_nama ?></td>
                                            <td><?= $b->balita_jk ?></td>
                                            <td><?= $b->balita_tgllahir ?></td>
                                            <td><?= $b->balita_orangtua ?></td>
                                            <td>
                                                <a href="<?= base_url(session('user')->user_type . '/periksa/detail/' . $b->balita_id) ?>" class="badge bg-primary">Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div><!-- .row -->
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?= $this->endSection(); ?>