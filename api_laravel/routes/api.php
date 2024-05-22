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
Route::get('student', 'App\Http\Controllers\studentscontroller@getStudent');

Route::get('student/id={id}','App\Http\Controllers\studentscontroller@getStudentxid');

Route::post('addStudent','App\Http\Controllers\studentscontroller@insertStudent');

Route::put('updateStudent/id={id}','App\Http\Controllers\studentscontroller@updateStudent');

// Eliminar persona (estudiante o profesor)
Route::delete('deletePerson/id={id}','App\Http\Controllers\studentscontroller@deletePerson');

// Metodos de profesor
Route::get('staff', 'App\Http\Controllers\staffcontroller@getStaff');

Route::get('student/id={id}','App\Http\Controllers\staffcontroller@getStaffxid');

Route::post('addStudent','App\Http\Controllers\staffcontroller@insertStaff');

Route::put('updateStudent/id={id}','App\Http\Controllers\staffcontroller@updateStaff');

// Metodos de casa
Route::get('houses', 'App\Http\Controllers\housecontroller@getHouse');

Route::get('house/id={id}','App\Http\Controllers\housecontroller@getHousexid');

Route::post('addHouse','App\Http\Controllers\housecontroller@insertHouse');

Route::put('updateHouse/id={id}','App\Http\Controllers\housecontroller@updateHouse');

Route::delete('deleteHouse/id={id}','App\Http\Controllers\housecontroller@deletehouse');

// Eliminar persona (estudiante o profesor)
Route::delete('deletePerson/id={id}','App\Http\Controllers\studentscontroller@deletePerson');

// Metodos para portar los datos de profesores y estudiantes
Route::post('portStudent','App\Http\Controllers\studentscontroller@portStudent');

Route::post('portStaff','App\Http\Controllers\staffcontroller@portStaff');

Route::post('portHouse','App\Http\Controllers\housecontroller@portHouse');