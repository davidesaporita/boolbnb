<?php

use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;


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


Auth::routes();

// guest
Route::get('/', 'HomeController@index')->name('home');
Route::get('/guest/{apartment}', 'HomeController@show')->name('apartments.show');
Route::post('/guest', 'HomeController@send')->name('info.send');



// ADMIN Controller
Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function() {
        Route::get('/home', 'HomeController@index')->name('home');
        
        Route::get('/apartments/sponsorship/pay', function () { 
            return view('admin.apartments.sponsorship.pay');
                })->name('apartments.sponsorship.pay');

        Route::get('/apartments/sponsorship/transaction', function () { 
            return view('admin.apartments.sponsorship.transaction');
                })->name('apartments.sponsorship.transaction');

        Route::resource('/apartments', 'ApartmentController');
    });