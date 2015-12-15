<?php

use Core\Http\Route;


Route::get('/america/newyour/test/:id', 'Controller@testAction');
Route::get('/america/newyour/:id', 'Controller@usaAction');
Route::get('/america/newyour/test/google/:id/:test', 'Controller@last');
Route::get('/test1', 'Controller@smallGoogle');
Route::get('/ma', 'Controller@bigTester');
Route::get('/admin/add/video/:cat_id/:video_id/:authName', 'Controller@test');
