<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ValidarUsuariosController extends Controller
{
    public function viewUsuarios(){
        $login = @$_COOKIE['nome_user'];
        $senha = @$_COOKIE['senha_user'];

        $palestrantes = DB::select("SELECT * FROM tb_proponente");
        $tipoEventos = DB::select("SELECT * FROM tb_tipo_evento");

        if(isset($login) && isset($senha)){
            if($this->validarLogin($login, $senha)){
                $eventos = DB::select("
                SELECT e.*, te.nome AS tipo_evento_nome
                FROM tb_evento AS e
                INNER JOIN tb_tipo_evento AS te ON e.id_tipo_evento = te.id
                ");
                $usuario = DB::select("SELECT * FROM tb_usuario WHERE nome = ?;", [$login])[0];
                $eventosCadastrados = DB::select("SELECT * FROM tb_evento_usuario WHERE id_usuario = ?;", [$usuario->id]);
                $eventosMapeados = $this->mapearEventos($eventos, $eventosCadastrados);
                return view("usuarios.home", compact("eventosMapeados", "usuario"));
            }
        }else{
            return view("usuarios.loginUser.view");
        }
        return view("home.view");
    }

    public function loginUser(){
        $login = request("txtNome");
        $senha = request("txtSenha");
        
        if($this->validarLogin($login, $senha)){
            return redirect("/usuarios");
        }else{
            return redirect("/usuarios");
        }
    }

    public function validarLogin($login, $senha){
        try {
            $usuario = DB::select("SELECT * FROM tb_usuario WHERE nome = ?;", [$login])[0];
            if ($usuario->senha == $senha) {
                setcookie("nome_user", $login, time() + (86400 * 30), "/");
                setcookie("senha_user", $senha, time() + (86400 * 30), "/");
                return true;
            } else {
                throw ValidationException::withMessages(['your error message']);
            }
        } catch (\Throwable $th) {
            throw ValidationException::withMessages(['your error message']);
        }
    }

    function mapearEventos($eventos, $eventosCadastrados) {
        $eventosMapeados = [];
    
        foreach ($eventos as $evento) {
            $eventoMapeado = new EventoDto(
                $evento->id,
                $evento->titulo,
                $evento->descricao,
                $evento->dia,
                $evento->horarioI,
                $evento->horarioF,
                $evento->vagas,
                $evento->horas,
                $evento->local,
                $evento->url,
                $evento->id_proponente,
                $evento->id_tipo_evento,
                false,
                $evento->tipo_evento_nome
            );
            foreach ($eventosCadastrados as $eventoCadastrado) {
                if ($evento->id == $eventoCadastrado->id_evento) {
                    $eventoMapeado->usuario_cadastrado = true;
                    break;
                }
            }
            $eventosMapeados[] = $eventoMapeado;
        }
        return $eventosMapeados;
    }
}

class EventoDto {
    public $id;
    public $titulo;
    public $descricao;
    public $dia;
    public $horarioI;
    public $horarioF;
    public $vagas;
    public $horas;
    public $local;
    public $url;
    public $id_proponente;
    public $id_tipo_evento;
    public $usuario_cadastrado;
    public $tipo_evento_nome;

    public function __construct(
        $id,
        $titulo,
        $descricao,
        $dia,
        $horarioI,
        $horarioF,
        $vagas,
        $horas,
        $local,
        $url,
        $id_proponente,
        $id_tipo_evento,
        $usuario_cadastrado,
        $tipo_evento_nome
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->dia = $dia;
        $this->horarioI = $horarioI;
        $this->horarioF = $horarioF;
        $this->vagas = $vagas;
        $this->horas = $horas;
        $this->local = $local;
        $this->url = $url;
        $this->id_proponente = $id_proponente;
        $this->id_tipo_evento = $id_tipo_evento;
        $this->id_tipo_evento = $id_tipo_evento;
        $this->usuario_cadastrado = $usuario_cadastrado;
        $this->tipo_evento_nome = $tipo_evento_nome;
    }
}
