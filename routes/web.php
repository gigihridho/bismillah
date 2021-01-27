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

Route::get('/','HomeController@index')->name('home');
Route::get('/detail','DetailController@index')->name('detail-kost');

Auth::routes(['verify' => true]);

Route::prefix('user')
    ->middleware(['auth','role:user', 'verified'])
    ->group(function(){
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/change-pass','ChangePassController@change')->name('change-pass');
        Route::resource('user-transaksi', 'UserTransactionController');
        Route::resource('review', 'UserReviewController');
        Route::get('change-profil-user','ProfilUserController@user')->name('change-profil-user');
        Route::post('change-profil-user/{redirect}','ProfilUserController@update')->name('change-profil-user-redirect');
});


Route::prefix('admin')
    ->middleware(['auth','role:admin', 'verified'])
    ->group(function () {
    Route::get('/','Admin\DashboardController@index')->name('admin-dashboard');
    Route::resource('fasilitas','Admin\FacilityController');
    Route::resource('kamar','Admin\RoomController');
    Route::resource('tipe','Admin\RoomTypeController');
    Route::resource('user','Admin\UserController');
    Route::get('user/{id}/detail','Admin\UserController@detail')->name('detail-user');
    Route::resource('transaksi', 'Admin\TransaksiController');
    Route::resource('reviews', 'Admin\ReviewsController');
    Route::resource('gallery', 'Admin\GalleryController');
    Route::get('change-pass', 'Admin\ChangePasswordController@edit')->name('change-pass-edit');
    Route::patch('change-pass','Admin\ChangePasswordController@update')->name('change-pass-update');
    Route::get('change-profil','Admin\ChangeProfilController@profil')->name('change-profil');
    Route::post('change-profil/{redirect}','Admin\ChangeProfilController@update')->name('change-profil-redirect');

});
Route::get('/verify', function () {
    return view('auth/verify');
});
