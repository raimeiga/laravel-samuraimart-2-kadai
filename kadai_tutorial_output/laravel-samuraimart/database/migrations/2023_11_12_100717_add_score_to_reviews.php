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
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('score')->unsigned()->default(0);   //scoreカラムを追加、マイナスの値などは受け取らないようにunsigned()も記述
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('score');  // dropColumn()=1つ以上のカラムを削除してテーブルを返す。でも何故カラムを削除するんだろ。
        });
    }
};
