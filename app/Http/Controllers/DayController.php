<?php

namespace App\Http\Controllers;

use App\Workout;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function index($year, $day, $month){
    	$day = Workout::getByDate($year,$day,$month);
    	if ($day->count() > 0) {
    		return $day->groupBy('exercise');
    	}
    	return 'There were no exercises on this day';
    }
}
