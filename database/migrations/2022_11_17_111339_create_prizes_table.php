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
        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('description');
            $table->integer('prize_no');
            $table->integer('total_amount');
            $table->integer('left_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prizes');
    }
};
