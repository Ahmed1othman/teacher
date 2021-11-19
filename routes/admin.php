<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NotificationsController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::group(['middleware'=>['auth','language']],function (){
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('partners-active', [PartnerController::class,'changeStatus']);
    Route::resource('partners', PartnerController::class);

    Route::resource('users', UserController::class);
    Route::post('category-assign', [UserController::class,'changeCategory']);
    Route::post('users-active', [UserController::class,'changeStatus']);

    Route::resource('contacts', ContactController::class);
    Route::post('contacts-active', [ContactController::class,'changeStatus']);

    Route::resource('countries', CountriesController::class);
    Route::post('countries-active', [CountriesController::class,'changeStatus']);

    Route::resource('cities', CitiesController::class);
    Route::post('cities-active', [CitiesController::class,'changeStatus']);

    Route::resource('sliders', SliderController::class);
    Route::post('sliders-active', [SliderController::class,'changeStatus']);

    Route::resource('categories', CategoryController::class);
    Route::post('categories-active', [CategoryController::class,'changeStatus']);

    Route::resource('appointment', AppointmentController::class);
    Route::get('appointment-request', [AppointmentController::class,'appointmentRequest'])->name('appointment.request');
    Route::get('appointment-implementation', [AppointmentController::class,'implementationAppointment'])->name('appointment.implementation');
    Route::get('appointment-delivery', [AppointmentController::class,'deliveryAppointment'])->name('appointment.delivery');
    Route::get('appointment-history', [AppointmentController::class,'historyAppointment'])->name('appointment.history');
    Route::post('appointments-active', [AppointmentController::class,'changeStatus']);
    Route::post('accept-appointment/{id}', [AppointmentController::class,'acceptAppointment']);
    Route::post('appointment-status/{id}', [AppointmentController::class,'adminChangeStatus']);
    Route::post('reject-appointment/{id}', [AppointmentController::class,'rejectAppointment']);

    Route::resource('info', InfoController::class);
    Route::get('notify/{id}/{status}', [AppointmentController::class,'markAsRead'])->name('appointmentNotification');

    Route::resource('notifications', NotificationsController::class);



});



