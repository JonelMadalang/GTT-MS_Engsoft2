<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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

            $table->unsignedBigInteger('taxi_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('role')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_number')->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->string('drivers_license')->nullable();

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('taxi_id')->references('id')->on('taxi')->onUpdate('cascade')->onDelete('cascade'); 
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
}
