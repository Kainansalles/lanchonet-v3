<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 25) as $i){
            Product::create([
                'name' => $faker->name,
                'description' => $faker->sentence(),
                'url_image' => $faker->imageUrl(140, 100, 'food'),
                'price_cost' =>  rand(1,50) . "." . rand(1,99),
                'price_sale' => rand(25,50) . "." . rand(1,99),
                'quantity' => rand(1,30),
                'store_id' => 1,
                'status' => 1
            ]);
        }
    }
}
