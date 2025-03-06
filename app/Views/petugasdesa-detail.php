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
                        <form action="<?= base_url('admin/petugasdesa/update') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="petugasdesa_id" value="<?= $petugasdesa->petugasdesa_id ?>">
                            <div class="form-group mb-4">
                                <label for="petugasdesa_nama">Nama</label>
                                <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control <?= (isset(session('errors')['petugasdesa_nama'])) ? 'is-invalid' : '' ?>" id="petugasdesa_nama" name="petugasdesa_nama" value="<?= old('petugasdesa_nama', $petugasdesa->petugasdesa_nama) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugasdesa_nama'])) : ?>
                                        <?= session('errors')['petugasdesa_nama'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugasdesa_jk">Jenis Kelamin</label>
                                <select class="form-control <?= (isset(session('errors')['petugasdesa_jk'])) ? 'is-invalid' : '' ?>" id="petugasdesa_jk" name="petugasdesa_jk">
                                    <option value="P" <?= ($petugasdesa->petugasdesa_jk == 'P') ? 'selected' : '' ?>>P</option>
                                    <option value="L" <?= ($petugasdesa->petugasdesa_jk == 'L') ? 'selected' : '' ?>>L</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugasdesa_jk'])) : ?>
                                        <?= session('errors')['petugasdesa_jk'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugasdesa_tempatlahir">Tempat Lahir</label>
                                <input type="text" class="form-control <?= (isset(session('errors')['petugasdesa_tempatlahir'])) ? 'is-invalid' : '' ?>" id="petugasdesa_tempatlahir" name="petugasdesa_tempatlahir" value="<?= old('petugasdesa_tempatlahir', $petugasdesa->petugasdesa_tempatlahir) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugasdesa_tempatlahir'])) : ?>
                                        <?= session('errors')['petugasdesa_tempatlahir'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugasdesa_tgllahir">Tanggal Lahir</label>
                                <input data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd-mm-yyyy" class="form-control input-mask <?= (isset(session('errors')['petugasdesa_tgllahir'])) ? 'is-invalid' : '' ?>" id="petugasdesa_tgllahir" name="petugasdesa_tgllahir" value="<?= old('petugasdesa_tgllahir', date('d/m/Y', strtotime($petugasdesa->petugasdesa_tgllahir))) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugasdesa_tgllahir'])) : ?>
                                        <?= session('errors')['petugasdesa_tgllahir'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugasdesa_alamat">Alamat Petugas</label>
                                <input type="text" class="form-control <?= (isset(session('errors')['petugasdesa_alamat'])) ? 'is-invalid' : '' ?>" id="petugasdesa_alamat" name="petugasdesa_alamat" value="<?= old('petugasdesa_alamat', $petugasdesa->petugasdesa_alamat) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugasdesa_alamat'])) : ?>
                                        <?= session('errors')['petugasdesa_alamat'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugasdesa_hp">Nomor HP</label>
                                <input type="text" class="form-control <?= (isset(session('errors')['petugasdesa_hp'])) ? 'is-invalid' : '' ?>" id="petugasdesa_hp" name="petugasdesa_hp" value="<?= old('petugasdesa_hp', $petugasdesa->petugasdesa_hp) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugasdesa_hp'])) : ?>
                                        <?= session('errors')['petugasdesa_hp'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (session('user')->user_type == 'superadmin') : ?>
                                <div class="form-group mb-4">
                                    <label for="kelurahan_id">Desa/Kelurahan</label>
                                    <select class="form-control <?= (isset(session('errors')['kelurahan_id'])) ? 'is-invalid' : '' ?>" id="kelurahan_id" name="kelurahan_id" required>
                                        <option value="">Pilih Desa</option>
                                        <?php foreach ($kelurahan as $p) : ?>
                                            <option value="<?= $p->kelurahan_id ?>" <?= ($p->kelurahan_id == old('kelurahan_id', $petugasdesa->kelurahan_id)) ? 'selected' : '' ?>><?= $p->kelurahan_nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php if (isset(session('errors')['kelurahan_id'])) : ?>
                                            <?= session('errors')['kelurahan_id'] ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="form-group mb-4">
                                <button type="submit" class="btn btn-primary">Ubah Data Petugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div><!-- .row -->
<!-- /.container-fluid -->

<!-- End of Main Content -->


<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    $('#edit').on('show.bs.modal', function(event) {
        console.log('Here');
        var kode = $(event.relatedTarget).data('id');
        var nama = $(event.relatedTarget).data('nama');
        $(this).find('#kodeitemedit').attr("value", kode);
        $(this).find('#namaitemedit').attr("value", nama);
    });
</script>
<?= $this->endSection(); ?>