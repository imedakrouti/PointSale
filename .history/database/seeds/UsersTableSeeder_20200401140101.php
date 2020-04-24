<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user= user::create([
        'first_name' => 'super',
        'last_name'  => 'admin',
        'email'      => 'super_admin@gmail.com',
        'password'   =>  Hash::make('123456'),
       ]);
        $user->attachRole('super_admin');
    }

}
