<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shoppingcart', function (Blueprint $table) {
            $table->string('code')->default("");                       // 注文コード
            $table->integer('price_total')->unsigned()->default(0);    // 金額
            $table->integer('qty')->unsigned()->default(0);            // 個数
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoppingcart', function (Blueprint $table) {
            $table->dropColumn('code');           // 注文コード
            $table->dropColumn('price_total');    // 金額
            $table->dropColumn('qty');            // 個数
        }); 
    }
};
