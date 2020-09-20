<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => "1",
            'caption' => 'no comment',
            'post_image' => 'exp_post_image.jpg'
        ]);

        DB::table('posts')->insert([
            'user_id' => "1",
            'caption' => 'Toko Kawan Kita',
            'post_image' => 'logotkk.png'
        ]);

        DB::table('posts')->insert([
            'user_id' => "2",
            'caption' => 'Koko anak murah',
            'post_image' => '0dcfbb73-8d5a-4758-b0ee-f6d3eefd905b.jpg'
        ]);
    }
}
