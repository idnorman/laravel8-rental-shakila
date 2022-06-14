<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;

//Main
Route::get('', [MainController::class, 'index'])->name('main.index');
Route::get('mobil', [MainController::class, 'carList'])->name('main.carList');


Route::group([
    'middleware' => 'auth'
], function(){
    Route::get('rental/{id}', [MainController::class, 'rental'])->name('main.rental');
    Route::post('rental', [MainController::class, 'rentalProcess'])->name('main.rentalProcess');
    Route::get('riwayat', [MainController::class, 'history'])->name('main.history');
    Route::post('rentalBarProcess', [MainController::class, 'rentalBarProcess'])->name('main.rentalBarProcess');
    Route::get('profil', [MainController::class, 'profil'])->name('main.profil');
    Route::put('ubah-password', [MainController::class, 'changePassword'])->name('main.changePassword');
});



////Authentication
Route::group([
    'middleware' => 'guest'
    ], function() {
        Route::get('masuk', [MainController::class, 'login'])->name('main.login');
        Route::post('masuk', [MainController::class, 'loginProcess'])->name('main.loginProcess');
        Route::get('lupa-password', [MainController::class, 'forgetPassword'])->name('main.forgetPassword');
        Route::post('lupa-password', [MainController::class, 'forgetPasswordProcess'])->name('main.forgetPasswordProcess');
        Route::get('reset-password/{email}/{token}', [MainController::class, 'resetPassword'])->name('main.resetPassword');
        Route::post('reset-password', [MainController::class, 'resetPasswordProcess'])->name('main.resetPasswordProcess');
        Route::get('daftar', [MainController::class, 'register'])->name('main.register');
        Route::post('daftar', [MainController::class, 'registerProcess'])->name('main.registerProcess');    
    }
);
Route::get('keluar', [MainController::class, 'logout'])->middleware('auth')->name('main.logout');

//Panel

////Index
Route::get('panel', [PanelController::class, 'index'])->middleware('admin')->name('panel.index');

////Authentication
Route::group([ 
    'prefix' => 'panel', 
    'middleware' => 'guest'
    ], function() {
        Route::get('masuk', [PanelController::class, 'login'])->name('panel.login');
        Route::post('masuk', [PanelController::class, 'loginProcess'])->name('panel.loginProcess');
        Route::get('lupa-password', [PanelController::class, 'forgetPassword'])->name('panel.forgetPassword');
        Route::post('lupa-password', [PanelController::class, 'forgetPasswordProcess'])->name('panel.forgetPasswordProcess');
        Route::get('reset-password/{email}/{token}', [PanelController::class, 'resetPassword'])->name('panel.resetPassword');
        Route::post('reset-password', [PanelController::class, 'resetPasswordProcess'])->name('panel.resetPasswordProcess');    
    }
);
Route::get('panel/keluar', [PanelController::class, 'logout'])->middleware('admin')->name('panel.logout');

////Car
Route::group([
    'prefix' => 'panel/mobil',
    'middleware' => 'admin'
], function(){
    Route::get('', [CarController::class, 'index'])->name('panel.car.index');
    Route::get('tambah', [CarController::class, 'create'])->name('panel.car.create');
    Route::post('tambah', [CarController::class, 'store'])->name('panel.car.store');
    Route::get('lihat/{id}', [CarController::class, 'show'])->name('panel.car.show');
    Route::get('ubah/{id}', [CarController::class, 'edit'])->name('panel.car.edit');
    Route::put('ubah', [CarController::class, 'update'])->name('panel.car.update');
    Route::delete('hapus', [CarController::class, 'destroy'])->name('panel.car.delete');
});

////Rental
Route::group([
    'prefix' => 'panel/rental',
    'middleware' => 'admin'
], function(){
    Route::get('', [RentalController::class, 'index'])->name('panel.rental.index');
    Route::get('tambah', [RentalController::class, 'create'])->name('panel.rental.create');
    Route::post('tambah', [RentalController::class, 'store'])->name('panel.rental.store');
    Route::get('lihat/{id}', [RentalController::class, 'show'])->name('panel.rental.show');
    Route::put('ubah/status', [RentalController::class, 'statusUpdate'])->name('panel.rental.statusUpdate');
    Route::put('ubah/tanggal-kembali', [RentalController::class, 'returnDateUpdate'])->name('panel.rental.returnDateUpdate');
    Route::get('ubah/{id}', [RentalController::class, 'edit'])->name('panel.rental.edit');
    Route::put('ubah', [RentalController::class, 'update'])->name('panel.rental.update');
    Route::delete('hapus', [RentalController::class, 'destroy'])->name('panel.rental.delete');

});

////User
Route::group([
    'prefix' => 'panel/pengguna',
    'middleware' => 'admin'
], function(){
    Route::get('', [UserController::class, 'index'])->name('panel.user.index');
    Route::get('tambah', [UserController::class, 'create'])->name('panel.user.create');
    Route::post('tambah', [UserController::class, 'store'])->name('panel.user.store');
    Route::get('lihat/{id}', [UserController::class, 'show'])->name('panel.user.show');
    Route::get('ubah/{id}', [UserController::class, 'edit'])->name('panel.user.edit');
    Route::put('ubah', [UserController::class, 'update'])->name('panel.user.update');
    Route::delete('hapus', [UserController::class, 'destroy'])->name('panel.user.delete');
});

Route::get('panel/plain', [PanelController::class, 'plain']);
//End Of Panel