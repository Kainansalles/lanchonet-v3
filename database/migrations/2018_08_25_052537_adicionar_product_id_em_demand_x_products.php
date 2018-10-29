<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarProductIdEmDemandXProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demand_x_products', function (Blueprint $table) {
            $table->integer('demand_id')->unsigned();
            $table->foreign('demand_id')->references('id')->on('demands');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demand_x_products', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn(['product_id']);
            $table->dropForeign(['demand_id']);
            $table->dropColumn(['demand_id']);
        });
    }
}
