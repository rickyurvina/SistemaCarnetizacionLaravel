<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

App::setlocale('es');
Auth::routes();
route::get('/', 'HomeController@index')->name('home');
/*
 * all rest routes for
 */
route::resource('/institution', 'InstitutionsController')->names('institution');
route::resource('/course', 'CoursesController')->names('course');
route::resource('/person', 'PersonController')->names('person');
route::resource('/area', 'AreaController')->names('area');
route::resource('/student', 'StudentController')->names('student');
route::resource('/photo', 'PhotoController')->names('photo');
route::resource('/picture', 'PictureController')->names('picture');
route::resource('/background', 'BackgroundController')->names('background');
route::resource('/logo', 'LogoController')->names('logo');
route::resource('/user', 'UserController')->names('user');
route::resource('/roles', 'RoleController')->names('role');
route::resource('/solicitadas', 'SolicitadasController')->names('solicitadas');
route::resource('/aprobadas', 'AprobadasController')->names('aprobadas');
/*Rutas Auxiliares*/
route::get('/pr', 'ServicesController@solicitadas')->name('soli');
route::get('/profile', 'ServicesController@profile')->name('profile');
route::get('/solicitud', 'ServicesController@solicitudImpresion')->name('solicitud');
route::get('/mail', 'ServicesController@mail')->name('mail');
route::get('/print/{student}','StudentController@carnet')->name('print');
route::get('/print_person/{person}','PersonController@carnet')->name('print_person');

//Route::get('/print', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {
//
//    $fpdf->AddPage();
//    $fpdf->SetFont('Courier', 'B', 18);
//    $fpdf->Cell(50, 25, 'Hello World!');
//    $fpdf->Output();
//
//});
