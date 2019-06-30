<?php

Route::group(['middleware' => 'auth'], function(){
    Route::resource('projects', 'ProjectController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
