<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\LookUp\CityController;
use App\Http\Controllers\Api\LookUp\SliderController;
use App\Http\Controllers\Api\LookUp\CountryController;
use App\Http\Controllers\Api\LookUp\PartnerController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\RateController;
use App\Http\Controllers\Api\OfferController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['api','lang'],'namespace' => 'Api'], function () {

    Route::group(['prefix'=>'auth'], function () {
        Route::post('login', [AuthController::class,'login']);
        Route::post('register', [AuthController::class,'register']);
        Route::post('forgot', [AuthController::class,'forgotEmail']);
        Route::post('checkcode', [AuthController::class,'checkcode']);
        Route::post('reset', [AuthController::class,'reset']);
    });
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('profileImage/{user}', [AuthController::class,'profileImage']);
        Route::get('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
        Route::get('me', [AuthController::class,'me']);
        Route::get('user', [AuthController::class,'user']);
        Route::post('profile', [AuthController::class,'profile']);
        Route::put('changePassword', [AuthController::class,'changePassword']);

        Route::group([ 'prefix' => 'lectures'], function () {
            Route::get('/', [LectureController::class,'index']);
            Route::post('/', [LectureController::class,'store']);
            Route::get('{lecture}', [LectureController::class,'get']);
            Route::put('{lecture}', [LectureController::class,'update']);
            Route::delete('bulkDelete', [LectureController::class,'bulkDelete']);
            Route::post('bulkRestore', [LectureController::class,'bulkRestore']);
        });

        Route::group(['prefix' => 'rate'], function () {
            Route::get('/', [RateController::class, 'index']);
            Route::post('/', [RateController::class, 'store']);
            Route::get('{rate}', [RateController::class, 'get']);
            Route::put('{rate}', [RateController::class, 'update']);
            Route::delete('bulkDelete', [RateController::class, 'bulkDelete']);
            Route::post('bulkRestore', [RateController::class, 'bulkRestore']);
        });
        Route::group(['prefix' => 'offers'], function () {
            Route::get('/', [OfferController::class, 'index']);
            Route::post('/', [OfferController::class, 'store']);
            Route::post('/accept-offer', [OfferController::class, 'acceptOffer']);
            Route::post('/reject-offer', [OfferController::class, 'rejectOffer']);
            Route::get('{offer}', [OfferController::class, 'get']);
            Route::put('{offer}', [OfferController::class, 'update']);
            Route::delete('bulkDelete', [OfferController::class, 'bulkDelete']);
            Route::post('bulkRestore', [OfferController::class, 'bulkRestore']);
        });
        Route::get('/notifications', [NotificationController::class, 'index']);
    });

    Route::get('info', [InfoController::class,'index']);

    Route::post('contacts', [ContactController::class,'store']);

    Route::group(['middleware' => [], 'namespace' => 'LookUp'], function () {
        Route::group([ 'prefix' => 'country'], function () {
            Route::get('/', [CountryController::class,'index']);
        });
        Route::group([ 'prefix' => 'slider'], function () {
            Route::get('/', [SliderController::class,'index']);
        });
        Route::group([ 'prefix' => 'cities'], function () {
            Route::get('/', [CityController::class,'index']);
        });
        Route::group([ 'prefix' => 'partners'], function () {
            Route::get('/', [PartnerController::class,'index']);
        });
    });
});

