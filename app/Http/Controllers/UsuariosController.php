<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\AtivarConta;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuariosController extends Controller
{
    public $id_usuario;
    public $nome_usuario;

    public function __construct() {
        $this->id_usuario = $_COOKIE['usuario'];
        $this->nome_usuario = $_COOKIE['nome_usuario'];
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

    public function viewUsuarios(){
        $login = @$_COOKIE['nome_user'];
        $senha = @$_COOKIE['senha_user'];

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
