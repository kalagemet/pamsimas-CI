<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('login', 'Auth\LoginController@index')->name('login');

//login proses admin
Route::post('login.admin','Auth\LoginController@login_admin')->name('login.admin');


//login proses cabang
Route::post('login.cabang','Auth\LoginController@login_cabang')->name('login.cabang');

//logout session
Route::get('logout','Auth\LoginController@logout');
Route::get('admin/logout','Auth\LoginController@logout');
Route::get('cabang/logout','Auth\LoginController@logout');

//redirect admin
Route::get('admin', 'Admin\HomeController@index')->name('admin');

//redirect cabang
Route::get('cabang', 'Cabang\HomeController@index')->name('cabang');

//get gambar public
Route::get('logo_cabang','PublicController@getPic');

// ====================================================================
// Begin: route sistem admin
// ====================================================================

//ke rubah edit profil admin
Route::get('admin/profil_ubah', 'Admin\HomeController@ubah_profil');

//post upload
Route::post('admin/admin.ubah_pic', 'Admin\HomeController@upload_pic')->name('admin.ubah_pic');

//get picture
Route::get('admin/get_pic', 'Admin\HomeController@getPic')->name('get_pic');

//ubah nama dan nik
Route::post('admin/admin.ubah_username', 'Admin\HomeController@ubah_nama')->name('admin.ubah_username');

//ganti password
Route::post('admin/admin.ubah_pas', 'Admin\HomeController@gantiPassword')->name('admin.ubah_pas');

//ganti lokasi
Route::post('admin/admin.ubah_lokasi', 'Admin\HomeController@gantiLokasi')->name('admin.ubah_lokasi');

// ==================================================
// daftar cabang
Route::get('admin/daftar_cabang', 'Admin\CabangController@index'); 

//get cabang
Route::get('admin/get_cabang', 'Admin\CabangController@getCabang')->name('get_cabang');

//tambah cabang
Route::post('admin/admin.tambah_cab', 'Admin\CabangController@tambahCab')->name('admin.tambah_cab');

//set status aktiv / non
Route::get('admin/set_status','Admin\CabangController@setStatus');

//hapus cabang
Route::get('admin/hapus_cabang','Admin\CabangController@hapusCabang');

//reset pass cabang
Route::get('admin/reset_cabang','Admin\CabangController@resetCabang');

//get detai cabang
Route::get('admin/getdetail_cabang', 'Admin\CabangController@detailCabang');

// ====================================================
// pembukuan

//pembukuan
Route::get('admin/pembukuan', 'Admin\HomeController@pembukuan');

//get data pembukuan
Route::get('admin/getpembukuan', 'Admin\HomeController@getPembukuan');

//get data dashboard jml pelanggan
Route::get('admin/getdashboardjumlah','Admin\HomeController@getDashboardPelangganDaftar');

//get data dashboard jml meter
Route::get('admin/getdashboardmeter','Admin\HomeController@getDashboardPelangganMeter');

//get riwayat
Route::get('admin/getdashboardriwayat','Admin\HomeController@getDashboardriwayatAdmin');

//get data dashboard keaungan saldo
Route::get('admin/getdashboardsaldo','Admin\HomeController@getDashboardSaldo');

//get data dashboard jml meter
Route::get('admin/getdashboardkredit','Admin\HomeController@getDashboardDebetKredit');

//get data pendapatan bulan ini
Route::get('admin/getpendapatanbulanini', 'Admin\HomeController@getDataGrafikPendapatanBulan');
Route::get('admin/getpendapatantahunini', 'Admin\HomeController@getDataGrafikPendapatanTahun');

//get data pembukuan non tagihan
Route::get('admin/getpendapatannontagihan', 'Admin\HomeController@getDataNonTagihan');
//get data pembukuan tagihan
Route::get('admin/getpendapatantagihan', 'Admin\HomeController@getDataTagihan');
//get data pembukuan pengeluaran
Route::get('admin/getpengeluaran', 'Admin\HomeController@getDataPengeluaran');
//get data pembukuan average
Route::get('admin/getavg', 'Admin\HomeController@getDataavg');

// ====================================================
// log

//log admin
Route::get('admin/log_admin', 'Admin\HomeController@logAdmin');

//get log admin
Route::get('admin/get_riwayat_admin', 'Admin\HomeController@getriwayatAdmin');

//log cabang
Route::get('admin/log_cabang', 'Admin\HomeController@logCabang');

//get log admin
Route::get('admin/get_riwayat_cabang', 'Admin\HomeController@getriwayatCabang');

// ====================================================================
// End: route sistem admin
// ====================================================================

// ====================================================================
// Begin: route sistem cabang
// ====================================================================

//profile
Route::get('cabang/profil', 'Cabang\HomeController@profile')->name('cabang/profil');

//post upload
Route::post('cabang/cabang.ubah_pic', 'Cabang\HomeController@upload_pic')->name('cabang.ubah_pic');

//get picture
Route::get('cabang/get_logo', 'Cabang\HomeController@getPic')->name('get_logo');

//ganti password
Route::post('cabang/cabang.ubah_pas', 'Cabang\HomeController@gantiPassword')->name('cabang.ubah_pas');

//ubah data cabang
Route::post('cabang/cabang.ubah_data', 'Cabang\HomeController@ubahData')->name('cabang.ubahData');

//ke pelanggan
Route::get('cabang/pelanggan','Cabang\PelangganController@index');

