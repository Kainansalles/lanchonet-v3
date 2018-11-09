<?php

use Illuminate\Database\Seeder;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'cnpj' => '96808349000123',
            'company_name' => 'Faculdade Integradas Campos Salles',
            'nickname' => 'Cantina Campos Salles',
            'cep' => '14015110',
            'country' => 'Brasil',
            'uf' => 'SP',
            'neighborhood' => 'Miguel Badra',
            'street' => 'Rua bla bla',
            'number' => '129',
            'telephone' => '1147477772',
            'bank_account' => '06392',
            'bank_agency' => '4876',
            'open_hours' => '2018-01-01 00:00:00',
            'close_hours' => '2019-01-01 23:59:00',
            'minutes_min_recall' => "00:15",
            'works_days' => 'Sun,Mon,Tue,Wed,Thu,Fri,Sat',
            'status' => 1
        ]);
    }
}
