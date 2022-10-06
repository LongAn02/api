<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount_type')->insert([
            [
                'name' => "Discount category",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Discount product",
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
