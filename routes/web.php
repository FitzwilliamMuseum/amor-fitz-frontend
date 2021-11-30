<?php
use App\Http\Controllers;

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

Route::get('/', 'App\Http\Controllers\aboutController@home')->name('home');

Route::get('/correspondences', 'App\Http\Controllers\correspondencesController@index')->name('correspondences');
Route::get('/correspondences/letters', 'App\Http\Controllers\correspondencesController@letters')->name('letters');
Route::get('/correspondences/letters/{id}', 'App\Http\Controllers\correspondencesController@letter')->name('letter');
Route::get('/correspondences/letters/tags/', 'App\Http\Controllers\correspondencesController@tags')->name('tags');
Route::get('/correspondences/letters/tags/{id}', 'App\Http\Controllers\correspondencesController@tag')->name('tag');


Route::get('/entities', 'App\Http\Controllers\entitiesController@index')->name('entities');
Route::get('/entities/{slug}', 'App\Http\Controllers\entitiesController@entity')->name('entity');
Route::get('/entities/details/{slug}', 'App\Http\Controllers\entitiesController@details')->name('entity.detail');

Route::get('/about', 'App\Http\Controllers\aboutController@index')->name('about');
Route::get('/about/team', 'App\Http\Controllers\aboutController@team')->name('team');
Route::get('/acknowledgements', 'App\Http\Controllers\aboutController@acknowledgements')->name('acknowledgements');
