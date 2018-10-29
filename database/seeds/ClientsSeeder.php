<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            "name" => "LanchoNET",
            "cpf" => rand(pow(10, 11-1), pow(10, 11)-1),
            "email" => "netlanchonet@gmail.com",
            "password" => Hash::make(123),
            'created_at' => "2018-" . rand(1,12) . "-20 20:34:09"
        ]);

        $faker = Faker::create();
        foreach(range(1, 24) as $i){
            DB::table('clients')->insert([
                "name" => $faker->name,
                "cpf" => rand(pow(10, 11-1), pow(10, 11)-1),
                "email" => $faker->email,
                "password" => Hash::make(123),
                'created_at' => "2018-" . rand(1,12) . "-20 20:34:09"
            ]);
        }

    }
}
