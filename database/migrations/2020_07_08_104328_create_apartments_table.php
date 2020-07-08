<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->unsignedTinyInteger('rooms_number');
            $table->unsignedTinyInteger('beds_number');
            $table->unsignedTinyInteger('bathrooms_number');
            $table->unsignedTinyInteger('square_meters');
            $table->string('address');
            $table->float('geo_lat', 9, 6); // Verificare dettaglio cifre totali e decimali
            $table->float('geo_lon', 9, 6); // Verificare dettaglio cifre totali e decimali
            $table->boolean('active');
            $table->string('featured_img');
            $table->timestamps();

            /**
             * Relationships
             */
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
