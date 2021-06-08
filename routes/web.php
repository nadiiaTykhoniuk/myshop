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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/customized', 'CustomizedController@index')->name('customized');

Route::group(['middleware' => ['web']], function () {
    Route::redirect('/', '/' . App::getLocale());
    Route::get('/{locale}', '\Aimeos\Shop\Controller\CatalogController@homeAction')->name('aimeos_home');
});

Route::get('{path?}', '\Aimeos\Shop\Controller\PageController@indexAction')
    ->name('aimeos_page')->where( 'path', '.*' );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
