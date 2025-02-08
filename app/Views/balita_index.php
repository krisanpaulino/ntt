<?= $this->extend('layout' . user()->user_type); ?>
<?= $this->section('main'); ?>
<!-- Begin Page Content -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title"><?= $title ?></h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg row">
                    <!-- <small>
                        Data Arsip
                    </small> -->

                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mb-4 waves-effect waves-light" data-toggle="modal" data-target="#tambah">Tambah</button>
                        </div>
                        <br><br>
                        <div class="table-responsive mt-2">
                            <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Dusun/ Desa</th>
                                        <th>Nama Balita</th>
                                        <th>JK</th>
                                        <th>Tgl Lahir</th>
                                        <th>OrangTua</th>
                                        <th>Umur(bln)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($balita as $b) : ?>
                                        <tr>
                                            <td><?= $b->dusun_nama ?>, <?= $b->kelurahan_nama ?></td>
                                            <td><?= $b->balita_nama ?></td>
                                            <td><?= $b->balita_jk ?></td>
                                            <td><?= $b->balita_tgllahir ?></td>
                                            <td><?= $b->balita_orangtua ?></td>
                                            <td><?= $b->balita_umur ?></td>
                                            <td>
                                                <form action="<?= base_url(session('user')->user_type . '/balita/hapus') ?>" method="post">
                                                    <input type="hidden" name="balita_id" value="<?= $b->balita_id ?>">
                                                    <a href="<?= base_url(session('user')->user_type . '/balita/' . $b->balita_id) ?>" class="badge bg-primary">Detail</a>
                                                    <button type="submit" class="badge bg-danger border" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                                </form>
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
<form action="<?= base_url(session('user')->user_type . '/balita/tambah') ?>" method="post" autocomplete="off">
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="balita_nama">Nama Balita</label>
                        <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control <?= (isset(session('errors')['balita_nama'])) ? 'is-invalid' : '' ?>" id="balita_nama" name="balita_nama" value="<?= old('balita_nama') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['balita_nama'])) : ?>
                                <?= session('errors')['balita_nama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="balita_jk">Jenis Kelamin</label>
                        <select class="form-control <?= (isset(session('errors')['balita_jk'])) ? 'is-invalid' : '' ?>" id="balita_jk" name="balita_jk" required>
                            <option value="">Pilih JK</option>
                            <option value="L" <?= (old('balita_jk' == 'L')) ? 'selected' : '' ?>>Laki-Laki</option>
                            <option value="P" <?= (old('balita_jk' == 'P')) ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['balita_jk'])) : ?>
                                <?= session('errors')['balita_jk'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="balita_tgllahir">Tgl Lahir Balita</label>
                        <input type="text" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd-mm-yyyy" class="form-control input-mask <?= (isset(session('errors')['balita_tgllahir'])) ? 'is-invalid' : '' ?>" id="balita_tgllahir" name="balita_tgllahir" value="<?= old('balita_tgllahir') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['balita_tgllahir'])) : ?>
                                <?= session('errors')['balita_tgllahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tgldaftar">Tgl Daftar</label>
                        <input type="text" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd-mm-yyyy" class="form-control input-mask <?= (isset(session('errors')['tgldaftar'])) ? 'is-invalid' : '' ?>" id="tgldaftar" name="tgldaftar" value="<?= old('tgldaftar') ?>" required>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['tgldaftar'])) : ?>
                                <?= session('errors')['tgldaftar'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="balita_orangtua">Orang Tua Balita</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['balita_orangtua'])) ? 'is-invalid' : '' ?>" id="balita_orangtua" name="balita_orangtua" value="<?= old('balita_orangtua') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['balita_orangtua'])) : ?>
                                <?= session('errors')['balita_orangtua'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="balita_alamat">Alamat</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['balita_alamat'])) ? 'is-invalid' : '' ?>" id="balita_alamat" name="balita_alamat" value="<?= old('balita_alamat') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['balita_alamat'])) : ?>
                                <?= session('errors')['balita_alamat'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (session('user')->user_type == "petugasdesa") : ?>
                        <div class="form-group mb-4">
                            <label for="dusun_id">Dusun</label>
                            <select class="form-control <?= (isset(session('errors')['dusun_id'])) ? 'is-invalid' : '' ?>" id="dusun_id" name="dusun_id" required>
                                <option value="">Pilih Dusun</option>
                                <?php foreach ($dusun as $p) : ?>
                                    <option value="<?= $p->dusun_id ?>"><?= $p->dusun_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['dusun_id'])) : ?>
                                    <?= session('errors')['dusun_id'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Tambah</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</form>

<!-- End of Main Content -->


<?= $this->endSection(); ?>