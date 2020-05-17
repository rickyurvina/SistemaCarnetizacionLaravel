<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

App::setlocale('es');
Auth::routes();
route::get('/','HomeController@index')->name('home');
/*
 * all rest routes for
 */
route::resource('/institution','InstitutionsController')->names('institution');
route::resource('/course','CoursesController')->names('course');
route::resource('/person','PersonController')->names('person');
route::resource('/area','AreaController')->names('area');
route::resource('/student','StudentController')->names('student');
route::resource('/photo','PhotoController')->names('photo');
route::resource('/picture','PictureController')->names('picture');
route::resource('/background','BackgroundController')->names('background');
route::resource('/logo','LogoController')->names('logo');
route::resource('/user','UserController')->names('user');






