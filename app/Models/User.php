<?php

namespace Labmanager\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['nama_user','tmp_lhr','tgl_lhr','agama','sex','tlp','foto','alamat','userakun_id','created_at','updated_at'];
    protected $dates =['tgl_lhr','created_at','updated_at'];

    public function akun()
    {
    	return $this->belongsTo('Labmanager\Models\UserAkun');
    }
    
	public function formatTgl($tgl)
    {
    	return $tgl->format('d-m-Y');
    }
}
