<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

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
            'id' => 1,
            'line_id' => 123456789,
            'DisplayName' => 'Brown',
            'ProfileImageUrl' => 'brown.jpeg',
            'prefecture' => '静岡県',
            'city' => '富士市',
            'birth' => '2002-08-23',
            'gender' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
