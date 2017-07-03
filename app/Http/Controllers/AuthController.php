<?php

namespace Labmanager\Http\Controllers;

use Auth;
use Date;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;

class AuthController extends Controller
{
    public function getLogin()
    {
        if(Auth::check() && Auth::user()->hak_akses === 'webmaster') {
            return redirect()->route('wm.beranda');
        }
        elseif(Auth::check() && Auth::user()->hak_akses === 'administrator') {
            return redirect()->route('adm.beranda');
        }
        else {
            return view('backend.login');
        }
    }

    public function postLogin(Request $request)
    {
    	$this->validate($request,[
    		'username'=>"required",
    		'password'=>"required",
           ]);

        $username = $request->input('username');
        $password = $request->input('password');
        Date::setLocale('id');

        if(Auth::attempt(['username' => $username, 'password' => $password, 'status' => 1])){
            $user = Auth::user();
            
            $notification = array(
                'title' => 'Selamat Datang '.$user->username,
                'message' => 'Session activated at '.Date::now()->format('l j F Y') .' '.Date::now()->format('H:i:s'), 
                'alert-type' => 'success'
                );

            if($user->hak_akses === 'webmaster') {
                return redirect()->intended('/webmaster/beranda')->with($notification);
            }
            if ($user->hak_akses === 'administrator') {
                return redirect()->intended('/administrator/beranda')->with($notification);
            }
        }else{
            $notification = array(
                'title' => 'Login Gagal',
                'message' => 'Username atau Password salah, Mohon Cek kembali', 
                'alert-type' => 'warning'
                );
            return redirect()->back()->with($notification);
        }

    }
}
