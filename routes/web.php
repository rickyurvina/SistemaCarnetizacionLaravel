<?php
App::setlocale('es');
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

route::view('/','identification.layouts.app')->name('home');
//route::view('/register','identification.institutions.educational.register');

//identification-institutions-educational
route::get('institution','InstitutionsController@index')->name('institution.index');
route::get('institution/create','InstitutionsController@create')->name('institution.create');
route::post('institution','InstitutionsController@store')->name('institution.store');

//route::view('/institution','identification.institutions.educational.create');
//route::view('/ejemplo','identification.institutions.educational.ejemplo');
