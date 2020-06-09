<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';

    protected $fillable = ['user_id','forum_id','konten'];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }


}
