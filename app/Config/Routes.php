<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('pencarian', 'Antropometri::pencarian');
$routes->get('hasilukur', 'Antropometri::daftarHasil');
$routes->get('hasilukur/(:num)', 'Antropometri::detailUkurFront/$1');
$routes->get('auth', 'Auth::loginPage');
$routes->post('login', 'Auth::login');
$routes->post('logout', 'Auth::logout');
$routes->get('logout', 'Auth::logout');
$routes->post('otentikasi', 'Otentikasi::index');

//API
$routes->get('api/master/dusun/(:num)', 'Apimaster::dusun/$1');
$routes->get('api/balita-kelurahan/(:num)', 'Apibalita::balitaKelurahan/$1');
$routes->get('api/balita-posyandu/(:num)', 'Apibalita::balitaPosyandu/$1');
$routes->get('api/balita/(:num)', 'Apibalita::show/$1');
$routes->get('api/balita/(:num)', 'Apibalita::show/$1');
$routes->get('api/riwayat-timbang/(:num)', 'Apitimbang::riwayat/$1');
$routes->post('api/balita', 'Apibalita::create');
$routes->put('api/balita/(:num)', 'Apibalita::update/$1');
$routes->delete('api/balita/(:num)', 'Apibalita::delete/$1');

$routes->get('api/periode/(:num)', 'Apitimbang::periode/$1');
$routes->get('api/timbang/(:num)', 'Apitimbang::detailtimbang/$1');
$routes->post('api/timbang', 'Apitimbang::timbang');
$routes->put('api/timbang/(:num)', 'Apitimbang::edittimbang/$1');


$routes->group('superadmin', ['filter' => 'superadmin'], static function ($routes) {
    $routes->get('/', 'Home::superadmin');
    $routes->get('admin', 'User::admin');
    $routes->post('admin/tambah', 'User::storeAdmin');
    $routes->post('admin/hapus', 'User::deleteAdmin');

    //Master
    $routes->get('kabupaten', 'Master::kabupaten');
    $routes->post('kabupaten/update', 'Master::savekabupaten');
    $routes->post('kabupaten/tambah', 'Master::savekabupaten');
    $routes->post('kabupaten/hapus', 'Master::deletekabupaten');

    $routes->get('kecamatan/(:num)', 'Master::kecamatan/$1');
    $routes->post('kecamatan/update', 'Master::savekecamatan');
    $routes->post('kecamatan/tambah', 'Master::savekecamatan');
    $routes->post('kecamatan/hapus', 'Master::deletekecamatan');

    $routes->get('kelurahan/(:num)', 'Master::kelurahan/$1');
    $routes->post('kelurahan/update', 'Master::savekelurahan');
    $routes->post('kelurahan/tambah', 'Master::savekelurahan');
    $routes->post('kelurahan/hapus', 'Master::deletekelurahan');

    $routes->get('dusun/(:num)', 'Master::dusun/$1');
    $routes->post('dusun/update', 'Master::savedusun');
    $routes->post('dusun/tambah', 'Master::savedusun');
    $routes->post('dusun/hapus', 'Master::deletedusun');

    $routes->get('posyandu/(:num)', 'Master::posyandu/$1');
    $routes->post('posyandu/update', 'Master::saveposyandu');
    $routes->post('posyandu/tambah', 'Master::saveposyandu');
    $routes->post('posyandu/hapus', 'Master::deleteposyandu');

    $routes->get('petugas', 'User::petugas');
    $routes->post('petugas/tambah', 'User::storePetugas');
    $routes->get('petugas/(:num)', 'User::detailPetugas/$1');
    $routes->post('petugas/update', 'User::updatePetugas');

    $routes->get('petugas-desa', 'User::petugasdesa');
    $routes->post('petugas-desa/tambah', 'User::storePetugasdesa');
    $routes->get('petugasdesa/(:num)', 'User::detailPetugasdesa/$1');
    $routes->post('petugasdesa/update', 'User::updatePetugasdesa');

    $routes->get('balita', 'Balita::index');
    $routes->get('riwayat-balita/(:num)', 'Periksa::riwayat/$1');
    $routes->get('periode', 'Periode::index');

    // $routes->get('posyandu', 'Posyandu::index');
    // $routes->post('posyandu/tambah', 'Posyandu::store');
    // $routes->post('posyandu/hapus', 'Posyandu::hapus');
    // $routes->post('posyandu/update', 'Posyandu::update');
});
$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Home::admin');
    $routes->get('admin', 'User::admin');
    $routes->post('admin/tambah', 'User::storeAdmin');
    $routes->post('user/hapus', 'User::deleteAdmin');
    $routes->post('petugas/hapus', 'User::deletePetugas');

    $routes->get('balita', 'Balita::index');
    $routes->get('riwayat-balita/(:num)', 'Periksa::riwayat/$1');

    $routes->get('petugas', 'User::petugas');
    $routes->post('petugas/tambah', 'User::storePetugas');
    $routes->get('petugas/(:num)', 'User::detailPetugas/$1');
    $routes->post('petugas/update', 'User::updatePetugas');

    $routes->get('petugas-desa', 'User::petugasdesa');
    $routes->post('petugas-desa/tambah', 'User::storePetugasdesa');
    $routes->get('petugasdesa/(:num)', 'User::detailPetugasdesa/$1');
    $routes->post('petugasdesa/update', 'User::updatePetugasdesa');

    $routes->get('dusun', 'Master::dusun');
    $routes->post('dusun/update', 'Master::savedusun');
    $routes->post('dusun/tambah', 'Master::savedusun');
    $routes->post('dusun/hapus', 'Master::deletedusun');

    $routes->get('posyandu', 'Master::posyandu');
    $routes->post('posyandu/update', 'Master::saveposyandu');
    $routes->post('posyandu/tambah', 'Master::saveposyandu');
    $routes->post('posyandu/hapus', 'Master::deleteposyandu');

    $routes->get('periode', 'Periode::index');
    $routes->post('periode/tambah', 'Periode::store');
    $routes->post('periode/buka', 'Periode::buka');
    $routes->post('periode/selesai', 'Periode::selesai');

    $routes->get('hasilukur', 'Antropometri::index');
    $routes->post('antropometri/hitung', 'Antropometri::hitung');
    $routes->get('hasilukur/(:num)', 'Antropometri::posyandu/$1');
    $routes->get('hasilukur/(:num)/posyandu/(:num)', 'Antropometri::detailAdmin/$1/$2');
    $routes->get('hasilukur/(:num)/detail/(:num)', 'Antropometri::detailUkur/$1/$2');

    $routes->get('cetak-hasil/(:num)/(:num)', 'Antropometri::cetakHasilPdf/$1/$2');
    $routes->get('laporan-hasil/(:num)/(:num)', 'Antropometri::laporanHasil/$1/$2');
});

