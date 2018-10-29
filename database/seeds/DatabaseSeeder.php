<?php

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
         $this->call([
             ClientsSeeder::class,
             StoresSeeder::class,
             ProductsSeeder::class,
             UserSeeder::class,
             StatusDemandsSeeder::class,
             DemandsSeeder::class
        ]);
    }
}