<?php
use Illuminate\Support\Facades\Route;
//App::setlocale('es');
//Auth::routes();
route::view('/','home')->name('home');
/*
 * all rest routes for institutions-educational
 */
route::resource('/institution','InstitutionsController')->names('institution');
route::resource('/course','CoursesController')->names('course');
//
//route::get('/institution','InstitutionsController@index')->name('institution.index');
//route::get('/institution/create','InstitutionsController@create')->name('institution.create');
//route::post('/institution','InstitutionsController@store')->name('institution.store');
//route::get('/institution/{institution}','InstitutionsController@show')->name('institution.show');
//route::get('/institution/{institution}/edit','InstitutionsController@edit')->name('institution.edit');
//route::patch('/institution/{institution}/','InstitutionsController@update')->name('institution.update');
//route::delete('/institution/{institution}','InstitutionsController@destroy')->name('institution.destroy');

