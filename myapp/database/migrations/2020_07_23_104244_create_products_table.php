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
            $table->id('id');
            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable();
            // $table->foreignId('parent_id')->nullable()->unsigned()->constrained('products');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('price');
            $table->integer('quantity');
            $table->json('color');
            $table->json('size');
            $table->integer('sale');
            $table->timestampsTz();
            $table->softDeletes();

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
