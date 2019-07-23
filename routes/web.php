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
    return view('welcome'); //обращение к блейду, который находится в корне папки views
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
    return view('main.alarm'); // обращение сначала в папку с вью, затем к блейду (после точки)
}]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); // обращение к контроллеру HomeController и его методу index, зачем нужно передавать name пока не понял
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
