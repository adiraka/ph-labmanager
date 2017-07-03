<?php

namespace Labmanager\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $table = 'periksa';
    protected $fillable = ['id','idtb','idpp','pasien_id','pemeriksaan_ke','jns_sampel','jns_resistensi','hasil','rif'];
    protected $dates = ['tgl_periksa','tgl_masuk_sampel'];

    public function pasien()
    {
    	return $this->belongsTo('Labmanager\Models\Pasien');
    }

    public function scopePositiv($query)
    {
    	return $query->where('hasil','TB Positif');
    }

    public function scopeNegativ($query)
    {
    	return $query->where('hasil','TB Negatif');
    }
}
