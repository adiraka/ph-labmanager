<?php

namespace Labmanager\Models;

use Illuminate\Database\Eloquent\Model;

class JenisInstansi extends Model
{
    protected $table = 'jenisinstansi';
    protected $fillable = ['nama_jenis_instansi'];

    public function instansi()
    {
    	return $this->hasMany('Labmanager\Models\Instansi','jenisinstansi_id');
    }
}
