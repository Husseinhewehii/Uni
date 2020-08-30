<?php

use Illuminate\Database\Seeder;
use App\Models\GroupUser;

class GroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GroupUser::class)->create([
            'user_id' => 1,
            'group_id'=>1
        ]);
    }
}
