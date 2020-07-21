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

// Authentication routes
Auth::routes();

// Guests
Route::get('/', 'HomeController@index')->name('home');
Route::get('/{apartment}', 'ApartmentController@customizeUrl')->name('apartments.show');
Route::get('/{category}/{country}/{region}/{city}/{title}', 'ApartmentController@show')->name('apartments.show.custom');

// Route::get('/{country}/{region}', 'LocationController@region')->name('apartments.show.custom');

// COUNTRIES
// id | name | descrizione_breve | descrizione_lunga | attrazioni_principali

// REGIONS
// id | name | country_id | descrizione_breve | descrizione_lunga | attrazioni_principali


Route::post('/guest/{apartment}/send', 'HomeController@send')->name('info.send');
Route::post('/guest/{apartment}/review', 'HomeController@reviews')->name('reviews');


// Search
Route::get('/search', 'SearchController@index')->name('search');

// Admin
Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function() {
        // Home
        Route::get('/home', 'HomeController@index')->name('home');

        // Dashboard
        Route::get('/index', 'HomeController@index')->name('index');

        // Apartments CRUD 
        Route::resource('/apartments', 'ApartmentController');
        Route::patch('/apartments/{apartment}/toggle', 'ApartmentController@toggle')->name('apartments.toggle');

        // apartments stats
        Route::get('/apartments/{apartment}/stats/', 'StatsController@index')->name('apartments.stats.index');

        // Payment for sponsorships
        Route::get('/apartments/{apartment}/sponsorship/pay', 'SponsorshipController@pay')
            ->name('apartments.sponsorship.pay');

        Route::post('/apartments/{apartment}/sponsorship/checkout', 'SponsorshipController@checkout')
            ->name('apartments.sponsorship.checkout');

        Route::get('/apartments/{apartment}/sponsorship/transaction/{transaction_id}', 'SponsorshipController@transaction')
            ->name('apartments.sponsorship.transaction'); 
            
        
    });