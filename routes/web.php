<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProgramacaoController;
use App\Http\Controllers\AdministradorController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'viewHome']);
Route::get('/sobre', [Controller::class, 'viewSobre']);
Route::get('/local', [Controller::class, 'viewLocal']);
Route::get('/programacao', [ProgramacaoController::class, 'viewProgramacao']);

Route::get('/admin', [AdministradorController::class, 'viewAdm']);
Route::post('/admin/entrar', [AdministradorController::class, 'entrar']);
Route::get('/admin/sair', [AdministradorController::class, 'sair']);
