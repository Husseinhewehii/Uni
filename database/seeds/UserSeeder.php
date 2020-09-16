<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class)->create([
            'name' => 'Bruce Wayne',
            'email' => 'bruce@wayne.com',
            'password' =>'test1234',
            'gender'=> 1,
            'type'=> 1,
            'date_of_birth' => '1980-07-11',
            'api_token' => str_random(60),
        ]);
        factory(User::class, 10)->create();


//        factory(App\Models\User::class, 10)->create()->each(function ($users) {
//            $users->save(factory(App\Models\User::class)->make()->toArray());
//        });



//        DB::table('users')->insert([
//            'name' => Str::random(10),
//            'email' => Str::random(10).'@gmail.com',
//            'password' => Hash::make('password')
//        ]);
    }
}
