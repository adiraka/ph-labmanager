<?php
Route::get('/', function(){	return redirect()->route('login'); })->name('beranda');

Route::get('/login','AuthController@getLogin')->name('login');
Route::post('/login','AuthController@postLogin')->name('login');
Route::get('/logout',function(){
	$notification = ['title'=>'MDRTB Laboratory Manager','message' =>'Session Deactivated at '.date('l d-m-Y'),'alert-type'=>'success'];
	Auth::logout();
	return redirect()->route('login')->with($notification);
})->name('logout');

Route::group(['prefix'=>'administrator','middleware'=>['auth','administrator']],function(){
//beranda
	Route::get('/beranda',['as'=>'adm.beranda','uses'=>'Administrator\BerandaController@getBeranda']);
	// Route::get('/data/rekapdaerah',['as'=>'adm.rkpdaerah','uses'=>'Administrator\BerandaController@getRekapDaerah']);
	// Route::get('/pesan',['as'=>'adm.pesan','uses'=>'Administrator\BerandaController@getPesan']);
	// Route::get('/petunjuk',['as'=>'adm.petunjuk','uses'=>'Administrator\BerandaController@getPetunjuk']);

	//profil
	Route::get('/profil','Administrator\AccuntController@getProfil');
	// Route::post('/akun','Administrator\AccuntController@postAkun');
	// Route::post('/profil','Administrator\AccuntController@postProfil');

//laporan
	Route::get('/laporan',['as'=>'adm.laporan','uses'=>'Administrator\LaporanController@getIndex']);
	Route::get('/laporan/bulan/{bln?}/{thn?}',['as'=>'adm.laporanbulan','uses'=>'Laporan\LaporanBulanController@getLaporanBulananPage'])->where(['bln'=>'[0-9]+','thn'=>'[0-9]+']);
	Route::post('/laporan/bulan',['as'=>'adm.laporanbulan','uses'=>'Laporan\LaporanBulanController@postLaporanBulananPage']);
	Route::get('/laporan/tahun',['as'=>'adm.laporantahun','uses'=>'Laporan\LaporanTahunController@getLaporanPasienPage']);
	Route::get('/laporan/pasien/{id?}',['as'=>'adm.laporanpasien','uses'=>'Laporan\LaporanPasienController@getLaporanPasienPage'])->where(['id' => '[0-9]+']);
	Route::post('/laporan/pasien',['as'=>'adm.laporanpasien','uses'=>'Laporan\LaporanPasienController@postLaporanPasienPage']);
	Route::get('/laporan/sampel/{idtb?}',['as'=>'adm.laporansampel','uses'=>'Laporan\LaporanSampelController@getLaporanSampelPage']);
	Route::post('/laporan/sampel',['as'=>'adm.laporansampel','uses'=>'Laporan\LaporanSampelController@postLaporanSampelPage']);
	Route::get('/laporan/institusi/{id?}',['as'=>'adm.laporaninstitusi','uses'=>'Laporan\LaporanInstitusiController@getLaporanInstitusiPage'])->where(['id' => '[0-9]+']);
	Route::post('/laporan/institusi',['as'=>'adm.laporaninstitusi','uses'=>'Laporan\LaporanInstitusiController@postLaporanInstitusiPage']);
	Route::get('/laporan/kuisioner',['as'=>'adm.laporankuisioner','uses'=>'Laporan\LaporanKuisionerController@getLaporanPasienPage']);

//PDF
	Route::get('/pdf/laporan-bulanan',['as'=>'adm.pdfbln','uses'=>'Administrator\PDFController@postPDFDaerah']);
	// Route::post('/pdf/daerah',['as'=>'adm.pdfdaerah','uses'=>'Administrator\PDFController@postPDFDaerah']);
	// Route::post('/pdf/instansi',['as'=>'adm.pdfinstansi','uses'=>'Administrator\PDFController@postPDFInstansi']);
	// Route::post('/pdf/pasien',['as'=>'adm.pdfpasien','uses'=>'Administrator\PDFController@postPDFPasien']);
	// Route::post('/pdf/sampel',['as'=>'adm.pdfsampel','uses'=>'Administrator\PDFController@postPDFSampel']);
	// Route::post('/pdf/kuisioner',['as'=>'adm.pdfkuisioner','uses'=>'Administrator\PDFController@postPDFKuisioner']);

//Excel
	// Route::get('/excel/daerah/{jenis}','Administrator\DaerahExcelController@getExcelDaerah');
	// Route::get('/excel/instansi/{jenis}','Administrator\InstansiExcelController@getExcelInstansi');
	// Route::get('/excel/pasien/{id?}','Excel\ExcelPasienController@getExcelPasien');
	// Route::get('/excel/bulan/{bln?}/{thn?}','Excel\ExcelBulanController@getExcelBulanan');
	// Route::get('/excel/periksa/{jenis}','Administrator\PeriksaExcelController@getExcelPeriksa');

//Chart
	// Route::get('/chart/daerah',['as'=>'adm.chartdaerah','uses'=>'Administrator\ChartController@getDaerah']);
	Route::get('/chart/pasien',['as'=>'adm.chartpasien','uses'=>'Administrator\ChartController@getPasien']);
	Route::get('/chart/sampel',['as'=>'adm.chartsampel','uses'=>'Administrator\ChartController@getSampel']);
	Route::get('/chart/institusi',['as'=>'adm.chartinstitusi','uses'=>'Administrator\ChartController@getInstitusi']);
	Route::get('/chart/kuisioner',['as'=>'adm.chartkuisioner','uses'=>'Administrator\ChartController@getKuisioner']);

//Datatables
	Route::get('/datatables/sampel', ['as'=>'adm.datasampel','uses'=>'Administrator\PeriksaController@getDataTableSampel']);
	Route::get('/datatables/sampel-positiv', ['as'=>'adm.datasampelpositiv','uses'=>'Administrator\PeriksaController@getDataTableSampelPositiv']);
	Route::get('/datatables/sampel-negativ', ['as'=>'adm.datasampelnegativ','uses'=>'Administrator\PeriksaController@getDataTableSampelNegativ']);
	Route::get('/datatables/pasien', ['as'=>'adm.datapasien','uses'=>'Administrator\PasienController@getDataTablePasien']);
	Route::get('/datatables/institusi',['as'=>'adm.datainstitusi','uses'=>'Administrator\InstansiController@getDataTableInstitusi']);
	Route::get('/datatables/jenis-institusi',['as'=>'adm.datajnsinstitusi','uses'=>'Administrator\JenisInstansiController@getDataTableJnsInstitusi']);
	Route::get('/datatables/daerah',['as'=>'adm.datadaerah','uses'=>'Administrator\DaerahController@getDataTableDaerah']);
	Route::get('/datatables/kuisioner', ['as'=>'adm.datakuisioner','uses'=>'Administrator\KuisionerController@getDataTableKuisioner']);

//Pasien
	Route::get('/pasien', ['as'=>'adm.pasien','uses'=>'Administrator\PasienController@getIndexPasien']);
	Route::get('/pasien/listpasien', ['as'=>'adm.datalistpasien','uses'=>'Administrator\PasienController@getListPasien']);
	Route::post('/pasien/tambah', ['as'=>'adm.formtambahpasien','uses'=>'Administrator\PasienController@postTambahPasien']);
	Route::post('/pasien/update',['as'=>'adm.formupdatepasien','uses'=>'Administrator\PasienController@postUpdatePasien']);
	Route::post('/pasien/delete',['as'=>'adm.formdeletepasien','uses'=>'Administrator\PasienController@postDeletePasien']);
	Route::get('/pasien/detail/{id}','Administrator\PasienController@getDetailPasien');

//Sampel
	Route::get('/sampel', ['as'=>'adm.sampel','uses'=>'Administrator\PeriksaController@getIndexSampel']);
	Route::get('/sampel/listsampel', ['as'=>'adm.datalistsampel','uses'=>'Administrator\PeriksaController@getListSampel']);
	Route::post('/sampel/tambah', ['as'=>'adm.formtambahsampel','uses'=>'Administrator\PeriksaController@postTambahSampel']);
	Route::post('/sampel/update',['as'=>'adm.formupdatesampel','uses'=>'Administrator\PeriksaController@postUpdateSampel']);
	Route::post('/sampel/delete',['as'=>'adm.formdeletesampel','uses'=>'Administrator\PeriksaController@postDeleteSampel']);
	Route::get('/sampel/detail/{id}','Administrator\PeriksaController@getDetailSampel');
	
//Institusi
	Route::get('/institusi',['as'=>'adm.instansi','uses'=>'Administrator\InstansiController@getIndexInstitusi']);
	Route::get('/institusi/listinstansi', ['as'=>'adm.datalistinstitusi','uses'=>'Administrator\InstansiController@getListInstitusi']);
	Route::post('/institusi/tambah',['as'=>'adm.formtambahinstitusi','uses'=>'Administrator\InstansiController@postTambahInstitusi']);
	Route::post('/institusi/update',['as'=>'adm.formupdateinstitusi','uses'=>'Administrator\InstansiController@postUpdateInstitusi']);
	Route::post('/institusi/delete',['as'=>'adm.formdeleteinstitusi','uses'=>'Administrator\InstansiController@postDeleteInstitusi']);
	Route::get('/institusi/detail/{id}','Administrator\InstansiController@getDetailInstitusi');

//Jenis Institusi
	Route::post('/jnsins/tambah',['as'=>'adm.formtambahjnsinstitusi','uses'=>'Administrator\JenisInstansiController@postTambahJnsins']);
	Route::post('/jnsins/update',['as'=>'adm.formupdatejnsinstitusi','uses'=>'Administrator\JenisInstansiController@postUpdateJnsins']);
	Route::post('/jnsins/delete',['as'=>'adm.formdeletejnsinstitusi','uses'=>'Administrator\JenisInstansiController@postDeleteJnsins']);

//Daerah
	Route::post('/daerah/tambah',['as'=>'adm.formtambahdaerah','uses'=>'Administrator\DaerahController@postTambahDaerah']);
	Route::post('/daerah/update',['as'=>'adm.formupdatedaerah','uses'=>'Administrator\DaerahController@postUpdateDaerah']);
	Route::post('/daerah/delete',['as'=>'adm.formdeletedaerah','uses'=>'Administrator\DaerahController@postDeleteDaerah']);
	// Route::get('/daerah/{daerah}/{jenisdata}/{param}','Administrator\DaerahController@getDetailDaerah');

//Kuisioner
	Route::get('/kuisioner',['as'=>'adm.kuisioner','uses'=>'Administrator\KuisionerController@getIndexKuisioner']);
	Route::get('/kuisioner/getform', ['as'=>'adm.getformkuisioner','uses'=>'Administrator\KuisionerController@getFormKuisioner']);
	Route::get('/kuisioner/getform/{id?}','Administrator\KuisionerController@getFormUpdateKuisioner');
	Route::post('/kuisioner/tambah', ['as'=>'adm.posttambahkuisioner','uses'=>'Administrator\KuisionerController@postTambahKuisioner']);
	Route::post('/kuisioner/update', ['as'=>'adm.postupdatekuisioner','uses'=>'Administrator\KuisionerController@postUpdateKuisioner']);
	Route::post('/kuisioner/delete', ['as'=>'adm.postdeletekuisioner','uses'=>'Administrator\KuisionerController@postDeleteKuisioner']);

// Excel
	Route::get('/excel/pasien', ['as' => 'adm.excel.pasien', 'uses' => 'Administrator\ExcelController@LaporanDataPasien']);
	Route::get('/excel/pasiennoage', ['as' => 'adm.excel.pasien.noage', 'uses' => 'Administrator\ExcelController@LaporanDataPasienNoUmur']);
	
	Route::get('/excel/sampel', ['as' => 'adm.excel.sampel', 'uses' => 'Administrator\ExcelController@LaporanSampelPasienExcel']);
	Route::get('/excel/sampelbta', ['as' => 'adm.excel.sampel.bta', 'uses' => 'Administrator\ExcelController@LaporanSampelBTA']);
	Route::get('/excel/sampelge', ['as' => 'adm.excel.sampel.ge', 'uses' => 'Administrator\ExcelController@LaporanSampelGE']);
	Route::get('/excel/sampelkltr', ['as' => 'adm.excel.sampel.kltr', 'uses' => 'Administrator\ExcelController@LaporanSampelKLTR']);
	
	Route::get('/excel/keseluruhan', ['as' => 'adm.excel.keseluruhan', 'uses' => 'Administrator\ExcelController@LaporanKeseluruhanExcel']);
	
	Route::get('/excel/kuisioner', ['as' => 'adm.excel.kuisioner', 'uses' => 'Administrator\ExcelController@LaporanKuisionerExcel']);

});