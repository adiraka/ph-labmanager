<?php

namespace Labmanager\Http\Controllers\Administrator;

use Illuminate\Http\Request;

use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Date;

class LaporanController extends Controller
{
    public function getIndex()
    {
    	return view('backend.administrator.laporan');
    }

}