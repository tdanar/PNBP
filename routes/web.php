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
Route::get('/lhc_web','lhc_webController@getLHC');
Route::get('/header','homepageController@header');

Route::get('/faq','faqController@index')->name('faq');
Route::get('/peraturan','peraturanController@index')->name('peraturan');
Route::get('/refereshcapcha', 'helperController@refereshCapcha');
Route::get('/artikel/{id}','AdminArticleController@showArticle')->name('article');
Route::middleware(['web','XSS', '\crocodicstudio\crudbooster\middlewares\CBBackend'])->group(function () {
    Route::get('/ma/importAwas', 'AdminLapAwasController@import');
    Route::get('/helpdesk','helpdeskController@index')->name('helpdesk');
    Route::post('/api/getAwas', 'AdminLapAwasController@getDataWas');
    Route::get('/api/getAwas', 'AdminLapAwasController@getDataWas');
    Route::post('/api/tlanjut', 'AdminLapAwasTlanjutController@getDataWas');
    Route::get('/api/tlanjut', 'AdminLapAwasTlanjutController@getDataWas');
    Route::get('/api/getNestedWas', 'AdminLapAwasController@getNestedWas');
    Route::post('/api/getMonitorWas', 'AdminMonitoringController@getMonitorWas');
    Route::get('/api/getMonitorWas', 'AdminMonitoringController@getMonitorWas');
    Route::post('/ma/importAwasExcel', 'AdminLapAwasController@importExcel');
    Route::get('/ma/excel/{id}', 'AdminLapAwasController@exporExcel');
    Route::get('/ma/word/{id}', 'AdminLapAwasController@exporWord');
    Route::get('/ma/validasi/{id}', 'AdminLapAwasController@Validasi');
    Route::get('/ma/kirim/{id}', 'AdminLapAwasController@Kirim');
    Route::get('/ma/batal/{id}', 'AdminLapAwasController@Batal');
    Route::get('/ma/lap_awas/add-temuan', 'AdminLapAwasController@postAddTemuan');
    Route::get('/ma/lap_awas/edit-temuan/{id}', 'AdminLapAwasController@postEditTemuan');
    Route::get('/ma/lap_awas_temuan/add-temuan', 'AdminLapAwasTemuanController@postAddTemuan');
    Route::get('/ma/lap_awas_temuan/edit-temuan/{id}', 'AdminLapAwasTemuanController@postEditTemuan');
    Route::get('/ma/monitoring/dlPDF/{id}','AdminMonitoringController@getDlPDF');
    Route::get('/ma/monitoring/tlanjut/{id}','AdminLapAwasTlanjutController@getTlanjut');
    Route::get('/infopnbp','perantaraController@getIndex')->name('perantara');
    Route::get('/ma/reviu/{id}','AdminLapAwasController@Reviu')->name('review');
    Route::get('/ma/rev','AdminLapAwasController@Rev');
    Route::get('/ma/manajemenGrafik','manajemenGrafikController@Index');
    Route::get('/ma/lap_awas_tlanjut/addTL/{id}', 'AdminLapAwasTlanjutController@getTlanjut');
    Route::get('/ma/kirimTL/{id}', 'AdminLapAwasTlanjutController@KirimTL');

    //Route::post('/ma/rev','AdminLapAwasController@Rev');
});
Route::get('/api/getPiePNBP/{tahun?}','homepageController@getPiePNBP')->name('getPiePNBP');
Route::get('/api/getTrenPNBP','homepageController@getTrenPNBP')->name('getTrenPNBP');











