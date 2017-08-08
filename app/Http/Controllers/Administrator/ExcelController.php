<?php

namespace Labmanager\Http\Controllers\Administrator;

use Excel;
use Illuminate\Http\Request;
use Labmanager\Http\Controllers\Controller;
use Labmanager\Models\Pasien;
use Labmanager\Models\Periksa;
use Labmanager\Models\Kuisioner;
use Carbon\Carbon;
use DB;

class ExcelController extends Controller
{

    public function LaporanDataPasien() {

        set_time_limit(300);

        return Excel::create('PH-MDRTB PATIENT DATA FULL REPORT', function($excel) {

            $excel->sheet('REPORT', function($sheet) {

                $listPasien = Pasien::all()->sortBy('idtb');

                $sheet->setPaperSize(5);
    			$sheet->setOrientation('portrait');
    			$sheet->setPageMargin(0.25);
                $sheet->setScale(60);

                $sheet->mergeCells('A1:L1');
    			$sheet->mergeCells('A2:L2');

                $sheet->cell('A1', function($cell) {
    				$cell->setValue('PEER HEALTH MDRTB PATIENT DATA FULL REPORT');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

                $sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

                $sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'TGL LAHIR', 'TGL DAFTAR', 'UMUR', 'SEX', 'ALAMAT', 'INSTANSI ASAL', 'KUISIONER', 'ENUMERATOR'
    			));

                $sheet->setFreeze('A5');
                
                $nomor = 1;
                $dataRow = 5;

                foreach($listPasien as $key => $value) {

                    $sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
                    $sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
                    $sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
                    $sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->nama_pasien)); });
                    $sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_lahir); });
                    $sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_daftar); });
                    $sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue($value->umur); });
                    $sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->sex)); });
                    $sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->alamat)); });
                    $sheet->cell('J'.$dataRow, function($cell) use($value) {
                        $cell->setValue(
                            strtoupper($value->instansi->nama_instansi).' - '.strtoupper($value->instansi->daerah->nama_daerah)
                        );
                    });
                    $sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue(($value->kuisioner == 1) ? "ADA" : "TIDAK"); });
                    $sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->enumerator)); });

                    $nomor = $nomor + 1;
                    $dataRow = $dataRow + 1;

                }

                $sheet->cells('A4:L4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

                $sheet->cells('A5:L'.($dataRow-1), function($cells) {
    				$cells->setValignment('center');
    				$cells->setFontSize(8);
    			});

                $sheet->cells('A5:C'.($dataRow-1), function($cells) {
    				$cells->setAlignment('center');
    			});

                $sheet->cells('F5:H'.($dataRow-1), function($cells) {
    				$cells->setAlignment('center');
    			});

                $sheet->cells('K5:K'.($dataRow-1), function($cells) {
    				$cells->setAlignment('center');
    			});

                $sheet->setBorder('A4:L'.($dataRow-1), 'thin');

                $sheet->setWidth(array(
                    'A' => 5, 'B' => 15, 'C' => 12, 'D' => 22, 'E' => 10, 'F' => 10, 'G' => 5, 'H' => 7, 'I' => 30,
                    'I' => 25, 'J' => 25, 'K' => 10, 'L' => 15
                ));

            });

        })->download('xls');

    }

    public function LaporanDataPasienNoUmur() {
        
        set_time_limit(300);

        return Excel::create('PH-MDRTB PATIENT NO-AGE REPORT', function($excel) {

            $excel->sheet('REPORT', function($sheet) {
                $listPasien = Pasien::where(function ($query) {
                    $query->where('umur', '0')->orWhere('umur', null);
                })->orderBy('idtb')->get();

                $sheet->setPaperSize(5);
    			$sheet->setOrientation('portrait');
    			$sheet->setPageMargin(0.25);
                $sheet->setScale(60);

                $sheet->mergeCells('A1:L1');
    			$sheet->mergeCells('A2:L2');

                $sheet->cell('A1', function($cell) {
    				$cell->setValue('PEER HEALTH MDRTB PATIENT NO-AGE REPORT');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

                $sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

                $sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'TGL LAHIR', 'TGL DAFTAR', 'UMUR', 'SEX', 'ALAMAT', 'INSTANSI ASAL', 'KUISIONER', 'ENUMERATOR'
    			));

                $sheet->setFreeze('A5');
                
                $nomor = 1;
                $dataRow = 5;

                foreach($listPasien as $key => $value) {

                    $sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
                    $sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
                    $sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
                    $sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->nama_pasien)); });
                    $sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_lahir); });
                    $sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_daftar); });
                    $sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue($value->umur); });
                    $sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->sex)); });
                    $sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->alamat)); });
                    $sheet->cell('J'.$dataRow, function($cell) use($value) {
                        $cell->setValue(
                            strtoupper($value->instansi->nama_instansi).' - '.strtoupper($value->instansi->daerah->nama_daerah)
                        );
                    });
                    $sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue(($value->kuisioner == 1) ? "ADA" : "TIDAK"); });
                    $sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->enumerator)); });

                    $nomor = $nomor + 1;
                    $dataRow = $dataRow + 1;

                }

                $sheet->cells('A4:L4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

                $sheet->cells('A5:L'.($dataRow-1), function($cells) {
    				$cells->setValignment('center');
    				$cells->setFontSize(8);
    			});

                $sheet->cells('A5:C'.($dataRow-1), function($cells) {
    				$cells->setAlignment('center');
    			});

                $sheet->cells('F5:H'.($dataRow-1), function($cells) {
    				$cells->setAlignment('center');
    			});

                $sheet->cells('K5:K'.($dataRow-1), function($cells) {
    				$cells->setAlignment('center');
    			});

                $sheet->setBorder('A4:L'.($dataRow-1), 'thin');

                $sheet->setWidth(array(
                    'A' => 5, 'B' => 15, 'C' => 12, 'D' => 22, 'E' => 10, 'F' => 10, 'G' => 5, 'H' => 7, 'I' => 30,
                    'I' => 25, 'J' => 25, 'K' => 10, 'L' => 15
                ));
            });

        })->download('xls');

    }

    public function LaporanSampelPasienExcel() {

        set_time_limit(300);

    	return Excel::create('PH-MDRTB SAMPLE REPORT', function($excel) {

    		$excel->sheet('KESELURUHAN', function($sheet) {

                $listPeriksa = Periksa::all()->sortBy('idtb');

    			$dataRow = 5;

    			$sheet->setPaperSize(5);
    			$sheet->setOrientation('landscape');
    			$sheet->setPageMargin(0.25);

    			$sheet->setFreeze('A5');

    			$sheet->mergeCells('A1:O1');
    			$sheet->mergeCells('A2:O2');

    			$sheet->cell('A1', function($cell) {
    				$cell->setValue('Laporan Keseluruhan Data Sample Pasien Peerhealth MDRTB');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'GENDER', 'UMUR', 'JNS INSTANSI', 'NAMA INSTANSI', 'PEMERIKSAAN KE', 'TGL MASUK', 'TGL PERIKSA', 'JNS SAMPEL', 'RESISTENSI', 'HASIL', 'RIFF'
    			));

                $nomor = 1;

    			foreach ($listPeriksa as $key => $value) {
    				
    				$sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
    				$sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
    				$sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
    				$sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->nama_pasien)?$value->pasien->nama_pasien:"")); });
    				$sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->sex)?$value->pasien->sex:"")); });
    				$sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->umur)?$value->pasien->umur:""); });
    				$sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->jenisinstansi->nama_jenis_instansi)?$value->pasien->instansi->jenisinstansi->nama_jenis_instansi:""); });
    				$sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->nama_instansi)?$value->pasien->instansi->nama_instansi:""); });
    				$sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->pemeriksaan_ke)); });
    				$sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_masuk_sampel->format('d-m-Y')); });
    				$sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_periksa->format('d-m-Y')); });
    				$sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_sampel); });
    				$sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_resistensi); });
    				$sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue($value->hasil); });
    				$sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue($value->rif); });

                    $nomor = $nomor + 1;
    				$dataRow = $dataRow + 1;

    			}

    			$sheet->cells('A4:O4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

    			$sheet->cells('A5:O'.($dataRow-1), function($cells) {
    				$cells->setAlignment('left');
    				$cells->setValignment('center');
    				// $cells->setFontWeight('bold');
    				$cells->setFontSize(8);
    			});

    			$sheet->setAutoSize(true);
    			$sheet->setBorder('A4:O'.($dataRow-1), 'thin');

    		});

            $excel->sheet('POSITIF', function($sheet) {

                $listPeriksa = Periksa::all()->where('hasil', 'TB Positif')->sortBy('idtb');

    			$dataRow = 5;

    			$sheet->setPaperSize(5);
    			$sheet->setOrientation('landscape');
    			$sheet->setPageMargin(0.25);

    			$sheet->setFreeze('A5');

    			$sheet->mergeCells('A1:O1');
    			$sheet->mergeCells('A2:O2');

    			$sheet->cell('A1', function($cell) {
    				$cell->setValue('Laporan Data Sample Positif Pasien Peerhealth MDRTB');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'GENDER', 'UMUR', 'JNS INSTANSI', 'NAMA INSTANSI', 'PEMERIKSAAN KE', 'TGL MASUK', 'TGL PERIKSA', 'JNS SAMPEL', 'RESISTENSI', 'HASIL', 'RIFF'
    			));

                $nomor = 1;

    			foreach ($listPeriksa as $key => $value) {
    				
    				$sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
    				$sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
    				$sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
    				$sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->nama_pasien)?$value->pasien->nama_pasien:"")); });
    				$sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->sex)?$value->pasien->sex:"")); });
    				$sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->umur)?$value->pasien->umur:""); });
    				$sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->jenisinstansi->nama_jenis_instansi)?$value->pasien->instansi->jenisinstansi->nama_jenis_instansi:""); });
    				$sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->nama_instansi)?$value->pasien->instansi->nama_instansi:""); });
    				$sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->pemeriksaan_ke)); });
    				$sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_masuk_sampel->format('d-m-Y')); });
    				$sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_periksa->format('d-m-Y')); });
    				$sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_sampel); });
    				$sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_resistensi); });
    				$sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue($value->hasil); });
    				$sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue($value->rif); });

                    $nomor = $nomor + 1;
    				$dataRow = $dataRow + 1;

    			}

    			$sheet->cells('A4:O4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

    			$sheet->cells('A5:O'.($dataRow-1), function($cells) {
    				$cells->setAlignment('left');
    				$cells->setValignment('center');
    				// $cells->setFontWeight('bold');
    				$cells->setFontSize(8);
    			});

    			$sheet->setAutoSize(true);
    			$sheet->setBorder('A4:O'.($dataRow-1), 'thin');

    		});

            $excel->sheet('NEGATIF', function($sheet) {

                $listPeriksa = Periksa::all()->where('hasil', 'TB Negatif')->sortBy('idtb');

    			$dataRow = 5;

    			$sheet->setPaperSize(5);
    			$sheet->setOrientation('landscape');
    			$sheet->setPageMargin(0.25);

    			$sheet->setFreeze('A5');

    			$sheet->mergeCells('A1:O1');
    			$sheet->mergeCells('A2:O2');

    			$sheet->cell('A1', function($cell) {
    				$cell->setValue('Laporan Data Sample Negatif Pasien Peerhealth MDRTB');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'GENDER', 'UMUR', 'JNS INSTANSI', 'NAMA INSTANSI', 'PEMERIKSAAN KE', 'TGL MASUK', 'TGL PERIKSA', 'JNS SAMPEL', 'RESISTENSI', 'HASIL', 'RIFF'
    			));

                $nomor = 1;

    			foreach ($listPeriksa as $key => $value) {
    				
    				$sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
    				$sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
    				$sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
    				$sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->nama_pasien)?$value->pasien->nama_pasien:"")); });
    				$sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->sex)?$value->pasien->sex:"")); });
    				$sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->umur)?$value->pasien->umur:""); });
    				$sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->jenisinstansi->nama_jenis_instansi)?$value->pasien->instansi->jenisinstansi->nama_jenis_instansi:""); });
    				$sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->nama_instansi)?$value->pasien->instansi->nama_instansi:""); });
    				$sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->pemeriksaan_ke)); });
    				$sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_masuk_sampel->format('d-m-Y')); });
    				$sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_periksa->format('d-m-Y')); });
    				$sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_sampel); });
    				$sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_resistensi); });
    				$sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue($value->hasil); });
    				$sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue($value->rif); });

                    $nomor = $nomor + 1;
    				$dataRow = $dataRow + 1;

    			}

    			$sheet->cells('A4:O4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

    			$sheet->cells('A5:O'.($dataRow-1), function($cells) {
    				$cells->setAlignment('left');
    				$cells->setValignment('center');
    				// $cells->setFontWeight('bold');
    				$cells->setFontSize(8);
    			});

    			$sheet->setAutoSize(true);
    			$sheet->setBorder('A4:O'.($dataRow-1), 'thin');

    		});

    	})->download('xls');

    }

    public function LaporanSampelBTA() {

        set_time_limit(300);

        return Excel::create('PH-MDRTB BTA SAMPLE REPORT', function($excel) {

            $excel->sheet('POSITIVE', function($sheet) {

                $listPeriksa = Periksa::all()
                                ->where('hasil', 'TB Positif')
                                ->where('jns_sampel', 'BTA')
                                ->sortBy('idtb');

    			$dataRow = 5;

    			$sheet->setPaperSize(5);
    			$sheet->setOrientation('landscape');
    			$sheet->setPageMargin(0.25);

    			$sheet->setFreeze('A5');

    			$sheet->mergeCells('A1:O1');
    			$sheet->mergeCells('A2:O2');

    			$sheet->cell('A1', function($cell) {
    				$cell->setValue('PEER HEALTH MDRTB BTA-POSITIVE SAMPLE REPORT');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'GENDER', 'UMUR', 'JNS INSTANSI', 'NAMA INSTANSI', 'PEMERIKSAAN KE', 'TGL MASUK', 'TGL PERIKSA', 'JNS SAMPEL', 'RESISTENSI', 'HASIL', 'RIFF'
    			));

                $nomor = 1;

    			foreach ($listPeriksa as $key => $value) {
    				
    				$sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
    				$sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
    				$sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
    				$sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->nama_pasien)?$value->pasien->nama_pasien:"")); });
    				$sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->sex)?$value->pasien->sex:"")); });
    				$sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->umur)?$value->pasien->umur:""); });
    				$sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->jenisinstansi->nama_jenis_instansi)?$value->pasien->instansi->jenisinstansi->nama_jenis_instansi:""); });
    				$sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->nama_instansi)?$value->pasien->instansi->nama_instansi:""); });
    				$sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->pemeriksaan_ke)); });
    				$sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_masuk_sampel->format('d-m-Y')); });
    				$sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_periksa->format('d-m-Y')); });
    				$sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_sampel); });
    				$sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_resistensi); });
    				$sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue($value->hasil); });
    				$sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue($value->rif); });

                    $nomor = $nomor + 1;
    				$dataRow = $dataRow + 1;

    			}

    			$sheet->cells('A4:O4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

    			$sheet->cells('A5:O'.($dataRow-1), function($cells) {
    				$cells->setAlignment('left');
    				$cells->setValignment('center');
    				// $cells->setFontWeight('bold');
    				$cells->setFontSize(8);
    			});

    			$sheet->setAutoSize(true);
    			$sheet->setBorder('A4:O'.($dataRow-1), 'thin');

            });

            $excel->sheet('NEGATIVE', function($sheet) {

                $listPeriksa = Periksa::all()
                                ->where('hasil', 'TB Negatif')
                                ->where('jns_sampel', 'BTA')
                                ->sortBy('idtb');

    			$dataRow = 5;

    			$sheet->setPaperSize(5);
    			$sheet->setOrientation('landscape');
    			$sheet->setPageMargin(0.25);

    			$sheet->setFreeze('A5');

    			$sheet->mergeCells('A1:O1');
    			$sheet->mergeCells('A2:O2');

    			$sheet->cell('A1', function($cell) {
    				$cell->setValue('PEER HEALTH MDRTB BTA-NEGATIVE SAMPLE REPORT');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'GENDER', 'UMUR', 'JNS INSTANSI', 'NAMA INSTANSI', 'PEMERIKSAAN KE', 'TGL MASUK', 'TGL PERIKSA', 'JNS SAMPEL', 'RESISTENSI', 'HASIL', 'RIFF'
    			));

                $nomor = 1;

    			foreach ($listPeriksa as $key => $value) {
    				
    				$sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
    				$sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
    				$sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
    				$sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->nama_pasien)?$value->pasien->nama_pasien:"")); });
    				$sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->sex)?$value->pasien->sex:"")); });
    				$sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->umur)?$value->pasien->umur:""); });
    				$sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->jenisinstansi->nama_jenis_instansi)?$value->pasien->instansi->jenisinstansi->nama_jenis_instansi:""); });
    				$sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->nama_instansi)?$value->pasien->instansi->nama_instansi:""); });
    				$sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->pemeriksaan_ke)); });
    				$sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_masuk_sampel->format('d-m-Y')); });
    				$sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_periksa->format('d-m-Y')); });
    				$sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_sampel); });
    				$sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_resistensi); });
    				$sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue($value->hasil); });
    				$sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue($value->rif); });

                    $nomor = $nomor + 1;
    				$dataRow = $dataRow + 1;

    			}

    			$sheet->cells('A4:O4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

    			$sheet->cells('A5:O'.($dataRow-1), function($cells) {
    				$cells->setAlignment('left');
    				$cells->setValignment('center');
    				// $cells->setFontWeight('bold');
    				$cells->setFontSize(8);
    			});

    			$sheet->setAutoSize(true);
    			$sheet->setBorder('A4:O'.($dataRow-1), 'thin');

            });

        })->download('xls');

    }

    public function LaporanSampelGE() {

        set_time_limit(300);

        return Excel::create('PH-MDRTB GENEXPERT SAMPLE REPORT', function($excel) {

            $excel->sheet('POSITIVE', function($sheet) {

                $listPeriksa = Periksa::all()
                                ->where('hasil', 'TB Positif')
                                ->where('jns_sampel', 'GeneXpert')
                                ->sortBy('idtb');

    			$dataRow = 5;

    			$sheet->setPaperSize(5);
    			$sheet->setOrientation('landscape');
    			$sheet->setPageMargin(0.25);

    			$sheet->setFreeze('A5');

    			$sheet->mergeCells('A1:O1');
    			$sheet->mergeCells('A2:O2');

    			$sheet->cell('A1', function($cell) {
    				$cell->setValue('PEER HEALTH MDRTB GENEXPERT-POSITIVE SAMPLE REPORT');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'GENDER', 'UMUR', 'JNS INSTANSI', 'NAMA INSTANSI', 'PEMERIKSAAN KE', 'TGL MASUK', 'TGL PERIKSA', 'JNS SAMPEL', 'RESISTENSI', 'HASIL', 'RIFF'
    			));

                $nomor = 1;

    			foreach ($listPeriksa as $key => $value) {
    				
    				$sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
    				$sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
    				$sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
    				$sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->nama_pasien)?$value->pasien->nama_pasien:"")); });
    				$sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->sex)?$value->pasien->sex:"")); });
    				$sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->umur)?$value->pasien->umur:""); });
    				$sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->jenisinstansi->nama_jenis_instansi)?$value->pasien->instansi->jenisinstansi->nama_jenis_instansi:""); });
    				$sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->nama_instansi)?$value->pasien->instansi->nama_instansi:""); });
    				$sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->pemeriksaan_ke)); });
    				$sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_masuk_sampel->format('d-m-Y')); });
    				$sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_periksa->format('d-m-Y')); });
    				$sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_sampel); });
    				$sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_resistensi); });
    				$sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue($value->hasil); });
    				$sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue($value->rif); });

                    $nomor = $nomor + 1;
    				$dataRow = $dataRow + 1;

    			}

    			$sheet->cells('A4:O4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

    			$sheet->cells('A5:O'.($dataRow-1), function($cells) {
    				$cells->setAlignment('left');
    				$cells->setValignment('center');
    				// $cells->setFontWeight('bold');
    				$cells->setFontSize(8);
    			});

    			$sheet->setAutoSize(true);
    			$sheet->setBorder('A4:O'.($dataRow-1), 'thin');

            });

            $excel->sheet('NEGATIVE', function($sheet) {

                $listPeriksa = Periksa::all()
                                ->where('hasil', 'TB Negatif')
                                ->where('jns_sampel', 'GeneXpert')
                                ->sortBy('idtb');

    			$dataRow = 5;

    			$sheet->setPaperSize(5);
    			$sheet->setOrientation('landscape');
    			$sheet->setPageMargin(0.25);

    			$sheet->setFreeze('A5');

    			$sheet->mergeCells('A1:O1');
    			$sheet->mergeCells('A2:O2');

    			$sheet->cell('A1', function($cell) {
    				$cell->setValue('PEER HEALTH MDRTB GENEXPERT-NEGATIVE SAMPLE REPORT');
    				$cell->setFontSize(12);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->cell('A2', function($cell) {
    				$cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
    				$cell->setFontSize(10);
    				$cell->setFontWeight('bold');
    				$cell->setAlignment('center');
    			});

    			$sheet->appendRow(4, array(
    				'NO', 'IDTB', 'IDPP', 'NAMA PASIEN', 'GENDER', 'UMUR', 'JNS INSTANSI', 'NAMA INSTANSI', 'PEMERIKSAAN KE', 'TGL MASUK', 'TGL PERIKSA', 'JNS SAMPEL', 'RESISTENSI', 'HASIL', 'RIFF'
    			));

                $nomor = 1;

    			foreach ($listPeriksa as $key => $value) {
    				
    				$sheet->cell('A'.$dataRow, function($cell) use($nomor) { $cell->setValue($nomor); });
    				$sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
    				$sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue($value->idpp); });
    				$sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->nama_pasien)?$value->pasien->nama_pasien:"")); });
    				$sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper(isset($value->pasien->sex)?$value->pasien->sex:"")); });
    				$sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->umur)?$value->pasien->umur:""); });
    				$sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->jenisinstansi->nama_jenis_instansi)?$value->pasien->instansi->jenisinstansi->nama_jenis_instansi:""); });
    				$sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(isset($value->pasien->instansi->nama_instansi)?$value->pasien->instansi->nama_instansi:""); });
    				$sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->pemeriksaan_ke)); });
    				$sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_masuk_sampel->format('d-m-Y')); });
    				$sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_periksa->format('d-m-Y')); });
    				$sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_sampel); });
    				$sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue($value->jns_resistensi); });
    				$sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue($value->hasil); });
    				$sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue($value->rif); });

                    $nomor = $nomor + 1;
    				$dataRow = $dataRow + 1;

    			}

    			$sheet->cells('A4:O4', function($cells) {
    				$cells->setAlignment('center');
    				$cells->setValignment('center');
    				$cells->setFontWeight('bold');
    				$cells->setFontSize(9);
    			});

    			$sheet->cells('A5:O'.($dataRow-1), function($cells) {
    				$cells->setAlignment('left');
    				$cells->setValignment('center');
    				// $cells->setFontWeight('bold');
    				$cells->setFontSize(8);
    			});

    			$sheet->setAutoSize(true);
    			$sheet->setBorder('A4:O'.($dataRow-1), 'thin');

            });

        })->download('xls');

    }

    public function LaporanSampelKLTR() {

        set_time_limit(300);

        return Excel::create('PH-MDRTB KULTUR SAMPLE REPORT', function($excel) {

            

        });

    }

    public function LaporanKeseluruhanExcel() {

        set_time_limit(300);

        return Excel::create('PH-MDRTB FULL REPORT', function($excel) {

            $excel->sheet('REPORT', function($sheet) {

                $sheet->setPaperSize(5);
                $sheet->setOrientation('landscape');
                $sheet->setPageMargin(0.25);
                $sheet->setScale(95);

                $sheet->mergeCells('A1:R1');
                $sheet->mergeCells('A2:R2');
                $sheet->mergeCells('A3:R3');

                $sheet->mergeCells('J6:L6');
                $sheet->mergeCells('M6:O6');
                $sheet->mergeCells('P6:R6');
                $sheet->mergeCells('K7:L7');
                $sheet->mergeCells('N7:O7');
                $sheet->mergeCells('Q7:R7');

                $sheet->setMergeColumn(array(
                    'columns' => array('A','B','C', 'D', 'E', 'F', 'G', 'H', 'I'),
                    'rows' => array(
                        array(6,8),
                    ), true
                ));

                $sheet->appendRow(6, array(
                    'NO', 'IDTB', 'NAMA PASIEN', 'SEX', 'UMUR', 'ALAMAT', 'TGL DAFTAR', 'KUISIONER', 'ENUMERATOR',
                    'PERTAMA', '', '', 'KEDUA', '', '', 'KETIGA', '', ''
                ));

                $sheet->appendRow(7, array(
                    '', '', '', '', '', '', '', '', '', 'BTA', 'GE', '', 'BTA', 'GE', '', 'BTA', 'GE', ''
                ));

                $sheet->appendRow(8, array(
                    '', '', '', '', '', '', '', '', '', 'TB', 'TB', 'RF', 'TB', 'TB', 'RF', 'TB', 'TB', 'RF'
                ));

                $sheet->cells('A6:I6', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(8);
                });

                $sheet->cells('J6:AR8', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(8);
                });

                $sheet->setBorder('A6:R8', 'thin');

                $sheet->setFreeze('A9');

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('FULL SAMPLE REPORT LABORATORY MANAGER PEERHEALTH MDRTB');
                    $cell->setFontSize(11);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                });

                $sheet->cell('A2', function($cell) {
                    $cell->setValue('Understanding the Acquisition and Transmission of Drug Resistant Tuberculosis');
                    $cell->setFontSize(10);
                    $cell->setAlignment('center');
                });

                $sheet->cell('A3', function($cell) {
                    $cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
                    $cell->setFontSize(10);
                    $cell->setAlignment('center');
                });

                $listPeriksa = DB::select('SELECT * FROM vlbln ORDER BY idtb');
                $dataRow = 9;

                foreach ($listPeriksa as $key => $value) {
                    
                    $sheet->cell('A'.$dataRow, function($cell) use($key) { $cell->setValue($key+1); });
                    $sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->idtb)); });
                    $sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->nama_pasien)); });
                    $sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->sex)); });
                    $sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue($value->umur); });
                    $sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->alamat)); });
                    $sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue($value->tgl_daftar); });
                    if ($value->kuisioner == 1) {
                        $sheet->cell('H'.$dataRow, function($cell) { $cell->setValue("ADA"); });
                    } else {
                        $sheet->cell('H'.$dataRow, function($cell) { $cell->setValue("TIDAK"); });
                    }
                    $sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->enumerator)); });
                    $sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue($value->btapertama_hasil); });
                    $sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue($value->gepertama_hasil); }
                        );
                    $sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue($value->gepertama_rif); });
                    $sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue($value->btakedua_hasil); });
                    $sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue($value->gekedua_hasil); }
                        );
                    $sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue($value->gekedua_rif); });   
                    $sheet->cell('P'.$dataRow, function($cell) use($value) { $cell->setValue($value->btaketiga_hasil); });
                    $sheet->cell('Q'.$dataRow, function($cell) use($value) { $cell->setValue($value->geketiga_hasil); }
                        );
                    $sheet->cell('R'.$dataRow, function($cell) use($value) { $cell->setValue($value->geketiga_rif); });          

                    $dataRow = $dataRow + 1;

                }

                $sheet->cells('A9:R'.$dataRow, function($cells) {
                    $cells->setFontSize(8);
                });

                $sheet->cells('A9:B'.$dataRow, function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->cells('D9:E'.$dataRow, function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->cells('G9:H'.$dataRow, function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->cells('I9:R'.$dataRow, function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->setBorder('A9:R'.($dataRow-1), 'thin');

                $sheet->setWidth(array(
                    'A' => 5, 'B' =>14, 'C' => 15, 'D' => 7, 'E' => 5, 'F' => 20, 'G' => 9, 'H' => 8, 'I' => 15,
                ));

            });

        })->download('xls');

    }

    public function LaporanKuisionerExcel() {

        set_time_limit(300);

        return Excel::create('Laporan Kuisioner', function($excel) {

            // $listKuisioner = Kuisioner::all();
            $listKuisioner = DB::table('kuisioner')
                                ->join('pasien', 'pasien.id', '=', 'kuisioner.pasien_id')
                                ->select('kuisioner.*', 'pasien.idtb', 'pasien.nama_pasien', 'pasien.sex', 'pasien.umur', 'pasien.enumerator')
                                ->orderBy('pasien.idtb', 'asc')
                                ->get();

            $excel->sheet('Laporan', function($sheet) use($listKuisioner) {

                $sheet->setPaperSize(5);
                $sheet->setOrientation('landscape');
                $sheet->setPageMargin(0.25);
                // $sheet->setScale(80);

                $sheet->mergeCells('A1:DO1');
                $sheet->mergeCells('A2:DO2');
                $sheet->mergeCells('A3:DO3');

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('KUISIONER REPORT LABORATORY MANAGER PEERHEALTH MDRTB');
                    $cell->setFontSize(11);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('left');
                });

                $sheet->cell('A2', function($cell) {
                    $cell->setValue('Understanding the Acquisition and Transmission of Drug Resistant Tuberculosis');
                    $cell->setFontSize(10);
                    $cell->setAlignment('left');
                });

                $sheet->cell('A3', function($cell) {
                    $cell->setValue('Research Conducted by Dr. dr. Andani Eka Putra, M.Sc');
                    $cell->setFontSize(10);
                    $cell->setAlignment('left');
                });

                $sheet->appendRow(6, array(
                    'NO', 'IDTB', 'NAMA', 'SEX', 'UMUR', 'ENUMERATOR', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
                    '10', '11', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26',
                    '27', '28', '29', '30', '31A', '31B', '31C', '31D', '31E', '31F', '31G', '31H', '31I', '31J',
                    '31K', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43A', '43B', '44', '45',
                    '46', '47', '48', '49', '50A', '50B', '50C', '51', '52', '53', '54', '55', '56', '57', '58', '59',
                    '60', '61', '62', '63', '64', '65', '66A', '66B', '67', '68A', '68B', '69', '70', '71', '72', '73',
                    '74', '75A', '75B', '76', '77A', '77B', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87',
                    '88', '89', '90', '91', '92', '93', '94', '95', '96', '97'
                ));

                $sheet->cells('A6:DO6', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontWeight('bold');
                    $cells->setFontSize(8);
                });

                $sheet->setFreeze('A7');

                $dataRow = 7;

                foreach ($listKuisioner as $key => $value) {
                    
                    $sheet->cell('A'.$dataRow, function($cell) use($key) { $cell->setValue($key+1); });
                    $sheet->cell('B'.$dataRow, function($cell) use($value) { $cell->setValue($value->idtb); });
                    $sheet->cell('C'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->nama_pasien)); });
                    $sheet->cell('D'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->sex)); });
                    $sheet->cell('E'.$dataRow, function($cell) use($value) { $cell->setValue($value->umur); });
                    $sheet->cell('F'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->enumerator)); });
                    $sheet->cell('G'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k1)); });
                    $sheet->cell('H'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k2)); });
                    $sheet->cell('I'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k3)); });
                    $sheet->cell('J'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k4)); });
                    $sheet->cell('K'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k5)); });
                    $sheet->cell('L'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k6)); });
                    $sheet->cell('M'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k7)); });
                    $sheet->cell('N'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k8)); });
                    $sheet->cell('O'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k9)); });
                    $sheet->cell('P'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k10)); });
                    $sheet->cell('Q'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k11)); });
                    $sheet->cell('R'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k13)); });
                    $sheet->cell('S'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k14)); });
                    $sheet->cell('T'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k15)); });
                    $sheet->cell('U'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k16)); });
                    $sheet->cell('V'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k17)); });
                    $sheet->cell('W'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k18)); });
                    $sheet->cell('X'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k19)); });
                    $sheet->cell('Y'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k20)); });
                    $sheet->cell('Z'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k21)); });
                    $sheet->cell('AA'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k22)); });
                    $sheet->cell('AB'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k23)); });
                    $sheet->cell('AC'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k24)); });
                    $sheet->cell('AD'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k25)); });
                    $sheet->cell('AE'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k26)); });
                    $sheet->cell('AF'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k27)); });
                    $sheet->cell('AG'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k28)); });
                    $sheet->cell('AH'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k29)); });
                    $sheet->cell('AI'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k30)); });
                    $sheet->cell('AJ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31a)); });
                    $sheet->cell('AK'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31b)); });
                    $sheet->cell('AL'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31c)); });
                    $sheet->cell('AM'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31d)); });
                    $sheet->cell('AN'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31e)); });
                    $sheet->cell('AO'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31f)); });
                    $sheet->cell('AP'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31g)); });
                    $sheet->cell('AQ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31h)); });
                    $sheet->cell('AR'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31i)); });
                    $sheet->cell('AS'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31j)); });
                    $sheet->cell('AT'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k31k)); });
                    $sheet->cell('AU'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k32)); });
                    $sheet->cell('AV'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k33)); });
                    $sheet->cell('AW'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k34)); });
                    $sheet->cell('AX'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k35)); });
                    $sheet->cell('AY'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k36)); });
                    $sheet->cell('AZ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k37)); });
                    $sheet->cell('BA'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k38)); });
                    $sheet->cell('BB'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k39)); });
                    $sheet->cell('BC'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k40)); });
                    $sheet->cell('BD'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k41)); });
                    $sheet->cell('BE'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k42)); });
                    $sheet->cell('BF'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k43a)); });
                    $sheet->cell('BG'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k43b)); });
                    $sheet->cell('BH'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k44)); });
                    $sheet->cell('BI'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k45)); });
                    $sheet->cell('BJ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k46)); });
                    $sheet->cell('BK'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k47)); });
                    $sheet->cell('BL'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k48)); });
                    $sheet->cell('BM'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k49)); });
                    $sheet->cell('BN'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k50a)); });
                    $sheet->cell('BO'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k50b)); });
                    $sheet->cell('BP'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k50c)); });
                    $sheet->cell('BQ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k51)); });
                    $sheet->cell('BR'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k52)); });
                    $sheet->cell('BS'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k53)); });
                    $sheet->cell('BT'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k54)); });
                    $sheet->cell('BU'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k55)); });
                    $sheet->cell('BV'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k56)); });
                    $sheet->cell('BW'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k57)); });
                    $sheet->cell('BX'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k58)); });
                    $sheet->cell('BY'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k59)); });
                    $sheet->cell('BZ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k60)); });
                    $sheet->cell('CA'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k61)); });
                    $sheet->cell('CB'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k62)); });
                    $sheet->cell('CC'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k63)); });
                    $sheet->cell('CD'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k64)); });
                    $sheet->cell('CE'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k65)); });
                    $sheet->cell('CF'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k66a)); });
                    $sheet->cell('CG'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k66b)); });
                    $sheet->cell('CH'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k67)); });
                    $sheet->cell('CI'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k68a)); });
                    $sheet->cell('CJ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k68b)); });
                    $sheet->cell('CK'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k69)); });
                    $sheet->cell('CL'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k70)); });
                    $sheet->cell('CM'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k71)); });
                    $sheet->cell('CN'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k72)); });
                    $sheet->cell('CO'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k73)); });
                    $sheet->cell('CP'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k74)); });
                    $sheet->cell('CQ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k75a)); });
                    $sheet->cell('CR'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k75b)); });
                    $sheet->cell('CS'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k76)); });
                    $sheet->cell('CT'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k77a)); });
                    $sheet->cell('CU'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k77b)); });
                    $sheet->cell('CV'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k78)); });
                    $sheet->cell('CW'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k79)); });
                    $sheet->cell('CX'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k80)); });
                    $sheet->cell('CY'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k81)); });
                    $sheet->cell('CZ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k82)); });
                    $sheet->cell('DA'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k83)); });
                    $sheet->cell('DB'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k84)); });
                    $sheet->cell('DC'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k85)); });
                    $sheet->cell('DD'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k86)); });
                    $sheet->cell('DE'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k87)); });
                    $sheet->cell('DF'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k88)); });
                    $sheet->cell('DG'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k89)); });
                    $sheet->cell('DH'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k90)); });
                    $sheet->cell('DI'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k91)); });
                    $sheet->cell('DJ'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k92)); });
                    $sheet->cell('DK'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k93)); });
                    $sheet->cell('DL'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k94)); });
                    $sheet->cell('DM'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k95)); });
                    $sheet->cell('DN'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k96)); });
                    $sheet->cell('DO'.$dataRow, function($cell) use($value) { $cell->setValue(strtoupper($value->k97)); });


                    $dataRow = $dataRow + 1;

                }

                $sheet->cells('A7:DO'.$dataRow, function($cells) {
                    $cells->setFontSize(8);
                });

                $sheet->cells('A7:B'.$dataRow, function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->cells('D7:E'.$dataRow, function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->cells('G7:DO'.$dataRow, function($cells) {
                    $cells->setAlignment('left');
                });

                $sheet->setWidth(array(
                    'A' => 4, 'B' => 14, 'C' => 15, 'D' => 7, 'E' => 6, 'F' => 15, 'G' => 5, 'H' => 5, 'I' => 5,
                     'J' => 5, 'K' => 5, 'L' => 5, 'M' => 5, 'N' => 5, 'O' => 5, 'P' => 5, 'Q' => 5, 'R' => 5,
                     'S' => 5, 'T' => 5, 'U' => 5, 'V' => 5, 'W' => 5, 'X' => 5, 'Y' => 5, 'Z' => 5, 'AA' => 5, 
                     'AB' => 5, 'AC' => 5, 'AD' => 5, 'AE' => 5, 'AF' => 5, 'AG' => 5, 'AH' => 5, 'AI' => 5, 'AJ' => 5,
                     'AK' => 5, 'AL' => 5, 'AM' => 5, 'AN' => 5, 'AO' => 5, 'AP' => 5, 'AQ' => 5, 'AR' => 5, 'AS' => 5,
                     'AT' => 5, 'AU' => 5, 'AV' => 5, 'AW' => 5, 'AX' => 5, 'AY' => 5, 'AZ' => 5, 'BA' => 5, 'BB' => 5,
                     'BC' => 5, 'BD' => 5, 'BE' => 5, 'BF' => 5, 'BG' => 5, 'BH' => 5, 'BI' => 5, 'BJ' => 5, 'BK' => 5,
                     'BL' => 5, 'BM' => 5, 'BN' => 5, 'BO' => 5, 'BP' => 5, 'BQ' => 5, 'BR' => 5, 'BS' => 5, 'BT' => 5, 
                     'BU' => 5, 'BV' => 5, 'BW' => 5, 'BX' => 5, 'BY' => 5, 'BZ' => 5, 'CA' => 5, 'CB' => 5, 'CC' => 5,
                     'CD' => 5, 'CE' => 5, 'CF' => 5, 'CG' => 5, 'CH' => 5, 'CI' => 5, 'CJ' => 5, 'CK' => 5, 'CL' => 5, 
                     'CM' => 5, 'CN' => 5, 'CO' => 5, 'CP' => 5, 'CQ' => 5, 'CR' => 5, 'CS' => 5, 'CT' => 5, 'CU' => 5,
                     'CV' => 5, 'CW' => 5, 'CX' => 5, 'CY' => 5, 'CZ' => 5, 'DA' => 5, 'DB' => 5, 'DC' => 5, 'DD' => 5,
                     'DE' => 5, 'DF' => 5, 'DG' => 5, 'DH' => 5, 'DI' => 5, 'DJ' => 5, 'DK' => 5, 'DL' => 5, 'DM' => 5, 
                     'DN' => 5, 'DO' => 5,
                ));

                $sheet->setBorder('A6:DO'.($dataRow-1), 'thin');

            });

        })->download('xls');

    }
}
