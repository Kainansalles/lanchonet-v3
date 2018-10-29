<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cnpj')->unique();
            $table->string('company_name');
            $table->string('nickname');
            $table->string('cep')->nullable();
            $table->string('country')->nullable();
            $table->string('uf')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('bank_account');
            $table->string('bank_agency');
            $table->time('open_hours');
            $table->time('close_hours');
            $table->time('minutes_min_recall');
            $table->string('works_days');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estabelecimentos');
    }
}
