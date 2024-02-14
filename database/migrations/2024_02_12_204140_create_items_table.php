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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('name')->index();
            $table->string('type');
            $table->longText('image_name')->nullable();  
            $table->string('model_no');
            $table->string('order_name');
            $table->string('order_person');
            $table->string('order_phone');
            $table->string('stock_unit');
            $table->integer('stock');
            $table->integer('minimum_stock');
            $table->integer('order_quantity');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
