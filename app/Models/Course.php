<?php

namespace App\Models;

//use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
//    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_date', 'end_date'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'course_user','course_id','user_id');
        //return $this->belongsToMany(User::class);
    }
}
