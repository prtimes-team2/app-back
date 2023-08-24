<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /*
    public function run()
    {
        DB::table('reports')->insert([
            'id' => 999,
            'user_id' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }*/
    public function run()
    {
        DB::table('reports')->insert([
            'id' => 1,
            'user_id' => 1,
            'title' => 'aaa',
            'content' => 'zzz',
            'address' => 'ccc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 2,
            'user_id' => 1,
            'title' => 'aaa',
            'content' => 'zzzaaa',
            'address' => 'ccc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 3,
            'user_id' => 1,
            'title' => 'aaa',
            'content' => 'zzzddd',
            'address' => 'ccc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 4,
            'user_id' => 1,
            'title' => 'aaa',
            'content' => 'zzzmmm',
            'address' => 'ccc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 5,
            'user_id' => 1,
            'title' => 'aaa',
            'content' => 'zzz',
            'address' => 'ccsaaac',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 6,
            'user_id' => 1,
            'title' => 'aaaeea',
            'content' => 'zzz',
            'address' => 'ccc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 7,
            'user_id' => 1,
            'title' => 'faaa',
            'content' => 'zfzz',
            'address' => 'cfcc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 8,
            'user_id' => 1,
            'title' => 'taaa',
            'content' => 'ztzz',
            'address' => 'cctc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 9,
            'user_id' => 1,
            'title' => 'aaya',
            'content' => 'zzyz',
            'address' => 'cycc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('reports')->insert([
            'id' => 10,
            'user_id' => 1,
            'title' => 'aoaa',
            'content' => 'ozzz',
            'address' => 'ccoc',
            'lat' => 36.3,
            'lng' => 140.55,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
