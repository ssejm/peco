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


View::share('site_name', Config::get('constants.SITE_NAME'));
View::share('site_url', Config::get('constants.SITE_URL'));
View::share('site_path', Config::get('constants.SITE_PATH'));


            
Route::get('/', function()
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
