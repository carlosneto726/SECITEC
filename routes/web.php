<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProgramacaoController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ValidarAdmController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ValidarUsuariosController;
use App\Http\Controllers\FpdfController;
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
Route::get('/login', [Controller::class, 'viewLogin']);
Route::get('/cadastrar', [Controller::class, 'viewCadastrar']);
Route::get('/termos', [Controller::class, 'viewTermos']);
Route::get('/proponente/{id}', [Controller::class, 'viewProponente']);
Route::get('/creditos', [Controller::class, 'viewCreditos']);

Route::get('/programacao', [ProgramacaoController::class, 'viewProgramacao']);

// Rotas do ValidarAdmController para validar o administrador
Route::get('/admin', [ValidarAdmController::class, 'viewAdm']);
Route::post('/admin/entrar', [ValidarAdmController::class, 'entrar']);
// Rotas do AdministradorController para funções do administrador
Route::get('/admin/sair', [AdministradorController::class, 'sair']);
Route::get('/admin/eventos', [AdministradorController::class, 'viewEventos']);
Route::post('/admin/eventos/cadastrar', [AdministradorController::class, 'insertEvento']);
Route::post('/admin/eventos/alterar', [AdministradorController::class, 'updateEvento']);
Route::post('/admin/eventos/deletar', [AdministradorController::class, 'deleteEvento']);
Route::get('/admin/proponente', [AdministradorController::class, 'viewProponente']);
Route::post('/admin/proponente/cadastrar', [AdministradorController::class, 'insertProponente']);
Route::put('/admin/proponente/atualizar/{id_proponente}', [AdministradorController::class, 'updateProponente']);
Route::post('/admin/proponente/deletar', [AdministradorController::class, 'deleteProponente']);
Route::get('/admin/logs', [AdministradorController::class, 'viewLogs']);

Route::post('/admin/presenca/checkin', [AdministradorController::class, 'checkin']);
Route::get('/admin/presenca/checkin/{id_evento}/{nome_evento}', [AdministradorController::class, 'viewCheckin']);
Route::post('/admin/presenca/checkout', [AdministradorController::class, 'checkout']);
Route::get('/admin/presenca/checkout/{id_evento}/{nome_evento}', [AdministradorController::class, 'viewCheckout']);
// Rotas do FpdfController para gerar os certificados
Route::get('/admin/usuario/certificados', [FpdfController::class, 'certificadoUsuario']);
// Rotas do ValidarUsuariosController para validar o usuário, criar conta, validar email
Route::post('/usuarios/cadastrar', [ValidarUsuariosController::class, 'addUsuario']);
Route::post('/usuarios/login', [ValidarUsuariosController::class, 'validarLogin']);
Route::get('/usuarios/sair', [ValidarUsuariosController::class, 'sair']);
Route::get('/validar/usuario/{token}', [ValidarUsuariosController::class, 'validarEmail']);

Route::post('/redefinir-senha/{token}', [ValidarUsuariosController::class, 'redefinirSenha']);
Route::get('/atualizar-senha/{token}', [ValidarUsuariosController::class, 'viewAtualizarSenha']);
Route::post('/redefinir-senha', [ValidarUsuariosController::class, 'redefinirSenhaEmail']);
// Rotas do UsuariosController para funções do usuário como visualizar, cadastrar eventos
Route::get('/eventos', [UsuariosController::class, 'viewEventos']);
Route::get('/meus-eventos', [UsuariosController::class, 'viewMeusEventos']);
Route::post('/usuarios/cadastarEvento', [UsuariosController::class, 'cadastrarEvento']);
Route::post('/usuarios/cadastarHackathon', [UsuariosController::class, 'cadastrarHackathon']);

// Rota Para Pesquisa
Route::get('/admin/logs/search', [AdministradorController::class, 'searchLogs'])->name('searchLogs');