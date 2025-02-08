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
                                        <th>Posyandu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($petugas as $p) : ?>
                                        <tr>
                                            <td><?= $p->user_email ?></td>
                                            <td><?= $p->petugas_nama ?></td>
                                            <td><?= $p->petugas_jk ?></td>
                                            <td><?= $p->posyandu_nama ?></td>
                                            <td>
                                                <form action="<?= base_url('admin/petugas/hapus') ?>" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $p->user_id ?>">
                                                    <a href="<?= base_url('admin/petugas/' . $p->petugas_id) ?>" class="badge bg-primary">Detail</a>
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
<form action="<?= base_url('admin/petugas/tambah') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-4">
                        <label for="petugas_nama">Nama Petugas</label>
                        <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control <?= (isset(session('errors')['petugas_nama'])) ? 'is-invalid' : '' ?>" id="petugas_nama" name="petugas_nama" value="<?= old('petugas_nama') ?>" required>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugas_nama'])) : ?>
                                <?= session('errors')['petugas_nama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="petugas_jk">Jenis Kelamin</label>
                        <select class="form-control <?= (isset(session('errors')['petugas_jk'])) ? 'is-invalid' : '' ?>" id="petugas_jk" name="petugas_jk" required>
                            <option value="">Pilih</option>
                            <option value="L" <?= (old('petugas_jk' == 'L')) ? 'selected' : '' ?>>Laki-Laki</option>
                            <option value="P" <?= (old('petugas_jk' == 'P')) ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugas_jk'])) : ?>
                                <?= session('errors')['petugas_jk'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="petugas_tempatlahir">Tempat Lahir</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['petugas_tempatlahir'])) ? 'is-invalid' : '' ?>" id="petugas_tempatlahir" name="petugas_tempatlahir" value="<?= old('petugas_tempatlahir') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugas_tempatlahir'])) : ?>
                                <?= session('errors')['petugas_tempatlahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="petugas_tgllahir">Tanggal Lahir</label>
                        <input type="date" class="form-control input-mask <?= (isset(session('errors')['petugas_tgllahir'])) ? 'is-invalid' : '' ?>" id="petugas_tgllahir" name="petugas_tgllahir" value="<?= old('petugas_tgllahir') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugas_tgllahir'])) : ?>
                                <?= session('errors')['petugas_tgllahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="petugas_alamat">Alamat Petugas</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['petugas_alamat'])) ? 'is-invalid' : '' ?>" id="petugas_alamat" name="petugas_alamat" value="<?= old('petugas_alamat') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugas_alamat'])) : ?>
                                <?= session('errors')['petugas_alamat'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="petugas_hp">Nomor HP Petugas</label>
                        <input type="number" class="form-control input-mask <?= (isset(session('errors')['petugas_hp'])) ? 'is-invalid' : '' ?>" id="petugas_hp" name="petugas_hp" value="<?= old('petugas_hp') ?>" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['petugas_hp'])) : ?>
                                <?= session('errors')['petugas_hp'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="posyandu_id">Posyandu</label>
                        <select class="form-control <?= (isset(session('errors')['posyandu_id'])) ? 'is-invalid' : '' ?>" id="posyandu_id" name="posyandu_id" required>
                            <option value="">Pilih Posyandu</option>
                            <?php foreach ($posyandu as $p) : ?>
                                <option value="<?= $p->posyandu_id ?>" <?= ($p->posyandu_id == old('posyandu_id')) ? 'selected' : '' ?>><?= $p->posyandu_nama ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['posyandu_id'])) : ?>
                                <?= session('errors')['posyandu_id'] ?>
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
                        <input autcomplete="off" type="email" class="form-control <?= (isset(session('errors')['user_email'])) ? 'is-invalid' : '' ?>" id="user_emaila" name="user_email" value="">
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