<?php

use Illuminate\Database\Seeder;

class StatusDemandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_demands')->insert([
            'initials' => 'E',
            'description' => 'Em preparo',
            'allows_low' => 1
        ]);
        DB::table('status_demands')->insert([
            'initials' => 'P',
            'description' => 'Pronto p/ retirada',
            'allows_low' => 1
        ]);
        DB::table('status_demands')->insert([
            'initials' => 'F',
            'description' => 'Finalizado'
        ]);
        DB::table('status_demands')->insert([
            'initials' => 'P',
            'description' => 'Pago',
            'allows_low' => 1
        ]);
        DB::table('status_demands')->insert([
            'initials' => 'C',
            'description' => 'Cancelado'
        ]);
    }
}
