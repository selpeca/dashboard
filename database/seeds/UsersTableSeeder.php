<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class)->create([
            'user_name' => 'selpeca',
            'password' => 'admin',
            'auto_password'=>false,
            'email'=>'ser.per.eli@gmail.com'
        ]);
        factory(App\Models\User::class,9)->create();
    }
}
