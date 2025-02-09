<?= $this->extend('layout' . user()->user_type); ?>
<?= $this->section('main'); ?>
<!-- Begin Page Content -->
<div class="row">
    <div class="col-md-12 row">
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
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Data bayi.
                    </small>
                </div>
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
    <div class="col-md-8">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Pengukuran Bayi</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Silahkan mengisi data pengukuran pada form di bawah.
                    </small>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form action="<?= base_url('petugas/periksa/store') ?>" method="post">
                            <input type="hidden" name="periode_id" value="<?= $periode->periode_id ?>">
                            <input type="hidden" name="balita_id" value="<?= $balita->balita_id ?>">
                            <?= csrf_field() ?>

                            <div class="form-group mb-4">
                                <label for="hasilukur_tgl">Tanggal Ukur</label>
                                <input type="date" class="form-control <?= (isset(session('errors')['hasilukur_tgl'])) ? 'is-invalid' : '' ?>" id="hasilukur_tgl" name="hasilukur_tgl" value="<?= old('hasilukur_tgl', date('Y-m-d')) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['hasilukur_tgl'])) : ?>
                                        <?= session('errors')['hasilukur_tgl'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="hasilukur_posisi">Posisi</label>
                                <select class="form-control <?= (isset(session('errors')['hasilukur_posisi'])) ? 'is-invalid' : '' ?>" id="hasilukur_posisi" name="hasilukur_posisi" required>
                                    <option value="B">Berdiri</option>
                                    <option value="T">Tidur</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['hasilukur_posisi'])) : ?>
                                        <?= session('errors')['hasilukur_posisi'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="hasilukur_bb">Berat Badan (Kg)</label>
                                <input type="number" step="0.1" class="form-control <?= (isset(session('errors')['hasilukur_bb'])) ? 'is-invalid' : '' ?>" id="hasilukur_bb" name="hasilukur_bb" value="<?= old('hasilukur_bb') ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['hasilukur_bb'])) : ?>
                                        <?= session('errors')['hasilukur_bb'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="hasilukur_pbtb">Tinggi/Panjang Badan (Cm)</label>
                                <input type="number" class="form-control <?= (isset(session('errors')['hasilukur_pbtb'])) ? 'is-invalid' : '' ?>" step="0.1" id="hasilukur_pbtb" name="hasilukur_pbtb" value="<?= old('hasilukur_pbtb') ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['hasilukur_pbtb'])) : ?>
                                        <?= session('errors')['hasilukur_pbtb'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="hasilukur_lk">Lingkar Kepala (Cm)</label>
                                <input type="number" class="form-control <?= (isset(session('errors')['hasilukur_lk'])) ? 'is-invalid' : '' ?>" step="0.1" id="hasilukur_lk" name="hasilukur_lk" value="<?= old('hasilukur_lk') ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['hasilukur_lk'])) : ?>
                                        <?= session('errors')['hasilukur_lk'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->
<!-- /.container-fluid -->
<!-- End of Main Content -->
<?= $this->endSection(); ?>