<?= $this->extend('layout' . user()->user_type); ?>
<?= $this->section('main'); ?>
<!-- Begin Page Content -->
<div class="row">
    <div class="col-12 row">
        <div class="col-sm-6">
            <h2><?= $title ?></h2>
        </div>
        <div class="col-sm-6 text-right">
            <span><a href="<?= base_url('petugas/periksa') ?>" class="text-primary">
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
                <h4 class="widget-title">Detail Pengukuran</h4>
            </header><!-- .widget-header -->
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <th>Usia Ukur</th>
                                <td><?= $detail->hasilukur_umur ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Ukur</th>
                                <td><?= $detail->hasilukur_tgl ?></td>
                            </tr>
                            <tr>
                                <th>Posisi</th>
                                <td><?= $detail->hasilukur_posisi ?></td>
                            </tr>
                            <tr>
                                <th>Berat Badan</th>
                                <td><?= $detail->hasilukur_bb ?> kg</td>
                            </tr>
                            <tr>
                                <th>Tinggi/Panjang Badan</th>
                                <td><?= $detail->hasilukur_pbtb ?> cm</td>
                            </tr>
                            <tr>
                                <th>Lingkar Kepala</th>
                                <td><?= $detail->hasilukur_lk ?> cm</td>
                            </tr>
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