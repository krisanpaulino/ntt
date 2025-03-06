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
                        <form action="<?= base_url('admin/petugas/update') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="petugas_id" value="<?= $petugas->petugas_id ?>">
                            <div class="form-group mb-4">
                                <label for="petugas_nama">Nama</label>
                                <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control <?= (isset(session('errors')['petugas_nama'])) ? 'is-invalid' : '' ?>" id="petugas_nama" name="petugas_nama" value="<?= old('petugas_nama', $petugas->petugas_nama) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugas_nama'])) : ?>
                                        <?= session('errors')['petugas_nama'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugas_jk">Jenis Kelamin</label>
                                <select class="form-control <?= (isset(session('errors')['petugas_jk'])) ? 'is-invalid' : '' ?>" id="petugas_jk" name="petugas_jk">
                                    <option value="L" <?= ($petugas->petugas_jk == 'P') ? 'selected' : '' ?>>P</option>
                                    <option value="P" <?= ($petugas->petugas_jk == 'L') ? 'selected' : '' ?>>L</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugas_jk'])) : ?>
                                        <?= session('errors')['petugas_jk'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugas_tempatlahir">Tempat Lahir</label>
                                <input type="text" class="form-control <?= (isset(session('errors')['petugas_tempatlahir'])) ? 'is-invalid' : '' ?>" id="petugas_tempatlahir" name="petugas_tempatlahir" value="<?= old('petugas_tempatlahir', $petugas->petugas_tempatlahir) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugas_tempatlahir'])) : ?>
                                        <?= session('errors')['petugas_tempatlahir'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugas_tgllahir">Tanggal Lahir</label>
                                <input data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd-mm-yyyy" class="form-control input-mask <?= (isset(session('errors')['petugas_tgllahir'])) ? 'is-invalid' : '' ?>" id="petugas_tgllahir" name="petugas_tgllahir" value="<?= old('petugas_tgllahir', date('d/m/Y', strtotime($petugas->petugas_tgllahir))) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugas_tgllahir'])) : ?>
                                        <?= session('errors')['petugas_tgllahir'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugas_alamat">Alamat Petugas</label>
                                <input type="text" class="form-control <?= (isset(session('errors')['petugas_alamat'])) ? 'is-invalid' : '' ?>" id="petugas_alamat" name="petugas_alamat" value="<?= old('petugas_alamat', $petugas->petugas_alamat) ?>">
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['petugas_alamat'])) : ?>
                                        <?= session('errors')['petugas_alamat'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="petugas_hp">Nomor HP</label>
                                <input type="text" class="form-control <?= (isset(session('errors')['petugas_hp'])) ? 'is-invalid' : '' ?>" id="petugas_hp" name="petugas_hp" value="<?= old('petugas_hp', $petugas->petugas_hp) ?>">
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
                                        <option value="<?= $p->posyandu_id ?>" <?= ($p->posyandu_id == $petugas->posyandu_id) ? 'selected' : '' ?>><?= $p->posyandu_nama ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['posyandu_id'])) : ?>
                                        <?= session('errors')['posyandu_id'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
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