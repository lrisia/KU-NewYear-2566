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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('p_id');
            $table->string('title');
            $table->string('name');
            $table->string('email')->nullable();
            $table->foreignIdFor(\App\Models\Organizer::class);
            $table->timestamp('register_at')->nullable();
            $table->timestamp('arrive_at')->nullable();
            $table->foreignIdFor(\App\Models\Prize::class)->nullable();
            $table->timestamp('got_prize_at')->nullable();
            $table->boolean('took_prize')->nullable();
            $table->string('qr_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
