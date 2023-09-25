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


    // status da tabela tb_evento_usuario: 0 = Cadastrado e 1 = Cadastro reserva
    public function cadastrarEvento(Request $request)
    {
        $usuarioId = $request->input('usuarioId');
        $eventoID = $request->input('eventoId');
        $vagasTotais = DB::select("SELECT * FROM tb_evento WHERE id = ?", [$eventoID])[0]->vagas;
        $vagasOcupadas = count(DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ? AND status = 0", [$eventoID]));    

        if($this->verificaCadastro( $request->input('usuarioId'),$request->input('eventoId'))) {
            // Descadastrar o usuario no evento
            // Ao descadastrar verificar a fila e adicionar o proximo da reserva a lista de cadastrados.
            try {
                DB::delete("DELETE FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?", [$eventoID, $usuarioId]);
                return response()->json(['mensagem' => 'Descadastrado com sucesso!', 'evento' => $eventoID]);
            } catch (\Throwable $th) {
                return response()->json(['mensagem' => $th]);
            }
        } else {
            // Cadastra o usuario no evento
            try {
                $status = $vagasOcupadas < $vagasTotais ? 0 : 1;    
                DB::insert("INSERT INTO 
                tb_evento_usuario(id_evento, id_usuario, status) 
                VALUES(?,?,?);", 
                [$eventoID,$usuarioId, $status]);
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
