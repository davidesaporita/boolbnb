<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('title');
            $table->text('body');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();

            /**
             * Relationships
             */
            $table->foreign('apartment_id')
                  ->references('id')
                  ->on('apartments')
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
        Schema::dropIfExists('reviews');
    }
}
