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
        Schema::create('football_clubs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('address');
            $table->string('country');
            $table->string('phone');
            $table->string('contact');
            $table->string('website');
            $table->enum('status', ['approved', 'not_approved'])->default('not_approved');
            $table->enum('payment', ['paid', 'not_paid'])->default('not_paid');
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
        Schema::dropIfExists('football_clubs');
    }
};
