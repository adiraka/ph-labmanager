<?php

namespace Labmanager\Http\Controllers\administrator;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Labmanager\Models\JenisInstansi;

class JenisInstansiController extends Controller
{
	//datatables
	public function getDataTableJnsInstitusi(Request $request)
	{
		if ($request->ajax()) {
			$listjnsinstansi = JenisInstansi::with('instansi')->select('*');

			return Datatables::of($listjnsinstansi)
			->addColumn('jmlInstitusi', function($listjnsinstansi) {
				return $listjnsinstansi->instansi->count();
			})
			->addColumn('action', function ($listjnsinstansi) {
				return '
				<button type="button" class="btn btn-xs bg-indigo waves-effect m-r-5" data-toggle="modal" data-target="#ModalUpdateJnsInstitusi" data-id="'.$listjnsinstansi->id.'" data-namajnsinstansi="'.$listjnsinstansi->nama_jenis_instansi.'"><i class="material-icons font-15">border_color</i></button>
				<button type="button" class="btn btn-xs bg-indigo waves-effect" data-toggle="modal" data-target="#ModalDeleteJnsInstitusi" data-id="'.$listjnsinstansi->id.'" data-namajnsinstansi="'.$listjnsinstansi->nama_jenis_instansi.'"><i class="material-icons font-15">delete_forever</i></button>';
			})
			->make(true);
		}
		return response('Unauthorise', 503);
	}

	public function postTambahJnsins(Request $request)
	{
		if ($request->ajax()) {
			$this->validate($request,['jNamaJenisInstitusi' => 'required']);

			$jnsInstitusi = new JenisInstansi;
			$jnsInstitusi->nama_jenis_instansi = strtoupper($request->jNamaJenisInstitusi);
			$jnsInstitusi->save();

			$return =['title'=>'Proses Berhasil','message'=>'data Jenis Institusi telah ditambahkan'];

			return ($return);
		}

		return view('administrator.daerah.daerah');
	}

	public function postUpdateJnsins(Request $request)
	{
		if ($request->ajax()) {
			$this->validate($request,['ujNamaJenisInstitusi' => 'required']);

			$jnsInstitusi = JenisInstansi::find($request->_id);
			$jnsInstitusi->nama_jenis_instansi = strtoupper($request->ujNamaJenisInstitusi);
			$jnsInstitusi->save();

			$return =['title'=>'Proses Berhasil','message'=>'data Jenis Institusi telah diperbaharui'];

			return ($return);
		}

		return view('administrator.daerah.daerah');
	}

	public function postDeleteJnsins(Request $request)
	{
		if ($request->ajax()) {

			$jnsInstitusi = JenisInstansi::find($request->_id);
			$jnsInstitusi->delete();

			$return =['title'=>'Proses Berhasil','message'=>'data Jenis Institusi telah dihapus'];

			return ($return);
		}

		return view('administrator.daerah.daerah');
	}
}
