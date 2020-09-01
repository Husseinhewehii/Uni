<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //protected $connection = 'mongodb';
    protected $fillable = ['user_id','object_id','object_type','message','user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
