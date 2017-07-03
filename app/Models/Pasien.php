<?php

namespace Labmanager\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = ['id','nama_pasien','tgl_lhr','tgl_daftar','umur','sex','instansi_id','kuisioner','enumerator','alamat'];

    public function instansi()
    {
    	return $this->belongsTo('Labmanager\Models\Instansi');
    }

    public function pemeriksaan()
    {
    	return $this->hasMany('Labmanager\Models\Periksa');
    }

    public function kuisioner()
    {
    	return $this->hasOne('Labmanager\Models\kuisioner');
    }

}
