<?php


Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });
    Route::auth();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('sendmessage', 'chatController@sendMessage');
    Route::post('/api/findmessage/{id}', function ($id) {
        return App\Messages::findOrFail($id);
    });
});


