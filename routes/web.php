<?php

use Illuminate\Support\Facades\Auth;
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
// Route::middleware('role:admin')->get('/dashboard', function(){
//     // return 'Dashboard';
// })->name('dashboard');

// Route::get('dashboard','Admin\DashboardController@index');
//(['middleware' => ['role:admin']], function () {
// Route::prefix('admin)
//     ->namespace('admin')
//     ->middleware('role:admin')
//     ->group(function(){
//     Route::get('/dashboard', 'Admin\DashboardController')->name('admin-dashboard');
//     Route::resource('fasilitas', 'FacilityController');
// });
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('admin','Admin\DashboardController@index')->name('admin-dashboard');
    Route::resource('fasilitas','Admin\FacilityController');
    Route::resource('kamar','Admin\RoomController');
    Route::resource('tipe','Admin\RoomTypeController');
    Route::resource('user','Admin\UserController');
    Route::get('user/{id}/detail','Admin\UserController@detail')->name('detail-user');
    Route::resource('transaksi', 'Admin\TransaksiController');
    Route::resource('testimoni', 'Admin\TestimoniController');
    Route::resource('gallery', 'Admin\GalleryController');

});
