<?php

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

// Public Controller
Route::get('/', 'PublicController@index')->name('index');
Route::get('about', 'PublicController@about')->name('about');
Route::get('contact', 'PublicController@contact')->name('contact');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// Auth Controller
Auth::routes();

// User Controller
Route::prefix('user')->group(function(){
    Route::get('dashboard', 'UserController@dashboard')->name('userDashboard');
    Route::get('profile', 'UserController@profile')->name('userProfile');
    Route::post('profile', 'UserController@profilePost')->name('userProfilePost');
    Route::get('vehicle', 'UserController@vehicles')->name('userVehicle');
    Route::get('vehicle/{id}/edit', 'UserController@editVehicle')->name('userEditVehicle');
    Route::post('vehicle/{id}/edit', 'UserController@editVehicleInfo')->name('userEditVehicleInfo');
    Route::post('vehicle/new', 'UserController@addVehicle')->name('userAddVehicle');
    Route::post('vehicle/{id}/remove', 'UserController@removeVehicle')->name('userRemoveVehicle');
    Route::get('balance', 'UserController@balance')->name('userBalance');
    Route::get('history', 'UserController@history')->name('userHistory');
    Route::get('reserve', 'UserController@reserve')->name('userReserve');
});

// Staff Controller
Route::prefix('staff')->group(function(){
    Route::get('dashboard', 'StaffController@dashboard')->name('staffDashboard');
    Route::get('history', 'StaffController@history')->name('staffHistory');
    Route::get('check-in', 'StaffController@checkIn')->name('staffCheckIn');
    Route::get('check-out', 'StaffController@checkOut')->name('staffCheckOut');
    Route::get('walk-in', 'StaffController@walkIn')->name('staffWalkIn');
});

// Admin Controller
Route::prefix('admin')->group(function(){
    Route::get('dashboard', 'AdminController@dashboard')->name('adminDashboard');
    Route::get('history', 'AdminController@history')->name('adminHistory');
    // Admin Users
    Route::get('users', 'AdminController@users')->name('adminUsers');
    Route::get('user/{id}', 'AdminController@singleUser')->name('adminSingleUser');
    Route::get('new_user', 'AdminController@newUser')->name('adminNewUser');
    Route::post('user/new', 'AdminController@addNewUser')->name('adminAddNewUser');
    Route::get('user/{id}/edit', 'AdminController@editUser')->name('adminEditUser');
    Route::post('user/{id}/edit', 'AdminController@editUserAccount')->name('adminEditUserAccount');
    Route::post('user/{id}/delete', 'AdminController@deleteUser')->name('adminDeleteUser');
    Route::get('vehicles', 'AdminController@vehicles')->name('adminVehicles');
    Route::post('vehicle/new', 'AdminController@addVehicle')->name('adminAddVehicle');
    Route::post('vehicle/{id}/remove', 'AdminController@removeVehicle')->name('adminRemoveVehicle');
});

// Payment Controller
Route::prefix('pay')->group(function(){
    Route::get('checkout/{amount}/{id}', 'PaymentController@checkoutOrder')->name('pay.checkoutOrder');
    Route::post('checkout/{id}/continue', 'PaymentController@continueCheckOut')->name('pay.continueCheckOut');
    Route::get('confirm/{id}/execute', 'PaymentController@executeOrder')->name('pay.executeOrder');
});

// Reserve Controller
Route::prefix('reserve')->group(function(){
    Route::get('slot', 'ReservationController@reserve')->name('reserveSlot');
    Route::post('slot', 'ReservationController@checkIn')->name('checkIn');
});

