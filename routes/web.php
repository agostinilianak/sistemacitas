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

    Route::resource('/usuarios', 'UsersController');
    Route::get('/pacientes', 'UsersController@pacientes');
    Route::get('/medicos', 'UsersController@medicos');
    Route::resource('/roles', 'RolesController');
    Route::resource('/permisos', 'PermissionsController');
    Route::resource('/citas', 'CitasController');
    Route::resource('/especialidades', 'EspecialidadesController');
    Route::resource('/medicinas', 'MedicinasController');
    Route::resource('/recipes', 'RecipesController');
    Route::get('/roles/{id}/permisos','RolesController@permisos');
    Route::put('/roles/{id}/asignarpermisos','RolesController@asignarPermisos');
    Route::get('/usuarios/{id}/permisos','UsersController@permisos');
    Route::put('/usuarios/{id}/asignarpermisos','UsersController@asignarPermisos');
    Route::get('/citas/{id}/solicitarcita','UsersController@solicitarcita');
    Route::get('/medicos/vermiscitas', 'HistoriasMedicasController@vermiscitasmedico');
    Route::get('/historiasmedicas/create/{id?}', 'HistoriasMedicasController@create');
    Route::resource('/historiasmedicas', 'HistoriasMedicasController');
    Route::get('/citas/{id}/cambiarstatuscita', 'CitasController@cambiarstatuscita');



    //Route::put('/roles/{id}/asignarpermisos','RolesController@asignarPermisos');
    //Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    //Route::get('/miscursos', 'HomeController@miscursos');
    //Route::get('/cursos/{id}/postular', 'CursosController@postular');
    //PARA RECIPES Route::post('/miscursos', 'HomeController@miscursos');
});

Route::group(['middleware' => ['role:Secretaria']], function () {

});

Route::group(['middleware' => ['role:Farmaceuta']], function () {

});

Route::group(['middleware' => ['role:Medico']], function () {
    Route::get('/medicos/vermiscitas', 'CitasController@vermiscitasmedico');
    Route::get('/historiasmedicas/create/{id?}', 'HistoriasMedicasController@create');
    Route::resource('/historiasmedicas', 'HistoriasMedicasController');
    Route::get('/citas/{id}/cambiarstatuscita', 'CitasController@cambiarstatuscita');


});

Route::group(['middleware' => ['role:Paciente']], function () {
    Route::get('/vermiscitas', 'CitasController@vermiscitas');

});

