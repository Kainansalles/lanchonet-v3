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
            'initials' => 'P',
            'description' => 'Pd. pagamento'
        ]);
        DB::table('status_demands')->insert([
            'initials' => 'A',
            'description' => 'Aguardando pgto'
        ]);
        DB::table('status_demands')->insert([
            'initials' => 'F',
            'description' => 'Finalizado'
        ]);
        DB::table('status_demands')->insert([
            'initials' => 'C',
            'description' => 'Cancelado'
        ]);
    }
}
