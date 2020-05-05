<?php
use Illuminate\Support\Facades\Route;

App::setlocale('es');
//Auth::routes();
route::view('/','home')->name('home');
/*
 * all rest routes for institutions-institutions
 */
route::resource('/institution','InstitutionsController')->names('institution');
route::resource('/course','CoursesController')->names('course');
route::resource('/person','PersonController')->names('person');
route::resource('/area','AreaController')->names('area');
route::resource('/student','StudentController')->names('student');
/**/

route::resource('/background','BackgroundController')->names('background');
route::resource('/logo','LogoController')->names('logo');


route::get('/institutionEducative','InstitutionsController@showIE')->name('institutionsE');
route::get('/organisation','InstitutionsController@showO')->name('institutionsO');




