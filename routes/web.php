<?php

Route::group(['middleware' => 'auth'], function(){
    Route::resource('projects', 'ProjectController');
    Route::post('projects/{project}/tasks', 'ProjectTasksController')->name('projects.tasks.store');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
