<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// @ is what method

Route::get('/books', 'BookController@getIndex');
Route::get('/books/show/{title}', 'BookController@getShow');
Route::get('/books/create', 'BookController@getCreate');
Route::post('/books/create', 'BookController@postCreate');


//Route::controller('/books', 'BookController');
/*
Route::get('/practice', function() {

	echo 'Hello World!';
	echo App::environment();
});
*/

Route::get('/practice', function() {

	echo config('app.url');
});
