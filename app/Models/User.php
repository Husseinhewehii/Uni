<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','date_of_birth','type','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function professorCourses()
    {
        return $this->hasMany(Course::class,'professor_id');
    }

    public function setPasswordAttribute($pass)
    {
        if($pass)
        {
            $this->attributes['password'] = \Hash::make($pass);
        }
    }



    public static function boot() {
        parent::boot();

        static::deleted(function($user) {
            $user->professorCourses()->delete();
        });
    }

}
