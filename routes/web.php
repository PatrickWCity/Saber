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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'WelcomeController@index');

Route::get('/quienessomos', 'WelcomeController@quienessomos');

Route::get('/contactanos', 'WelcomeController@contactanos');

Route::resource('eventos','EventoController');

Route::resource('tipoeventos','TipoEventoController');

Route::resource('noticias','NoticiaController');

Route::resource('tiponoticias','TipoNoticiaController');

Route::resource('documentos','DocumentoController');

Route::resource('tipodocumentos','TipoDocumentoController');

Route::resource('voluntarios','VoluntarioController');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );

//Route::get('/{vue_capture?}', function () { return view('layouts.master'); })->where('vue_capture', '[\/\w\.-]*');

//Route::get('/{vue_capture?}', function () { return view('home'); })->where('vue_capture', '[\/\w\.-]*');