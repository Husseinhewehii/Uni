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

        $bruce_wayne = \App\Models\User::where('email','bruce@wayne.com')->first();
        factory(GroupUser::class)->create([
            'user_id' => $bruce_wayne->id,
            'group_id'=>1
        ]);
    }
}
