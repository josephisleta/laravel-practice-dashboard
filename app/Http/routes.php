<?php

Route::get('tasks', 'TasksController@index');
Route::get('tasks/create', 'TasksController@create');
Route::post('tasks/create', 'TasksController@store');
Route::get('tasks/completed', 'TasksController@getCompleted');
Route::get('tasks/overdue', 'TasksController@getOverdue');
Route::get('tasks/{task}/edit', 'TasksController@edit');
Route::post('tasks/{task}/edit', 'TasksController@update');
Route::post('tasks/{task}/delete', 'TasksController@destroy');
Route::get('tasks/{task}', 'TasksController@show');
Route::post('tasks/{task}', 'TasksController@setDone');

Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/', 'PagesController@home');