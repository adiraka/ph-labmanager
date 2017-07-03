<?php

namespace Labmanager\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Date;

class LaporanInstitusiController extends Controller
{
    public function getLaporanInstitusiPage(Request $request,$id=null)
    {
    	if ($id) {
            $dataIns = $this->getDataIns($request->$id);
            $statistik = $this->getStatistikIns($request->$id);
            return view('backend.administrator.report.institusireport')->with(['id'=>$id,'statistik'=>$statistik,'data'=>$dataIns]);
        }

    	return view('backend.administrator.report.institusireport')->with(['id'=>'blm']);
    }

    public function postLaporanInstitusiPage(Request $request)
    {
    	if ($request->ins_id) {
            $dataIns = $this->getDataIns($request->ins_id);
            $statistik = $this->getStatistikIns($request->ins_id);
            return view('backend.administrator.report.institusireport')->with(['id'=>$request->ins_id,'statistik'=>$statistik,'data'=>$dataIns]);
        }

    	return view('backend.administrator.report.institusireport')->with(['id'=>'blm']);
    }

    public function getDataIns($id)
    {
        return DB::select('SELECT * FROM vlinstansi WHERE instansi_id=:id', ['id'=>$id]);
    }

    public function getStatistikIns($id)
    {
        return DB::select('SELECT 
            COUNT(*) as total,
            COUNT(CASE WHEN gepertama_hasil="TB Positif" AND gepertama_rif="Rif Positif" THEN true END) as gespp,
            COUNT(CASE WHEN gekedua_hasil="TB Positif" AND gekedua_rif="Rif Positif" THEN true END) as gedpp,
            COUNT(CASE WHEN geketiga_hasil="TB Positif" AND geketiga_rif="Rif Positif" THEN true END) as getpp,

            COUNT(CASE WHEN gepertama_hasil="TB Positif" AND gepertama_rif="Rif Negatif" THEN true END) as gespn,
            COUNT(CASE WHEN gekedua_hasil="TB Positif" AND gekedua_rif="Rif Negatif" THEN true END) as gedpn,
            COUNT(CASE WHEN geketiga_hasil="TB Positif" AND geketiga_rif="Rif Negatif" THEN true END) as getpn,

            COUNT(CASE WHEN gepertama_hasil="TB Negatif" THEN true END) as gesn,
            COUNT(CASE WHEN gekedua_hasil="TB Negatif" THEN true END) as gedn,
            COUNT(CASE WHEN geketiga_hasil="TB Negatif" THEN true END) as getn,

            COUNT(CASE WHEN gepertama_hasil="TB Negatif" THEN true END) as gesn,
            COUNT(CASE WHEN gekedua_hasil="TB Negatif" THEN true END) as gedn,
            COUNT(CASE WHEN geketiga_hasil="TB Negatif" THEN true END) as getn,

            COUNT(CASE WHEN gepertama_rif="Indeterminate" THEN true END) as gesi,
            COUNT(CASE WHEN gekedua_rif="Indeterminate" THEN true END) as gedi,
            COUNT(CASE WHEN geketiga_rif="Indeterminate" THEN true END) as geti

            FROM vlinstansi 
            WHERE instansi_id=:id ', ['id'=>$id]);
    }
}
