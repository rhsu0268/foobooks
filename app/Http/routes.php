<?php

// indicate thaty you want to use the package
//use Rych\Random\Random;

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


# Show login form
Route::get('/login', 'Auth\AuthController@getLogin');

# Process login form
Route::post('/login', 'Auth\AuthController@postLogin');

# Process logout
Route::get('/logout', 'Auth\AuthController@getLogout');

# Show registration form
Route::get('/register', 'Auth\AuthController@getRegister');

# Process registration form
Route::post('/register', 'Auth\AuthController@postRegister');

Route::get('/confirm-login-worked', function() {

    # You may access the authenticated user via the Auth facade
    $user = Auth::user();

    if($user) {
        echo 'You are logged in.';
        dump($user->toArray());
    } else {
        echo 'You are not logged in.';
    }

    return;

});

Route::get('/', 'WelcomeController@getIndex');



// @ is what method


//Route::get('/books/create', 'BookController@getCreate');
//Route::post('/books/create', 'BookController@postCreate');

/*
Route::get('/books/create', [
    'middleware' => 'auth',
    'uses' => 'BookController@getCreate'
]);
*/
Route::group(['middleware' => 'auth'], function() {

    Route::get('/books', 'BookController@getIndex');
    Route::get('/books/show/{title?}', 'BookController@getShow');

    Route::get('/books/create', 'BookController@getCreate');
    Route::post('/books/create', 'BookController@postCreate');

    Route::get('/books/edit/{id?}', 'BookController@getEdit');
    Route::post('/books/edit', 'BookController@postEdit');

});


//Route::get('/books/edit/{id?}', 'BookController@getEdit');
//Route::post('/books/edit', 'BookController@postEdit');

//Route::controller('/books', 'BookController');
/*
Route::get('/practice', function() {

	echo 'Hello World!';
	echo App::environment();
});
*/
/*
Route::get('/practice', function() {

	// full namespace
	$random = new Random();

	// Generate a 16-byte string of random raw data
	return $random->getRandomString(16);


*/
Route::controller('/practice', 'PracticeController');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

/*----------------------------------------------------
Debugging/Local/Misc
-----------------------------------------------------*/
if(App::environment('local')) {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/drop', function() {
        DB::statement('DROP database foobooks');
        DB::statement('CREATE database foobooks');
        return 'Dropped foobooks; created foobooks.';
    });
};

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
