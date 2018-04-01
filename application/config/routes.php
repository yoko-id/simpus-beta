<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';

$route['dashboard'] = "welcome/aksi_login";
$route['logout'] = "welcome/logout";

$route['user'] = "user";
$route['user/edit/(:num)'] = "user/edit/$1";
$route['user/addpetugas'] = "user/add_petugas";
$route['user/addpegawai'] = "user/add_pegawai";
$route['user/addpegawai/(:num)'] = "user/add_pegawai/$1";
//$route['user/addpegawai/(:num)'] = "user/update_pegawai";
$route['user/delete'] = "user/delete";

/* POLI */
$route['poli/addpoli'] = "poli/add_poli";
$route['poli/addpoli/(:num)'] = "poli/add_poli/$1";
$route['poli/(:any)'] = "poli";

/* PASIEN */
$route['pasien/add'] = "pasien";
$route['pasien/view'] = "pasien/view_pasien";
$route['pasien/addvisit'] = "pasien/add_visit";
$route['pasien/viewvisit'] = "pasien/view_visit";
$route['pasien/antrian'] = "pasien/antrian";
$route['pasien/demo/antrian'] = "pasien/getNoAntrian";
$route['pasien/printkartu'] = "pasien/printkartu";

$route['laporan/(:any)'] = "laporan";
$route['laporan/pasien/pdf'] = "laporan/pasienpdf";
$route['laporan/pasien/xls'] = "laporan/pasienxls";


$route['diagnosa'] = "diagnosa";
$route['diagnosa/histori'] = "diagnosa/histori";
$route['diagnosa/histori/(:num)'] = "diagnosa/histori_pasien";
$route['diagnosa/import'] = "diagnosa/import_diagnosa";
$route['diagnosa/update'] = "diagnosa/update_diagnosa";
$route['diagnosa/desa'] = "diagnosa/import_desa";

/* APOTEK */
$route['apotek/resep'] = "obat/resep";
$route['apotek/laporan'] = "obat/obat_keluar";
$route['apotek/obat/stok'] = "obat";
$route['apotek/obat/keluar'] = "obat/obat_keluar";
$route['apotek/obat/expired'] = "obat/obat_expired";
$route['apotek/obat/(:num)'] = "obat/input_obat";
$route['pages/(:any)'] = "pages";
$route['profile'] = "profile";
$route['register'] = "register";
#$route['cetak'] = "cetak";

/* API */
$route['api/kartu'] = "api";
$route['api/kartu/cetak'] = "api/cetak";
$route['api/kartu/view'] = "api/view_barcode";
$route['api/diagnosa'] = "api/diagnosa";
$route['api/diagnosa/histori'] = "api/diagnosa_histori";
$route['api/penyakit'] = "api/penyakit";
$route['api/pengobatan'] = "api/obat";
$route['api/pasien'] = "api/pasien";
$route['api/rekam_medis'] = "api/rekamedis_pasien";
$route['api/sign_apotek'] = "api/sign_apotek";
$route['api/sink'] = "api/sink";
$route['api/rujukan'] = "api/rujukan";
$route['api/getrujukan'] = "api/getrujukan";
$route['api/demo'] = "excel";
$route['api/pegawai/delete'] = "api/delete_pegawai";
$route['api/poli/delete'] = "api/delete_poli";

$route['api/laporanpdf'] = "api/laporanpdf";

/* SMS */
$route['sms/inbox'] = "sms";
$route['sms/outbox'] = "sms/outbox";
$route['sms/phonebok'] = "sms/phonebok";

/* RUJUKAN */
$route['rujukan'] = "rujukan";

/* End of file routes.php */
/* Location: ./application/config/routes.php */