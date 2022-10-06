<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();
         \App\Models\Post::factory(20)->create();
         \App\Models\Category::factory(3)->create();

         $this->call([
             DiscountSeeder::class,
             ProductSeeder::class,
             DiscountType::class,
             DiscountDetailSeeder::class,
             UserDiscountDetailSeeder::class
         ]);
    }
}
