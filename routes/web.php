<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\ShowCSC;

use App\Models\Country;
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
});

Route::get('/save', [HomeController::class, 'save']);
Route::get('/save_states', [HomeController::class, 'save_states']);
Route::get('/save_cities', [HomeController::class, 'save_cities']);
Route::get('/display', [HomeController::class, 'display']);
Route::get('/wire', [HomeController::class, 'wire']);
Route::get('/wire_csc', [HomeController::class, 'wire_csc']);
Route::get('/power_table', [HomeController::class, 'power_table']);
Route::delete('/country_destroy/{id}', [HomeController::class, 'country_destroy'])->name("country.destroy");
Route::get('/show_csc', ShowCSC::class);