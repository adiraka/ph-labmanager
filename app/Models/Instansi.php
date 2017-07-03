<?php

namespace Labmanager\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $fillable = ['nama_instansi','jenisinstansi_id','daerah_id','alamat'];

    public function daerah()
    {
    	return $this->belongsTo('Labmanager\Models\Daerah');
    }

    public function jenisinstansi()
    {
    	return $this->belongsTo('Labmanager\Models\JenisInstansi');
    }

    public function pasien()
    {
    	return $this->hasMany('Labmanager\Models\Pasien');
    }

}
