<?php

// use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/welcome', 'PagesController@index');
Route::get('auth/google', 'LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'LoginController@handleGoogleCallback');
Route::get('auth/facebook', 'LoginController@redirectTofacebook');
Route::get('auth/facebook/callback', 'LoginController@handlefacebookCallback');
Route::get('/', 'PagesController@index');
Route::get('/search', 'PagesController@search');
Route::get('/sortbyprice', 'PagesController@sortbyprice');
Route::get('/login', 'PagesController@login');
Route::post('/validatelogin', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/get-province-list/{regn_hash}','CartController@getProvinceList');
Route::get('/get-city-list/{prov_hash}','CartController@getCityList');
Route::get('/get-barangay-list/{city_hash}','CartController@getBarangayList');

Route::get('/trackorder', 'PagesController@trackorder');
Route::get('/checkout', 'PagesController@checkout');
// Route::get('/payment', 'PagesController@payment');

Route::get('/signup', 'PagesController@signup');
Route::post('/users/create', 'UsersController@create');

Route::get('/status/{id}','CartController@updateStatus');
Route::post('/placeorder/create', 'CartController@placeorder');
Route::get('/mycart', 'CartController@index');
Route::get('/checkout', 'CartController@indexcheckout');
Route::get('/delete/{id}', 'CartController@delete');
Route::get('/updatestatus/{id}', 'ProfileController@updatestatus');
Route::get('/updatecancel/{id}', 'ProfileController@updatecancel');
Route::get('/review/{id}', 'ProfileController@review');
Route::post('/cart/create', 'CartController@create');
Route::post('/cart/createmsg', 'CartController@createmsg');
Route::post('/cart/update', 'CartController@update');
Route::post('/cart/updatestatus', 'CartController@updatecart');
Route::post('/cart/updateqty', 'CartController@updateqty');
Route::get('/productdetails/{id}', 'CartController@show');
Route::get('/categories/{id}', 'PagesController@show');
Route::get('/searchcat', 'PagesController@searchcat');
Route::get('/sortbypricebycat', 'PagesController@sortbypricebycat');

Route::get('/profile', 'ProfileController@index');
Route::get('/verify/{id}', 'UsersController@verify');
Route::get('/verify', 'PagesController@verify');
Route::post('/updateverification', 'LoginController@updateverification');

// Route::get('/mycart', 'PagesController@mycart');
// Route::get('/mycart/{id}', 'ProfileController@cart');
// Route::get('/mycart', 'ProfileController@cart');
Route::get('/sort', 'ProfileController@sort');
Route::get('/waybill', 'ProfileController@waybill');
Route::get('/logs', 'ProfileController@logs');

Route::get('/welcomeseller', 'PagesController@welcomeseller');

