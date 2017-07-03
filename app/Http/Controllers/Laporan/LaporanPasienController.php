<?php

namespace Labmanager\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Date;

class LaporanPasienController extends Controller
{
    public function getLaporanPasienPage(Request $request, $id=Null)
    {
        if ($id) {
            $dataPas = $this->getDataPas($request->$id);
            return view('backend.administrator.report.pasienreport')->with(['id'=>$id,'data'=>$dataPas]);
        }

    	return view('backend.administrator.report.pasienreport')->with('id','blm');
    }

    public function postLaporanPasienPage(Request $request)
    {
        if ($request->pasien_id) {

            $dataPas = $this->getDataPas($request->pasien_id);
            return view('backend.administrator.report.pasienreport')->with(['id'=>$request->pasien_id,'data'=>$dataPas]);
        }

        return view('backend.administrator.report.pasienreport')->with('id','blm');
    }
    
    public function getDataPas($id)
    {
        return DB::select('SELECT * FROM vlpasien WHERE id=:id', ['id'=>$id]);
    }
}
