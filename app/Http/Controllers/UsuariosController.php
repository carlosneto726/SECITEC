<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    public $nome_usuario; 
    public $senha_usuario;
    public function __construct() {
        $this->nome_usuario = $_COOKIE['nome_user'];
        $this->senha_usuario = $_COOKIE['senha_user'];

        if(!isset($this->nome_usuario) && !isset($this->senha_usuario)){
            redirect("/usuarios");
        }
    }


    // VALIDAR CPF, LOGIN E EMAIL
    public function cadastrarUser()
    {
        $nome = request("txtNome");
        $matricula = request("txtMatricula");
        $cpf = request("txtCPF");
        $email = request("txtEmail");
        $senha = request("txtSenha");

        DB::insert("INSERT INTO 
        tb_usuario(nome,matricula,cpf,email,senha) 
        VALUES(?,?,?,?,?);", 
        [$nome,$matricula,$cpf,$email,$senha]);

        return redirect("/loginUser");
    }

    // verificar se ja foi cadastro, e cadastrar ou descadastrar
    public function cadastrarEvento(Request $request)
    {
        $usuarioId = $request->input('usuarioId');
        $eventoID = $request->input('eventoId');

        if($request->input('cadastrado')) {
            // descadastra
        } else {
            try {
                DB::insert("INSERT INTO 
                tb_evento_usuario(id_evento, id_usuario, status) 
                VALUES(?,?,?);", 
                [$eventoID,$usuarioId, 0]);
            } catch (\Throwable $th) {
                return response()->json(['mensagem' => $th]);
            }
        }

        return response()->json(['mensagem' => $request->input('cadastrado')]);
    }
}
