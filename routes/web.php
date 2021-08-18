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
    Route::get('/emi-calculator', 'App\Http\Controllers\EmiCalculatorController@index')->name('emi-calculator.index');
    Route::post('/emi-calculator/create', 'App\Http\Controllers\EmiCalculatorController@createHistory')->name('emi-calculator.create');
    Route::get('/emi-calculator/lists', 'App\Http\Controllers\EmiCalculatorController@history')->name('emi-calculator.lists');
    Route::get('/emi-calculator/lists/{id}', 'App\Http\Controllers\EmiCalculatorController@getEmiDetails')->name('emi-calculator.view');
});

