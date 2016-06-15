<?php

Route::group(['prefix' => 'lcm', 'middleware' => ['web']], function ()
{	
    Route::group(['prefix' => '/gen/{class}'], function () {
		Route::get('/', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@getIndex');
		Route::get('/form/{id?}', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@getForm');

		Route::post('/', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@postStore');
		Route::post('/{id?}', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@postUpdate');
		Route::delete('/{id?}', 'MFebriansyah\LaravelContentManager\Controllers\GeneratorController@deleteRecord');
	});
});