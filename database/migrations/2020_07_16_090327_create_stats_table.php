<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('stat_type_id');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent();

            $table->foreign('apartment_id')
                  ->references('id')
                  ->on('apartments');

            $table->foreign('stat_type_id')
                  ->references('id')
                  ->on('stat_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats');
    }
}
