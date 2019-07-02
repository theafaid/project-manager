<?php

Route::group(['middleware' => 'auth'], function(){
    Route::resource('projects', 'ProjectController');
    Route::post('projects/{project}/tasks', 'ProjectTasksController@store')->name('projects.tasks.store');
    Route::patch('projects/{project}/tasks/{task}', 'ProjectTasksController@update')->name('projects.tasks.update');
    Route::delete('/tasks/{task}', 'ProjectTasksController@destroy')->name('projects.tasks.destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