//get pelanggan
Route::get('cabang/get_pelanggan', 'Cabang\PelangganController@getPel');

//hapus pelanggan
Route::get('cabang/hapus_pelanggan', 'Cabang\PelangganController@hapusPelanggan');

//cari pel
Route::get('cabang/cari_pelanggan', 'Cabang\PelangganController@cariPel');

//tambah pelanggan
Route::post('cabang/tambah_pelanggan', 'Cabang\PelangganController@tambahPelanggan');

//ubah pelanggan
Route::post('cabang/ubah_pelanggan', 'Cabang\PelangganController@ubahPelanggan');

//input tagihan
Route::get('cabang/input_tagihan', 'Cabang\TagihanController@index');

//get tarif berlaku
Route::get('cabang/get_tarif', 'Cabang\TagihanController@getTarif');

//set tarif berlaku
Route::post('cabang/set_tarif', 'Cabang\TagihanController@setTarif');

//update tagihan
Route::post('cabang/update_tagihan', 'Cabang\TagihanController@updateTagihan');

//input tagihan
Route::post('cabang/input_tagihan', 'Cabang\TagihanController@inputTagihan');

//input tagihan2 tagihan menu ubah
Route::post('cabang/input_tagihan2', 'Cabang\TagihanController@inputTagihan2');

//get pelanggan tagihan
Route::get('cabang/get_tagihanpelanggan', 'Cabang\TagihanController@getPel');

//cari pel
Route::get('cabang/cari_tagihanpelanggan', 'Cabang\TagihanController@cariPel');

//ubah tagihan pelanggan
Route::get('cabang/ubah_tagihan', 'Cabang\TagihanController@ubahTagihan');

//get tagihan pelanggan
Route::get('cabang/get_tagihanall', 'Cabang\TagihanController@getTagihanall');

//riwwayat tagihan
Route::get('cabang/riwayat_tagihan', 'Cabang\HomeController@riwayatTagihan');

//get riwwayat tagihan
Route::get('cabang/get_riwayat_tagihan', 'Cabang\HomeController@getriwayatTagihan');

//riwwayat sistem
Route::get('cabang/riwayat_sistem', 'Cabang\HomeController@riwayatSistem');

//get riwwayat sistem
Route::get('cabang/get_riwayat_sistem', 'Cabang\HomeController@getriwayatSistem');

//bayar tagihan
//===============================

// index
Route::get('cabang/bayar_tagihan', 'Cabang\BayarController@index');

//get pelanggan bayar
Route::get('cabang/get_bayartagihan', 'Cabang\BayarController@getTagihan');


//get pelanggan bayar tagihan belum
Route::get('cabang/get_bayartagihanbelum', 'Cabang\BayarController@getTagihanbelum');

//cari pelanggan bayar
Route::get('cabang/cari_bayartagihan', 'Cabang\BayarController@cariTagihan');

//cari bulan pelanggan bayar
Route::get('cabang/cari_bulantagihan', 'Cabang\BayarController@cariBulanTagihan');

//cetak ulang
Route::get('cabang/cetak_ulang', 'Cabang\BayarController@cetakUlang');

//get daftar cetak ulang
Route::get('cabang/get_cetakulang', 'Cabang\BayarController@getCetakUlang');

//get bayar tagihan
Route::get('cabang/getbayardetail', 'Cabang\BayarController@getBayarDetail');

//bayar
Route::post('cabang/bayar','Cabang\BayarController@bayar');

//dashboar

//log tagihan dashboard
Route::get('cabang/getdashboardtagihan','Cabang\HomeController@getTagihandashboard');

//log meter dashboard
Route::get('cabang/getdashboardmeter','Cabang\HomeController@getMeterdashboard');

// ====================================================================
// End: route sistem cabang
// ====================================================================

//get provinsi
Route::get('/get_kab','PublicController@get_kab')->name('get_kab');

//get kecamatan
Route::get('/get_kec','PublicController@get_kec')->name('get_kec');

//get desa
Route::get('/get_desa','PublicController@get_desa')->name('get_desa');

//get nama lokasi
Route::get('/get_name','PublicController@getNama')->name('get_name');

//=====================================================================
//cetak
//=====================================================================

//cetak dokumen
Route::get('cabang/cetak_tagihan', 'Cabang\BayarController@cetakTagihan');

//cetak rekening
Route::get('cabang/cetak_rekening', 'Cabang\BayarController@cetakRekening');

//get invoice pic
Route::get('cabang/invoicepic', 'Cabang\HomeController@getPicprint');

//cetak laporan keuangan
Route::get('cabang/cetak_laporan','Cabang\PembukuanController@cetakLaporan');

//cetak laporan keuangan excel
Route::get('cabang/cetak_excel','Cabang\PembukuanController@cetakExcel');

//=====================================================================
// Begin : Pembukuan
//=====================================================================

//index pembukuan
Route::get('cabang/pembukuan', 'Cabang\PembukuanController@index');

//get data pembukuan
Route::get('cabang/get_datapembukuan','Cabang\PembukuanController@getData');

//tambah data
Route::post('cabang/tambah_keuangan', 'Cabang\PembukuanController@tambahData');

//hapus transaksi
Route::post('cabang/hapus_transaksi', 'Cabang\PembukuanController@hapusData');

//=====================================================================
// End : Pembukuan
//=====================================================================