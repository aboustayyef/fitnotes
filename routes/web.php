<?php

use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home. Where everything happens
Route::get('/',function(){ return redirect('home');});
Route::get('/home', 'HomeController@index')->name('home');

// Uploading the data
Route::post('/upload', 'UploadController@store');

// AJAX
Route::get('/fnData', function(){
	if (!Cache::has('fnData')) {
		return null;
	}
	return Cache::get('fnData');	
});
// Route::get('/day/{year}/{month}/{day}', 'DayController@index');

