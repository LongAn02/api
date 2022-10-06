<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount_detail')->insert([
            'discount_type_id' => 1,
            'discount_id' => rand(1, 6),
            'detailID' => rand(1, 3),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        for ($i = 1; $i <= 3; $i++) {
            DB::table('discount_detail')->insert([
                'discount_type_id' => 2,
                'discount_id' => rand(1, 6),
                'detailID' => rand(1, 12),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
