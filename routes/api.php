<?php

use App\Http\Controllers\StudentController;
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

Route::post('/createStudent', [StudentController::class, 'createStudent']);

Route::post('/studentDetails/{id}', [StudentController::class, 'studentDetails']);

Route::post('/updateStudent/{id}', [StudentController::class, 'updateStudent']);

Route::post('/deleteStudent/{id}', [StudentController::class, 'deleteStudent']);

