<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Not auth data
Route::prefix('front')->group(static function(){

    Route::prefix('festivals')->group(function (){
        Route::get('all',[\App\Http\Controllers\Api\Front\FestivalController::class,'all']);
        Route::get('specials',[\App\Http\Controllers\Api\Front\FestivalController::class,'specials']);
        Route::get('categories',[\App\Http\Controllers\Api\Front\FestivalController::class,'categories']);
        Route::get('expiring',[\App\Http\Controllers\Api\Front\FestivalController::class,'expiring']);
        Route::get('show/{slug}',[\App\Http\Controllers\Api\Front\FestivalController::class,'show']);
        Route::get('get/formats/{slug}',[\App\Http\Controllers\Api\Front\FestivalController::class,'get_formats']);
        Route::get('get/forms/{slug}',[\App\Http\Controllers\Api\Front\FestivalController::class,'get_forms']);
    });
    Route::prefix('users')->group(function (){
        Route::get('top',[\App\Http\Controllers\Api\Front\UserController::class,'top']);

    });

    Route::post('contact/message/send',[\App\Http\Controllers\Api\Front\ContactController::class,'store']);
});




Route::prefix('auth')->group(static function() {

    Route::post('register',[\App\Http\Controllers\Api\Auth\AuthController::class,'register']);
    Route::post('register/check',[\App\Http\Controllers\Api\Auth\AuthController::class,'register_check']);

    Route::post('login',[\App\Http\Controllers\Api\Auth\AuthController::class,'login']);
    Route::post('login/check',[\App\Http\Controllers\Api\Auth\AuthController::class,'login_check']);
});

Route::prefix('helpers')->group(static function (){
    Route::get('get/provinces',[\App\Http\Controllers\Api\HelperController::class,'all_provinces']);
    Route::get('get/festival/categories',[\App\Http\Controllers\Api\HelperController::class,'festival_categories']);

});

Route::group(['prefix'=>'panel','middleware'=>['check_auth']],static function (){
    Route::post('submit/form/festival/{slug}',[\App\Http\Controllers\Api\Panel\FestivalController::class,'submit_form']);

    Route::get('me',[\App\Http\Controllers\Api\Auth\AuthController::class,'get_me']);
    Route::post('me/update',[\App\Http\Controllers\Api\Panel\ProfileController::class,'edit']);
    Route::prefix('festivals')->group(function (){
        Route::get('',[\App\Http\Controllers\Api\Panel\FestivalController::class,'get_all']);
        Route::post('new/store',[\App\Http\Controllers\Api\Panel\FestivalController::class,'store']);
        Route::get('files/{festival}',[\App\Http\Controllers\Api\Panel\FestivalController::class,'files']);
        Route::get('show/{festival}',[\App\Http\Controllers\Api\Panel\FestivalController::class,'show']);
        Route::get('downloader/files/single/{file}',[\App\Http\Controllers\Api\Panel\FestivalController::class,'download_single']);
        Route::get('activation/{festival}',[\App\Http\Controllers\Api\Panel\FestivalController::class,'activation']);
    });
    Route::prefix('participate')->group(function (){
        Route::get('all',[\App\Http\Controllers\Api\Panel\ParticipateController::class,'get_all']);
    });



});
Route::group(['prefix'=>'manage','middleware'=>['check_manager']],static function(){

    //Dashboard
    Route::prefix('dashboard')->group(function (){
        Route::get('get/new/users/{count}',[\App\Http\Controllers\Api\Manage\DashboardController::class,'new_users']);
    });

    //users
    Route::prefix('users')->group(function (){
        Route::get('managers',[\App\Http\Controllers\Api\Manage\UserController::class,'get_managers']);
        Route::post('managers/store',[\App\Http\Controllers\Api\Manage\UserController::class,'managers_store']);
        Route::post('managers/edit/{user}',[\App\Http\Controllers\Api\Manage\UserController::class,'managers_edit']);
        Route::get('managers/delete/{user}',[\App\Http\Controllers\Api\Manage\UserController::class,'managers_delete']);
        Route::get('managers/activation/{user}',[\App\Http\Controllers\Api\Manage\UserController::class,'managers_activation']);
        Route::get('managers/{user}',[\App\Http\Controllers\Api\Manage\UserController::class,'managers_single']);

        Route::get('members',[\App\Http\Controllers\Api\Manage\UserController::class,'get_members']);
        Route::post('members/store',[\App\Http\Controllers\Api\Manage\UserController::class,'members_store']);
        Route::post('members/edit/{user}',[\App\Http\Controllers\Api\Manage\UserController::class,'members_edit']);
        Route::get('members/delete/{user}',[\App\Http\Controllers\Api\Manage\UserController::class,'members_delete']);
        Route::get('members/activation/{user}',[\App\Http\Controllers\Api\Manage\UserController::class,'members_activation']);
        Route::get('members/{user}',[\App\Http\Controllers\Api\Manage\UserController::class,'members_single']);

    });

    //festivals
    Route::prefix('festivals')->group(function (){
        Route::prefix('categories')->group(function (){
            Route::get('',[\App\Http\Controllers\Api\Manage\FestivalController::class,'categories']);
            Route::post('store',[\App\Http\Controllers\Api\Manage\FestivalController::class,'categories_store']);
            Route::post('edit/{category}',[\App\Http\Controllers\Api\Manage\FestivalController::class,'categories_edit']);
            Route::get('delete/{category}',[\App\Http\Controllers\Api\Manage\FestivalController::class,'categories_delete']);
            Route::get('{category}',[\App\Http\Controllers\Api\Manage\FestivalController::class,'categories_single']);
        });
        Route::get('',[\App\Http\Controllers\Api\Manage\FestivalController::class,'festivals']);
        Route::get('expire',[\App\Http\Controllers\Api\Manage\FestivalController::class,'festivals_expire']);
        Route::post('store',[\App\Http\Controllers\Api\Manage\FestivalController::class,'festivals_store']);
        Route::get('waiting',[\App\Http\Controllers\Api\Manage\FestivalController::class,'waiting']);
        Route::get('waiting-count',[\App\Http\Controllers\Api\Manage\FestivalController::class,'waiting_count']);
        Route::post('edit/{category}',[\App\Http\Controllers\Api\Manage\FestivalController::class,'festivals_edit']);
        Route::get('delete/{category}',[\App\Http\Controllers\Api\Manage\FestivalController::class,'festivals_delete']);
        Route::get('accept/{festival}',[\App\Http\Controllers\Api\Manage\FestivalController::class,'festivals_accept']);
        Route::get('{festival}',[\App\Http\Controllers\Api\Manage\FestivalController::class,'festivals_single']);

    });

});

