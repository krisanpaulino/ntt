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
                        <div class="table-responsive mt-2">
                            <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <?php if (user()->user_type == 'superadmin') : ?>
                                            <th>Desa - Kecamatan - Kabupaten</th>
                                        <?php endif ?>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($periode as $p) : ?>
                                        <tr>
                                            <td><?= $p->periode_tahun ?></td>
                                            <td><?= konversiBulan($p->periode_bulan) ?></td>
                                            <?php if (user()->user_type == 'superadmin') : ?>
                                                <td><?= $p->kelurahan_nama ?> - <?= $p->kecamatan_nama ?> - <?= $p->kabupaten_nama ?></td>
                                            <?php endif ?>
                                            <td><?= $p->periode_status ?></td>
                                            <td>
                                                <a href="<?= base_url(session('user')->user_type . '/riwayat/' . $p->periode_id) ?>" class="badge bg-primary">Lihat Riwayat</a>
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