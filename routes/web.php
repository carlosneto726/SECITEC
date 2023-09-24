<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProgramacaoController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ValidarAdmController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ValidarUsuariosController;
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

Route::get('/admin', [ValidarAdmController::class, 'viewAdm']);
Route::post('/admin/entrar', [ValidarAdmController::class, 'entrar']);
Route::get('/admin/sair', [AdministradorController::class, 'sair']);
Route::get('/admin/eventos', [AdministradorController::class, 'viewEventos']);
Route::post('/admin/eventos/cadastrar', [AdministradorController::class, 'insertEvento']);
Route::post('/admin/eventos/alterar', [AdministradorController::class, 'updateEvento']);
Route::post('/admin/eventos/deletar', [AdministradorController::class, 'deleteEvento']);
Route::get('/admin/proponente', [AdministradorController::class, 'viewProponente']);
Route::post('/admin/proponente/cadastrar', [AdministradorController::class, 'insertProponente']);
Route::put('/admin/proponente/atualizar/{id_proponente}', [AdministradorController::class, 'updateProponente']);
Route::post('/admin/proponente/deletar', [AdministradorController::class, 'deleteProponente']);
Route::get('/admin/presenca/{id_evento}', [AdministradorController::class, 'viewPresenca']);
Route::post('/admin/presenca/checkin', [AdministradorController::class, 'checkin']);
Route::post('/admin/presenca/checkout', [AdministradorController::class, 'checkout']);

Route::post('/admin/teste', [AdministradorController::class, 'teste']);

Route::get('/teste', [AdministradorController::class, 'enviarEmail']);

Route::get('/loginUser', [Controller::class, 'viewLogin']);
Route::get('/cadastrarUser', [Controller::class, 'viewCadastrar']);
Route::get('/usuarios', [ValidarUsuariosController::class, 'viewUsuarios']);
Route::post('/usuarios/cadastarUser/view', [UsuariosController::class, 'cadastrarUser']);
Route::post('/usuarios/loginUser/view', [ValidarUsuariosController::class, 'loginUser']);

Route::post('/usuarios/cadastarEvento', [UsuariosController::class, 'cadastrarEvento']);
