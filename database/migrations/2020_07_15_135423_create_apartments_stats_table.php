<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('stat_id');
            $table->timestamps();

            $table->foreign('apartment_id')
                  ->references('id')
                  ->on('apartments')
                  ->onDelete('cascade');

            $table->foreign('stat_id')
                  ->references('id')
                  ->on('stats')
                  ->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments_stats');
    }
}
