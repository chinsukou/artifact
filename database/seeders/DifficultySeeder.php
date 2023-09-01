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
            'name' => 'easy',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('difficulties')->insert([
            'name' => 'nomal',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('difficulties')->insert([
            'name' => 'hard',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
