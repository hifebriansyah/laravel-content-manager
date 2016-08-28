<?php

Route::group(['prefix' => 'lcm', 'middleware' => ['web']], function () {
    Route::group(['prefix' => '/gen'], function () {
        Route::group(['prefix' => '/{class}'], function () {
            Route::get('/login', function ($class) {
                return App::call('MFebriansyah\LaravelContentManager\Controllers\GeneratorController@getLogin', [$class]);
            })->where(['class' => 'user']);

            Route::post('/login', function ($class) {
                return App::call('MFebriansyah\LaravelContentManager\Controllers\GeneratorController@postLogin', [$class]);
            })->where(['class' => 'user']);

            Route::get('/', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@getIndex');
            Route::get('/form/{id?}', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@getForm');

            Route::post('/', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@postStore');
            Route::post('/{id?}', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@postUpdate');
            Route::delete('/{id?}', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@deleteRecord');
        });
    });
});
