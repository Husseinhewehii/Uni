<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Group::class)->create([
            'name' => 'Super Admin',
            'status'=>1
        ]);
    }
}
