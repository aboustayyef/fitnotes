<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;

class DayController extends Controller
{
    public function index($year, $day, $month){
    	$day = Exercise::getByDate($year,$day,$month);
    	if ($day->count() > 0) {
    		$day = $day->groupBy(['name','exercise']);
    		// dd($day);
    		return view('day')->with(compact('day'));
    	}
    	return 'There were no exercises on this day';
    }
}
