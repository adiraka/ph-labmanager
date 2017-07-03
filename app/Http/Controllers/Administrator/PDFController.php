<?php

namespace Labmanager\Http\Controllers\Administrator;

use DB;
use PDF;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;

class PDFController extends Controller
{
	public function postPDFDaerah(Request $request)
	{
        $chart = $request->img ? $request->img : "";
        $queryBuilder="";
        $helper = [];

        $listjenisinstansi=DB::table('vinstansi')
        ->select('jenisinstansi_id','nama_jenis_instansi')
        ->groupBy('jenisinstansi_id')
        ->get();

        foreach ($listjenisinstansi as $jenisinstansi) {
            $queryBuilder .= ",COUNT(CASE WHEN jenisinstansi_id=$jenisinstansi->jenisinstansi_id THEN 1 END) AS '$jenisinstansi->nama_jenis_instansi'";
        }

        $listinstansi = DB::select("SELECT nama_daerah,COUNT(1) AS Total $queryBuilder FROM vinstansi GROUP BY nama_daerah",[]);

        foreach ($listinstansi as $instansi) {
            array_push($helper,(array)$instansi);
        }

        $listpasien = DB::table('vpasien')
        ->select('nama_daerah',
            DB::Raw("COUNT(CASE WHEN hasil='TB Positif' AND pemeriksaan_ke='pertama' THEN 'Positif' END) AS Pasien_Positif"),
            DB::Raw("COUNT(CASE WHEN hasil='TB Negatif' AND pemeriksaan_ke='pertama' THEN 'negatif' END) AS Pasien_Negatif"),
            DB::Raw("COUNT(*) AS Total_Pasien"))
        ->groupBy('nama_daerah')
        ->get();

        $data = ['chart'=>$chart,'listinstansi'=>$helper,'listpasien'=>$listpasien];
        $pdf = PDF::loadView('backend.administrator.report.pdf.pdfdaerah');

        return $pdf->stream('Daerah-PEER Health MDRTB.pdf');
	}

	public function postPDFInstansi(Request $request)  
	{
        $chart = $request->img ? $request->img : "";
        $queryBuilder="";
        $helper = [];

        $listpasien = DB::select("SELECT  nama_jenis_instansi,
            COUNT(CASE WHEN hasil='TB Positif' THEN 1 END) AS 'Positif',
            COUNT(CASE WHEN hasil='TB Negatif' THEN 1 END) AS 'Negatif',
            COUNT(CASE WHEN hasil IS NULL THEN 1 END) AS 'kosong',
            COUNT(*) AS Total
            FROM vpasien
            GROUP BY nama_jenis_instansi",[]);

        $listsampel = DB::select("SELECT  nama_jenis_instansi,
            COUNT(CASE WHEN hasil='TB Positif' THEN 1 END) AS 'Positif',
            COUNT(CASE WHEN hasil='TB Negatif' THEN 1 END) AS 'Negatif',
            COUNT(*) AS Total
            FROM vperiksa
            GROUP BY nama_jenis_instansi",[]);

		$data = ['chart'=>$chart,'listsampel'=>$listsampel,'listpasien'=>$listpasien];
        $pdf = PDF::loadView('administrator.instansi.pdfinstansi',$data);

        return $pdf->stream('Instansi-PEER Health MDRTB.pdf');
	}

    public function postPDFPasien(Request $request)
    {
        $chart = $request->img ? $request->img : "";
        $queryBuilder="";
        $helper = [];
        ini_set('max_execution_time', 60);

        $rekapsexpasien = DB::select("SELECT sex,
            COUNT(*) AS total,
            COUNT(CASE WHEN hasil='TB Positif' THEN 1 END) AS positif,
            COUNT(CASE WHEN hasil='TB Negatif' THEN 1 END) AS negatif
            FROM vpasien GROUP BY sex", []);

        $kelumurpasien = DB::select("SELECT CASE
            WHEN umur = 0 THEN '0' 
            WHEN umur >= 1 AND umur <= 18 THEN '1-18' 
            WHEN umur >= 19 AND umur <= 30 THEN '19-30' 
            WHEN umur >= 31 AND umur <= 50 THEN '31-50' 
            ELSE '50+' END AS rentang,
            COUNT(CASE 
            WHEN umur = 0 THEN '0' 
            WHEN umur >= 1 AND umur <= 18 THEN '1-18' 
            WHEN umur >= 19 AND umur <= 30 THEN '19-30' 
            WHEN umur >= 31 AND umur <= 50 THEN '31-50'
            ELSE '50+' END) AS jumlah,
            COUNT(CASE 
            WHEN umur = 0 AND hasil = 'TB Positif' THEN '0' 
            WHEN umur >= 1 AND umur <= 18 AND hasil = 'TB Positif' THEN '1-18' 
            WHEN umur >= 19 AND umur <= 30 AND hasil = 'TB Positif' THEN '19-30' 
            WHEN umur >= 31 AND umur <= 50 AND hasil = 'TB Positif' THEN '31-50'
            WHEN umur >=50 AND hasil = 'TB Positif' THEN '50+' END) AS positif,
            COUNT(CASE 
            WHEN umur = 0 AND hasil = 'TB Negatif' THEN '0' 
            WHEN umur >= 1 AND umur <= 18 AND hasil = 'TB Negatif' THEN '1-18' 
            WHEN umur >= 19 AND umur <= 30 AND hasil = 'TB Negatif' THEN '19-30' 
            WHEN umur >= 31 AND umur <= 50 AND hasil = 'TB Negatif' THEN '31-50'
            WHEN umur >=50 AND hasil = 'TB Negatif' THEN '50+' END) AS negatif
            FROM vpasien
            GROUP BY rentang", []);

        $data = [
            'chart'=>$chart,
            'kelumurpasien'=>$kelumurpasien,
            'rekapsexpasien'=>$rekapsexpasien,
        ];

        $pdf = PDF::loadView('administrator.pasien.pdfpasien',$data);

        return $pdf->stream('Instansi-PEER Health MDRTB.pdf');
    }

    public function postPDFPeriksa(Request $request)
    {

    }

    public function postPDFKuisioner(Request $request)
    {

    }
}

