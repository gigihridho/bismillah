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
Route::post('details/{id}/confirmation', 'BookingController@confirmation')->name('confirmation');
Route::post('details/{id}/book', 'BookingController@booking')->name('booking');
Route::get('invoice','BookingController@show')->name('upload');
Route::post('upload/{id}','BookingController@upload')->name('upload-pembayaran');

Route::prefix('user')
    ->middleware(['auth', 'role:user', 'verified'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::get('change-pass', 'ChangePassController@change')->name('change-pass');
        Route::post('change-pass','ChangePassController@update')->name('change-pass-user-update');

        Route::get('user-transaksi', 'UserTransactionController@index')->name('user-transaksi');
        Route::get('lanjut-sewa','UserTransactionController@lanjut')->name('lanjut-sewa');
        Route::post('user-transaksi','UserTransactionController@save')->name('save-lanjut-sewa');
        Route::get('user-transaksi/{id}', 'UserTransactionController@detail')->name('user-transaksi-detail');
        Route::post('user-transaksi/{id}', 'UserTransactionController@upload')->name('user-transaksi-upload');
        Route::delete('user-transaksi/{id}','UserTransactionController@cancel')->name('user-transaksi-delete');

        Route::get('review', 'UserReviewController@review')->name('review-user');
        Route::post('review/{id}', 'UserReviewController@update')->name('review-user-update');

        Route::get('view-profil','ProfilUserController@index')->name('profil-user');
        Route::get('change-profil-user', 'ProfilUserController@user')->name('change-profil-user');
        Route::post('change-profil-user/{id}', 'ProfilUserController@update')->name('change-profil-user-redirect');
    });

Route::prefix('admin')
    ->middleware(['auth', 'role:admin', 'verified'])
    ->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('admin-dashboard');
        Route::resource('fasilitas', 'Admin\FacilityController');

        Route::resource('user', 'Admin\UserController');

        Route::get('booking/sudah', 'Admin\RoomBookingController@index')->name('sudah-bayar');
        Route::get('booking/belum','Admin\RoomBookingController@belum')->name('belum-dibayar');
        Route::get('booking/{id}/edit','Admin\RoomBookingController@edit');
        Route::put('booking/{id}/edit','Admin\RoomBookingController@update');
        Route::get('booking/detail/{id}','Admin\RoombookingController@detail')->name('detail-booking');
        Route::delete('booking/{id}','Admin\RoomBookingController@destroy');

        Route::get('transaksi','Admin\TransactionsController@index')->name('transaksi');
        Route::get('transaksi/transaksi-pdf','Admin\TransactionsController@pdf')->name('transaksi-pdf');

        Route::resource('pengeluaran','Admin\ExpenseController');
        Route::get('pdf','Admin\ExpenseController@ex_pdf')->name('pengeluaran-pdf');

        Route::resource('reviews', 'Admin\ReviewsController');

        Route::get('invoice', 'Admin\InvoiceController@index')->name('invoice');
        Route::get('invoice/{id}','Admin\InvoiceController@create');
        Route::post('invoice/{id}','Admin\InvoiceController@store');

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
                Route::delete('/{id}/kamar/{room_id}', 'Admin\RoomController@destroy');


        });
    });
Route::get('/verify', function () {
    return view('auth/verify');
});
Auth::routes(['verify' => true]);

Route::get('detail-transaksi', 'DetailTransactionController@index')->name('detail-transaksi');
