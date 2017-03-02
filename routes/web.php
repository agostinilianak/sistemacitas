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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['role:Administrador']], function () {

    Route::resource('/citas', 'CitasController');
    Route::resource('/usuarios', 'UsersController');
    //Route::resource();
    Route::get('/pacientes', 'UsersController@pacientes');
    Route::get('/medicos', 'UsersController@medicos');
    //Route::resource('/roles', 'RolesController');
    //Route::resource('/permisos', 'PermissionsController');
    //Route::resource('/cursos', 'CursosController');
    //Route::get('/roles/{id}/permisos','RolesController@permisos');
    //Route::put('/roles/{id}/asignarpermisos','RolesController@asignarPermisos');
    //Route::get('/usuarios/{id}/permisos','UsersController@permisos');
    //Route::put('/usuarios/{id}/asignarpermisos','UsersController@asignarPermisos');
    //Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    //Route::get('/miscursos', 'HomeController@miscursos');
    //Route::get('/cursos/{id}/postular', 'CursosController@postular');
});

Route::group(['middleware' => ['role:Profesor']], function () {
    //
});

Route::group(['middleware' => ['role:Alumno']], function () {
    //Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    //Route::get('/miscursos', 'HomeController@miscursos');
    //Route::get('/cursos/{id}/postular', 'CursosController@postular');
});
