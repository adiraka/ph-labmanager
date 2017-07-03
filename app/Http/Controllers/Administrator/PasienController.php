<?php

namespace Labmanager\Http\Controllers\Administrator;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Labmanager\Models\Pasien;
use Carbon\Carbon;
use DB;

class PasienController extends Controller
{
    public function getIndexPasien()
    {
    	return view('backend.administrator.pasien');
    }

    // select2 Responder
    public function getListPasien(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request,["term"=>"required"]);
            $return = collect();

            $listPasien = Pasien::with('instansi')
            ->where('idtb','like',"%".$request->term."%")
            ->orWhere('nama_pasien','like',"%".$request->term."%")
            ->get();

            foreach ($listPasien as $pasien) {
                $return->push(['id'=>$pasien->id,'text'=>$pasien->idtb.' - '.$pasien->nama_pasien.' - '.$pasien->instansi->nama_instansi]);
            }
        
            return response()->json($return);
        }

        return response('Unauthorized', 503);
    }

    // datatables Responder
    public function getDataTablePasien(Request $request)
    {
    	if ($request->ajax()) {
    		$listPasien = Pasien::with('instansi','pemeriksaan')->select('*');

    		return Datatables::of($listPasien)
            ->addColumn('action', function ($listPasien) {
                return '
                <button type="button" class="btn btn-xs bg-teal waves-effect m-r-5" data-toggle="modal" data-target="#ModalTambahSampel" data-id="'.$listPasien->id.'" data-nama_pasien="'.$listPasien->nama_pasien.'" data-idtb="'.$listPasien->idtb.'" data-idpp="'.$listPasien->idpp.'"><i class="material-icons font-15">playlist_add</i></button>
                <button type="button" class="btn btn-xs bg-green waves-effect m-r-5" data-toggle="modal" data-target="#ModalUpdatePasien" data-id="'.$listPasien->id.'" data-idtb="'.$listPasien->idtb.'" data-idpp="'.$listPasien->idpp.'"><i class="material-icons font-15">border_color</i></button>
                <button type="button" class="btn btn-xs bg-light-green waves-effect" data-toggle="modal" data-target="#ModalDeletePasien" data-id="'.$listPasien->id.'" data-idtb="'.$listPasien->idtb.'" data-idpp="'.$listPasien->idpp.'" data-nama_pasien="'.$listPasien->nama_pasien.'" data-sex="'.$listPasien->sex.'" data-umur="'.$listPasien->umur.'"><i class="material-icons font-15">delete_forever</i></button>';
            })
            ->addColumn('control', function ($listPasien) {})
            ->make(true);
    	}
    	return response('Unauthorise', 503);
    }

    // detail pasien
    public function getDetailPasien(Request $request, $id)
    {
        $pasien = Pasien::with('instansi')->find($id);

        if ($request->ajax()) {
            return response()->json($pasien);
        }
        
        return response('Unauthorise', 503);
    }

    // CRUD
    public function postTambahPasien(Request $request)
    {
        $this->validate($request, [
            "idtb"=>"required",
            "namapasien"=>"required",
            "sex"=>"required",
            "instansiasal"=>"required",
            "kuisioner"=>"required"
        ]);

        $rekap = $this->getRekapPasien($request);

        $pasienBaru = new Pasien;
        $pasienBaru->idtb = $request->idtb;
        $pasienBaru->idpp = ($request->idpp ? $request->idpp : NULL);
        $pasienBaru->nama_pasien = $request->namapasien;
        $pasienBaru->tgl_lhr = ( $request->tgllahir ? $request->tgllahir : Null );
        $pasienBaru->tgl_daftar = ( $request->tgl_daftar ? NULL : date("Y-m-d") );
        $pasienBaru->umur = ( $request->umur ? $request->umur : Null );
        $pasienBaru->sex = $request->sex;
        $pasienBaru->instansi_id = $request->instansiasal;
        $pasienBaru->kuisioner = $request->kuisioner;
        $pasienBaru->enumerator = ( $request->enumerator ? $request->enumerator : Null );
        $pasienBaru->alamat = ( $request->alamat ? $request->alamat : Null );
        $pasienBaru->save();

        $return =['rekap'=>$rekap,'title'=>'Proses Berhasil','message'=>'data pasien '.$pasienBaru->nama_pasien.' telah disimpan'];

        return ($return);
    }

    public function postUpdatePasien(Request $request)
    {
        $this->validate($request,[
            "_id"          =>"required",
            "namapasien"   =>"required",
            "sex"          =>"required",
            "instansiasal" =>"required",
            "kuisioner"    =>"required"
            ]);

        $pasien = Pasien::find($request->_id);
        $pasien->idtb = $request->idtb;
        $pasien->idpp = ($request->idpp ? $request->idpp : NULL);
        $pasien->nama_pasien = $request->namapasien;
        $pasien->tgl_lhr = ( $request->tgllahir ? $request->tgllahir : Null );
        $pasien->tgl_daftar = ( $request->tgl_daftar ? NULL : date("Y-m-d") );
        $pasien->umur = ( $request->umur ? $request->umur : Null );
        $pasien->sex = $request->sex;
        $pasien->instansi_id = $request->instansiasal;
        $pasien->kuisioner = $request->kuisioner;
        $pasien->enumerator = ( $request->enumerator ? $request->enumerator : Null );
        $pasien->alamat = ( $request->alamat ? $request->alamat : Null );
        $pasien->save();

        $return =['title'=>'Proses Berhasil','message'=>'data pasien '.$pasien->nama_pasien.'telah perbaharui'];

        return ($return);
    }

    public function postDeletePasien(Request $request)
    {
        $this->validate($request,[
            '_id'=>'required'
            ]);

        $pasien = Pasien::find($request->_id);
        $pasien->delete();

        $return = ['title'=>'Proses Berhasil','message'=>'data pasien telah dihapus'];

        return ($return);
    }

    public function getRekapPasien(Request $request)
    {
        $dt = Carbon::now();
        $rekappasien = DB::select("SELECT COUNT(DISTINCT id) AS total,
            COUNT(CASE WHEN MONTH(`created_at`) = :bln AND  YEAR(`created_at`) = :th THEN 1 END) AS baru
            FROM vpasien", ['th'=>$dt->year,'bln'=>$dt->month]);

        return $rekappasien;
    }
}
