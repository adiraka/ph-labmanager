<?php

namespace Labmanager\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

class BerandaController extends Controller
{
	public function getBeranda(Request $request)
	{
		$return = collect([]);
        $dt = Carbon::now();

        $listdaerah = DB::select("SELECT * FROM daerah", []);
		$listJnsInstansi = DB::select("SELECT * FROM jenisinstansi", []);

		$rekappasien = $this->getRekapPasien($request);
		$rekapsampel = $this->getRekapSampel($request);
		$rekapinstitusi = $this->getRekapInstitusi($request);
		$rekapdaerah = $this->getRekapDaerah($request);
		$rekapkuis = $this->getRekapKuisioner($request);

		return view('backend.administrator.beranda')->with([
			'rekapsampel'     =>$rekapsampel,
			'rekappasien'     =>$rekappasien,
			'rekapinstitusi'  =>$rekapinstitusi,
			'rekapdaerah'     =>$rekapdaerah,
			'rekapkuis'       =>$rekapkuis,
			'listdaerah'      =>$listdaerah,
			'listJnsInstansi' =>$listJnsInstansi,
            ]);
	}

	public function getPesan()
	{
		return view('administrator.pesan');
	}

	public function getPetunjuk()
	{
		return view('administrator.petunjuk');
	}

	public function getRekapPasien(Request $request)
	{
		$dt = Carbon::now();
		$rekappasien = DB::select("SELECT COUNT(DISTINCT id) AS total,
            COUNT(CASE WHEN MONTH(`created_at`) = :bln AND  YEAR(`created_at`) = :th THEN 1 END) AS baru
            FROM vpasien", ['th'=>$dt->year,'bln'=>$dt->month]);

		if ($request->ajax()) {
			return response()->json($rekappasien);
		} else {
			return $rekappasien;
		} 
	}

	public function getRekapSampel(Request $request)
	{
		$dt = Carbon::now();
		$rekapsampel = DB::select("SELECT COUNT(DISTINCT id) AS total,
            COUNT(CASE WHEN MONTH(`tgl_periksa`) = :bln AND  YEAR(`tgl_periksa`) = :th THEN 1 END) AS baru
            FROM vperiksa", ['th'=>$dt->year,'bln'=>$dt->month]);

		if ($request->ajax()) {
			return response()->json($rekapsampel);
		} else {
			return $rekapsampel;
		} 
	}

	public function getRekapInstitusi(Request $request)
	{
		$dt = Carbon::now();
		$rekapinstitusi = DB::select("SELECT COUNT(DISTINCT id) AS total,
            COUNT(CASE WHEN MONTH(`created_at`) = :bln AND  YEAR(`created_at`) = :th THEN 1 END) AS baru
            FROM vinstansi", ['th'=>$dt->year,'bln'=>$dt->month]);

		if ($request->ajax()) {
			return response()->json($rekapinstitusi);
		} else {
			return $rekapinstitusi;
		} 
	}

	public function getRekapDaerah(Request $request)
	{
		$dt = Carbon::now();
		$rekapdaerah = DB::select("SELECT COUNT(DISTINCT id) AS total,
            COUNT(CASE WHEN MONTH(`created_at`) = :bln AND  YEAR(`created_at`) = :th THEN 1 END) AS baru
            FROM daerah", ['th'=>$dt->year,'bln'=>$dt->month]);

		if ($request->ajax()) {
			return response()->json($rekapdaerah);
		} else {
			return $rekapdaerah;
		}
	}

	public function getRekapKuisioner(Request $request)
	{
		$dt = Carbon::now();
		$rekapkuis = DB::select("SELECT COUNT(DISTINCT pasien_id) AS total,
            COUNT(CASE WHEN MONTH(`created_at`) = :bln AND  YEAR(`created_at`) = :th THEN 1 END) AS baru
            FROM kuisioner", ['th'=>$dt->year,'bln'=>$dt->month]);

		if ($request->ajax()) {
			return response()->json($rekapkuis);
		} else {
			return $rekapkuis;
		}
	}
}
