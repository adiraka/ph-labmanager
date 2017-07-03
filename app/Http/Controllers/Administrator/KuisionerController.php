<?php

namespace Labmanager\Http\Controllers\Administrator;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Labmanager\Models\Kuisioner;
use Carbon\Carbon;
use DB;

class KuisionerController extends Controller
{
    public function getIndexKuisioner()
    {
    	return view('backend.administrator.kuisioner');
    }

    public function getFormKuisioner(Request $request)
    {
        return view('backend.administrator.kuisioner.formkuisioner');
    }

    public function getFormUpdateKuisioner(Request $request, $id=null)
     {
        $kuisioner = Kuisioner::with('pasien')->find($id);
        return view('backend.administrator.kuisioner.edit.formekuisioner')->with(['ans'=>$kuisioner]);
     }

    //datatable Responder
    public function getDataTableKuisioner(Request $request)
    {
    	$listkuisioner =  DB::table('kuisioner')
            ->leftJoin('pasien','pasien.id','=','kuisioner.pasien_id')
            ->leftJoin('instansi','instansi.id','=','pasien.instansi_id')
            ->leftJoin('jenisinstansi','jenisinstansi.id','=','instansi.jenisinstansi_id')
            ->leftJoin('daerah','daerah.id','=','instansi.daerah_id')
            ->select(['kuisioner.id','kuisioner.pasien_id','pasien.nama_pasien','pasien.idtb','pasien.sex','pasien.alamat','instansi.nama_instansi','jenisinstansi.nama_jenis_instansi','daerah.nama_daerah']);

    	return Datatables::of($listkuisioner)
        ->addColumn('action', function ($listkuisioner) {
                return '
                <button type="button" class="btn btn-xs bg-lime waves-effect m-r-5" data-toggle="modal" data-target="#ShowKuisioner" data-id="'.$listkuisioner->id.'"><i class="material-icons font-15">share</i></button>
                <button type="button" class="btn btn-xs bg-green waves-effect m-r-5" data-toggle="modal" data-target="#ModalUpdateKuisioner" data-id="'.$listkuisioner->id.'"><i class="material-icons font-15">border_color</i></button>
                <button type="button" class="btn btn-xs bg-light-green waves-effect" data-toggle="modal" data-target="#ModalDeleteKuisioner" data-id="'.$listkuisioner->id.'" data-responden="'.$listkuisioner->nama_pasien.'"><i class="material-icons font-15">delete_forever</i></button>';
            })
            ->addColumn('control', function ($listkuisioner) {})
            ->make(true);
    }

