<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['user_id','image','caption'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
