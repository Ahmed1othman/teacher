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
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BookController;
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

        Route::get('teachers-lesson/{id}', [LectureController::class,'teachersLesson']);
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
            Route::get('/user-rate/{id}', [RateController::class, 'userRate']);
            Route::post('/', [RateController::class, 'store']);
            Route::get('{rate}', [RateController::class, 'get']);
            Route::put('{rate}', [RateController::class, 'update']);
            Route::delete('bulkDelete', [RateController::class, 'bulkDelete']);
            Route::post('bulkRestore', [RateController::class, 'bulkRestore']);
        });

        Route::get('teacher-appointment/{id}', [AppointmentController::class, 'getteacher']);
        Route::group(['prefix' => 'appointments'], function () {
            Route::get('/', [AppointmentController::class, 'index']);
            Route::post('/', [AppointmentController::class, 'store']);
            Route::get('{appointment}', [AppointmentController::class, 'get']);
            Route::put('{appointment}', [AppointmentController::class, 'update']);
            Route::delete('bulkDelete', [AppointmentController::class, 'bulkDelete']);
            Route::post('bulkRestore', [AppointmentController::class, 'bulkRestore']);
        });

        Route::group(['prefix' => 'books'], function () {
            Route::get('/', [BookController::class, 'index']);
            Route::post('/', [BookController::class, 'store']);
            Route::get('{book}', [BookController::class, 'get']);
            Route::put('{book}', [BookController::class, 'update']);
            Route::delete('bulkDelete', [BookController::class, 'bulkDelete']);
            Route::post('bulkRestore', [BookController::class, 'bulkRestore']);
        });

        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::post('search', [AppointmentController::class, 'search']);

    });

    Route::get('info', [InfoController::class,'index']);

    Route::get('categories', [InfoController::class,'categories']);

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

