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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('professores', 'Professor\\ProfessoresController');
Route::get('professores/periodos/{id}', 'Professor\\ProfessoresController@exibindo_periodos')->name('exibir_periodos');
Route::post('professores/periodos', 'Professor\\ProfessoresController@cadastrar_periodos');

Route::resource('grades', 'Grade\\GradesController');
Route::resource('materias', 'Materia\\MateriasController');
Route::resource('periodos', 'Periodo\\PeriodosController');
Route::resource('periodos', 'Periodo\\PeriodosController');
Route::resource('turmas', 'Turmas\\TurmasController');
Route::resource('quadro-horarios', 'QuadroHorarios\\QuadroHorariosController');