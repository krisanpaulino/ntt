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
                                    <?php foreach ($admin as $p) : ?>
                                        <tr>
                                            <td><?= $p->user_email ?></td>
                                            <td><?= $p->admin_nama ?></td>
                                            <td><?= $p->admin_jk ?></td>
                                            <td><?= $p->kelurahan_nama ?></td>
                                            <td>
                                                <form action="<?= base_url('superadmin/admin/hapus') ?>" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $p->user_id ?>">
                                                    <a href="<?= base_url('superadmin/admin/' . $p->admin_id) ?>" class="badge bg-primary">Detail</a>
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
<form action="<?= base_url('superadmin/admin/tambah') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Admin Desa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                        <label for="admin_nama">Nama Admin</label>
                        <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control <?= (isset(session('errors')['admin_nama'])) ? 'is-invalid' : '' ?>" id="admin_nama" name="admin_nama" value="<?= old('admin_nama') ?>" required>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['admin_nama'])) : ?>
                                <?= session('errors')['admin_nama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="admin_jk">Jenis Kelamin</label>
                        <select class="form-control <?= (isset(session('errors')['admin_jk'])) ? 'is-invalid' : '' ?>" id="admin_jk" name="admin_jk" required>
                            <option value="">Pilih</option>
                            <option value="L" <?= (old('admin_jk' == 'L')) ? 'selected' : '' ?>>Laki-Laki</option>
                            <option value="P" <?= (old('admin_jk' == 'P')) ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['admin_jk'])) : ?>
                                <?= session('errors')['admin_jk'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="admin_tempatlahir">Tempat Lahir</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['admin_tempatlahir'])) ? 'is-invalid' : '' ?>" id="admin_tempatlahir" name="admin_tempatlahir" value="<?= old('admin_tempatlahir') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['admin_tempatlahir'])) : ?>
                                <?= session('errors')['admin_tempatlahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="admin_tgllahir">Tanggal Lahir</label>
                        <input type="date" class="form-control input-mask <?= (isset(session('errors')['admin_tgllahir'])) ? 'is-invalid' : '' ?>" id="admin_tgllahir" name="admin_tgllahir" value="<?= old('admin_tgllahir') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['admin_tgllahir'])) : ?>
                                <?= session('errors')['admin_tgllahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="admin_alamat">Alamat Admin</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['admin_alamat'])) ? 'is-invalid' : '' ?>" id="admin_alamat" name="admin_alamat" value="<?= old('admin_alamat') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['admin_alamat'])) : ?>
                                <?= session('errors')['admin_alamat'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="admin_hp">Nomor HP Admin</label>
                        <input type="number" class="form-control input-mask <?= (isset(session('errors')['admin_hp'])) ? 'is-invalid' : '' ?>" id="admin_hp" name="admin_hp" value="<?= old('admin_hp') ?>" data-inputmask="'mask': '9', 'repeat': 12, 'greedy' : false">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['admin_hp'])) : ?>
                                <?= session('errors')['admin_hp'] ?>
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