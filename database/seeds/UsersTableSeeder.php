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
        $user = User::where('email', 'hesham.mohamed19930@gmail.com')->first();
        if (!$user) {
            User::create([
               'name' => 'Hesham Mohamed',
               'email' => 'hesham.mohamed19930@gmail.com',
               'password' => Hash::make('123456'),
                'role' => 'admin'
            ]);
        }
        User::create([
            'name' => 'Martin Lother king',
            'email' => 'marto.king19930@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'writer'
        ]);
    }
}
