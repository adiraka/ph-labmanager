<?php

namespace Labmanager\Models;

use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
	protected $table = 'daerah';
	protected $fillable = ['nama_daerah'];

	public function instansi()
	{
		return $this->hasMany('Labmanager\Models\Instansi');
	}
}