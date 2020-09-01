<?php

namespace App\Models;

use App\Events\PermissionEditedEvent;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name','identifier','status'
    ];

    public $dispatchesEvents = [

        'updated' => PermissionEditedEvent::class

    ];
}
