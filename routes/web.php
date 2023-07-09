<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Calculator;

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
    return view('welcome');
})->name('counter');

Route::get('/calculator', Calculator::class)->name('calculator');