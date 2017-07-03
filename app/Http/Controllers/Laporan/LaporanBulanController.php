<?php

namespace Labmanager\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Date;

class LaporanBulanController extends Controller
{
    public function getLaporanBulananPage(Request $request, $bln=Null,$thn=Null)
    {
        Carbon::setLocale('id');
        Date::setLocale('id');

        $skr  = Carbon::now('Asia/Jakarta');
        $bln ? $bln = $bln : $bln = $skr->month;
        $thn ? $thn = $thn : $thn = $skr->year;
        $test = Carbon::createFromDate($skr->year, $bln, $skr->day, $skr->tz);

        $statistik = $this->getStatistikBln($bln,$thn);
        $data = $this->getDataBln($bln,$thn);

    	return view('backend.administrator.report.bulanreport')->with(['statistik'=>$statistik,'data'=>$data,'bln'=>$bln,'thn'=>$thn]);
    }

    public function postLaporanBulananPage(Request $request)
    {
        Carbon::setLocale('id');
        Date::setLocale('id');

        $bln = $request->bln;
        $thn = $request->thn;

        $skr  = Carbon::now('Asia/Jakarta');
        $bln ? $bln = $bln : $bln = $skr->month;
        $thn ? $thn = $thn : $thn = $skr->year;
        $test = Carbon::createFromDate($skr->year, $bln, $skr->day, $skr->tz);

        $statistik = $this->getStatistikBln($bln,$thn);
        $data = $this->getDataBln($bln,$thn);

        return view('backend.administrator.report.bulanreport')->with(['statistik'=>$statistik,'data'=>$data,'bln'=>$bln,'thn'=>$thn]);
    }

    public function getStatistikBln($bln,$thn)
    {
        return DB::select('SELECT 
            COUNT(*) as total,
            COUNT(CASE WHEN jns_sampel="GeneXpert" AND hasil="TB Positif" AND rif="Rif Positif" THEN true END) as pp,
            COUNT(CASE WHEN (jns_sampel="GeneXpert" AND hasil="TB Positif" AND rif="Rif Negatif") OR (jns_sampel="BTA" AND hasil="TB Positif") THEN true END) as pn,
            COUNT(CASE WHEN hasil="TB Negatif" THEN true END) as n,
            COUNT(CASE WHEN rif="Indeterminate" THEN true END) as i

            FROM periksa WHERE MONTH(`tgl_periksa`)=:bln AND YEAR(`tgl_periksa`)=:thn ', ['bln'=>$bln,'thn'=>$thn]);
    }

    public function getDataBln($bln,$thn)
    {
        return DB::select('SELECT id,nama_pasien,sex,umur,kuisioner,btapertama_hasil,btakedua_hasil,btaketiga_hasil,gepertama_hasil,gepertama_rif,gekedua_hasil,gekedua_rif,geketiga_hasil,geketiga_rif 
            FROM vlbln 
            WHERE ( MONTH(`btapertama_tgl_periksa`)=:bln  AND YEAR(`btapertama_tgl_periksa`)=:thn )
            OR ( MONTH(`btakedua_tgl_periksa`)=:bln AND YEAR(`btakedua_tgl_periksa`)=:thn )
            OR ( MONTH(`btaketiga_tgl_periksa`)=:bln AND YEAR(`btaketiga_tgl_periksa`)=:thn )
            OR ( MONTH(`gepertama_tgl_periksa`)=:bln AND YEAR(`gepertama_tgl_periksa`)=:thn )
            OR ( MONTH(`gekedua_tgl_periksa`)=:bln AND YEAR(`gekedua_tgl_periksa`)=:thn )
            OR ( MONTH(`geketiga_tgl_periksa`)=:bln AND YEAR(`geketiga_tgl_periksa`)=:thn )', ['bln'=>$bln,'thn'=>$thn]);
    }
}
