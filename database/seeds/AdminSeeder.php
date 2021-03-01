<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'name' => "admin",
            'email' => 'admin@admin.com',
            'password' => bcrypt('1admin23'),
            'img_path' => '/img/profile/panji.jpg',
            'who' => 'admin'
        ]);
    }
}
