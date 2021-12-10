<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;
class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->double('boundary')->nullable();
            $table->double('bond')->default('0');
            $table->double('expenses')->default('0');
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('expenses_details')->nullable();

            $table->foreign('user_id')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
