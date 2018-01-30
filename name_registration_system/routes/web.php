<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/results', 'ResultsController@index')->name('results');
Route::post('/results/search', 'ResultsController@searchDomain');
Route::post('/register-domain', 'ResultsController@registerDomain');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('/dashboard/domains', 'DomainController');
Route::get('/domains/renew/{id}', 'DomainController@renew')->name('domains.renew');
Route::post('/domains/search', 'DomainController@searchDomain');

Route::get('/auth', 'AuthController@index')->name('auth');
Route::get('/auth/{domainName}', 'AuthController@registerDomain')->name('registerDomain');


Route::get('/dashboard/change-password', 'Dashboard\ChangePasswordController@index')->name('change-password');
Route::post('/dashboard/change-password', 'Dashboard\ChangePasswordController@ChangeUserPassword')->name('change-password');
Route::get('/dashboard/profile', 'Dashboard\ProfileController@index')->name('profile');
Route::post('/dashboard/profile', 'Dashboard\ProfileController@ChangeUserProfile')->name('profile');
Route::get('/changeDomain', 'ResultsController@ChangeDomain')->name('changedomain');
Route::post('/changeDomain', 'ResultsController@ChangeDomain')->name('changedomain');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){
	Route::group(['prefix' => 'names'], function() {
		Route::get('/', 'Dashboard\NameManagementController@index');
        Route::post('/', 'DomainController@redirectNameManagement');
		Route::post('/search', 'Dashboard\NameManagementController@searchDomain');
		Route::get('/create', 'Dashboard\NameManagementController@create');
		Route::post('/create', 'Dashboard\NameManagementController@create');
		Route::post('/store', 'Dashboard\NameManagementController@store');
	});
});



Route::get('register/verify/{confirmationCode}', 'Auth\RegisterController@confirm')->name('verify_email');
