<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProducerProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');



    Route::get('/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');


    Route::patch('/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');


    Route::delete('/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');



    /*
    |--------------------------------------------------------------------------
    | Producer Profile
    |--------------------------------------------------------------------------
    */

    Route::middleware(['producer'])->group(function () {


        Route::get(
            '/producer/profile/create',
            [ProducerProfileController::class, 'create']
        )->name('producer.profile.create');


        Route::post(
            '/producer/profile',
            [ProducerProfileController::class, 'store']
        )->name('producer.profile.store');


    });


});


require __DIR__.'/auth.php';
