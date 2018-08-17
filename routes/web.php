<?php

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

Route::get('/', function () 
{
	if(Auth::check()) return redirect('/dashboard');
    return view('welcome');
});

Route::post('/authorize','web\UserController@verify');

Route::middleware(['Islogin'])->group(function () 
{
	Route::get('/dashboard', 'web\DashboardController@index');

	Route::get('/logout', function () 
	{
		Auth::logout();
  		return view('welcome');
	});
});