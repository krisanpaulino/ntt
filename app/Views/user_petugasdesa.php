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
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Desa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($petugasdesa as $p) : ?>
                                        <tr>
                                            <td><?= $p->user_email ?></td>
                                            <td><?= $p->petugasdesa_nama ?></td>
                                            <td><?= $p->petugasdesa_jk ?></td>
                                            <td><?= $p->kelurahan_nama ?></td>
                                            <td>
                                                <form action="<?= base_url('admin/petugasdesa/hapus') ?>" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $p->user_id ?>">
                                                    <a href="<?= base_url('admin/petugasdesa/' . $p->petugasdesa_id) ?>" class="badge bg-primary">Detail</a>
                                                    <button type="submit" class="badge bg-danger border-0">Hapus</button>
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
<form action="<?= base_url('admin/petugas-desa/tambah') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Petugas Desa</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="kelurahan_id">Desa/Kelurahan</label>
                        <select class="form-control <?= (isset(session('errors')['kelurahan_id'])) ? 'is-invalid' : '' ?>" id="kelurahan_id" name="kelurahan_id" required>
                            <option value="">Pilih Desa</option>
                            <?php foreach ($kelurahan as $p) : ?>
                                <option value="<?= $p->kelurahan_id ?>" <?= ($p->kelurahan_id == old('kelurahan_id')) ? 'selected' : '' ?>><?= $p->kelurahan_nama ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['kelurahan_id'])) : ?>
                                <?= session('errors')['kelurahan_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="petugasdesa_nama">Nama Petugas</label>
                        <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control <?= (isset(session('errors')['petugasdesa_nama'])) ? 'is-invalid' : '' ?>" id="petugasdesa_nama" name="petugasdesa_nama" value="<?= old('petugasdesa_nama') ?>" required>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugasdesa_nama'])) : ?>
                                <?= session('errors')['petugasdesa_nama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="petugasdesa_jk">Jenis Kelamin</label>
                        <select class="form-control <?= (isset(session('errors')['petugasdesa_jk'])) ? 'is-invalid' : '' ?>" id="petugasdesa_jk" name="petugasdesa_jk" required>
                            <option value="">Pilih</option>
                            <option value="L" <?= (old('petugasdesa_jk' == 'L')) ? 'selected' : '' ?>>Laki-Laki</option>
                            <option value="P" <?= (old('petugasdesa_jk' == 'P')) ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugasdesa_jk'])) : ?>
                                <?= session('errors')['petugasdesa_jk'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="petugasdesa_tempatlahir">Tempat Lahir</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['petugasdesa_tempatlahir'])) ? 'is-invalid' : '' ?>" id="petugasdesa_tempatlahir" name="petugasdesa_tempatlahir" value="<?= old('petugasdesa_tempatlahir') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugasdesa_tempatlahir'])) : ?>
                                <?= session('errors')['petugasdesa_tempatlahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="petugasdesa_tgllahir">Tanggal Lahir</label>
                        <input type="date" class="form-control input-mask <?= (isset(session('errors')['petugasdesa_tgllahir'])) ? 'is-invalid' : '' ?>" id="petugasdesa_tgllahir" name="petugasdesa_tgllahir" value="<?= old('petugasdesa_tgllahir') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugasdesa_tgllahir'])) : ?>
                                <?= session('errors')['petugasdesa_tgllahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="petugasdesa_alamat">Alamat Petugas</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['petugasdesa_alamat'])) ? 'is-invalid' : '' ?>" id="petugasdesa_alamat" name="petugasdesa_alamat" value="<?= old('petugasdesa_alamat') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugasdesa_alamat'])) : ?>
                                <?= session('errors')['petugasdesa_alamat'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="petugasdesa_hp">Nomor HP Petugas</label>
                        <input type="number" class="form-control input-mask <?= (isset(session('errors')['petugasdesa_hp'])) ? 'is-invalid' : '' ?>" id="petugasdesa_hp" name="petugasdesa_hp" value="<?= old('petugasdesa_hp') ?>" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugasdesa_hp'])) : ?>
                                <?= session('errors')['petugasdesa_hp'] ?>
                            <?php endif; ?>
                        </div>
                    </div>



                    <div class="form-group mb-4">
                        <label for="file">Foto Petugas</label>
                        <input type="file" class="form-control <?= (isset(session('errors')['file'])) ? 'is-invalid' : '' ?>" id="file" name="file" value="<?= old('file') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['file'])) : ?>
                                <?= session('errors')['file'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <h3>Informasi Login</h3>
                    <hr>
                    <div class="form-group mb-4">
                        <label for="user_email">Email</label>
                        <input autcomplete="off" type="email" class="form-control <?= (isset(session('errors')['user_email'])) ? 'is-invalid' : '' ?>" id="user_email" name="user_email" value="">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['user_email'])) : ?>
                                <?= session('errors')['user_email'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control <?= (isset(session('errors')['user_password'])) ? 'is-invalid' : '' ?>" id="user_password" name="user_password" value="" autocomplete="new-password">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['user_password'])) : ?>
                                <?= session('errors')['user_password'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control <?= (isset(session('errors')['password_confirmation'])) ? 'is-invalid' : '' ?>" id="password_confirmation" name="password_confirmation" value="">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['password_confirmation'])) : ?>
                                <?= session('errors')['password_confirmation'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="sumbit" class="btn btn-primary waves-effect waves-light">Tambah</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</form>

<!-- End of Main Content -->


<?= $this->endSection(); ?>