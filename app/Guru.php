<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = ['nama','telepon','alamat','nip'];

    public function mapel()
    {
    	// $this adalah mengambil banyak data
    	return $this->hasMany(Mapel::class);
    }

    public function getAvatar()
    {
    	if(!$this->avatar) {
    		return asset('images/default.jpg');
    	}
    		return asset('images/'.$this->avatar);
    }
}
