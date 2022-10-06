<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 100; $i += 5) {
            DB::table('discounts')->insert([
                'name' => 'Discount '.$i.'%',
                'percent_discount' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
