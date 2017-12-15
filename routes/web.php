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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
	->namespace('Admin')
	->group(function ($router)
	{
		$router->get('login', 'LoginController@showLoginForm');
	    $router->post('login', 'LoginController@login');
	    $router->post('logout', 'LoginController@logout');

		$router->middleware(['auth.admin', 'check.permission'])->group(function ($router)
		{
			$router->get('/', 'HomeController@index');
			
			$router->resource('permission','PermissionController');
			
			$router->resource('role','RoleController');
			
			$router->resource('user','UserController');
			
			$router->get('menu/clear','MenuController@cacheClear');
			$router->resource('menu','MenuController');
		});

	});
