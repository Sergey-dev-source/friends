<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verifie'])->group(function (){
    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/status', 'UserController@status')->name('status');
    Route::post('/status', 'UserController@stat')->name('stat');
    Route::get('/account', 'AccauntController@index')->name('account');
    Route::post('/account', 'AccauntController@edit')->name('edit');
    Route::get('/image', 'ImageController@index')->name('image');
    Route::post('/image', 'ImageController@add')->name('img');
    Route::post('/i', 'ImageController@sel_avatar')->name('se_img');
    Route::post('/search','SearchController@search');
    Route::get('/user/{id}','UserController@user');
    Route::get('/contact/{id}','MessageController@index');
    Route::get('/chats/','MessageController@chat')->name('chat');
    Route::post('/chats}','MessageController@create_chat')->name('create_chat');
});

Route::group(['middleware'=>'auth'],function (){
    Route::get('/add','AddController@index')->name('edit_accaunt');
    Route::post('/enter_telephone','AddController@enter_telephone')->name('enter_telephone');
    Route::post('/enter_image','AddController@enter_image')->name('enter_image');
    Route::get('/enter_image','AddController@skip')->name('skip');

});

require __DIR__.'/auth.php';


