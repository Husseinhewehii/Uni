<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Permission;

class InsertPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [

            [
                "identifier" => "courses.store",
                "status" => true,
                "name" => "create course"
            ],
            [
                "identifier" => "courses.index",
                "status" => true,
                "name" => "view course"
            ],
            [
                "identifier" => "courses.update",
                "status" => true,
                "name" => "update course"
            ],
            [
                "identifier" => "courses.destroy",
                "status" => true,
                "name" => "delete course"
            ],

            [
                "identifier" => "permissions.index",
                "status" => true,
                "name" => "view permissions"
            ],
            [
                "identifier" => "permissions.update",
                "status" => true,
                "name" => "update permission"
            ],
            [
                "identifier" => "groups.store",
                "status" => true,
                "name" => "create group"
            ],
            [
                "identifier" => "groups.index",
                "status" => true,
                "name" => "view group"
            ],
            [
                "identifier" => "groups.update",
                "status" => true,
                "name" => "update group"
            ],
            [
                "identifier" => "groups.destroy",
                "status" => true,
                "name" => "delete group"
            ],
            [
                "identifier" => "group.permissions.index",
                "status" => true,
                "name" => "view group permissions"
            ],
            [
                "identifier" => "group.permissions.store",
                "status" => true,
                "name" => "modify group permissions"
            ],


        ];

        foreach ($permissions as $permission) {
            $permissionObj = new Permission($permission);
            $permissionObj->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
