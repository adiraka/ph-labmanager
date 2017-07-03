<?php

namespace Labmanager\Http\Controllers\Administrator;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Labmanager\Models\Periksa;
use Carbon\Carbon;
use DB;

class PeriksaController extends Controller
{
    public function getIndexSampel()
    {
    	return view('backend.administrator.sampel');
    }

    // datatables Responder
    public function getDataTableSampel(Request $request)
    {
        if ($request->ajax()) {
            $listPeriksa = Periksa::with('pasien')->select('*');

            return Datatables::of($listPeriksa)
            ->editColumn('tgl_periksa', function ($listPeriksa) {
                return $listPeriksa->tgl_periksa->format('d-m-Y');
            })
            ->editColumn('tgl_masuk_sampel', function ($listPeriksa) {
                return $listPeriksa->tgl_masuk_sampel->format('d-m-Y');
            })
            ->addColumn('action', function ($listPeriksa) {
                return '
                <button type="button" class="btn btn-xs bg-green waves-effect m-r-5" data-toggle="modal" data-target="#ModalUpdateSampel" data-id="'.$listPeriksa->id.'"><i class="material-icons font-15">border_color</i></button>
                <button type="button" class="btn btn-xs bg-light-green waves-effect" data-toggle="modal" data-target="#ModalDeleteSampel" data-id="'.$listPeriksa->id.'" data-idtb="'.$listPeriksa->idtb.'" data-idpp="'.$listPeriksa->idpp.'" data-nama_pasien="'.$listPeriksa->pasien->nama_pasien.'" data-pemeriksaanke="'.$listPeriksa->pemeriksaan_ke.'" data-jns_sampel="'.$listPeriksa->jns_sampel.'" data-hasil="'.$listPeriksa->hasil.'"><i class="material-icons font-15">delete_forever</i></button>';
            })
            ->addColumn('control', function ($listPasien) {})
            ->make(true);
        }
        return response('Unauthorise', 503);
    }

    public function getDataTableSampelPositiv(Request $request)
    {
        if ($request->ajax()) {
            $listPeriksa = Periksa::positiv()->with('pasien')->select('*');

            return Datatables::of($listPeriksa)
            ->editColumn('tgl_periksa', function ($listPeriksa) {
                return $listPeriksa->tgl_periksa->format('d-m-Y');
            })
            ->editColumn('tgl_masuk_sampel', function ($listPeriksa) {
                return $listPeriksa->tgl_masuk_sampel->format('d-m-Y');
            })
            ->addColumn('action', function ($listPeriksa) {
                return '
                <button type="button" class="btn btn-xs bg-green waves-effect m-r-5" data-toggle="modal" data-target="#ModalUpdateSampel" data-id="'.$listPeriksa->id.'"><i class="material-icons font-15">border_color</i></button>
                <button type="button" class="btn btn-xs bg-light-green waves-effect" data-toggle="modal" data-target="#ModalDeleteSampel" data-id="'.$listPeriksa->id.'" data-idtb="'.$listPeriksa->idtb.'" data-idpp="'.$listPeriksa->idpp.'" data-nama_pasien="'.$listPeriksa->pasien->nama_pasien.'" data-pemeriksaanke="'.$listPeriksa->pemeriksaan_ke.'" data-jns_sampel="'.$listPeriksa->jns_sampel.'" data-hasil="'.$listPeriksa->hasil.'"><i class="material-icons font-15">delete_forever</i></button>';
            })
            ->addColumn('control', function ($listPasien) {})
            ->make(true);
        }
        return response('Unauthorise', 503);
    }

    public function getDataTableSampelNegativ(Request $request)
    {
        if ($request->ajax()) {
            $listPeriksa = Periksa::negativ()->with('pasien')->select('*');

            return Datatables::of($listPeriksa)
            ->editColumn('tgl_periksa', function ($listPeriksa) {
                return $listPeriksa->tgl_periksa->format('d-m-Y');
            })
            ->editColumn('tgl_masuk_sampel', function ($listPeriksa) {
                return $listPeriksa->tgl_masuk_sampel->format('d-m-Y');
            })
            ->addColumn('action', function ($listPeriksa) {
                return '
                <button type="button" class="btn btn-xs bg-green waves-effect m-r-5" data-toggle="modal" data-target="#ModalUpdateSampel" data-id="'.$listPeriksa->id.'"><i class="material-icons font-15">border_color</i></button>
                <button type="button" class="btn btn-xs bg-light-green waves-effect" data-toggle="modal" data-target="#ModalDeleteSampel" data-id="'.$listPeriksa->id.'" data-idtb="'.$listPeriksa->idtb.'" data-idpp="'.$listPeriksa->idpp.'" data-nama_pasien="'.$listPeriksa->pasien->nama_pasien.'" data-pemeriksaanke="'.$listPeriksa->pemeriksaan_ke.'" data-jns_sampel="'.$listPeriksa->jns_sampel.'" data-hasil="'.$listPeriksa->hasil.'"><i class="material-icons font-15">delete_forever</i></button>';
            })
            ->addColumn('control', function ($listPasien) {})
            ->make(true);
        }
        return response('Unauthorise', 503);
    }

