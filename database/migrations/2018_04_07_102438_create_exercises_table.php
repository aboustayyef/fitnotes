<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name'); // Name of Workout
            $table->dateTime('start'); // Start Date/Time
            $table->dateTime('end'); // end Date/Time
            $table->float('bodyweight'); // weight at time of exercise
            $table->string('exercise'); // Name of Exercise
            $table->string('equipment'); // Equipments Used
            $table->tinyInteger('reps')->unsigned()->defaul(0);
            $table->float('weight')->nullable();
            $table->integer('time')->nullable();
            $table->integer('distance')->nullable();
            $table->boolean('done');
            $table->string('categories');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workouts');
    }
}
