<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transport')->insert([
            [
               'name' => 'moto',
                'price' => 20500,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'name' => 'car',
                'price' => 40500,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'name' => 'plane',
                'price' => 60500,
                'created_at'  => now(),
                'updated_at'  => now()
            ],
        ]);
    }
}
