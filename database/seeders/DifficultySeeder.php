<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('difficulties')->insert([
            'name' => 'EASY',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('difficulties')->insert([
            'name' => 'NOMAL',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('difficulties')->insert([
            'name' => 'HARD',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
