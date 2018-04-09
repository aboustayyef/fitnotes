<?php

namespace App\Http\Controllers;

use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
    public function index($year, $month, $day){
    	$day = Auth::user()->exercises()->whereDate('start','=', $year.'-'.$month.'-'.$day)->get();
    	if ($day->count() > 0) {
    		$day = $day->groupBy(['name','exercise']);
    		// dd($day);
    		return view('day')->with(compact('day'));
    	}
    	return 'There were no exercises on this day';
    }
}
