<?php

namespace Labmanager\Http\Controllers\Administrator;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Labmanager\Models\Daerah;
use DB;

class DaerahController extends Controller
{

    //datatable
    public function getDataTableDaerah()
    {
        $daerah = Daerah::with('instansi')->select('*');
         
        return Datatables::of($daerah)
        ->addColumn('jmlInstitusi', function($daerah) {
            return $daerah->instansi->count();
        })
        ->addColumn('action', function ($daerah) {
            return '
            <button type="button" class="btn btn-xs bg-indigo waves-effect m-r-5" data-toggle="modal" data-target="#ModalUpdateDaerah" data-id="'.$daerah->id.'" data-namadaerah="'.$daerah->nama_daerah.'"><i class="material-icons font-15">border_color</i></button>
            <button type="button" class="btn btn-xs bg-indigo waves-effect" data-toggle="modal" data-target="#ModalDeleteDaerah" data-id="'.$daerah->id.'" data-namadaerah="'.$daerah->nama_daerah.'"><i class="material-icons font-15">delete_forever</i></button>';
        })
        ->make(true);
    }

    //CRUD
    public function postTambahDaerah(Request $request)
    {
    	if ($request->ajax()) {
			$this->validate($request,['NamaDaerah' => 'required']);

			$daerahbaru = new Daerah;
			$daerahbaru->nama_daerah = strtoupper($request->NamaDaerah);
			$daerahbaru->save();

            $return =['title'=>'Proses Berhasil','message'=>'data daerah '.$daerahbaru->nama_daerah.' telah disimpan'];

            return ($return);
        }
    }

    public function postUpdateDaerah(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request,['uNamaDaerah' => 'required']);

            $daerah = Daerah::find($request->_id);
            $daerah->nama_daerah = strtoupper($request->uNamaDaerah);
            $daerah->save();

            $return =['title'=>'Proses Berhasil','message'=>'data daerah telah diperbaharui'];
            return ($return);
        }
    }

    public function postDeleteDaerah(Request $request)
    {
        if ($request->ajax()) {

            $daerah = Daerah::find($request->_id);
            $daerah->delete();

            $return =['title'=>'Proses Berhasil','message'=>'data daerah telah dihapus'];
            return ($return);
        }
    }
}
