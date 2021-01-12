<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->boolean('monday')->default(false)->nullable();
            $table->boolean('tuesday')->default(false)->nullable();
            $table->boolean('wednesday')->default(false)->nullable();
            $table->boolean('thursday')->default(false)->nullable();
            $table->boolean('friday')->default(false)->nullable();
            $table->boolean('saturday')->default(false)->nullable();
            $table->boolean('sunday')->default(false)->nullable();
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
        Schema::dropIfExists('events');
    }
}
