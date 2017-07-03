<?php

namespace Labmanager\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Date;

class LaporanSampelController extends Controller
{
    public function getLaporanSampelPage(Request $request, $id=Null)
    {
        if ($id) {
            $dataSampel = $this->getDataSampel($request->id);
            return view('backend.administrator.report.sampelreport')->with(['id'=>$id,'data'=>$dataSampel]);
        }

        return view('backend.administrator.report.sampelreport')->with('id','blm');
    }

    public function postLaporanSampelPage(Request $request)
    {
        if ($request->id) {

            $dataSampel = $this->getDataSampel($request->id);
            return view('backend.administrator.report.sampelreport')->with(['id'=>$request->id,'data'=>$dataSampel]);
        }

        return view('backend.administrator.report.sampelreport')->with('id','blm');
    }

    public function getDataSampel($id)
    {
        return DB::select('SELECT * FROM vperiksa WHERE id=:id', ['id'=>$id]);
    }
}
