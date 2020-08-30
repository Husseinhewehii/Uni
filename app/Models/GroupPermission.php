<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupPermission extends Model
{

    protected $table = 'group_permissions';
    protected $fillable = ['permission_id', 'group_id'];

}
