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
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('photo');
            $table->string('video');
            $table->string('address');
            $table->string('age');
            $table->string('dob');
            $table->string('nationality');
            $table->string('football_club_manage');
            $table->string('coaching_badges');
            $table->longText('qualification');
            $table->longText('honours');
            $table->longText('international_team_managed');
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
        Schema::dropIfExists('managers');
    }
};
