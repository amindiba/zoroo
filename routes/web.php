<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProducerProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {

    return view('welcome');

});





Route::middleware(['auth', 'verified'])->group(function () {



    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');






    /*
    |--------------------------------------------------------------------------
    | User Profile
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');



    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');



    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');








    /*
    |--------------------------------------------------------------------------
    | Producer Area
    |--------------------------------------------------------------------------
    */


    Route::middleware(['producer'])->group(function () {




        /*
        |--------------------------------------------------------------------------
        | Producer Profile
        |--------------------------------------------------------------------------
        */


        Route::get(
            '/producer/profile/create',
            [ProducerProfileController::class, 'create']
        )->name('producer.profile.create');



        Route::post(
            '/producer/profile',
            [ProducerProfileController::class, 'store']
        )->name('producer.profile.store');



        Route::get(
            '/producer/profile',
            [ProducerProfileController::class, 'show']
        )->name('producer.profile.show');



        Route::get(
            '/producer/profile/edit',
            [ProducerProfileController::class, 'edit']
        )->name('producer.profile.edit');



        Route::put(
            '/producer/profile',
            [ProducerProfileController::class, 'update']
        )->name('producer.profile.update');








        /*
        |--------------------------------------------------------------------------
        | Producer Products
        |--------------------------------------------------------------------------
        */


        Route::resource(
            'products',
            ProductController::class
        )
        ->names('products');



    });



});





require __DIR__.'/auth.php';
