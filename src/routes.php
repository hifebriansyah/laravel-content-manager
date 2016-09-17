<?php

Route::group(['prefix' => 'lcm', 'middleware' => ['web']], function () {
    Route::group(['prefix' => '/gen'], function () {
        Route::group(['prefix' => '/{class}'], function () {
            Route::get('/login', function ($class) {
                return App::call('HiFebriansyah\LaravelContentManager\Controllers\GeneratorController@getLogin', [$class]);
            })->where(['class' => 'user']);

            Route::post('/login', function ($class) {
                return App::call('HiFebriansyah\LaravelContentManager\Controllers\GeneratorController@postLogin', [$class]);
            })->where(['class' => 'user']);

            Route::get('/', 'HiFebriansyah\LaravelContentManager\Controllers\GeneratorController@getIndex');
            Route::get('/form/{id?}', 'HiFebriansyah\LaravelContentManager\Controllers\GeneratorController@getForm');

            Route::post('/', 'HiFebriansyah\LaravelContentManager\Controllers\GeneratorController@postStore');
            Route::post('/{id?}', 'HiFebriansyah\LaravelContentManager\Controllers\GeneratorController@postUpdate');
            Route::delete('/{id?}', 'HiFebriansyah\LaravelContentManager\Controllers\GeneratorController@deleteRecord');
        });
    });
});
