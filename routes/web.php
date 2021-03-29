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

Route::get('/', 'LandingPageController@index')->name('landingpage');

Auth::routes();

Route::middleware(['auth', 'auth:superadmin'])->group(function () {
    Route::get('/beranda', 'BerandaController@index')->name('beranda');
});

Route::group([
    'prefix' => 'mahasiswa',
    'as' => 'mahasiswa.',
    'namespace' => 'Mahasiswa',
    'middleware' => ['auth','auth:mahasiswa']],
function() {
    Route::get('/beranda', 'BerandaController@index')->name('beranda');
});
