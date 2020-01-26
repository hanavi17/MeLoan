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
       \App\User::insert([
            [
              'id'  			=> 1,
              'name'  			=> 'Dimas - Admin',
              'username'		=> 'admin123',
              'email' 			=> 'dimas@gmail.com',
              'password'		=> bcrypt('admin123'),
              'foto'			=> '60194-2019-11-21-03-49-26.jpg',
              'level'			=> 'admin',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'name'  			=> 'Udin - User',
              'username'		=> 'user123',
              'email' 			=> 'udin@gmail.com',
              'password'		=> bcrypt('user123'),
              'foto'			=> '41842-2019-05-02-13-47-01.jpg',
              'level'			=> 'user',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
