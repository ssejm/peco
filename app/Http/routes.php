<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//   return view('welcome');
//});


//share constants on any view, i.e. {{ $site_name }}
//constants created in app/config/constants.php
View::share('site_name', Config::get('constants.SITE_NAME'));
View::share('site_url', Config::get('constants.SITE_URL'));
View::share('site_path', Config::get('constants.SITE_PATH'));


Route::controllers([
     'auth' => 'Auth\AuthController',
     'password' => 'Auth\PasswordController',
]);

//Route::resource('listings', 'ListingsController');

//explicitally  listed them, so SHOW doesn't need to be logged in!
Route::get('listings', ['middleware' => 'auth','uses' => 'ListingsController@index']);
Route::get('listings/create', ['middleware' => 'auth','uses' => 'ListingsController@create']);
Route::post('listings', ['middleware' => 'auth','uses' => 'ListingsController@store']);
Route::get('listings/{listings}', ['uses' => 'ListingsController@show']);
Route::get('listings/{listings}/edit', ['middleware' => 'auth','uses' => 'ListingsController@edit']);
Route::put('listings/{listings}', ['middleware' => 'auth','uses' => 'ListingsController@update']);
Route::patch('listings/{listings}', ['middleware' => 'auth','uses' => 'ListingsController@update']);
Route::delete('listings/{listings}', ['middleware' => 'auth','uses' => 'ListingsController@destroy']);


Route::resource('user', 'UserController', ['except' => ['create', 'edit', 'update', 'show']]);



Route::get('/', function()
{
    return View::make('pages.home');
});

Route::get('home', function()
{
    return View::make('pages.home');
});

Route::get('about', function()
{
    return View::make('pages.about');
});

Route::get('contact', function()
{
    return View::make('pages.contact');
});


Route::get('login', function()
{
    return View::make('pages.login');
});


Route::get('signup', function()
{
    return View::make('pages.signup');
});


Route::get('dashboard', function()
{
    return View::make('pages.dashboard');
});




