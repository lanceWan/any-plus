<?php

Route::get('category/clear','CategoryController@cacheClear');
Route::resource('category','CategoryController');