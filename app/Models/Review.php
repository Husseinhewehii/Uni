<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'user_id','comment','rate', 'reviewable_type', 'reviewable_id'
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }
}
