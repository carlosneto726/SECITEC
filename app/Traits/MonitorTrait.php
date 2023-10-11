<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\ValidarUsuariosController;
use Illuminate\Support\Facades\Hash;

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

        $validarCPF = new ValidarUsuariosController;
        if(!$validarCPF->validaCPF($cpf)){
            return "cpf inválido";
        }

        $usuarios = DB::select("SELECT email, cpf FROM tb_usuario WHERE email = ? OR cpf = ?;", [$email, $cpf]);
        if(count($usuarios) > 0){
            return "cpf ou email já cadastrado";
        }
        DB::insert("INSERT INTO tb_usuario(nome, senha, cpf, email, status) 
                    VALUES(?,?,?,?,?);", [$nome, $senha, $cpf, $email, "1"]);
    }
}