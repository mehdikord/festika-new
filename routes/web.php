<?php

use App\Models\Festival;
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
Route::get('panel/{any}',static function(){
    return view('dashboard');
})->where('any','(.*)');


Route::get('manage/{any}',static function(){
    return view('manage');
})->where('any','(.*)');



Route::get('/{any}',static function () {

    return view('app');
})->where('any','(.*)');

