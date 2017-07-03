<?php

namespace Labmanager\Http\Controllers\Excel;

use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Carbon\Carbon;
use PHPExcel_Worksheet_Drawing;
use Date;
use Excel;
use DB;

class ExcelBulanController extends Controller
{
	public function getExcelBulanan(Request $request,$bln=null,$thn=null)
	{
		Carbon::setLocale('id');
        Date::setLocale('id');

        $skr  = Carbon::now('Asia/Jakarta');
        $NmBln = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $bln ? $bln = $bln : $bln = $skr->month;
        $thn ? $thn = $thn : $thn = $skr->year;
        $test = Carbon::createFromDate($skr->year, $bln, $skr->day, $skr->tz);

        $title = "Laporan Bulan ".$NmBln[$bln]." - PEER Health MDRTB";

		Excel::create($title, function($excel) use ($bln,$thn,$NmBln){
			$excel->sheet('Laporan Bulanan', function($sheet) use ($bln,$thn,$NmBln){
				$sheet->setWidth('A', 3);
				$sheet->setWidth('B', 45);
				$sheet->setWidth('C', 2);
				$sheet->setWidth('D', 10);
				$sheet->setWidth('E', 10);
				$sheet->freezeFirstRow();
				$sheet->setFreeze('A4');
				$sheet->setStyle(['borders' =>['allborders' =>['color' =>['rgb' => '999999']]],'font' => ['name'=>'Calibri','size'=>10]]);

				$this->getHeaderPotrait($sheet);

				$sheet->mergeCells('A6:G6');
				$sheet->setHeight(6, 30);

				$sheet->row(6,function($row)
				{
					$row->setFontSize(12);
				});

				$sheet->cell('A6', function($cell) use ($bln,$thn,$NmBln){
					$cell->setValue('Data Bulan '.$NmBln[$bln].' '.$thn);
					$cell->setFontWeight('bold');
					$cell->setValignment('center');
					$cell->setAlignment('center');
				});

				$this->getTitle($sheet,$sheet->getHighestRow()+3,'Jumlah Spesimen');

				$statistik = DB::select('SELECT 
					COUNT(*) as total,
					COUNT(CASE WHEN (jns_sampel="GeneXpert" AND hasil="TB Positif" AND rif="Rif Positif") OR (jns_sampel="BTA" AND hasil="TB Positif") THEN true END) as pp,
					COUNT(CASE WHEN hasil="TB Positif" AND rif="Rif Negatif" THEN true END) as pn,
					COUNT(CASE WHEN hasil="TB Negatif" THEN true END) as n,
					COUNT(CASE WHEN rif="Indeterminate" THEN true END) as i

					FROM periksa WHERE MONTH(`tgl_periksa`)=:bln AND YEAR(`tgl_periksa`)=:thn ', ['bln'=>$bln,'thn'=>$thn]);

				foreach ($statistik as $data) {
					$sheet->appendRow([
						"",
						"Jumlah spesimen yang berasal dari suspek TB MDR",
						":",
						$data->total,
						"Spesimen",
						]);
				}

				$this->getTitle($sheet,$sheet->getHighestRow()+2,'Hasil Pemeriksaan GeneXpert');

				foreach ($statistik as $data) {
					$sheet->appendRow([
						"",
						"MTB Detected, Rif Resistance NOT Detected",
						":",
						$data->pn,
						"Spesimen",
						]);
					$sheet->appendRow([
						"",
						"MTB Detected, Rif Detected",
						":",
						$data->pp,
						"Spesimen",
						]);
					$sheet->appendRow([
						"",
						"MTB NOT Detected",
						":",
						$data->n,
						"Spesimen",
						]);
					$sheet->appendRow([
						"",
						"Indeterminate",
						":",
						$data->i,
						"Spesimen",
						]);
					$sheet->appendRow([
						"",
						"Error",
						":",
						"",
						"Spesimen",
						]);
					$sheet->appendRow([
						"",
						"Invalid",
						":",
						"",
						"Spesimen",
						]);
					$sheet->appendRow([
						"",
						"No Result",
						":",
						"",
						"Spesimen",
						]);
				}

			});

			$excel->sheet("Data ".$NmBln[$bln], function($sheet) use ($bln,$thn,$NmBln){
				$sheet->setOrientation('landscape');
				$sheet->setScale('none');
				$sheet->setWidth('A', 5);
				$sheet->setWidth('B', 12);
				$sheet->setWidth('C', 12);
				$sheet->setWidth('D', 15);
				$sheet->setWidth('E', 22);
				$sheet->setWidth('F', 5);
				$sheet->setWidth('G', 8);
				$sheet->setWidth('H', 25);
				$sheet->setWidth('I', 4);
				$sheet->setWidth('J', 4);
				$sheet->setWidth('K', 4);
				$sheet->setWidth('L', 4);
				$sheet->setWidth('M', 4);
				$sheet->setWidth('N', 4);
				$sheet->setWidth('O', 4);
				$sheet->setWidth('P', 4);
				$sheet->setWidth('Q', 4);
				$sheet->setWidth('R', 5);
				$sheet->freezeFirstRow();
				$sheet->setFreeze('A4');
				$sheet->setStyle(['borders' =>['allborders' =>['color' =>['rgb' => '999999']]],'font' => ['name'=>'Calibri','size'=>10]]);

				$this->getHeaderLanscape($sheet);

				$sheet->mergeCells('A6:C6');
				$this->getTableTitle($sheet,6,'Data Pemeriksaan');
				$this->getTableHeader($sheet,7);

				$listPeriksa = DB::select('SELECT 
					nama_pasien,sex,umur,kuisioner,nama_jenis_instansi,nama_instansi,btapertama_hasil,btakedua_hasil,btaketiga_hasil,gepertama_hasil,gepertama_rif,gekedua_hasil,gekedua_rif,geketiga_hasil,geketiga_rif,
					IF ( MONTH(`btapertama_tgl_periksa`)=:bln  AND YEAR(`btapertama_tgl_periksa`)=:thn ,btapertama_tgl_periksa,
						IF ( MONTH(`btakedua_tgl_periksa`)=:bln AND YEAR(`btakedua_tgl_periksa`)=:thn ,btakedua_tgl_periksa,
							IF ( MONTH(`btaketiga_tgl_periksa`)=:bln AND YEAR(`btaketiga_tgl_periksa`)=:thn ,btaketiga_tgl_periksa,
								IF( MONTH(`gepertama_tgl_periksa`)=:bln AND YEAR(`gepertama_tgl_periksa`)=:thn ,gepertama_tgl_periksa,
									IF( MONTH(`gekedua_tgl_periksa`)=:bln AND YEAR(`gekedua_tgl_periksa`)=:thn ,gekedua_tgl_periksa,
										IF( MONTH(`geketiga_tgl_periksa`)=:bln AND YEAR(`geketiga_tgl_periksa`)=:thn ,geketiga_tgl_periksa,NULL)
									)
								)
							)
						)
					) AS `tgl_periksa`,
					IF ( MONTH(`btapertama_tgl_masuk_sampel`)=:bln  AND YEAR(`btapertama_tgl_masuk_sampel`)=:thn ,btapertama_tgl_masuk_sampel,
						IF ( MONTH(`btakedua_tgl_masuk_sampel`)=:bln AND YEAR(`btakedua_tgl_masuk_sampel`)=:thn ,btakedua_tgl_masuk_sampel,
							IF ( MONTH(`btaketiga_tgl_masuk_sampel`)=:bln AND YEAR(`btaketiga_tgl_masuk_sampel`)=:thn ,btaketiga_tgl_masuk_sampel,
								IF( MONTH(`gepertama_tgl_masuk_sampel`)=:bln AND YEAR(`gepertama_tgl_masuk_sampel`)=:thn ,gepertama_tgl_masuk_sampel,
									IF( MONTH(`gekedua_tgl_masuk_sampel`)=:bln AND YEAR(`gekedua_tgl_masuk_sampel`)=:thn ,gekedua_tgl_masuk_sampel,
										IF( MONTH(`geketiga_tgl_masuk_sampel`)=:bln AND YEAR(`geketiga_tgl_masuk_sampel`)=:thn ,geketiga_tgl_masuk_sampel,NULL)
									)
								)
							)
						)
					) AS `tgl_masuk_sampel`,
					IF ( MONTH(`btapertama_tgl_periksa`)=:bln  AND YEAR(`btapertama_tgl_periksa`)=:thn ,btapertama_idtb,
						IF ( MONTH(`btakedua_tgl_periksa`)=:bln AND YEAR(`btakedua_tgl_periksa`)=:thn ,btakedua_idtb,
							IF ( MONTH(`btaketiga_tgl_periksa`)=:bln AND YEAR(`btaketiga_tgl_periksa`)=:thn ,btaketiga_idtb,
								IF( MONTH(`gepertama_tgl_periksa`)=:bln AND YEAR(`gepertama_tgl_periksa`)=:thn ,gepertama_idtb,
									IF( MONTH(`gekedua_tgl_periksa`)=:bln AND YEAR(`gekedua_tgl_periksa`)=:thn ,gekedua_idtb,
										IF( MONTH(`geketiga_tgl_periksa`)=:bln AND YEAR(`geketiga_tgl_periksa`)=:thn ,geketiga_idtb,NULL)
									)
								)
							)
						)
					) AS `idtb`
					FROM vlbln 
					WHERE ( MONTH(`btapertama_tgl_periksa`)=:bln  AND YEAR(`btapertama_tgl_periksa`)=:thn )
					OR ( MONTH(`btakedua_tgl_periksa`)=:bln AND YEAR(`btakedua_tgl_periksa`)=:thn )
					OR ( MONTH(`btaketiga_tgl_periksa`)=:bln AND YEAR(`btaketiga_tgl_periksa`)=:thn )
					OR ( MONTH(`gepertama_tgl_periksa`)=:bln AND YEAR(`gepertama_tgl_periksa`)=:thn )
					OR ( MONTH(`gekedua_tgl_periksa`)=:bln AND YEAR(`gekedua_tgl_periksa`)=:thn )
					OR ( MONTH(`geketiga_tgl_periksa`)=:bln AND YEAR(`geketiga_tgl_periksa`)=:thn )', ['bln'=>$bln,'thn'=>$thn]);

				$i = 1;
				$col = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R'];

				foreach ($listPeriksa as $data) {
					$sheet->appendRow([
						$i,
						$data->tgl_periksa,
						$data->tgl_masuk_sampel,
						$data->idtb,
						$data->nama_pasien,
						$data->umur,
						ucfirst($data->sex),
						$data->nama_instansi,
						$data->gepertama_hasil == Null ? '' : ( $data->gepertama_hasil == 'TB Positif' ? '+' : '-'),
						$data->gepertama_rif == Null ? '' : ( $data->gepertama_rif == 'Rif Positif' ? '+' : '-'),
						$data->gekedua_hasil == Null ? '' : ( $data->gekedua_hasil == 'TB Positif' ? '+' : '-'),
						$data->gekedua_rif == Null ? '' : ( $data->gekedua_rif == 'Rif Positif' ? '+' : '-'),
						$data->geketiga_hasil == Null ? '' : ( $data->geketiga_hasil == 'TB Positif' ? '+' : '-'),
						$data->geketiga_rif == Null ? '' : ( $data->geketiga_rif == 'Rif Positif' ? '+' : '-'),
						$data->btapertama_hasil == Null ? '' : ( $data->btapertama_hasil == 'TB Positif' ? '+' : '-'),
						$data->btakedua_hasil == Null ? '' : ( $data->btakedua_hasil == 'TB Positif' ? '+' : '-'),
						$data->btaketiga_hasil == Null ? '' : ( $data->btaketiga_hasil == 'TB Positif' ? '+' : '-'),
						$data->kuisioner == 1 ? '√' : 'x',
						]);

					foreach ($col as $c) {
						$sheet->cell($c.($i+8),function($cell)
						{
							$cell->setBorder('thin', 'thin', 'thin', 'thin');
						});
					}

					$i++;
				}
			});

		})->store('xlsx')->download('xlsx');
	}

	private function getHeaderPotrait($sheet)
	{
		$sheet->mergeCells('A1:E1');
		$sheet->mergeCells('F1:H2');

		$objDrawing = new PHPExcel_Worksheet_Drawing;
		$objDrawing->setWorksheet($sheet);
		$objDrawing->setPath(public_path('img/pdf-logo.png'));
		$objDrawing->setCoordinates('F1');
		$objDrawing->setHeight(40);
		$objDrawing->setOffsetX(20);
		$objDrawing->setOffsetY(10);
		

		$sheet->setHeight(1, 25);

		$sheet->row(1,function($row)
		{
			$row->setFontSize(14);
			$row->setFontWeight('bold');
		});

		$sheet->cell('A1', function($cell) {
			$cell->setValue('Partnerships for Enhanced Engagement in Research');
			$cell->setValignment('center');
		});

		$sheet->mergeCells('A2:E2');
		$sheet->setHeight(2, 25);

		$sheet->row(2,function($row)
		{
			$row->setFontSize(14);
			$row->setFontWeight('bold');
		});

		$sheet->cell('A2', function($cell) {
			$cell->setValue('Multidrug-Resistant Tuberculosis ');
			$cell->setValignment('center');
		});

		$sheet->mergeCells('A3:H3');
		$sheet->setHeight(3, 20);

		$sheet->row(3,function($row)
		{
			$row->setFontSize(12);
		});

		$sheet->cell('A3', function($cell) {
			$cell->setValue('JL. Perintis Kemerdekaan, Kampus FK-UNAND, Padang – Sumatera Barat');
			$cell->setValignment('center');
		});


		$sheet->setHeight(4, 1);
		$sheet->row(4,function($row)
		{
			$row->setBackground('#92D050');
		});
	}

	private function getHeaderLanscape($sheet)
	{
		$sheet->mergeCells('A1:L1');
		$sheet->mergeCells('M1:R2');

		$objDrawing = new PHPExcel_Worksheet_Drawing;
		$objDrawing->setWorksheet($sheet);
		$objDrawing->setPath(public_path('img/pdf-logo.png'));
		$objDrawing->setCoordinates('M1');
		$objDrawing->setHeight(40);
		$objDrawing->setOffsetX(10);
		$objDrawing->setOffsetY(10);
		
		$sheet->setHeight(1, 25);

		$sheet->row(1,function($row)
		{
			$row->setFontSize(14);
			$row->setFontWeight('bold');
		});

		$sheet->cell('A1', function($cell) {
			$cell->setValue('Partnerships for Enhanced Engagement in Research');
			$cell->setValignment('center');
		});

		$sheet->mergeCells('A2:L2');
		$sheet->setHeight(2, 25);

		$sheet->row(2,function($row)
		{
			$row->setFontSize(14);
			$row->setFontWeight('bold');
		});

		$sheet->cell('A2', function($cell) {
			$cell->setValue('Multidrug-Resistant Tuberculosis ');
			$cell->setValignment('center');
		});

		$sheet->mergeCells('A3:R3');
		$sheet->setHeight(3, 20);

		$sheet->row(3,function($row)
		{
			$row->setFontSize(12);
		});

		$sheet->cell('A3', function($cell) {
			$cell->setValue('JL. Perintis Kemerdekaan, Kampus FK-UNAND, Padang – Sumatera Barat');
			$cell->setValignment('center');
		});


		$sheet->setHeight(4, 1);
		$sheet->row(4,function($row)
		{
			$row->setBackground('#92D050');
		});
	}

	private function getTitle($sheet,$NumRow,$title)
	{
		$sheet->mergeCells('A'.$NumRow.':G'.$NumRow);
		$sheet->setHeight($NumRow, 20);

		$sheet->cell('A'.$NumRow, function($cell) use($title) {
			$cell->setValue($title);
			$cell->setFontSize(12);
			$cell->setFontWeight('bold');
			$cell->setValignment('center');
		});
	}

	private function getTableTitle($sheet,$NumRow,$title)
	{
		$sheet->setHeight($NumRow, 20);

		$sheet->row($NumRow,function($row)
		{
			$row->setBackground('#92D050');
			$row->setFontColor('#ffffff');
			$row->setFontSize(12);
		});

		$sheet->cell('A'.$NumRow, function($cell) use($title) {
			$cell->setValue($title);
			$cell->setBackground('#00B050');
			$cell->setFontColor('#ffffff');
			$cell->setFontSize(12);
			$cell->setValignment('center');
		});
	}

	private function getTableHeader($sheet,$NumRow)
	{
		$sheet->setHeight($NumRow, 20);

		$sheet->mergeCells('A'.$NumRow.':A'.($NumRow + 1));
		$sheet->mergeCells('B'.$NumRow.':B'.($NumRow + 1));
		$sheet->mergeCells('C'.$NumRow.':C'.($NumRow + 1));
		$sheet->mergeCells('D'.$NumRow.':D'.($NumRow + 1));
		$sheet->mergeCells('E'.$NumRow.':E'.($NumRow + 1));
		$sheet->mergeCells('F'.$NumRow.':F'.($NumRow + 1));
		$sheet->mergeCells('G'.$NumRow.':G'.($NumRow + 1));
		$sheet->mergeCells('H'.$NumRow.':H'.($NumRow + 1));
		$sheet->mergeCells('I'.$NumRow.':K'.$NumRow);
		$sheet->mergeCells('L'.$NumRow.':N'.$NumRow);
		$sheet->mergeCells('O'.$NumRow.':Q'.$NumRow);
		$sheet->mergeCells('R'.$NumRow.':R'.($NumRow + 1));

		$sheet->row(7,['No','Tgl Periksa','Tgl Msk','IDTB','Nama Pasien','Umr','Gender','Ins Asal','GeneXpert','','','','','','BTA','','','kuis']);
		$sheet->row(8,['','','','','','','','','TH0','R0','TH2','R2','TH6','R6','H1','H2','H3','']);

		$sheet->row($NumRow,function($row)
		{
			$row->setBackground('#DDDDDD');
			$row->setFontColor('#555555');
			$row->setFontSize(12);
			$row->setValignment('center');
		});
	}
}
