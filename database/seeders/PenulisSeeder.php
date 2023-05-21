<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PenulisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('penulis')->insert([
            'username' => 'penulis1',
            'password' => '12345678'
        ]);
        \DB::table('penulis')->insert([
            'username' => 'penulis2',
            'password' => '12345678'
        ]);
        \DB::table('penulis')->insert([
            'username' => 'penulis3',
            'password' => '12345678'
        ]);
    }
}
