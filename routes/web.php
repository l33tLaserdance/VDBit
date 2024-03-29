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

Route::group(['middleware' => ['web']], function () {
Route::get('/', function () {
    return view('auth.login'); //обращение к блейду, который находится в корне папки views
});

Route::get('/main', ['middleware' => 'auth', function () {
    return view('main.main'); // обращение сначала в папку с вью, затем к блейду (после точки)
}]) -> name('main');

/*Route::post('/login', [
	'uses' => 'MainController@postLogin',
	'as' => 'main'
]);*/

Route::get('/main/it', ['middleware' => 'auth', function () {
    return view('main.it'); // обращение сначала в папку с вью, затем к блейду (после точки)
}]);

Route::get('/main/scud', ['middleware' => 'auth', function () {
    return view('main.scud'); // обращение сначала в папку с вью, затем к блейду (после точки)
}]);

Route::get('/main/svn', ['middleware' => 'auth', function () {
    return view('main.svn'); // обращение сначала в папку с вью, затем к блейду (после точки)
}]);

Route::get('/main/alarm', ['middleware' => 'auth', function () {
    return view('main.alarm'); 
}]);

Route::post('/main/sendscud', 'MainController@postValidateSCUD')->name('SCUD');

Route::post('/main/sendsvn', 'MainController@postValidateSVN')->name('SVN');

Route::post('/main/sendalarm', 'MainController@postValidateAlarm')->name('alarm');

Route::post('/main/sendit', 'MainController@postValidateIT')->name('IT');

Route::get('/main/deletescud', 'MainController@deleteSCUD')->name('delSCUD');

Route::get('/main/deletealarm', 'MainController@deleteAlarm')->name('delAlarm');

Route::get('/main/deletesvn', 'MainController@deleteSVN')->name('delSVN');

Route::get('/main/deleteit', 'MainController@deleteIT')->name('delIT');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); // обращение к контроллеру HomeController и его методу index, зачем нужно передавать name пока не понял

Route::get('/applist', 'HomeController@showAppList')->name('showapplist');

Route::get('/appscud', 'HomeController@showAppSCUD')->name('appscud');

Route::get('/appit', 'HomeController@showAppIT')->name('appit');

Route::get('/appsvn', 'HomeController@showAppSVN')->name('appsvn');

Route::get('/appalarm', 'HomeController@showAppAlarm')->name('appalarm');
});

Route::group(['middleware' => ['auth']], function () {
	
	Route::get('/admin', ['middleware' => 'auth', function () {
		if (Gate::allows('view-admin', Auth::user())) {
			return view('admin.main');
		} else {
			abort(404);
		}
	}]) -> name('admin');

	Route::get('/admin/users', 'AdminController@showUsers') -> name('users');

	Route::get('/admin/users/create', 'AdminController@createUser') -> name('createuser');

	Route::get('/admin/updateuser', 'AdminController@updateUser')->name('updateuser');

	Route::get('/admin/deleteuser', 'AdminController@deleteUser')->name('deleteuser');

	Route::post('/admin/senduser', 'AdminController@postValidateUser')->name('USR');

	Route::post('/admin/upduser', 'AdminController@postUpdateUser')->name('UPDUSR');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
