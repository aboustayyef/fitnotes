<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
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

            // "Name", 0
            // "Start Date (UTC)", 1
            // "Start Time (UTC)", 2
            // "End Date (UTC)", 3
            // "End Time (UTC)", 4
            // "BodyWeight", 5
            // "Exercise", 6
            // "Equipment", 7
            // "Reps", 8
            // "Weight", 9
            // "Time", 10
            // "Distance", 11
            // "Status", 12
            // "Categories", 13
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
