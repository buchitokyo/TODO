<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToFolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->integer('user_id')->unsigned(); //整数カラムを符号なしに設定(MySQLのみ) //カラム追加

            // 外部キーを設定する
            $table->foreign('user_id')->references('id')->on('users');
            // ->onDelete('cascade');  //ユーザーが削除されたら紐付くpostsも削除;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropColumn('user_id'); //カラム削除
        });
    }
}
