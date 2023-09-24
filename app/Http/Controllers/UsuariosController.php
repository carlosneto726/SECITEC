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

    public function cadastrarEvento(Request $request)
    {
        $usuarioId = $request->input('usuarioId');
        $eventoID = $request->input('eventoId');

        if($this->verificaCadastro( $request->input('usuarioId'),$request->input('eventoId'))) {
            try {
                DB::delete("DELETE FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?", [$eventoID, $usuarioId]);
                return response()->json(['mensagem' => 'Descadastrado com sucesso!', 'evento' => $eventoID]);
            } catch (\Throwable $th) {
                return response()->json(['mensagem' => $th]);
            }
        } else {
            try {
                DB::insert("INSERT INTO 
                tb_evento_usuario(id_evento, id_usuario, status) 
                VALUES(?,?,?);", 
                [$eventoID,$usuarioId, 0]);
                return response()->json(['mensagem' => 'Cadastrado com sucesso!', 'evento' => $eventoID]);
            } catch (\Throwable $th) {
                return response()->json(['mensagem' => $th]);
            }
        }
    }

    public function verificaCadastro($usuarioId,  $eventoID) {
        $resultados = DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?", [$eventoID, $usuarioId]);

        if (count($resultados) > 0) {
            return true; 
        } else {
            return false;
        }
    }
}
