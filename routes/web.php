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
    return view('welcome');
});

Route::get('import', 'import@get');
Route::post('import','import@post');
Route::post('philosopher','philosopher@post');
Route::get('philosopher', 'philosopher@get');
Route::get('philosopher/search', 'philosopher@search_ph');
Route::post('school','school@post');
Route::get('school', 'school@get');
Route::get('school/search', 'school@search_sch');
Route::get('definitions', 'definitions@get');
Route::post('definitions', 'definitions@post');
