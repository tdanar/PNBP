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
Route::get('/faq','faqController@index')->name('faq');
Route::get('/peraturan','peraturanController@index')->name('peraturan');

