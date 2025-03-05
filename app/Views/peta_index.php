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
                        <div id="map" style="width:100%;height:600px;"></div>

                    </div>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div><!-- .row -->
<!-- /.container-fluid -->

<!-- End of Main Content -->


<?= $this->endSection(); ?>
<?= $this->section('jsplugins'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9CASihanCphq2R0nIAHMU1jpA_I9X2rk"></script>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng('-10.335498265607502', '123.71631730990043'),
            zoom: 13
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        setMarkers(map, balitaLocations);
    }
    var balitaLocations = [
        <?php foreach ($balita as $key => $row) : ?>[
                '<?= $row->balita_nama ?>',
                '<?= $row->balita_umur ?>',
                '<?= $row->balita_jk ?>',
                '<?= $row->balita_lat ?>',
                '<?= $row->balita_long ?>',
            ],
        <?php endforeach ?>
    ];

    function setMarkers(map, locations) {

        for (var i = 0; i < locations.length; i++) {

            var balita = locations[i];
            console.log(balita);

            var myLatLng = new google.maps.LatLng(balita[3], balita[4]);
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            var contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<h4 align="center">' + balita[0] + '</h4>' +
                '<p align="center">' + balita[1] + ' Bulan<br></p>' +
                '<div id="bodyContent">' +
                '<div class="card" style="width: 18rem;">' +
                '' +
                '<div class="">' +
                '' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: balita[0],
                icon: {
                    url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    scaledSize: new google.maps.Size(45, 45),
                },
                // animation: google.maps.Animation.BOUNCE
            });
            google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
        }

    }

    function getInfoCallback(map, content) {
        var infowindow = new google.maps.InfoWindow({
            content: content
        });
        return function() {
            infowindow.setContent(content);
            infowindow.open(map, this);
        };
    }

    initialize();
</script>
<?= $this->endSection(); ?>