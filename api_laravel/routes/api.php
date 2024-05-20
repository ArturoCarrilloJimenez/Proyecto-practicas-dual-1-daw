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

Route::get('student', 'App\Http\Controllers\studentscontroller@getStudent');

Route::get('student/id={id}','App\Http\Controllers\studentscontroller@getStudentxid');

Route::post('addStudent','App\Http\Controllers\studentscontroller@insertStudent');

Route::put('updateStudent/id={id}','App\Http\Controllers\studentscontroller@updateStudent');

Route::delete('deleteStudent/id={id}','App\Http\Controllers\studentscontroller@deleteStudent');