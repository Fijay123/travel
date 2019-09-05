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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes(['verify' => true]);
Route::get('/', 'FrontController@index')->name('index');
Route::get('/schedule', 'FrontController@schedule')->name('schedule');
Route::post('/schedule-info.{schedule}', 'FrontController@scheduleInfo')->name('scheduleInfo');
Route::get('/booking-form.{schedule}', 'FrontController@bookingForm')->name('bookingForm');
Route::post('/booking-form.{schedule}', 'FrontController@bookingSave')->name('bookingSave');
route::get('/data-booking.{user}', 'FrontController@dataBooking')->name('dataBooking');
route::get('/data-passenger.{booking_code}', 'FrontController@dataPassenger')->name('dataPassenger');
route::post('/data-passenger.{booking_code}', 'FrontController@updatePassenger')->name('updatePassenger');
route::get('/payment-confirmation.{booking_code}', 'FrontController@formConfirmation')->name('formConfirmation');
route::post('/payment-confirmation.{booking_code}', 'FrontController@saveConfirmation')->name('saveConfirmation');
route::get('/edit-payment-confirmation.{booking_code}', 'FrontController@editConfirmation')->name('editConfirmation');
route::get('/e-ticket.{booking_code}','FrontController@eTicket')->name('eTicket');


Route::get('/administrator', 'DashboardController@dashboard')->name('dashboard');
Route::resource('/administrator/route', 'RouteController');
Route::get('/administrator/route/{route}/route-status', 'RouteController@getStatus')->name('route.getStatus');
Route::post('/administrator/route/{route}/route-status', 'RouteController@changeStatus')->name('route.changeStatus');

Route::resource('/administrator/schedule', 'ScheduleController');
Route::get('/administrator/schedule/{schedule}/schedule-status', 'ScheduleController@getStatus')->name('schedule.getStatus');
Route::post('/administrator/schedule/{schedule}/schedule-status', 'ScheduleController@changeStatus')->name('schedule.changeStatus');

Route::get('/administrator/data-booking', 'BookingController@index')->name('data-booking');
Route::get('/administrator/verificated.{booking_code}', 'BookingController@formVerificated')->name('verificatedForm');
Route::post('/administrator/verificated.{booking_code}', 'BookingController@saveVerificated')->name('verificatedSave');

//hapus notifikasi
Route::get('administrator/notifications/{id}','DashboardController@deleteNotification')->name('deleteNotification');

//report
Route::get('administrator/report', 'DashboardController@report')->name('report');
Route::get('administrator/report-result', 'DashboardController@reportResult')->name('reportResult');

//member
Route::get('administrator/member', 'DashboardController@member')->name('member');

//armada
Route::resource('/administrator/car', 'CarController');
Route::get('/administrator/car.{car}/change-status', 'CarController@getStatus')->name('car.getStatus');
Route::post('/administrator/car.{car}/change-status', 'CarController@changeStatus')->name('car.changeStatus');

//driver
Route::resource('/administrator/driver', 'DriverController');
Route::get('/administrator/driver.{driver}/change-status', 'DriverController@getStatus')->name('driver.getStatus');
Route::post('/administrator/driver.{driver}/change-status', 'DriverController@changeStatus')->name('driver.changeStatus');
Route::get('/administrator/driver.{driver}/printed', 'DriverController@print')->name('driver.print');



