<?php

use Illuminate\Database\Seeder;
use App\Models\Demand;
use App\Models\DemandxProduct;

class DemandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 5) as $i){
            Demand::create([
                'client_id' => rand(1,25),
                'store_id' => 1,
                'hour_recall' => "2018-10-" . rand(1,31) . " " . rand(9,20) . ":" . rand(1,59),
                'status_demand_id' => rand(1,4)
            ]);
        }

        foreach(range(1, 20) as $i){
            DemandxProduct::create([
                "product_id" => rand(1,25),
                "demand_id" => rand(1,5),
                "quantity" => rand(1,10),
                "price_registred" => rand(1,25) . "." . rand(1,25)
            ]);
        }


    }
}
