<?php

Route::get('/', function () {
//    return view('home');
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
