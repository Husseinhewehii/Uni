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

    public function hasAccess($permission): bool
    {
        $userPermissions = $this->permissions();
        return in_array($permission, $userPermissions);
    }

    /**
     * @return array
     */
    public function permissions() : array
    {
        $permissions = $this->query()
            ->join("group_user", "users.id", "=", "group_user.user_id")
            ->join("groups", "group_user.group_id", "=", "groups.id")
            ->join("group_permissions", "groups.id", "=", "group_permissions.group_id")
            ->join("permissions", "group_permissions.permission_id", "=", "permissions.id")
            ->select("permissions.identifier")
            ->where("users.id", "=", auth()->id())
            ->distinct()
            ->get();

        $permissionsIdentifier = [];
        foreach ($permissions as $permission) {
            $permissionsIdentifier[] = $permission["identifier"];
        }


        return $permissionsIdentifier;
    }

    public function isTypeOf($userType)
    {
        return ($this->type == $userType);
    }

}
