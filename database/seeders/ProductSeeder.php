<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            if ($i <= 4) {
                $this->createProduct(
                    name: Str::random(5).'-'.$i,
                    price: rand(1000, 5000),
                    image: 'product-'.$i.'.jpg',
                    category: rand(1, 3),
                    discount: rand(2, 20),
                );
            } else {
                $this->createProduct(
                    name: Str::random(5).'-'.$i,
                    price: rand(1000, 5000),
                    image: 'product-'.$i.'.jpg',
                    category: rand(1, 3),
                    discount: 1
                );
            }
        }
    }

    public function createProduct(
        $name,
        $price,
        $image,
        $category,
        $discount,
    ) {
        DB::table('products')->insert([
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'category_id' => $category,
            'discount_id' => $discount,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
