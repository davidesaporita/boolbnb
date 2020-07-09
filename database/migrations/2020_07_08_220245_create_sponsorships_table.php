<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('sponsor_plan_id');
            $table->string('transaction_id', 20);
            $table->float('amount', 4, 2);
            $table->datetime('start');
            $table->datetime('deadline');
            $table->timestamps();

            /**
             * Relationships
             */
            $table->foreign('apartment_id')
                  ->references('id')
                  ->on('apartments');
                  
            $table->foreign('sponsor_plan_id')
                  ->references('id')
                  ->on('sponsor_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsorships');
    }
}
