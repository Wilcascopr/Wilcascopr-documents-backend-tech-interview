<?php

use App\Http\Controllers\TipTipoDocController;
use App\Http\Controllers\ProProcesosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DocDocumentoController;
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

Route::controller(UsersController::class)->group(function () {
    Route::post('/users/login', 'logIn');
    Route::post('/users/logout', 'logOut');
});

Route::controller(DocDocumentoController::class)->group(function () {
    Route::get('/doc-documentos', 'index');
    Route::get('/doc-documentos/{id}', 'show');
    Route::post('/doc-documentos', 'store');
    Route::put('/doc-documentos/{id}', 'update');
});

Route::get('/tip-tipo-docs', [TipTipoDocController::class, 'index']);
Route::get('/pro-procesos', [ProProcesosController::class, 'index']);