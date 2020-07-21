<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->string('email', 50);
            $table->string('title', 30);
            $table->string('direction', 8)->default('received');
            $table->boolean('read')->default(false);
            $table->text('body');
            $table->timestamps();

            /**
             * Relationships
             */
            $table->foreign('apartment_id')
                  ->references('id')
                  ->on('apartments');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_requests');
    }
}
