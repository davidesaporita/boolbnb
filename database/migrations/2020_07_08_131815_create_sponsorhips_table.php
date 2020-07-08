<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorhipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorhips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('sponsor_plan_id');
            $table->unsignedBigInteger('transaction_id');
            $table->float('amount', 4, 2);
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
        Schema::dropIfExists('sponsorhips');
    }
}
