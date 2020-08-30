<?php

use Illuminate\Database\Seeder;
use App\Models\GroupPermission;
use App\repository\PermissionRepository;
use Illuminate\Http\Request;

class GroupPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }


    public function run()
    {
        $permissions = $this->permissionRepository->search(request())->get("id");
        foreach ($permissions as $permission){
            factory(GroupPermission::class,1)->create([
                'permission_id' => $permission->id,
                'group_id'=>1
            ]);
        }

    }
}
