<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
 
Route::group(['middleware' => ['auth','checkRole:admin']], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']); 
	// Page Bencana
	Route::get('/bencana','BencanaController@index')->name('bencana.index'); 
	Route::post('/bencana/create','BencanaController@create');
	Route::get('/bencana/{bencana}/edit','BencanaController@edit')->name('bencana.edit');
	Route::post('/bencana/{bencana}/update','BencanaController@update'); 
	Route::get('/bencana/{bencana}/delete','BencanaController@delete');
	Route::get('/bencana/laporan','BencanaController@laporan')->name('bencana.laporan');
	Route::get('/bencana/exportpdf','BencanaController@exportPdf');
		Route::get('/bencana/{id}/profile','BencanaController@profile')->name('bencana.profile');;
	// Page Barang
	Route::get('/barang','BarangController@index')->name('barang.index'); 
	Route::post('/barang/create','BarangController@create');
	Route::get('/barang/{barang}/edit','BarangController@edit')->name('barang.edit');
	Route::post('/barang/{barang}/update','BarangController@update'); 
	Route::get('/barang/{barang}/delete','BarangController@delete');
	Route::get('/barang/laporan','BarangController@laporan')->name('barang.laporan');
	Route::get('/barang/exportpdf','BarangController@exportPdf');
	// Page Posko
	Route::get('/posko','PoskoController@index')->name('posko.index'); 
	Route::post('/posko/create','PoskoController@create');
	Route::get('/posko/{posko}/edit','PoskoController@edit')->name('posko.edit');
	Route::post('/posko/{posko}/update','PoskoController@update'); 
	Route::get('/posko/{posko}/delete','PoskoController@delete');
	Route::get('/posko/laporan','PoskoController@laporan')->name('posko.laporan');
	Route::get('/posko/exportpdf','PoskoController@exportPdf');
		Route::get('/posko/{id}/profile','PoskoController@profile')->name('posko.profile');
	// Page Transaksi Penerimaan
	Route::get('/penerimaan','PenerimaanController@index')->name('penerimaan.index'); 
	Route::post('/penerimaan','PenerimaanController@store')->name('penerimaan.store');
	Route::get('/penerimaan/{penerimaan}/edit','PenerimaanController@edit')->name('penerimaan.edit');
	Route::get('/penerimaan/update','PenerimaanController@update')->name('penerimaan.update'); 
	Route::delete('/penerimaan/{id}','PenerimaanController@destroy')->name('penerimaan.destroy');
		Route::get('/penerimaan/{id}/profile','PenerimaanController@profile')->name('penerimaan.profile');
	// Page Transaksi Penerimaan
	Route::get('/pengiriman','PengirimanController@index')->name('pengiriman.index'); 
	Route::post('/pengiriman','PengirimanController@store')->name('pengiriman.store');
	Route::get('/pengiriman/{pengiriman}/edit','PengirimanController@edit')->name('pengiriman.edit');
	Route::get('/pengiriman/update','PengirimanController@update')->name('pengiriman.update'); 
	Route::delete('/pengiriman/{id}','PengirimanController@destroy')->name('pengiriman.destroy');
		Route::get('/pengiriman/{id}/profile','PengirimanController@profile')->name('pengiriman.profile');			
});

