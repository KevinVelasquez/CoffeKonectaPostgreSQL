<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_product');
            $table->string('reference');
            $table->integer('price');
            $table->integer('weight');
            $table->string('category');
            $table->integer('stock');
            $table->timestamps('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
