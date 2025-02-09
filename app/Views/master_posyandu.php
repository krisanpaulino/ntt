<?= $this->extend('layout' . user()->user_type); ?>
<?= $this->section('main'); ?>
<!-- Begin Page Content -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title"><?= $title ?></h4>
                <h5><?= $kabupaten->kabupaten_nama ?>/<a href="<?= base_url('superadmin/kecamatan/' . $kabupaten->kabupaten_id) ?>" class="text-primary"><?= $kecamatan->kecamatan_nama ?></a>/<a href="<?= base_url('superadmin/kelurahan/' . $kecamatan->kecamatan_id) ?>" class="text-primary"><?= $kelurahan->kelurahan_nama ?></a></h5>
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
                        <h3>Data Posyandu di <?= $kelurahan->kelurahan_nama ?></h3>
                        <div class="table-responsive mt-2">
                            <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Posyandu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($posyandu as $p) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $p->posyandu_nama ?></td>
                                            <td>
                                                <form action="<?= base_url('superadmin/posyandu/hapus') ?>" method="post">
                                                    <input type="hidden" name="posyandu_id" value="<?= $p->posyandu_id ?>">
                                                    <a href="#" class="badge bg-warning" data-id="<?= $p->posyandu_id ?>" data-nama="<?= $p->posyandu_nama ?>" data-posyandu="<?= $p->posyandu_id ?>" data-toggle="modal" data-target="#edit">Edit</a>
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
<form action="<?= base_url('superadmin/posyandu/tambah') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Posyandu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="kelurahan_id" value="<?= $kelurahan->kelurahan_id ?>">
                    <div class="form-group mb-4">
                        <label for="posyandu_nama">Nama Posyandu</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['posyandu_nama'])) ? 'is-invalid' : '' ?>" id="posyandu_nama" name="posyandu_nama" value="<?= old('posyandu_nama') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['posyandu_nama'])) : ?>
                                <?= session('errors')['posyandu_nama'] ?>
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
<form action="<?= base_url('superadmin/posyandu/update') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Posyandu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="posyandu_id" value="" id="kodeitemedit">
                    <div class="form-group mb-4">
                        <label for="posyandu_nama">Nama Posyandu</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['posyandu_nama'])) ? 'is-invalid' : '' ?>" id="namaitemedit" name="posyandu_nama" value="">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['posyandu_nama'])) : ?>
                                <?= session('errors')['posyandu_nama'] ?>
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