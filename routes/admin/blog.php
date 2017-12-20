<?php

Route::get('category/clear','CategoryController@cacheClear');
Route::resource('category','CategoryController');

Route::resource('tag','TagController');

Route::resource('link','LinkController');

Route::get('article/category','ArticleController@createCategory');
Route::get('article/tag','ArticleController@createTag');
Route::resource('article','ArticleController');