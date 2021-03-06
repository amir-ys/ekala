<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('price');
            $table->string('quantity');
            $table->string('slug')->unique();
            $table->string('description');
            $table->tinyInteger('status');
            $table->string('delivery_amount')->nullable();
            $table->string('delivery_amount_per_product')->nullable();
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
        Schema::dropIfExists('products');
    }
}