    public function postTambahKuisioner(Request $request)
    {
        $this->validate($request, [
            "pasien_id"=>"required",
        ]);
        
        $kuisionerBaru = new Kuisioner;
        $kuisionerBaru->pasien_id = $request->pasien_id;
        $kuisionerBaru->k1 = $request->ks1;
        $kuisionerBaru->k2 = $request->ks2 == 'lainya' ? $request->ks2t : $request->ks2;
        $kuisionerBaru->k3 = $request->ks3;
        $kuisionerBaru->k4 = $request->ks4 == 'lainya' ? $request->ks4t : $request->ks4;
        $kuisionerBaru->k5 = $request->ks5;
        $kuisionerBaru->k6 = $request->ks6;
        $kuisionerBaru->k7 = $request->ks7;
        $kuisionerBaru->k8 = $request->ks8;
        $kuisionerBaru->k9 = $request->ks9;
        $kuisionerBaru->k10 = $request->ks10;
        $kuisionerBaru->k11 = $request->ks11 == 'lainya' ? $request->ks11t : $request->ks11;
        $kuisionerBaru->k13 = $request->ks13;
        $kuisionerBaru->k14 = $request->ks14;
        $kuisionerBaru->k15 = $request->ks15;
        $kuisionerBaru->k16 = $request->ks16;
        $kuisionerBaru->k17 = $request->ks17;
        $kuisionerBaru->k18 = $request->ks18;
        $kuisionerBaru->k19 = $request->ks19;
        $kuisionerBaru->k20 = $request->ks20 == 'lainya' ? $request->ks20t : $request->ks20;
        $kuisionerBaru->k21 = $request->ks21;
        $kuisionerBaru->k22 = $request->ks22;
        $kuisionerBaru->k23 = $request->ks23;
        $kuisionerBaru->k24 = $request->ks24 == 'lainya' ? $request->ks24t : $request->ks24;
        $kuisionerBaru->k25 = $request->ks25;
        $kuisionerBaru->k26 = $request->ks26 == 'lainya' ? $request->ks26t : $request->ks26;
        $kuisionerBaru->k27 = $request->ks27;
        $kuisionerBaru->k28 = $request->ks28;
        $kuisionerBaru->k29 = $request->ks29;
        $kuisionerBaru->k30 = $request->ks30;
        $kuisionerBaru->k31a = $request->ks31a;
        $kuisionerBaru->k31b = $request->ks31b;
        $kuisionerBaru->k31c = $request->ks31c;
        $kuisionerBaru->k31d = $request->ks31d;
        $kuisionerBaru->k31e = $request->ks31e;
        $kuisionerBaru->k31f = $request->ks31f;
        $kuisionerBaru->k31g = $request->ks31g;
        $kuisionerBaru->k31h = $request->ks31h;
        $kuisionerBaru->k31i = $request->ks31i;
        $kuisionerBaru->k31j = $request->ks31j;
        $kuisionerBaru->k31k = $request->ks31k;
        $kuisionerBaru->k32 = $request->ks32;
        $kuisionerBaru->k33 = $request->ks33;
        $kuisionerBaru->k34 = $request->ks34;
        $kuisionerBaru->k35 = $request->ks35;
        $kuisionerBaru->k36 = $request->ks36;
        $kuisionerBaru->k37 = $request->ks37;
        $kuisionerBaru->k38 = $request->ks38;
        $kuisionerBaru->k39 = $request->ks39;
        $kuisionerBaru->k40 = $request->ks40;
        $kuisionerBaru->k41 = $request->ks41;
        $kuisionerBaru->k42 = $request->ks42;
        $kuisionerBaru->k43a = $request->ks43a;
        $kuisionerBaru->k43b = $request->ks43b;
        $kuisionerBaru->k44 = $request->ks44;
        $kuisionerBaru->k45 = $request->ks45;
        $kuisionerBaru->k46 = $request->ks46;
        $kuisionerBaru->k47 = $request->ks47;
        $kuisionerBaru->k48 = $request->ks48;
        $kuisionerBaru->k49 = $request->ks49;
        $kuisionerBaru->k50a = $request->ks50a;
        $kuisionerBaru->k50b = $request->ks50b == 'lainya' ? $request->ks50bt : $request->ks50b;
        $kuisionerBaru->k50c = $request->ks50c;
        $kuisionerBaru->k51 = $request->ks51;
        $kuisionerBaru->k52 = $request->ks52 == 'lainya' ? $request->ks52t : $request->ks52;
        $kuisionerBaru->k53 = $request->ks53;
        $kuisionerBaru->k54 = $request->ks54;
        $kuisionerBaru->k55 = $request->ks55 == 'lainya' ? $request->ks55t : $request->ks55;
        $kuisionerBaru->k56 = $request->ks56;
        $kuisionerBaru->k57 = $request->ks57;
        $kuisionerBaru->k58 = $request->ks58;
        $kuisionerBaru->k59 = $request->ks59;
        $kuisionerBaru->k60 = $request->ks60;
        $kuisionerBaru->k61 = $request->ks61;
        $kuisionerBaru->k62 = $request->ks62;
        $kuisionerBaru->k63 = $request->ks63;
        $kuisionerBaru->k64 = $request->ks64;
        $kuisionerBaru->k65 = $request->ks65 == 'lainya' ? $request->ks65t : $request->ks65;
        $kuisionerBaru->k66a = $request->ks66a == 'lainya' ? $request->ks66at : $request->ks66a;
        $kuisionerBaru->k66b = $request->ks66b == 'lainya' ? $request->ks66bt : $request->ks66b;
        $kuisionerBaru->k67 = $request->ks67 == 'lainya' ? $request->ks67t : $request->ks67;
        $kuisionerBaru->k68a = $request->ks68a == 'lainya' ? $request->ks68at : $request->ks68a;
        $kuisionerBaru->k68b = $request->ks68b == 'lainya' ? $request->ks68bt : $request->ks68b;
        $kuisionerBaru->k69 = $request->ks69;
        $kuisionerBaru->k70 = $request->ks70;
        $kuisionerBaru->k71 = $request->ks71;
        $kuisionerBaru->k72 = $request->ks72;
        $kuisionerBaru->k73 = $request->ks73;
        $kuisionerBaru->k74 = $request->ks74;
        $kuisionerBaru->k75a = $request->ks75a == 'lainya' ? $request->ks75at : $request->ks75a;
        $kuisionerBaru->k75b = $request->ks75b == 'lainya' ? $request->ks75bt : $request->ks75b;
        $kuisionerBaru->k76 = $request->ks76 == 'lainya' ? $request->ks76t : $request->ks76;
        $kuisionerBaru->k77a = $request->ks77a == 'lainya' ? $request->ks77at : $request->ks77a;
        $kuisionerBaru->k77b = $request->ks77b == 'lainya' ? $request->ks77bt : $request->ks77b;
        $kuisionerBaru->k78 = $request->ks78 == 'lainya' ? $request->ks78t : $request->ks78;
        $kuisionerBaru->k79 = $request->ks79 == 'lainya' ? $request->ks79t : $request->ks79;
        $kuisionerBaru->k80 = $request->ks80 == 'lainya' ? $request->ks80t : $request->ks80;
        $kuisionerBaru->k81 = $request->ks81 == 'lainya' ? $request->ks81t : $request->ks81;
        $kuisionerBaru->k82 = $request->ks82 == 'lainya' ? $request->ks82t : $request->ks82;
        $kuisionerBaru->k83 = $request->ks83;
        $kuisionerBaru->k84 = $request->ks84;
        $kuisionerBaru->k85 = $request->ks85 == 'lainya' ? $request->ks85t : $request->ks85;
        $kuisionerBaru->k86 = $request->ks86 == 'lainya' ? $request->ks86t : $request->ks86;
        $kuisionerBaru->k87 = $request->ks87 == 'lainya' ? $request->ks87t : $request->ks87;
        $kuisionerBaru->k88 = $request->ks88;
        $kuisionerBaru->k89 = $request->ks89;
        $kuisionerBaru->k90 = $request->ks90;
        $kuisionerBaru->k91 = $request->ks91;
        $kuisionerBaru->k92 = $request->ks92;
        $kuisionerBaru->k93 = $request->ks93;
        $kuisionerBaru->k94 = $request->ks94;
        $kuisionerBaru->k95 = $request->ks95;
        $kuisionerBaru->k96 = $request->ks96;
        $kuisionerBaru->k97 = $request->ks97;
        $kuisionerBaru->save();

        $rekap = $this->getRekapKuisioner($request);
        $return =['rekap'=>$rekap,'title'=>'Proses Berhasil','message'=>'data kuisioner telah disimpan'];

        return ($return);
    }

