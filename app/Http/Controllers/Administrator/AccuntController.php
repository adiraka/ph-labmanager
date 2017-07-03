<?php

namespace Labmanager\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use Labmanager\Models\User;
use Labmanager\Models\UserAkun;
use Auth;
use DB;

class AccuntController extends Controller
{
	public function getProfil() {
		$user = UserAkun::with('profil')->find(Auth::user()->id);
		return view('backend.administrator.profil')->with('user',$user);
	}

	public function postAkun(Request $request){
		$user = Auth::user()->id;
		return view('administrator.akun.akun')->with('user',$user);
	}

	public function postProfil(Request $request){
		$user = Auth::user()->id;
		return view('administrator.akun.profil')->with('user',$user);
	}
}
