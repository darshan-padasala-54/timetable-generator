<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/time-table/step1', 'App\Http\Controllers\TimeTableController@step1')->name('timetable.step1');
    Route::post('/time-table/step1', 'App\Http\Controllers\TimeTableController@create')->name('timetable.step1.store');
    Route::get('/time-table/step2/{id}', 'App\Http\Controllers\TimeTableController@getTimeTableDetails')->name('timetable.step2');
    Route::post('/time-table/generate/{id}', 'App\Http\Controllers\TimeTableController@generateTimeTable')->name('timetable.generate');
});
