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

/* Route::get('/', function () {
    return view('partials.header');
}); */
Route::get('/','homepageController@index')->name('home');
Route::get('/header','homepageController@header');
Route::get('/helpdesk','helpdeskController@index')->name('helpdesk');
Route::get('/infopnbp','perantaraController@getIndex')->name('perantara');
Route::get('/faq','faqController@index')->name('faq');
Route::get('/peraturan','peraturanController@index')->name('peraturan');
Route::get('/ma/importAwas', 'AdminLapAwasController@import');
Route::post('/api/getAwas', 'AdminLapAwasController@getDataWas');
Route::get('/api/getAwas', 'AdminLapAwasController@getDataWas');
Route::post('/ma/importAwasExcel', 'AdminLapAwasController@importExcel');



