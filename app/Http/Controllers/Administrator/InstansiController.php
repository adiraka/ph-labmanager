<?php

namespace Labmanager\Http\Controllers\Administrator;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Labmanager\Models\Instansi;
use Carbon\Carbon;
use DB;

class InstansiController extends Controller
{
	public function getIndexInstitusi()
	{
		$listdaerah = DB::select("SELECT * FROM daerah", []);
		$listJnsInstansi = DB::select("SELECT * FROM jenisinstansi", []);

		return view('backend.administrator.institusi')->with(['listdaerah'=>$listdaerah,'listJnsInstansi'=>$listJnsInstansi]);
	}

	// datatables Responder
	public function getDataTableInstitusi(Request $request)
	{
		if ($request->ajax()) {
			$listinstansi = Instansi::with('jenisinstansi','daerah')->select('*');

			return Datatables::of($listinstansi)
			->addColumn('action', function ($listinstansi) {
				return '
				<button type="button" class="btn btn-xs bg-green waves-effect m-r-5" data-toggle="modal" data-target="#ModalUpdateInstitusi" data-id="'.$listinstansi->id.'"><i class="material-icons font-15">border_color</i></button>
				<button type="button" class="btn btn-xs bg-light-green waves-effect" data-toggle="modal" data-target="#ModalDeleteInstitusi" data-id="'.$listinstansi->id.'" data-namainstansi="'.$listinstansi->nama_instansi.'" data-jenisinstansi="'.$listinstansi->jenisinstansi->nama_jenis_instansi.'" data-daerah="'.$listinstansi->daerah->nama_daerah.'" data-alamat="'.$listinstansi->alamat.'"><i class="material-icons font-15">delete_forever</i></button>';
			})
			->addColumn('control', function ($listinstansi) {})
			->make(true);
		}
		return response('Unauthorise', 503);
	}

	// select2 Responder
	public function getListInstitusi(Request $request)
	{
		if ($request->ajax()) {
			$this->validate($request,["term"=>"required"]);
			$return = collect();

			$listInstansi = Instansi::with('jenisinstansi','daerah')->where('nama_instansi','like',"%".$request->term."%")
			->get();

			foreach ($listInstansi as $instansi) {
				$return->push(['id'=>$instansi->id,'text'=>$instansi->jenisinstansi->nama_jenis_instansi.' '.$instansi->nama_instansi.' '.$instansi->daerah->nama_daerah]);
			}
		
			return response()->json($return);
		}

		return response('Unauthorized', 503);
	}

	public function postTambahInstitusi(Request $request)
	{
		if ($request->ajax()) {
			$this->validate($request,[
				'iNamaInstitusi' => 'required',
				'iJnsInstitusi'=>'required',
				'iDaerah' =>'required',
				'iAlamat' =>'required',
				]);

			$rekap = $this->getRekapInstitusi($request);

			$instansibaru = new Instansi;
			$instansibaru->nama_instansi = strtoupper($request->iNamaInstitusi);
			$instansibaru->jenisinstansi_id = strtoupper($request->iJnsInstitusi);
			$instansibaru->daerah_id = strtoupper($request->iDaerah);
			$instansibaru->alamat = strtoupper($request->iAlamat);
			$instansibaru->save();

			$return =['rekap'=>$rekap,'title'=>'Proses Berhasil','message'=>'data Institusi telah disimpan'];

			return ($return);
		}

		return response('Unauthorise', 503);
	}

	public function postUpdateInstitusi(Request $request)
	{
		if ($request->ajax()) {
			$this->validate($request,[
				'uiNamaInstitusi' => 'required',
				'uiJnsInstitusi'=>'required',
				'uiDaerah' =>'required',
				'uiAlamat' =>'required',
				]);

			$instansibaru = Instansi::find($request->_id);
			$instansibaru->nama_instansi = strtoupper($request->uiNamaInstitusi);
			$instansibaru->jenisinstansi_id = strtoupper($request->uiJnsInstitusi);
			$instansibaru->daerah_id = strtoupper($request->uiDaerah);
			$instansibaru->alamat = strtoupper($request->uiAlamat);
			$instansibaru->save();

			$return =['title'=>'Proses Berhasil','message'=>'data Institusi telah diperbaharui'];

			return ($return);
		}

		return response('Unauthorise', 503);
	}

	public function postDeleteInstitusi(Request $request)
	{
		if ($request->ajax()) {
			$this->validate($request,[
				'_id'=>'required'
			]);

			$instansi = Instansi::find($request->_id);
			$instansi->delete();

			$return =['title'=>'Proses Berhasil','message'=>'data Institusi telah dihapus'];

			return ($return);
		}

		return response('Unauthorise', 503);
	}

	public function getDetailInstitusi(Request $request, $id)
	{
		$institusi = Instansi::with('jenisinstansi','daerah')->find($id);

		if ($request->ajax()) {
			return response()->json($institusi);
		}

		return response('Unauthorise', 503);
	}

	public function getRekapInstitusi(Request $request)
	{
		$dt = Carbon::now();
		$rekapinstitusi = DB::select("SELECT COUNT(DISTINCT id) AS total,
            COUNT(CASE WHEN MONTH(`created_at`) = :bln AND  YEAR(`created_at`) = :th THEN 1 END) AS baru
            FROM vinstansi", ['th'=>$dt->year,'bln'=>$dt->month]);

			return $rekapinstitusi;
	}
}
