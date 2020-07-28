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

// GUEST 
Route::get('/', 'HomeController@index')->name('home');

// Apartment
Route::get('/apartments/{apartment}', 'ApartmentController@customizeUrl')->name('apartments.show');
Route::get('/{category}/{country}/{region}/{city}/{title}/{apartment}', 'ApartmentController@show')->name('apartments.show.custom');

Route::get('/Discover/{country}', 'ApartmentController@discover')->name('apartments.discover.country');
Route::get('/Discover/{country}/{region}', 'ApartmentController@discover')->name('apartments.discover.region');
Route::get('/Discover/{country}/{region}/{city}', 'ApartmentController@discover')->name('apartments.discover.city');

Route::post('/{apartment}/send', 'ApartmentController@send')->name('info.send');
Route::post('/{apartment}/review', 'ApartmentController@reviews')->name('reviews');

// Search
Route::get('/search', 'SearchController@index')->name('search');

// ADMIN
Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function() {

        // Home
        Route::get('/home', 'HomeController@index')->name('home');

        // Dashboard
        Route::get('/index', 'HomeController@index')->name('index');

        // Inbox
        Route::get('/inbox', 'MessageController@inbox')->name('inbox');
        Route::delete('/inbox/{message}', 'MessageController@destroy')->name('inbox.destroy');

        // Reviews
        Route::get('/reviews', 'ReviewController@reviews')->name('reviews');
        Route::delete('/reviews/{review}', 'ReviewController@destroy')->name('reviews.destroy');
        
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