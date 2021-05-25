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

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth:admin'],
],
function () {
    Route::get('beranda', 'BerandaController@index')->name('beranda');
    Route::get('edit_password', 'BerandaController@edit_password')->name('edit_password');
    Route::put('edit_password', 'BerandaController@edit_password')->name('edit_password');
    Route::resource('mahasiswa', 'MahasiswaController')->except(['create', 'store']);
    Route::resource('dosen', 'DosenController');
});

Route::group([
    'prefix' => 'mahasiswa',
    'as' => 'mahasiswa.',
    'namespace' => 'Mahasiswa',
    'middleware' => ['auth:mahasiswa']
],
function() {
    Route::get('beranda', 'BerandaController@index')->name('beranda');
    Route::resource('mahasiswa', 'MahasiswaController')->except(['create', 'store', 'index', 'destroy']);
});

Route::group([
    'prefix' => 'dosen',
    'as' => 'dosen.',
    'namespace' => 'Dosen',
    'middleware' => ['auth:dosen']
],
function() {
    Route::get('beranda', 'BerandaController@index')->name('beranda');
    Route::resource('dosen', 'DosenController')->except(['create', 'store', 'index', 'destroy']);
});
