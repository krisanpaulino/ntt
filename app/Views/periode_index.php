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
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($periode as $p) : ?>
                                        <tr>
                                            <td><?= $p->periode_tahun ?></td>
                                            <td><?= konversiBulan($p->periode_bulan) ?></td>
                                            <td><?= $p->periode_status ?></td>
                                            <td>
                                                <?php if ($p->periode_status == 'tutup') : ?>
                                                    <div class="d-flex justify-content-start">
                                                        <form action="<?= base_url('admin/periode/buka') ?>" method="post">
                                                            <input type="hidden" name="periode_id" value="<?= $p->periode_id ?>">
                                                            <button type="submit" class="badge bg-success border">Buka</button>
                                                        </form>
                                                        <form action="<?= base_url('admin/periode/hapus') ?>" method="post">
                                                            <input type="hidden" name="periode_id" value="<?= $p->periode_id ?>">
                                                            <button type="submit" class="badge bg-danger border" onclick="return confirm('apakah anda yakin>')">Hapus</button>
                                                        </form>
                                                    </div>
                                                <?php elseif ($p->periode_status == 'buka') : ?>
                                                    <form action="<?= base_url('admin/periode/selesai') ?>" method="post">
                                                        <input type="hidden" name="periode_id" value="<?= $p->periode_id ?>">
                                                        <button type="submit" class="badge bg-warning border">Selesai</button>
                                                    </form>
                                                <?php endif ?>
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
<form action="<?= base_url(session('user')->user_type . '/periode/tambah') ?>" method="post" autocomplete="off">
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Kabupaten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="periode_tahun">Tahun</label>
                        <input type="year" class="form-control <?= (isset(session('errors')['periode_tahun'])) ? 'is-invalid' : '' ?>" id="periode_tahun" name="periode_tahun" value="<?= old('periode_tahun', date('Y')) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['periode_tahun'])) : ?>
                                <?= session('errors')['periode_tahun'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="periode_bulan">Bulan</label>
                        <select class="form-control <?= (isset(session('errors')['periode_bulan'])) ? 'is-invalid' : '' ?>" id="periode_bulan" name="periode_bulan" required>
                            <option value="">Pilih Bulan</option>
                            <?php foreach ($bulan as $b) : ?>
                                <option value="<?= $b['angka'] ?>"><?= $b['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['periode_bulan'])) : ?>
                                <?= session('errors')['periode_bulan'] ?>
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
<form action="<?= base_url('superadmin/kabupaten/update') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Kabupaten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="kabupaten_id" value="" id="kodeitemedit">
                    <div class="form-group mb-4">
                        <label for="kabupaten_nama">Nama Kabupaten</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['kabupaten_nama'])) ? 'is-invalid' : '' ?>" id="namaitemedit" name="kabupaten_nama" value="">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['kabupaten_nama'])) : ?>
                                <?= session('errors')['kabupaten_nama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="sumbit" class="btn btn-warning waves-effect waves-light">Update</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</form>

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