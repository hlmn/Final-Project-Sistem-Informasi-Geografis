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

Route::get('/', function () {
    return view('luas');
});

Route::group(['prefix' => 'polygon'], function(){
	Route::get('/', 'PolygonController@index')->name('index.polygon');
	Route::post('/submit', 'PolygonController@submit')->name('submit.polygon');
	Route::post('/update/{shape}', 'PolygonController@update')->name('update.polygon');
	Route::get('/view/{shape}', 'PolygonController@view')->name('view.polygon');
});

Route::group(['prefix' => 'polyline'], function(){
	Route::get('/', 'PolylineController@index')->name('index.polyline');
	Route::post('/submit', 'PolylineController@submit')->name('submit.polyline');
	Route::post('/update/{shape}', 'PolylineController@update')->name('update.polyline');
	Route::get('/view/{shape}', 'PolylineController@view')->name('view.polyline');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
