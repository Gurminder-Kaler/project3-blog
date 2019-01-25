<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
            'name'=>'admin',
            'password'=>bcrypt('password'),
            'email'=>'admin@admin.com',
            'admin'=>1,
            'avatar'=>asset('avatars/avatar.png')
        ]);
        App\User::create([
            'name'=>'non-admin',
            'password'=>bcrypt('password'),
            'email'=>'non-admin@admin.com',

            'avatar'=>asset('avatars/avatar.png')
        ]);

    }
}
