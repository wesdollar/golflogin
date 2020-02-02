<?php

if (env("APP_ENV") === "local") {
    Route::get('/phpinfo', function () {
        return view("phpinfo");
    });
}

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function() {
    $pageTitle = 'Golf Login | Golf Team Management Software';
    $pageDesc = 'Golf team software perfect for High School and College. Offers player statistics, rankings, score card archive, and more. Cloud-based = no install required!';

    return view('front.static.home', compact('pageTitle', 'pageDesc'));
})->name("home");

Route::get('/demo', function() {
    $pageTitle = 'Golf Login | Golf Team Management Software';
    $pageDesc = 'Golf team software perfect for High School and College. Offers player statistics, rankings, score card archive, and more. Cloud-based = no install required!';

    return view('front.static.home', compact('pageTitle', 'pageDesc'));
})->name("demo");

Route::get('/golf-team-software-features', function() {
    $pageTitle = 'Golf Login Features';

    return view('front.static.features', compact('pageTitle'));
})->name("features");

Route::get('/golf-login-pricing', function() {
    $pageTitle = 'Golf Login Pricing';

    return view('front.static.pricing', compact('pageTitle'));
})->name("pricing");

Route::get('/buy-golf-login', function() {
    $pageTitle = 'Purchase a Golf Login Subscription';

    return view('front.static.purchase', compact('pageTitle'));
})->name("buy");

Route::get('/purchase-golf-login', function() {
    $pageTitle = 'Purchase a Golf Login Subscription';

    return view('front.static.purchase', compact('pageTitle'));
})->name("purchase");

Route::get('/golf-login-software-free-trial', function() {
    $pageTitle = '14 Days Free, No Strings Attached! Golf Login!';

    return view('front.static.freeTrial', compact('pageTitle'));
})->name("freeTrial");

Route::get('/support', function() {
    $pageTitle = 'Golf Login Support';

    return view('front.static.support', compact('pageTitle'));
})->name("support");

Route::get('/contact-golf-login', function() {
    $pageTitle = 'Contact Us';

    return view('front.static.support', compact('pageTitle'));
})->name("contact");

Route::get('/frequently-asked-questions', function() {
    $pageTitle = 'Frequently Asked Questions';

    return view('front.static.faqs', compact('pageTitle'));
})->name("faqs");

Route::get('/contact-golf-login', function() {
    $pageTitle = 'Contact Us';

    return view('front.static.support', compact('pageTitle'));
})->name("contact");

Route::get('/golf-team-software', function() {
    $pageTitle = 'Golf Team, Group, &amp; Club Software';

    return view('front.static.golfLoginStory', compact('pageTitle'));
})->name("about");

Route::get('/thanks-for-contacting-us', function() {
    $pageTitle = 'Contact Us :: Message Received!';

    return view('front.static.contactThanks', compact('pageTitle'));
})->name("contactThanks");

Route::get('/registration-complete', function() {
    $pageTitle = 'Registration Complete!';

    return view('front.static.signupConfirmation', compact('pageTitle'));
})->name("signupConfirmation");

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

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
    Route::get('courses/get-course-data/{courseId}', 'CoursesController@getCourseData')->name('courses.getCourseData');

    Route::get('stats/get', 'StatsController@get')->name('stats.get');

    Route::get('rounds/create', 'RoundsController@roundEntry')->name('rounds.roundEntry');
    Route::post('rounds/create', 'RoundsController@create')->name('rounds.create');
    Route::get('rounds/{roundId}', 'RoundsController@get')->name('rounds.get');

    Route::get('scorecard-archive/{userId}', 'RoundsController@scorecardArchive')->name('scorecardArchive');

    Route::get('/' . env("APP_REACT_BASE") . '/{path?}', 'DashboardController@react')
        ->where('path', '.*')
        ->name('react');

    Route::get('/admin/{path?}', 'DashboardController@argon')
        ->where('path', '.*')
        ->name('argon');
});
