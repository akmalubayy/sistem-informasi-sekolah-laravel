<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    // Fillable adalah dari field table db yang sudah dibuat, di inisialisasi untuk form inputan agar terinput ke db
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','user_id','tgl_lahir'];

    protected $dates = ['tgl_lahir'];

    public function getAvatar()
    {
    	if(!$this->avatar) {
    		return asset('images/default.jpg');
    	}
    		return asset('images/'.$this->avatar);
    }

    public function mapel()
    {
        // Relasi Many To Many
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimeStamps();
    }

     public function user()
    {
        // Model User terhubung dengan model User, ditujukan dengan fungsi belongsTo
        return $this->belongsTo('App\User');
    }

    public function hitung()
    {
        $total = 0;
        $avg = 0;
        foreach ($this->mapel as $mapela) {
            // $total = $total + $mapela->pivot->nilai;
            $total += $mapela->pivot->nilai;
            $avg++;
        }

        return round($total == 0 ? 0 : ($total / $avg));
    }

    public function nama_lengkap()
    {
        return $this->nama_depan.' '.$this->nama_belakang;
    }

}
