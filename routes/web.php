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

Route::get('/', function () {
    return view('guest.welcome');
});

Auth::routes();

// guest
Route::get('/home', 'HomeController@index')->name('home');


// ADMIN Controller
Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function() {
        // Home
        Route::get('/home', 'HomeController@index')->name('home');

        // Apartments CRUD 
        Route::resource('/apartments', 'ApartmentController');

        // Payment for sponsorships
        Route::get('/apartments/{apartment}/sponsorship/pay', 'SponsorshipController@pay')
            ->name('apartments.sponsorship.pay');

        Route::post('/apartments/{apartment}/sponsorship/checkout', 'SponsorshipController@checkout')
            ->name('apartments.sponsorship.checkout');

        Route::get('/apartments/{apartment}/sponsorship/transaction/{transaction_id}', 'SponsorshipController@transaction')
            ->name('apartments.sponsorship.transaction');      
    });