<?php

use App\Http\Controllers\DetailController;
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

Route::get('/', 'HomeController@index')->name('home');

Route::get('details/{id}', 'DetailController@detail')->name('detail-kost');
Route::post('details/{id}/book', 'BookingController@booking')->name('booking');

Route::get('checkout','CheckoutController@process')->name('checkout');

Route::prefix('user')
    ->middleware(['auth', 'role:user', 'verified'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('change-pass', 'ChangePassController@change')->name('change-pass');
        Route::post('change-pass','ChangePassController@update')->name('change-pass-user-update');
        Route::get('user-transaksi', 'UserTransactionController@index')->name('user-transaksi');
        Route::get('user-transaksi/{id}', 'UserTransactionController@detail')->name('user-transaksi-detail');
        Route::post('user-transaksi/{id}', 'UserTransactionController@upload')->name('user-transaksi-upload');
        Route::delete('user-transaksi/{id}','UserTransactionController@destroy')->name('user-transaksi-delete');
        Route::get('review', 'UserReviewController@review')->name('review-user');
        Route::post('review/{redirect}', 'UserReviewController@update')->name('review-user-redirect');
        Route::get('change-profil-user', 'ProfilUserController@user')->name('change-profil-user');
        Route::post('change-profil-user/{redirect}', 'ProfilUserController@update')->name('change-profil-user-redirect');
    });

Route::prefix('admin')
    ->middleware(['auth', 'role:admin', 'verified'])
    ->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('admin-dashboard');
        Route::resource('fasilitas', 'Admin\FacilityController');
        Route::resource('user', 'Admin\UserController');
        Route::get('user/{id}/detail', 'Admin\UserController@detail')->name('detail-user');
        Route::resource('transaksi', 'Admin\TransactionsController')->except('Belum Terbayar');
        Route::get('transaksi/konfirmasi/{id}','Admin\TransactionsController@confirmation')->name('confirmation');
        Route::get('paid','Admin\TransactionsController@paid')->name('view');
        Route::resource('reviews', 'Admin\ReviewsController');
        Route::resource('gallery', 'Admin\GalleryController');
        Route::get('change-pass', 'Admin\ChangePasswordController@edit')->name('change-pass-edit');
        Route::post('change-pass', 'Admin\ChangePasswordController@update')->name('change-pass-update');
        Route::get('change-profil', 'Admin\ChangeProfilController@profil')->name('change-profil');
        Route::post('change-profil/{redirect}', 'Admin\ChangeProfilController@update')->name('change-profil-redirect');

        Route::resource('tipe', 'Admin\RoomTypeController');

        Route::prefix('tipe')
            ->middleware(['auth', 'role:admin' , 'verified'])
            ->group(function(){
                Route::get('/{id}/kamar', 'Admin\RoomController@index');
                Route::get('/{id}/kamar/create', 'Admin\RoomController@create');
                Route::post('/{id}/kamar', 'Admin\RoomController@store');
                Route::get('/{id}/kamar/{room_id}/edit', 'Admin\RoomController@edit');
                Route::put('/{id}/kamar/{room_id}/edit', 'Admin\RoomController@update');
                Route::delete('/{id}/room/{room_id}', 'Admin\RoomController@destroy');


        });
    });
Route::get('/verify', function () {
    return view('auth/verify');
});
Auth::routes(['verify' => true]);

Route::get('detail-transaksi', 'DetailTransactionController@index')->name('detail-transaksi');
