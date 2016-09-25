<?php

Route::group(['middleware' => 'web'], function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index');
//    Route::get('test', 'TestController@test');
    Route::get('/', function () {
        Illuminate\Support\Facades\Redis::publish('rooms', json_encode(['room' => 'default_room']));
        return view('home');
    });

//    Route::get('register', function () {
//        return view('auth/register');
//    });
//    Route::post('register', 'auth\RegisterController@create');
//    Route::resource('register', 'auth\RegisterController');

    Route::resource('messages', 'MessagesController');
    Route::resource('rooms', 'RoomsController');
    Route::post('users/set_room', 'UsersController@setRoom');
    Route::get('users/get_user', 'UsersController@getUser');

});

//Route::resource('auth', 'Auth\AuthController');
