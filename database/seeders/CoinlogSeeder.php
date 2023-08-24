<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CoinlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('coinlogs')->insert([
            'id' => 1,
            'user_id' => 1,
            'amount' => 1000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);*/
        /*DB::table('coinlogs')->insert([
            'id' => 2,
            'user_id' => 1,
            'amount' => -300,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);*/
        DB::table('coinlogs')->insert([
            'id' => 3,
            'user_id' => 1,
            'amount' => -200,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('coinlogs')->insert([
            'id' => 4,
            'user_id' => 1,
            'amount' => 1500,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('coinlogs')->insert([
            'id' => 5,
            'user_id' => 1,
            'amount' => -1000,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
