<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('category_id')->unsigned();
            $table->string('walk_category')->nullable();
            $table->string('accepted');
            $table->string('latitude');
            $table->string('longitude');
            $table->dateTime('beginning');
            $table->dateTime('ending');
            $table->string('reference')->unique();
            $table->integer('initial_slots');
            $table->integer('remaining_slots');
            $table->float('price_cat', 10, 2)->nullable();
            $table->float('price_dog', 10, 2)->nullable();
            $table->boolean('public');
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
        Schema::dropIfExists('activities');
    }
}
