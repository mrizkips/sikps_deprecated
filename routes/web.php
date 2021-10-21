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
Route::get('proposal', 'LandingPageController@proposal')->name('proposal.index');

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth:admin'],
],
function () {
    Route::get('/', function() {
        return redirect()->route('admin.beranda');
    });
    Route::get('beranda', 'BerandaController@index')->name('beranda');
    Route::get('edit_password', 'BerandaController@edit_password')->name('edit_password');
    Route::put('edit_password', 'BerandaController@edit_password')->name('edit_password');

    // Data Pengguna
    Route::resource('mahasiswa', 'MahasiswaController')->except(['create', 'store']);
    Route::resource('dosen', 'DosenController');
    Route::resource('keuangan', 'KeuanganController');
    Route::resource('baak', 'BaakController');

    // KP & Skripsi
    Route::resource('pendaftaran', 'PendaftaranController')->except(['show']);
    Route::resource('proposal', 'ProposalController')->except(['create', 'store', 'edit', 'update']);
    Route::post('proposal/{proposal}/approval', 'ProposalController@approval')->name('proposal.approval');
    Route::post('proposal/{proposal}/assign', 'ProposalController@assign')->name('proposal.assign');
    Route::resource('jadwal', 'JadwalController')->only(['index', 'show']);
    Route::resource('bimbingan', 'BimbinganController')->only(['index', 'show']);
    Route::resource('sidang', 'SidangController')->only(['index', 'show', 'destroy']);
    Route::post('sidang/{sidang}/approval', 'SidangController@approval')->name('sidang.approval');
    Route::resource('pengujian', 'PengujianController');
    Route::group(['prefix' => 'pengujian/{pengujian}'], function() {
        Route::resource('penguji', 'PengujiController')->except(['show', 'index']);
        Route::resource('penilaian', 'PenilaianController')->except(['index']);
    });

    // Data Master
    Route::resource('form_penilaian', 'FormPenilaianController')->except(['show']);
    Route::group(['prefix' => 'form_penilaian/{form_penilaian}'], function() {
        Route::resource('form_penilaian_item', 'FormPenilaianItemController')->except(['show']);
    });
});

Route::group([
    'prefix' => 'mahasiswa',
    'as' => 'mahasiswa.',
    'namespace' => 'Mahasiswa',
    'middleware' => ['auth:mahasiswa']
],
function() {
    Route::get('/', function() {
        return redirect()->route('mahasiswa.beranda');
    });
    Route::get('beranda', 'BerandaController@index')->name('beranda');
    Route::get('profil/{mahasiswa}', 'ProfilController@show')->name('profil.show');
    Route::get('profil/{mahasiswa}/edit', 'ProfilController@edit')->name('profil.edit');
    Route::put('profil/{mahasiswa}', 'ProfilController@update')->name('profil.update');

    // KP & Skripsi
    Route::resource('proposal', 'ProposalController');
    Route::resource('jadwal', 'JadwalController')->only(['index']);
    Route::resource('bimbingan', 'BimbinganController');
    Route::get('get_proposal', 'BimbinganController@getProposal')->name('bimbingan.get_proposal');
    Route::resource('sidang', 'SidangController');
    Route::resource('pengujian', 'PengujianController')->only(['index', 'show']);
});

Route::group([
    'prefix' => 'dosen',
    'as' => 'dosen.',
    'namespace' => 'Dosen',
    'middleware' => ['auth:dosen']
],
function() {
    Route::get('/', function() {
        return redirect()->route('dosen.beranda');
    });
    Route::get('beranda', 'BerandaController@index')->name('beranda');
    Route::get('profil/{dosen}', 'ProfilController@show')->name('profil.show');
    Route::get('profil/{dosen}/edit', 'ProfilController@edit')->name('profil.edit');
    Route::put('profil/{dosen}', 'ProfilController@update')->name('profil.update');

    // KP & Skripsi
    Route::resource('proposal', 'ProposalController')->only(['index', 'show']);
    Route::resource('jadwal', 'JadwalController');
    Route::resource('bimbingan', 'BimbinganController')->only(['index', 'show', 'destroy']);
    Route::resource('sidang', 'SidangController')->only(['index', 'show']);
    Route::post('sidang/{sidang}/approval', 'SidangController@approval')->name('sidang.approval');
    Route::resource('pengujian', 'PengujianController')->only(['index', 'show']);
    Route::group(['prefix' => 'pengujian/{pengujian}'], function() {
        Route::resource('penilaian', 'PenilaianController')->except(['index']);
    });
});

Route::group([
    'prefix' => 'baak',
    'as' => 'baak.',
    'namespace' => 'Baak',
    'middleware' => ['auth:baak']
],
function() {
    Route::get('/', function() {
        return redirect()->route('baak.beranda');
    });
    Route::get('beranda', 'BerandaController@index')->name('beranda');
    Route::get('profil/{baak}', 'ProfilController@show')->name('profil.show');
    Route::get('profil/{baak}/edit', 'ProfilController@edit')->name('profil.edit');
    Route::put('profil/{baak}', 'ProfilController@update')->name('profil.update');

    // KP & Skripsi
    Route::resource('proposal', 'ProposalController')->except(['create', 'store', 'destroy', 'edit', 'update']);
    Route::post('proposal/{proposal}/approval', 'ProposalController@approval')->name('proposal.approval');
    Route::resource('sidang', 'SidangController')->only(['index', 'show']);
    Route::post('sidang/{sidang}/approval', 'SidangController@approval')->name('sidang.approval');
});

Route::group([
    'prefix' => 'keuangan',
    'as' => 'keuangan.',
    'namespace' => 'Keuangan',
    'middleware' => ['auth:keuangan']
],
function() {
    Route::get('/', function() {
        return redirect()->route('keuangan.beranda');
    });
    Route::get('beranda', 'BerandaController@index')->name('beranda');
    Route::get('profil/{keuangan}', 'ProfilController@show')->name('profil.show');
    Route::get('profil/{keuangan}/edit', 'ProfilController@edit')->name('profil.edit');
    Route::put('profil/{keuangan}', 'ProfilController@update')->name('profil.update');

    // KP & Skripsi
    Route::resource('proposal', 'ProposalController')->except(['create', 'store', 'destroy', 'edit', 'update']);
    Route::post('proposal/{proposal}/approval', 'ProposalController@approval')->name('proposal.approval');
    Route::resource('sidang', 'SidangController')->only(['index', 'show']);
    Route::post('sidang/{sidang}/approval', 'SidangController@approval')->name('sidang.approval');
});
