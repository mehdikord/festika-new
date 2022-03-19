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
Route::get('test',function (){
   for ($i=1;$i<632;$i++){
       \App\Models\User::create([
           'role'=>4,
           'province_id'=>24,
           'city_id'=>316,
           'name'=>'کاربر فستیکا '.$i,
           'phone'=>'0911'.rand(1000000,9999999),
           'email'=>'user.of_festika'.$i.'@gmail.com',

       ]);
   }
});

Route::get('panel/{any}',static function(){
    return view('dashboard');
})->where('any','(.*)');


Route::get('manage/{any}',static function(){
    return view('manage');
})->where('any','(.*)');



Route::get('/{any}',static function () {
    return view('app');
})->where('any','(.*)');

