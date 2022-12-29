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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('house_rent');
            $table->string('advance_rent_amount');
            $table->string('nid_passport_driving_license');
            $table->string('full_address');
            $table->string('house_no');
            $table->string('flat_no');
            $table->string('road_no');
            $table->string('city');
            $table->string('house_rent_form');
            $table->string('hosue_renting_date');
            $table->string('rent_amount');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
