<?= $this->extend('layout' . user()->user_type); ?>
<?= $this->section('main'); ?>
<!-- Begin Page Content -->
<div class="row">
    <div class="col-12 row">
        <div class="col-sm-6">
            <h2><?= $title ?></h2>
        </div>
        <div class="col-sm-6 text-right">
            <span><a href="<?= base_url(user()->user_type . '/balita') ?>" class="text-primary">
                    << Kembali</a></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Detail Balita</h4>
            </header><!-- .widget-header -->
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th>Nama balita</th>
                                <td><?= $balita->balita_nama ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td><?= $balita->balita_jk ?></td>
                            </tr>
                            <tr>
                                <th>Umur</th>
                                <td><?= $balita->balita_umur ?> Bulan</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
    <div class="col-md-6">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Riwayat Pengukuran</h4>
            </header><!-- .widget-header -->
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">No</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Usia Pengukuran (Bln)</th>
                                    <th>BB</th>
                                    <th>Tinggi/Panjang Badan</th>
                                    <th>Lingkar Kepala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($hasilukur as $h) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= konversiBulan($h->periode_bulan) ?></td>
                                        <td><?= $h->periode_tahun ?></td>
                                        <td><?= $h->hasilukur_umur ?></td>
                                        <td><?= $h->hasilukur_bb ?> Kg</td>
                                        <td><?= $h->hasilukur_pbtb ?> Cm</td>
                                        <td><?= $h->hasilukur_lk ?> Cm</td>
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
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?= $this->endSection(); ?>