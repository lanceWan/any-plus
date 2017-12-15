<?php

Route::get('/', 'HomeController@index');
				
Route::resource('permission','PermissionController');

Route::resource('role','RoleController');

Route::resource('user','UserController');

Route::get('menu/clear','MenuController@cacheClear');
Route::resource('menu','MenuController');