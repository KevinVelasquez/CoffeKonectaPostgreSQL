<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->unsignedBigInteger('method_payment_id');
            $table->timestamps();

            $table->foreign('method_payment_id')->references('id')->on('methods_payment');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
