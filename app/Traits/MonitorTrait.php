<?php

namespace App\Traits;

use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\ValidarUsuariosController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait MonitorTrait {
    public function viewAdicionarUsuario(){
        $usuarios = DB::select("SELECT * FROM tb_usuario ORDER BY id DESC;");
        foreach ($usuarios as $usuario) {
            $usuario_eventos = DB::select(" SELECT tb_evento.titulo
                                            FROM tb_evento
                                            INNER JOIN tb_evento_usuario ON tb_evento_usuario.id_evento = tb_evento.id
                                            WHERE tb_evento_usuario.id_usuario = ?;", [$usuario->id]);
            $usuario->eventos = $usuario_eventos;
        }

        return view("admin.usuario.view", compact("usuarios"));
    }
    public function addUsuario(Request $request){
        $email = request("email");
        $cpf = request("cpf");
        $nome = request("nome");
        $senha = Hash::make("secitec2023"); // Senha criptografada
        $eventosSelecionados = request("eventosSelecionados");
        $token = Str::random(60);

        $validarCPF = new ValidarUsuariosController;
        if(!$validarCPF->validaCPF($cpf)){
            return response()->json(['error' => 'CPF ou email já cadastrado']);
        }

        $usuarios = DB::select("SELECT email, cpf FROM tb_usuario WHERE email = ? OR cpf = ?;", [$email, $cpf]);
        if(count($usuarios) > 0){
            return response()->json(['error' => 'CPF ou EMAIL já cadastrado']);
        }

        try {
            DB::insert("INSERT INTO tb_usuario(nome, senha, cpf, email, token, status) VALUES(?,?,?,?,?,?);", [$nome, $senha, $cpf, $email, $token, "1"]);
            $id_usuario = DB::getPdo()->lastInsertId();
            if (!empty($eventosSelecionados)) {
                foreach ($eventosSelecionados as $eventoId) {
                    $usuarioCadastradoEvento = count(DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?;", [$eventoId, $id_usuario])) > 0;
                    if($usuarioCadastradoEvento) {
                        break;
                    }
                    $usuariosController = new UsuariosController();
                    $vagasTotais = DB::select("SELECT * FROM tb_evento WHERE id = ?", [$eventoId])[0]->vagas;
                    $vagasRestantes = $usuariosController->calcularVagasRestantes($eventoId, $vagasTotais);
                    $status = $vagasRestantes > 0 ? 0 : 1;
                    DB::insert("INSERT INTO tb_evento_usuario(id_evento, id_usuario, status, data_insercao) VALUES(?,?,?,?);", [$eventoId, $id_usuario, $status, date('Y-m-d H:i:s')]);
                }
            }
            return response()->json(['mensagem' => 'Cadastrado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function AddUsuariosEventos(Request $request){
        $userId = request("userId");
        $eventosSelecionados = request("eventosSelecionados");
        try {
            if (!empty($eventosSelecionados)) {
                foreach ($eventosSelecionados as $eventoId) {
                    $usuarioCadastradoEvento = count(DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?;", [$eventoId, $userId])) > 0;
                    if($usuarioCadastradoEvento) {
                        break;
                    }
                    $usuariosController = new UsuariosController();
                    $vagasTotais = DB::select("SELECT * FROM tb_evento WHERE id = ?", [$eventoId])[0]->vagas;
                    $vagasRestantes = $usuariosController->calcularVagasRestantes($eventoId, $vagasTotais);
                    $status = $vagasRestantes > 0 ? 0 : 1;
                    DB::insert("INSERT INTO tb_evento_usuario(id_evento, id_usuario, status, data_insercao) VALUES(?,?,?,?);", [$eventoId, $userId, $status, date('Y-m-d H:i:s')]);
                }
            }
            return response()->json(['mensagem' => 'Eventos cadastrados com sucesso!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function getEventos(){
        $eventos = DB::select("SELECT * FROM tb_evento;");
        foreach ($eventos as $evento) {
            $usuariosController = new UsuariosController();
            $vagasRestantes = $usuariosController->calcularVagasRestantes($evento->id, $evento->vagas);
            $evento->vagasEsgotadas = !$vagasRestantes > 0;
        }
        return response()->json($eventos);
    }


    // Eventos que o usuario não esta cadastrado ainda
    public function getEventosByUserId(Request $request){
        $userId = request("id");
        try {
            $eventos = DB::select("SELECT *
            FROM tb_evento
            WHERE tb_evento.id NOT IN (
                SELECT id_evento
                FROM tb_evento_usuario
                WHERE id_usuario = ?);", [$userId]);

            foreach ($eventos as $evento) {
                $usuariosController = new UsuariosController();
                $vagasRestantes = $usuariosController->calcularVagasRestantes($evento->id, $evento->vagas);
                $evento->vagasEsgotadas = !$vagasRestantes > 0;
            }
            
            return response()->json($eventos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

}