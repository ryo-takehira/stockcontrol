<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // カラムを追加する場合
            // $table->string('order_person')->nullable(); 
            // $table->string('order_phone')->nullable(); 

            // カラム値のnullの値を許容する変更でデータベース更新
            $table->string('order_person')->nullable()->change(); 
            $table->string('order_phone')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // データベースにカラム追加の場合
            // $table->dropColumn('order_person');
            // $table->dropColumn('order_phone'); 

            // カラム値の値を変更でデータベース更新場合
            $table->string('order_person')->nullable()->change(); 
            $table->string('order_phone')->nullable()->change(); 
        });
    }
};
