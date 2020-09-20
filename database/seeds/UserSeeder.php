<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Nadhif",
            'username' => 'nadhif',
            'email' => 'nadhif@gmail.com',
            'bio' => 'Semua akan indah pada waktunya!',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60),
        ]);

        DB::table('users')->insert([
            'name' => "Fulan bin Fulan",
            'username' => 'fulan',
            'email' => 'fulan@gmail.com',
            'bio' => 'Never give and stay calm.',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60),
        ]);
        
        DB::table('users')->insert([
            'name' => "Mr X",
            'username' => 'mrx',
            'email' => 'mrx@gmail.com',
            'bio' => 'Be unique!',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60),
        ]);
      


    }
}
