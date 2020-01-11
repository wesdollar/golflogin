<?php

if (env("APP_ENV") === "local") {
    Route::get('/phpinfo', function () {
        return view("phpinfo");
    });
}

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
//    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/subscribe', 'SubscriptionsController@createNoCcSubscription')->name('subscribeNoCc');

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });

    Route::get('/groups/switch', 'GroupsController@switch')->name('groups.switch');
    Route::get('/groups/switch/{group_id}', 'GroupsController@switchGroup')->name('groups.switchGroup');
    Route::get('/groups/create', 'GroupsController@createGui')->name('groups.createGui');
    Route::get('/groups/join-or-create-group', 'GroupsController@joinOrCreateGroup')->name('joinOrCreateGroup');
    Route::post('/groups/join-or-create-group', 'GroupsController@handleJoinOrCreateGroup')->name('joinOrCreateGroup');
    Route::post('/groups/create', 'GroupsController@create')->name('groups.create');

    Route::get('courses/create', 'CoursesController@createGui')->name('courses.createGui');
    Route::post('courses/create', 'CoursesController@create')->name('courses.create');
    Route::get('courses/get', 'CoursesController@get')->name('courses.get');

    Route::get('rounds/create', 'RoundsController@createGui')->name('rounds.createGui');
    Route::post('rounds/create', 'RoundsController@create')->name('rounds.create');

    Route::get('/' . env("APP_REACT_BASE") . '/{path?}', 'DashboardController@react')
        ->where('path', '.*')
        ->name('react');

    Route::get('/admin/{path?}', 'DashboardController@argon')
        ->where('path', '.*')
        ->name('argon');
});
