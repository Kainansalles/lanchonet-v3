<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarForeignIdsEmDemands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demands', function (Blueprint $table) {
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->integer('status_demand_id')->unsigned()->default(2);
            $table->foreign('status_demand_id')->references('id')->on('status_demands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demands', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->dropColumn(['store_id']);
            $table->dropForeign(['client_id']);
            $table->dropColumn(['client_id']);
            $table->dropForeign(['status_demand_id']);
            $table->dropColumn(['status_demand_id']);
        });
    }
}
