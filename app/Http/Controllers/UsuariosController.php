<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class UsuariosController extends Controller
{
    public $nome_usuario; 
    public $senha_usuario;
    public function __construct() {
        $this->nome_usuario = $_COOKIE['nome_usuario'];
        $this->senha_usuario = $_COOKIE['senha_usuario'];

        if(!isset($this->nome_usuario) && !isset($this->senha_usuario)){
            redirect("/usuarios");
        }
    }

    public function cadastrarUser()
    {
        $nome = request("txtNome");
        $matricula = request("txtMatricula");
        $cpf = request("txtCPF");
        $email = request("txtEmail");
        $senha = request("txtSenha");

        DB::insert("INSERT INTO 
        tb_aluno(nome,matricula,cpf,email,senha) 
        VALUES(?,?,?,?,?);", 
        [$nome,$matricula,$cpf,$email,$senha]);

        return redirect("/loginUser");
        
    }
}
