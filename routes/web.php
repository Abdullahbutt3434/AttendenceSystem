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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('attendence', 'AttendenceController');
Route::post('user', 'UserController@store');
Route::resource('user', 'UserController');
Route::resource('admin', 'AdminController');
Route::get('/vattendence', 'UserController@viewAttendence')->name('viewAttendence');
Route::get('/leaverequest', 'UserController@leaveRequest')->name('leaveRequest');
Route::get('/profile', 'UserController@viewProfile')->name('viewProfile');
Route::get('/allStudents', 'AdminController@viewAllStudents')->name('viewAllStudents');
Route::get('/student/{id}', 'AdminController@viewStudent')->name('viewStudent');
Route::get('/totalleaves', 'AdminController@leaveRequest')->name('leavesR');
Route::post('/acceptleave/{id}/{date}', 'AdminController@acceptLeave')->name('acceptLeave');
Route::post('/rejectleave/{id}/{date}', 'AdminController@rejectLeave')->name('rejectLeave');
Route::get('/editattendence/{id}', 'AdminController@editAttendence')->name('editAttendence');
Route::post('/updateattendence/{id}', 'AdminController@updateAttendence')->name('updateAttendence');
Route::put('/updateattendence/{id}', 'AdminController@updateAttendence')->name('updateAttendence');
Route::get('/addattendence/{id}', 'AdminController@addAttendence')->name('addAttendence');
Route::post('/storeattendence', 'AdminController@storeAttendence')->name('storeAttendence');
Route::post('/deleteattendence/{id}', 'AdminController@deleteAttendence')->name('deleteAttendence');