    public function postUpdateKuisioner(Request $request)
    {
        $this->validate($request, [
            "pasien_id"=>"required",
        ]);
        
        $kuisioner = Kuisioner::find($request->_id);
        $kuisioner->pasien_id = $request->pasien_id;
        $kuisioner->k1 = $request->ks1;
        $kuisioner->k2 = $request->ks2 == 'lainya' ? $request->ks2t : $request->ks2;
        $kuisioner->k3 = $request->ks3;
        $kuisioner->k4 = $request->ks4 == 'lainya' ? $request->ks4t : $request->ks4;
        $kuisioner->k5 = $request->ks5;
        $kuisioner->k6 = $request->ks6;
        $kuisioner->k7 = $request->ks7;
        $kuisioner->k8 = $request->ks8;
        $kuisioner->k9 = $request->ks9;
        $kuisioner->k10 = $request->ks10;
        $kuisioner->k11 = $request->ks11 == 'lainya' ? $request->ks11t : $request->ks11;
        $kuisioner->k13 = $request->ks13;
        $kuisioner->k14 = $request->ks14;
        $kuisioner->k15 = $request->ks15;
        $kuisioner->k16 = $request->ks16;
        $kuisioner->k17 = $request->ks17;
        $kuisioner->k18 = $request->ks18;
        $kuisioner->k19 = $request->ks19;
        $kuisioner->k20 = $request->ks20 == 'lainya' ? $request->ks20t : $request->ks20;
        $kuisioner->k21 = $request->ks21;
        $kuisioner->k22 = $request->ks22;
        $kuisioner->k23 = $request->ks23;
        $kuisioner->k24 = $request->ks24 == 'lainya' ? $request->ks24t : $request->ks24;
        $kuisioner->k25 = $request->ks25;
        $kuisioner->k26 = $request->ks26 == 'lainya' ? $request->ks26t : $request->ks26;
        $kuisioner->k27 = $request->ks27;
        $kuisioner->k28 = $request->ks28;
        $kuisioner->k29 = $request->ks29;
        $kuisioner->k30 = $request->ks30;
        $kuisioner->k31a = $request->ks31a;
        $kuisioner->k31b = $request->ks31b;
        $kuisioner->k31c = $request->ks31c;
        $kuisioner->k31d = $request->ks31d;
        $kuisioner->k31e = $request->ks31e;
        $kuisioner->k31f = $request->ks31f;
        $kuisioner->k31g = $request->ks31g;
        $kuisioner->k31h = $request->ks31h;
        $kuisioner->k31i = $request->ks31i;
        $kuisioner->k31j = $request->ks31j;
        $kuisioner->k31k = $request->ks31k;
        $kuisioner->k32 = $request->ks32;
        $kuisioner->k33 = $request->ks33;
        $kuisioner->k34 = $request->ks34;
        $kuisioner->k35 = $request->ks35;
        $kuisioner->k36 = $request->ks36;
        $kuisioner->k37 = $request->ks37;
        $kuisioner->k38 = $request->ks38;
        $kuisioner->k39 = $request->ks39;
        $kuisioner->k40 = $request->ks40;
        $kuisioner->k41 = $request->ks41;
        $kuisioner->k42 = $request->ks42;
        $kuisioner->k43a = $request->ks43a;
        $kuisioner->k43b = $request->ks43b;
        $kuisioner->k44 = $request->ks44;
        $kuisioner->k45 = $request->ks45;
        $kuisioner->k46 = $request->ks46;
        $kuisioner->k47 = $request->ks47;
        $kuisioner->k48 = $request->ks48;
        $kuisioner->k49 = $request->ks49;
        $kuisioner->k50a = $request->ks50a;
        $kuisioner->k50b = $request->ks50b == 'lainya' ? $request->ks50bt : $request->ks50b;
        $kuisioner->k50c = $request->ks50c;
        $kuisioner->k51 = $request->ks51;
        $kuisioner->k52 = $request->ks52 == 'lainya' ? $request->ks52t : $request->ks52;
        $kuisioner->k53 = $request->ks53;
        $kuisioner->k54 = $request->ks54;
        $kuisioner->k55 = $request->ks55 == 'lainya' ? $request->ks55t : $request->ks55;
        $kuisioner->k56 = $request->ks56;
        $kuisioner->k57 = $request->ks57;
        $kuisioner->k58 = $request->ks58;
        $kuisioner->k59 = $request->ks59;
        $kuisioner->k60 = $request->ks60;
        $kuisioner->k61 = $request->ks61;
        $kuisioner->k62 = $request->ks62;
        $kuisioner->k63 = $request->ks63;
        $kuisioner->k64 = $request->ks64;
        $kuisioner->k65 = $request->ks65 == 'lainya' ? $request->ks65t : $request->ks65;
        $kuisioner->k66a = $request->ks66a == 'lainya' ? $request->ks66at : $request->ks66a;
        $kuisioner->k66b = $request->ks66b == 'lainya' ? $request->ks66bt : $request->ks66b;
        $kuisioner->k67 = $request->ks67 == 'lainya' ? $request->ks67t : $request->ks67;
        $kuisioner->k68a = $request->ks68a == 'lainya' ? $request->ks68at : $request->ks68a;
        $kuisioner->k68b = $request->ks68b == 'lainya' ? $request->ks68bt : $request->ks68b;
        $kuisioner->k69 = $request->ks69;
        $kuisioner->k70 = $request->ks70;
        $kuisioner->k71 = $request->ks71;
        $kuisioner->k72 = $request->ks72;
        $kuisioner->k73 = $request->ks73;
        $kuisioner->k74 = $request->ks74;
        $kuisioner->k75a = $request->ks75a == 'lainya' ? $request->ks75at : $request->ks75a;
        $kuisioner->k75b = $request->ks75b == 'lainya' ? $request->ks75bt : $request->ks75b;
        $kuisioner->k76 = $request->ks76 == 'lainya' ? $request->ks76t : $request->ks76;
        $kuisioner->k77a = $request->ks77a == 'lainya' ? $request->ks77at : $request->ks77a;
        $kuisioner->k77b = $request->ks77b == 'lainya' ? $request->ks77bt : $request->ks77b;
        $kuisioner->k78 = $request->ks78 == 'lainya' ? $request->ks78t : $request->ks78;
        $kuisioner->k79 = $request->ks79 == 'lainya' ? $request->ks79t : $request->ks79;
        $kuisioner->k80 = $request->ks80 == 'lainya' ? $request->ks80t : $request->ks80;
        $kuisioner->k81 = $request->ks81 == 'lainya' ? $request->ks81t : $request->ks81;
        $kuisioner->k82 = $request->ks82 == 'lainya' ? $request->ks82t : $request->ks82;
        $kuisioner->k83 = $request->ks83;
        $kuisioner->k84 = $request->ks84;
        $kuisioner->k85 = $request->ks85 == 'lainya' ? $request->ks85t : $request->ks85;
        $kuisioner->k86 = $request->ks86 == 'lainya' ? $request->ks86t : $request->ks86;
        $kuisioner->k87 = $request->ks87 == 'lainya' ? $request->ks87t : $request->ks87;
        $kuisioner->k88 = $request->ks88;
        $kuisioner->k89 = $request->ks89;
        $kuisioner->k90 = $request->ks90;
        $kuisioner->k91 = $request->ks91;
        $kuisioner->k92 = $request->ks92;
        $kuisioner->k93 = $request->ks93;
        $kuisioner->k94 = $request->ks94;
        $kuisioner->k95 = $request->ks95;
        $kuisioner->k96 = $request->ks96;
        $kuisioner->k97 = $request->ks97;
        $kuisioner->save();

        $rekap = $this->getRekapKuisioner($request);
        $return =['rekap'=>$rekap,'title'=>'Proses Berhasil','message'=>'data kuisioner telah diperbaharui'];

        return ($return);
    }

    public function postDeleteKuisioner(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request,[
                '_id'=>'required'
            ]);

            $kuisioner = Kuisioner::find($request->_id);
            $kuisioner->delete();

            $return =['title'=>'Proses Berhasil','message'=>'data Kuisioner telah dihapus'];

            return ($return);
        }

        return response('Unauthorise', 503);
    }

    public function getRekapKuisioner(Request $request)
    {
        $dt = Carbon::now();
        return DB::select("SELECT COUNT(DISTINCT pasien_id) AS total,
            COUNT(CASE WHEN MONTH(`created_at`) = :bln AND  YEAR(`created_at`) = :th THEN 1 END) AS baru
            FROM kuisioner", ['th'=>$dt->year,'bln'=>$dt->month]);
    }
}