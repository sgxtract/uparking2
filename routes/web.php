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
Auth::routes(['verify' => true]);

// User Controller
// Route::group(['prefix' => 'user', 'middleware' => 'verified', function(){
    
// }]);
Route::prefix('user')->group(function(){
    Route::get('dashboard', 'UserController@dashboard')->name('userDashboard')->middleware('verified');
    Route::get('profile', 'UserController@profile')->name('userProfile')->middleware('verified');
    Route::post('profile', 'UserController@profilePost')->name('userProfilePost');
    Route::get('vehicle', 'UserController@vehicles')->name('userVehicle')->middleware('verified');
    Route::get('vehicle/{id}/edit', 'UserController@editVehicle')->name('userEditVehicle')->middleware('verified');
    Route::post('vehicle/{id}/edit', 'UserController@editVehicleInfo')->name('userEditVehicleInfo');
    Route::post('vehicle/new', 'UserController@addVehicle')->name('userAddVehicle');
    Route::post('vehicle/{id}/remove', 'UserController@removeVehicle')->name('userRemoveVehicle');
    Route::get('balance', 'UserController@balance')->name('userBalance')->middleware('verified');
    Route::get('history', 'UserController@history')->name('userHistory')->middleware('verified');
    // User Slots
    Route::get('reserve', 'UserController@reserve')->name('userReserve')->middleware('verified');
    Route::post('slot/{id}', 'UserController@reserveSlot')->name('userReserveSlot');
    Route::post('reserve/{id}/cancel', 'UserController@cancelReserve')->name('userCancelReserve');
});

// Staff Controller
Route::prefix('staff')->group(function(){
    Route::get('dashboard', 'StaffController@dashboard')->name('staffDashboard');
    Route::get('history', 'StaffController@history')->name('staffHistory');
    // Check In - Check Out
    Route::get('check-in', 'StaffController@checkIn')->name('staffCheckIn');
    Route::get('check-out', 'StaffController@checkOut')->name('staffCheckOut');
    // Staff Slots
    Route::get('walk-in', 'StaffController@walkIn')->name('staffWalkIn');
    Route::get('reserve', 'StaffController@reserve')->name('staffReserve');
    Route::get('reserves/view', 'StaffController@reservesView')->name('staffReservesView');
    Route::post('cancel/{id}/reserve', 'StaffController@cancelReserve')->name('staffCancelReserve');
    // Add Funds to User
    Route::get('add_funds', 'StaffController@addFunds')->name('staffAddFunds');
    Route::get('add_funds/{id}/continue', 'StaffController@continueUserFunds')->name('staffContinueUserFunds');
});

// Admin Controller
Route::prefix('admin')->group(function(){
    Route::get('dashboard', 'AdminController@dashboard')->name('adminDashboard');
    Route::get('user-logs', 'AdminController@userLogs')->name('adminUserLogs');
    Route::get('staff-logs', 'AdminController@staffLogs')->name('adminStaffLogs');
    Route::get('parking-logs', 'AdminController@parkingLogs')->name('adminParkingLogs');
    // Admin Users
    Route::get('users', 'AdminController@users')->name('adminUsers');
    Route::get('user/{id}', 'AdminController@singleUser')->name('adminSingleUser');
    Route::get('new_user', 'AdminController@newUser')->name('adminNewUser');
    Route::post('user/new', 'AdminController@addNewUser')->name('adminAddNewUser');
    Route::get('user/{id}/edit', 'AdminController@editUser')->name('adminEditUser');
    Route::post('user/{id}/edit', 'AdminController@editUserAccount')->name('adminEditUserAccount');
    Route::post('user/{id}/delete', 'AdminController@deleteUser')->name('adminDeleteUser');
    Route::post('user/{id}/activate', 'AdminController@activateUser')->name('adminActivateUser');
    Route::get('vehicles', 'AdminController@vehicles')->name('adminVehicles');
    Route::post('vehicle/new', 'AdminController@addVehicle')->name('adminAddVehicle');
    Route::post('vehicle/{id}/remove', 'AdminController@removeVehicle')->name('adminRemoveVehicle');
    // Admin Slots
    Route::get('reserve', 'AdminController@reserve')->name('adminReserve');
    Route::get('walk-in', 'AdminController@walkIn')->name('adminWalkIn');
    // Admin Reports
    Route::get('sales-report', 'AdminController@salesReport')->name('adminSalesReport');
    Route::get('statistics-report', 'AdminController@statisticsReport')->name('adminStatisticsReport');
    // Admin CMS
    Route::prefix('cms')->group(function(){
        Route::get('home', 'PublicController@homeCMS')->name('admin.homeCMS');
        Route::get('about', 'PublicController@aboutCMS')->name('admin.aboutCMS');
        Route::get('contact', 'PublicController@contactCMS')->name('admin.contactCMS');
        // Post
        Route::post('home/update', 'PublicController@changeHome')->name('admin.changeHome');
        Route::post('about/update', 'PublicController@changeAbout')->name('admin.changeAbout');
        Route::post('contact/update', 'PublicController@changeContact')->name('admin.changeContact');
    });
});

// Payment Controller
Route::prefix('pay')->group(function(){
    Route::get('checkout/{amount}/{id}', 'PaymentController@checkoutOrder')->name('pay.checkoutOrder');
    Route::post('checkout/{id}/continue', 'PaymentController@continueCheckOut')->name('pay.continueCheckOut');
    Route::get('confirm/{id}/execute', 'PaymentController@executeOrder')->name('pay.executeOrder');
    // Staff Add Funds To User
    Route::post('checkout/user/{id}', 'PaymentController@checkOutUserFunds')->name('pay.checkOutUserFunds');
    Route::get('confirm/{id}/checkout/{amount}/', 'PaymentController@executeUserFunds')->name('pay.executeUserFunds');
});

// Slots Controller for method posts || Admin / Staff
Route::prefix('slot')->group(function(){
    Route::post('check-in', 'SlotController@checkIn')->name('slotCheckIn');
    Route::post('reserve', 'SlotController@reserve')->name('slotReserve');
    Route::get('check-out/{id}/slot', 'SlotController@checkOutSearch')->name('slotCheckOutSearch');
    Route::post('check-out/bySlot', 'SlotController@checkOutSearch2')->name('slotCheckOutSearch2');
    Route::get('check-in/{id}/new', 'SlotController@checkInSearch')->name('slotCheckInSearch');
    Route::post('check-out/{slot}', 'SlotController@checkOut')->name('slotCheckOut');
    Route::post('check-out2/{slot}/{id}/{toPay}', 'SlotController@checkOut2')->name('slotCheckOut2');
    Route::post('check-in/{slot}', 'SlotController@checkInReserve')->name('slotCheckInReserve');
});

