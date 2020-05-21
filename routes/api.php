<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

route::get('/institution/{id}/courses','CoursesController@byInstitution')->name('institution.courses');