    // select2 Responder
    public function getListSampel(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request,["term"=>"required"]);
            $return = collect();

            $listSampel = Periksa::with('pasien')->where('idtb','like',"%".$request->term."%")
            ->get();

            foreach ($listSampel as $sampel) {
                $return->push(['id'=>$sampel->id,'text'=>$sampel->idtb.' - '.$sampel->jns_sampel.' - '.$sampel->pasien->nama_pasien]);
            }
        
            return response()->json($return);
        }

        return response('Unauthorized', 503);
    }

    // detail sampel
    public function getDetailSampel(Request $request, $id)
    {
      $periksa = Periksa::with('pasien')->find($id);

      if ($request->ajax()) {
        return response()->json($periksa);
      }

      return response()->json($periksa);
    }

    public function postTambahSampel(Request $request)
    {

        $this->validate($request, [
            "pasien_id"=>"required",
            "idtb"=>"required",
            "pemeriksaanke"=>"required",
            "tgl_masuk_sampel"=>"required",
            "tgl_periksa"=>"required",
            "jns_sampel"=>"required",
            "hasil"=>"required"
        ]);

        $rekap = $this->getRekapSampel($request);

        $tgl_masuk_sampel =Carbon::createFromFormat('Y/m/d',$request->tgl_masuk_sampel);
        $tgl_periksa =Carbon::createFromFormat('Y/m/d',$request->tgl_periksa);

        $periksaBaru = new Periksa;
        $periksaBaru->pasien_id = $request->pasien_id;
        $periksaBaru->idtb = $request->idtb;
        $periksaBaru->idpp = $request->idpp;
        $periksaBaru->pemeriksaan_ke = $request->pemeriksaanke;
        $periksaBaru->tgl_periksa = $tgl_periksa;
        $periksaBaru->tgl_masuk_sampel = $tgl_masuk_sampel;
        $periksaBaru->jns_sampel = $request->jns_sampel;
        $periksaBaru->jns_resistensi = $request->jenisresistensi ? $request->jenisresistensi : Null;
        $periksaBaru->hasil = $request->hasil;
        $periksaBaru->rif = $request->rif ? $request->rif : Null;
        $periksaBaru->save();

    	$return = ['rekap'=>$rekap,'title'=>'Proses Berhasil','message'=>'data sampel telah ditambahkan'];

        return ($return);
    }

    public function postUpdateSampel(Request $request)
    {

        $this->validate($request, [
             "_id"              =>"required",
             "pasien_id"        =>"required",
             "idtb"             =>"required",
             "pemeriksaanke"    =>"required",
             "tgl_masuk_sampel" =>"required",
             "tgl_periksa"      =>"required",
             "jns_sampel"       =>"required",
             "hasil"            =>"required"
        ]);

        $tgl_masuk_sampel =Carbon::createFromFormat('Y/m/d',$request->tgl_masuk_sampel);
        $tgl_periksa =Carbon::createFromFormat('Y/m/d',$request->tgl_periksa);

        $periksa = Periksa::find($request->_id);
        $periksa->pasien_id = $request->pasien_id;
        $periksa->idtb = $request->idtb;
        $periksa->idpp = $request->idpp;
        $periksa->pemeriksaan_ke = $request->pemeriksaanke;
        $periksa->tgl_periksa = $tgl_periksa;
        $periksa->tgl_masuk_sampel = $tgl_masuk_sampel;
        $periksa->jns_sampel = $request->jns_sampel;
        $periksa->jns_resistensi = $request->jenisresistensi ? $request->jenisresistensi : Null;
        $periksa->hasil = $request->hasil;
        $periksa->rif = $request->rif ? $request->rif : Null;
        $periksa->save();

        $return = ['title'=>'Proses Berhasil','message'=>'data sampel telah diperbaharui'];

        return ($return);
    }

    public function postDeleteSampel(Request $request)
    {
        $this->validate($request,[
            '_id'=>'required'
            ]);

        $periksa = Periksa::find($request->_id);
        $periksa->delete();

        $return = ['title'=>'Proses Berhasil','message'=>'data sampel telah dihapus'];

        return ($return);
    }

    public function getRekapSampel(Request $request)
    {
        $dt = Carbon::now();
        $rekapsampel = DB::select("SELECT COUNT(DISTINCT id) AS total,
            COUNT(CASE WHEN MONTH(`tgl_periksa`) = :bln AND  YEAR(`tgl_periksa`) = :th THEN 1 END) AS baru
            FROM vperiksa", ['th'=>$dt->year,'bln'=>$dt->month]);

        return $rekapsampel;
    }
    
}
