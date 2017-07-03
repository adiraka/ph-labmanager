<?php

namespace Labmanager\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAkun extends Authenticatable
{
    protected $table = 'userakun';
    protected $fillable = ['username','password','status','hak_akses'];
    protected $hidden = ['password', 'remember_token'];

    public function profil()
    {
    	return $this->hasOne('Labmanager\Models\User','userakun_id');
    }

}
