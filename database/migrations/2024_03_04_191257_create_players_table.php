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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('video')->nullable();
            $table->string('age');
            $table->string('gender');
            $table->string('phone');
            $table->string('address');

            $table->string('dob');
            $table->string('height');
            $table->string('weight');
            $table->string('favourite_foot')->nullable();
            $table->string('position')->comment('goalkeeper or Defender');
            $table->string('nationality');
            $table->string('passport_type');
            $table->string('is_passport_more_then_one')->nullable();
            $table->string('current_club');
            $table->string('player_represent');
            $table->string('international_appearance');
            $table->string('contract_length')->nullable();
            $table->string('football_group_player')->nullable();
            $table->longText('other_info')->nullable();
            $table->enum('status', ['approved', 'not_approved'])->default('not_approved');
            $table->enum('payment_status', ['paid', 'not_paid'])->default('not_paid');
            
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
        Schema::dropIfExists('players');
    }
};