$routes->group('petugas', ['filter' => 'petugas'], static function ($routes) {
    $routes->get('/', 'Home::petugas');
    $routes->get('balita', 'Balita::index');
    $routes->get('riwayat-balita/(:num)', 'Periksa::riwayat/$1');
    // $routes->get('balita/(:num)', 'Balita::detail/$1');
    // $routes->post('balita/tambah', 'Balita::store');
    // $routes->post('balita/update', 'Balita::update');
    // $routes->post('balita/hapus', 'Balita::delete');
    // $routes->post('balita/buat-akun', 'Balita::buatAkun');
    // $routes->post('laporan-balita', 'Balita::laporanBalita');

    $routes->get('periksa', 'Periksa::index');
    $routes->get('periksa/(:num)', 'Periksa::periksa/$1');
    $routes->get('periksa/detail/(:num)', 'Periksa::detail/$1');
    $routes->post('periksa/store', 'Periksa::store');

    $routes->get('profil', 'Profil::petugas');
    $routes->post('update-profil', 'Profil::updatePetugas');
    $routes->post('update-login', 'Profil::updateUser');

    $routes->get('riwayat', 'Periksa::riwayatPeriode');
    $routes->get('riwayat/(:num)', 'Periksa::riwayatDetail/$1');
    $routes->get('detail-ukur/(:num)/(:num)', 'Periksa::detail/$1/$2');

    $routes->get('cetak-hasil/(:num)/(:num)', 'Antropometri::cetakHasilPdf/$1/$2');
    $routes->get('laporan-hasil/(:num)/(:num)', 'Antropometri::laporanHasil/$1/$2');

    $routes->get('hasilukur/(:num)/detail/(:num)', 'Antropometri::detailUkur/$1/$2');
});
$routes->group('petugasdesa', ['filter' => 'petugasdesa'], static function ($routes) {
    $routes->get('/', 'Home::petugasdesa');
    $routes->get('balita', 'Balita::index');
    $routes->get('balita/(:num)', 'Balita::detail/$1');
    $routes->post('balita/tambah', 'Balita::store');
    $routes->post('balita/update', 'Balita::update');
    $routes->post('balita/hapus', 'Balita::delete');
    $routes->post('balita/buat-akun', 'Balita::buatAkun');
    $routes->post('laporan-balita', 'Balita::laporanBalita');
});
