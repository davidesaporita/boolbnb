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
Route::post('/guest/{apartment}/send', 'HomeController@send')->name('info.send');
Route::post('/guest/{apartment}/review', 'HomeController@reviews')->name('reviews');

// Search
// Route::get('/search?{geo_lat}&{geo_lng}', 'SearchController@index')->name('search');
Route::get('/search', 'HomeController@search')->name('search');


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