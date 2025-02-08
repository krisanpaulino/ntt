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
$routes->post('api/balita', 'Apibalita::create');

$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'Home::admin');
    $routes->get('admin', 'User::admin');
    $routes->post('admin/tambah', 'User::storeAdmin');
    $routes->post('user/hapus', 'User::deleteAdmin');
    $routes->post('petugas/hapus', 'User::deletePetugas');

    $routes->get('petugas', 'User::petugas');
    $routes->post('petugas/tambah', 'User::storePetugas');
    $routes->get('petugas/(:num)', 'User::detailPetugas/$1');
    $routes->post('petugas/update', 'User::updatePetugas');

    $routes->get('petugas-desa', 'User::petugasdesa');
    $routes->post('petugas-desa/tambah', 'User::storePetugasdesa');
    $routes->get('petugasdesa/(:num)', 'User::detailPetugasdesa/$1');
    $routes->post('petugasdesa/update', 'User::updatePetugasdesa');

    $routes->get('posyandu', 'Posyandu::index');
    $routes->post('posyandu/tambah', 'Posyandu::store');
    $routes->post('posyandu/hapus', 'Posyandu::hapus');
    $routes->post('posyandu/update', 'Posyandu::update');

    $routes->get('/', 'Home::petugas');
    $routes->get('balita', 'Balita::index');
    $routes->get('balita/(:num)', 'Balita::detail/$1');
    $routes->post('balita/tambah', 'Balita::store');
    $routes->post('balita/update', 'Balita::update');
    $routes->post('balita/hapus', 'Balita::delete');
    $routes->post('balita/buat-akun', 'Balita::buatAkun');
    $routes->post('laporan-balita', 'Balita::laporanBalita');

    $routes->get('periode', 'Periode::index');
    $routes->post('periode/tambah', 'Periode::store');
    $routes->post('periode/buka', 'Periode::buka');
    $routes->post('periode/selesai', 'Periode::selesai');

    $routes->get('ambangbatas', 'Master::ambangbatas');
    $routes->post('ambangbatas/tambah', 'Master::store_ambangbatas');
    $routes->post('ambangbatas/update', 'Master::update_ambangbatas');
    $routes->post('ambangbatas/hapus', 'Master::delete_ambangbatas');

    $routes->get('kriteria', 'Master::kriteria');
    $routes->post('kriteria/tambah', 'Master::store_kriteria');
    $routes->post('kriteria/hapus', 'Master::delete_kriteria');

    $routes->get('statusgizi', 'Master::statusgizi');
    $routes->get('statusgizi/(:num)', 'Master::edit_statusgizi/$1');
    $routes->post('statusgizi/tambah', 'Master::store_statusgizi');
    $routes->post('statusgizi/hapus', 'Master::delete_statusgizi');
    $routes->post('statusgizi/update', 'Master::update_statusgizi');

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
    $routes->get('balita/(:num)', 'Balita::detail/$1');
    $routes->post('balita/tambah', 'Balita::store');
    $routes->post('balita/update', 'Balita::update');
    $routes->post('balita/hapus', 'Balita::delete');
    $routes->post('balita/buat-akun', 'Balita::buatAkun');
    $routes->post('laporan-balita', 'Balita::laporanBalita');

    $routes->get('periksa', 'Periksa::index');
    $routes->get('periksa/(:num)', 'Periksa::periksa/$1');
    $routes->get('periksa/detail/(:num)', 'Periksa::detail/$1');
    $routes->post('periksa/store', 'Periksa::store');

    $routes->get('hasilukur', 'Antropometri::index');
    $routes->post('antropometri/hitung', 'Antropometri::hitung');
    $routes->get('hasilukur/(:num)', 'Antropometri::detailPetugas/$1');

    $routes->get('profil', 'Profil::petugas');
    $routes->post('update-profil', 'Profil::updatePetugas');
    $routes->post('update-login', 'Profil::updateUser');

    $routes->get('cetak-hasil/(:num)/(:num)', 'Antropometri::cetakHasilPdf/$1/$2');
    $routes->get('laporan-hasil/(:num)/(:num)', 'Antropometri::laporanHasil/$1/$2');

    $routes->get('hasilukur/(:num)/detail/(:num)', 'Antropometri::detailUkur/$1/$2');

    $routes->get('pengumuman', 'Pengumuman::index');
    $routes->get('pengumuman/tambah', 'Pengumuman::tambah');
    $routes->get('pengumuman/(:num)', 'Pengumuman::edit/$1');
    $routes->post('pengumuman/store', 'Pengumuman::store');
    $routes->post('pengumuman/update', 'Pengumuman::update');
    $routes->post('pengumuman/hapus', 'Pengumuman::delete');
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

    $routes->get('periksa', 'Periksa::index');
    $routes->get('periksa/(:num)', 'Periksa::periksa/$1');
    $routes->get('periksa/detail/(:num)', 'Periksa::detail/$1');
    $routes->post('periksa/store', 'Periksa::store');

    $routes->get('hasilukur', 'Antropometri::index');
    $routes->post('antropometri/hitung', 'Antropometri::hitung');
    $routes->get('hasilukur/(:num)', 'Antropometri::detailPetugas/$1');

    $routes->get('profil', 'Profil::petugas');
    $routes->post('update-profil', 'Profil::updatePetugas');
    $routes->post('update-login', 'Profil::updateUser');

    $routes->get('cetak-hasil/(:num)/(:num)', 'Antropometri::cetakHasilPdf/$1/$2');
    $routes->get('laporan-hasil/(:num)/(:num)', 'Antropometri::laporanHasil/$1/$2');

    $routes->get('hasilukur/(:num)/detail/(:num)', 'Antropometri::detailUkur/$1/$2');

    $routes->get('pengumuman', 'Pengumuman::index');
    $routes->get('pengumuman/tambah', 'Pengumuman::tambah');
    $routes->get('pengumuman/(:num)', 'Pengumuman::edit/$1');
    $routes->post('pengumuman/store', 'Pengumuman::store');
    $routes->post('pengumuman/update', 'Pengumuman::update');
    $routes->post('pengumuman/hapus', 'Pengumuman::delete');
});
