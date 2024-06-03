<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Metodos de estudiante
Route::get('student', 'App\Http\Controllers\studentscontroller@getStudent'); // Optengo los estudiantes de froma paginada

Route::get('student/{id}','App\Http\Controllers\studentscontroller@getStudentxid'); // Optengo el estudiante con un id

Route::post('addStudent','App\Http\Controllers\studentscontroller@insertStudent'); // Añado un estudiante

Route::put('updateStudent/{id}','App\Http\Controllers\studentscontroller@updateStudent'); // Actualizo el estudiante con el id

// Eliminar persona (estudiante o profesor)
Route::delete('deletePerson/{id}','App\Http\Controllers\studentscontroller@deletePerson');

// Busca una persona por nombre
Route::get('person/{name}','App\Http\Controllers\studentscontroller@getPersonxName');

// Metodos de profesor
Route::get('staff', 'App\Http\Controllers\staffcontroller@getStaff'); // Optengo los profesore de froma paginada

Route::get('staff/{id}','App\Http\Controllers\staffcontroller@getStaffxid'); // Optengo el profesor con un id

Route::post('addStaff','App\Http\Controllers\staffcontroller@insertStaff'); // Añado un profesor

Route::put('updateStaff/{id}','App\Http\Controllers\staffcontroller@updateStaff'); // Actualizo el profesor con el id

// Metodos de casa
Route::get('houses', 'App\Http\Controllers\housecontroller@getHouse'); // Optengo las casas de froma paginada

Route::get('allHouses', 'App\Http\Controllers\housecontroller@getAllHouse'); // Optengo todas las casas

Route::get('house/{id}','App\Http\Controllers\housecontroller@getHousexid'); // Optengo la casa con un id

Route::get('houseName/{name}','App\Http\Controllers\housecontroller@getHousexName'); // Optengo la casa por el nombre

Route::post('addHouse','App\Http\Controllers\housecontroller@insertHouse'); // Inserto una casa

Route::put('updateHouse/{id}','App\Http\Controllers\housecontroller@updateHouse'); // Actualizo una casa

Route::delete('deleteHouse/{id}','App\Http\Controllers\housecontroller@deletehouse'); // Elimino una casa

// Metodos para portar los datos de profesores, estudiantes y casas (Solo se usa en caso de querer añadir de forma masiva datos)
Route::post('portStudent','App\Http\Controllers\studentscontroller@portStudent');

Route::post('portStaff','App\Http\Controllers\staffcontroller@portStaff');

Route::post('portHouse','App\Http\Controllers\housecontroller@portHouse');