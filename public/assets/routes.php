<?php

use Core\Routing\Route;

Route::get('/', 'Controller@index');
Route::get('/get/user/info/:name/:email', 'Controller@userInfo');
Route::get('/america/newyour/test/:id', 'Controller@testAction');
Route::get('/america/newyour/:id', 'Controller@usaAction');
Route::get('/america/newyour/test/google/:id/:test', 'Controller@last');
Route::get('/test1', 'Controller@smallGoogle');
Route::get('/ma', 'Controller@bigTester');
Route::get('/admin/add/video/:cat_id/:video_id/:authName', 'Controller@test');
Route::post('/email/send', 'Controller@emailSend');
