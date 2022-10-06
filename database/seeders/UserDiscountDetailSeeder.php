<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDiscountDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_discountDetail')->insert([
            [
                'discountDetail_id' => 1,
                'user_id' => rand(1,20),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'discountDetail_id' => 2,
                'user_id' => rand(1,20),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'discountDetail_id' => 3,
                'user_id' => rand(1,20),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'discountDetail_id' => 4,
                'user_id' => rand(1,20),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
