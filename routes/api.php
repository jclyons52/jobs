<?php

Route::group(['namespace' => 'API\V1', 'prefix' => '/v1'], function () {

    Route::get('/jobs', 'JobsController@index');

    Route::get('/jobs/watching', 'JobsController@watching');

    Route::get('/jobs/owned', 'JobsController@owned');

    Route::get('/jobs/search', 'JobsController@search');

    Route::get('/jobs/github', 'JobsController@github');

    Route::get('/jobs/indeed', 'JobsController@indeed');

    Route::get('tags', 'TagsController@index');
});