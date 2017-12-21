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
			// 系统管理
			$router->namespace('System')->group(base_path('routes/admin/system.php'));
			// 博客
			$router->namespace('Blog')->group(base_path('routes/admin/blog.php'));
			
		});

	});

Route::namespace('Iwanli')
	->group(function ($router)
	{
		$router->get('/', 'IndexController@index');
		$router->get('blog', 'IndexController@blog');
		// $router->middleware(['auth.admin'])->group(function ($router)
		// {
		
			
		// });

	});
