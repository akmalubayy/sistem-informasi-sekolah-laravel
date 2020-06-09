<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
	use Sluggable;
    protected $table = 'posts';

    // Fillable adalah dari field table db yang sudah dibuat, di inisialisasi untuk form inputan agar terinput ke db
    protected $fillable = ['user_id','title','content','slug','thumbnail'];

    protected $dates = ['created_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function thumbnail()
	{
		// Ini adalah kondisi saat mengecek jika ada thumbnail dahulu
		// if($this->thumbnail){
		// 	return $this->thumbnail;
		// } else {
		// 	return asset('no-thumbnail.jpg');
		// }

		// Ini adalah kondisi saat mengecek if this empty (if(!$this)) maka akan mereturn asset, lalu mereturn hasil yang sudah ada thumbnail
		// if(!$this->thumbnail){
		// 	return asset('no-thumbnail.jpg');
		// }
		// return $this->thumbnail;

		// If cara ketiga yang lebih pendek
		return !$this->thumbnail ? asset('no-thumbnail.jpg') : $this->thumbnail;
	}

}
