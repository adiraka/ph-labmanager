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

class ExcelPasienController extends Controller
{
    public function getExcelPasien(Request $request,$id=Null)
    {
    	$nmPas;
    	
    	$nmPashelper = DB::select('SELECT * FROM pasien where id=:id',['id'=>$id]);
    	foreach ($nmPashelper as $pas) {
    		$nmPas = $pas->nama_pasien;
    	}

    	$title = "Laporan Pasien ".$nmPas." - PEER Health MDRTB";

    	Excel::create($title, function($excel) use ($id,$nmPas){
    		$excel->sheet($nmPas, function($sheet) use ($id,$nmPas){
    			$sheet->setScale('none');
    			$sheet->setWidth('A', 3);
				$sheet->setWidth('B', 8);
				$sheet->setWidth('C', 10);
				$sheet->setWidth('D', 2);
				$sheet->setWidth('E', 5);
				$sheet->setWidth('F', 4);
				$sheet->setWidth('G', 11);
				$sheet->setWidth('H', 12);
				$sheet->setWidth('I', 5);
				$sheet->setWidth('J', 4);
				$sheet->setWidth('K', 11);
				$sheet->setWidth('L', 12);
				$sheet->setWidth('M', 5);
				$sheet->setWidth('N', 4);
				$sheet->freezeFirstRow();
				$sheet->setFreeze('A4');
				$sheet->setStyle(['borders' =>['allborders' =>['color' =>['rgb' => '999999']]],'font' => ['name'=>'Calibri','size'=>10]]);

    			$this->getHeaderPotrait($sheet);

    			$sheet->mergeCells('A6:N6');
				$sheet->setHeight(6, 30);

				$sheet->row(6,function($row)
				{
					$row->setFontSize(12);
				});

				$sheet->cell('A6', function($cell) use ($id,$nmPas){
					$cell->setValue('Laporan Pemeriksaan Pasien');
					$cell->setFontWeight('bold');
					$cell->setValignment('center');
					$cell->setAlignment('center');
				});

				$this->getTitle($sheet,$sheet->getHighestRow()+3,'Identitas Pasien');

				$dataPas = DB::select('SELECT * FROM lpasien WHERE id=:id', ['id'=>$id]);

				$sheet->appendRow([
					"",
					"Nama Pasien",
					"",
					":",
					$dataPas[0]->nama_pasien
					]);
				$sheet->appendRow([
					"",
					"Jenis Kelamin",
					"",
					":",
					$dataPas[0]->sex
					]);

				Date::setLocale('id');
				$date = new Date($dataPas[0]->created_at, 'Asia/Jakarta');
				$tgl = $date->format('j F Y');

				$sheet->appendRow([
					"",
					"Umur",
					"",
					":",
					$dataPas[0]->umur." thn ( Pada ".$tgl." )",
					]);
				$sheet->appendRow([
					"",
					"Alamat",
					"",
					":",
					$dataPas[0]->alamat
					]);

				$this->getTitle($sheet,$sheet->getHighestRow()+3,'Keterangan');

				$sheet->appendRow([
					"",
					"- Pasien rujukan dari ".$dataPas[0]->nama_jenis_instansi." ".$dataPas[0]->nama_instansi,
					]);
				$sheet->appendRow([
					"",
					"- Domisili pasien di kota/kab ".$dataPas[0]->nama_daerah,
					]);
				$sheet->appendRow([
					"",
					$dataPas[0]->kuisioner == 1 ? "- Pasien merupakan Responden" : '- Pasien bukan Responden',
					]);

				$this->getTitle($sheet,$sheet->getHighestRow()+3,'Data Pemeriksaan GeneXpert');
				$this->getTableHeader($sheet,$sheet->getHighestRow()+1);

				$i = 1;
				$j = $sheet->getHighestRow();
				$col = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];

				foreach ($dataPas as $data) {
					$sheet->appendRow([
					$data->gepertama_tgl_periksa,
					'',
					$data->gepertama_idtb,
					'',
					$data->gepertama_hasil == Null ? '' : ( $data->gepertama_hasil == 'TB Positif' ? 'TbD' : 'TbN'),
					$data->gepertama_rif == Null ? '' : ( $data->gepertama_rif == 'Rif Positif' ? 'RD' : 'RN'),
					$data->gekedua_tgl_periksa,
					$data->gekedua_idtb,
					$data->gekedua_hasil == Null ? '' : ( $data->gekedua_hasil == 'TB Positif' ? 'TbD' : 'TbN'),
					$data->gekedua_rif == Null ? '' : ( $data->gekedua_rif == 'Rif Positif' ? 'RD' : 'RN'),
					$data->geketiga_tgl_periksa,
					$data->geketiga_idtb,
					$data->geketiga_hasil == Null ? '' : ( $data->geketiga_hasil == 'TB Positif' ? 'TbD' : 'TbN'),
					$data->geketiga_rif == Null ? '' : ( $data->geketiga_rif == 'Rif Positif' ? 'RD' : 'RN'),
					]);

					foreach ($col as $c) {
						$sheet->cell($c.($i+$j),function($cell)
						{
							$cell->setBorder('thin', 'thin', 'thin', 'thin');
						});
					}

					$i++;
				}

				$sheet->mergeCells('A'.$j.':B'.$j);
				$sheet->mergeCells('C'.$j.':D'.$j);

				$this->getTitle($sheet,$sheet->getHighestRow()+3,'Data Pemeriksaan BTA');
				$this->getTableHeader2($sheet,$sheet->getHighestRow()+1);

				$i = 1;
				$j = $sheet->getHighestRow();

				foreach ($dataPas as $data) {
					$sheet->appendRow([
					$data->btapertama_tgl_periksa,
					'',
					$data->btapertama_idtb,
					'',
					$data->btapertama_hasil == Null ? '' : ( $data->btapertama_hasil == 'TB Positif' ? 'TbD' : 'TbN'),
					'',
					$data->btakedua_tgl_periksa,
					$data->btakedua_idtb,
					$data->btakedua_hasil == Null ? '' : ( $data->btakedua_hasil == 'TB Positif' ? 'TbD' : 'TbN'),
					'',
					$data->btaketiga_tgl_periksa,
					$data->btaketiga_idtb,
					$data->btaketiga_hasil == Null ? '' : ( $data->btaketiga_hasil == 'TB Positif' ? 'TbD' : 'TbN'),
					'',
					]);

					foreach ($col as $c) {
						$sheet->cell($c.($i+$j),function($cell)
						{
							$cell->setBorder('thin', 'thin', 'thin', 'thin');
						});
					}

					$i++;
				}

				$sheet->mergeCells('A'.$j.':B'.$j);
				$sheet->mergeCells('C'.$j.':D'.$j);
				
    		});


    	})->store('xlsx')->download('xlsx');
    }

    private function getHeaderPotrait($sheet)
	{
		$sheet->mergeCells('A1:J1');
		$sheet->mergeCells('K1:N2');

		$objDrawing = new PHPExcel_Worksheet_Drawing;
		$objDrawing->setWorksheet($sheet);
		$objDrawing->setPath(public_path('img/pdf-logo.png'));
		$objDrawing->setCoordinates('K1');
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

		$sheet->mergeCells('A2:J2');
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

		$sheet->mergeCells('A3:N3');
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
		$sheet->mergeCells('A'.$NumRow.':N'.$NumRow);
		$sheet->setHeight($NumRow, 20);

		$sheet->cell('A'.$NumRow, function($cell) use($title) {
			$cell->setValue($title);
			$cell->setFontSize(12);
			$cell->setFontWeight('bold');
			$cell->setValignment('center');
		});
	}

	private function getTableHeader($sheet,$NumRow)
	{
		$sheet->setHeight($NumRow, 20);

		$sheet->mergeCells('A'.$NumRow.':F'.$NumRow);
		$sheet->mergeCells('G'.$NumRow.':J'.$NumRow);
		$sheet->mergeCells('K'.$NumRow.':N'.$NumRow);

		$sheet->row($NumRow,['T0','','','','','','T2','','','','T6','','']);
		$sheet->row($NumRow+1,['tgl Periksa','','IDTB','','TB','Rif','tgl Periksa','IDTB','TB','Rif','tgl Periksa','IDTB','TB','Rif']);

		$sheet->row($NumRow,function($row)
		{
			$row->setBackground('#92D050');
			$row->setFontColor('#ffffff');
			$row->setFontSize(12);
			$row->setValignment('center');
			$row->setAlignment('center');
		});

		$sheet->row($NumRow+1,function($row)
		{
			$row->setBackground('#DDDDDD');
			$row->setValignment('center');
		});
	}

	private function getTableHeader2($sheet,$NumRow)
	{
		$sheet->setHeight($NumRow, 20);

		$sheet->mergeCells('A'.$NumRow.':F'.$NumRow);
		$sheet->mergeCells('G'.$NumRow.':J'.$NumRow);
		$sheet->mergeCells('K'.$NumRow.':N'.$NumRow);

		$sheet->row($NumRow,['T0','','','','','','T2','','','','T6','','']);
		$sheet->row($NumRow+1,['tgl Periksa','','IDTB','','TB','','tgl Periksa','IDTB','TB','','tgl Periksa','IDTB','TB','']);

		$sheet->row($NumRow,function($row)
		{
			$row->setBackground('#92D050');
			$row->setFontColor('#ffffff');
			$row->setFontSize(12);
			$row->setValignment('center');
			$row->setAlignment('center');
		});

		$sheet->row($NumRow+1,function($row)
		{
			$row->setBackground('#DDDDDD');
			$row->setValignment('center');
		});
	}
}
