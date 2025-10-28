<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            Product::create([
                'name' => ucwords($faker->word),
                'description' => $faker->sentence,
                'image' => '',
                'quantity' => 50,
                'barcode' => $faker->unique()->ean13,  
                'regular_price' => $faker->randomFloat(2, 50, 200),
                'price' => $faker->randomFloat(2, 40, 190),
                'status' => true
            ]);
        }
    }
}
