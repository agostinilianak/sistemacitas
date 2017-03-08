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
Route::get('/calendario', function () {
    return view('calendar');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['role:Administrador']], function () {

    Route::resource('/citas', 'CitasController');
    Route::resource('/usuarios', 'UsersController');
    Route::get('/pacientes', 'UsersController@pacientes');
    Route::get('/medicos', 'UsersController@medicos');
    Route::resource('/roles', 'RolesController');
    Route::resource('/permisos', 'PermissionsController');
    Route::get('/roles/{id}/permisos','RolesController@permisos');
    Route::get('/citas/{id}/solicitarcita','CitasController');
    //Route::resource('/cursos', 'CursosController');
    //Route::put('/roles/{id}/asignarpermisos','RolesController@asignarPermisos');
    //Route::put('/usuarios/{id}/asignarpermisos','UsersController@asignarPermisos');
    //Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    //Route::get('/miscursos', 'HomeController@miscursos');
    //Route::get('/cursos/{id}/postular', 'CursosController@postular');
});

Route::group(['middleware' => ['role:Secretaria']], function () {
    //
});

Route::group(['middleware' => ['role:Farmaceuta']], function () {
    //Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    //Route::get('/miscursos', 'HomeController@miscursos');
    //Route::get('/cursos/{id}/postular', 'CursosController@postular');
});

Route::group(['middleware' => ['role:Medico']], function () {
    //Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    //Route::get('/miscursos', 'HomeController@miscursos');
    //Route::get('/cursos/{id}/postular', 'CursosController@postular');
});

Route::group(['middleware' => ['role:Paciente']], function () {
    //Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    //Route::get('/miscursos', 'HomeController@miscursos');
    //Route::get('/cursos/{id}/postular', 'CursosController@postular');
});

