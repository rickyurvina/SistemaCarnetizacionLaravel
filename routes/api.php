<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

route::get('/institution/{id}/courses','CoursesController@byInstitution')->name('institution.courses');
route::get('/institution/{id}/students','StudentController@byInstitution')->name('institution.students');
route::get('/institution/{id}/student','StudentController@byStudent')->name('institution.student');

route::get('/institution/{id}/persons','PersonController@byInstitution')->name('institution.persons');
route::get('/institution/{id}/person','PersonController@byPerson')->name('institution.person');
