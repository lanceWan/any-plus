<?php

Route::get('category/clear','CategoryController@cacheClear');
Route::resource('category','CategoryController');

Route::resource('tag','TagController');

Route::resource('link','LinkController');

Route::resource('article','ArticleController');