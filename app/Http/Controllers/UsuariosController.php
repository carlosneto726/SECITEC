<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| UsuáriosController
|--------------------------------------------------------------------------
|
| Este Controller é responsável por executar funções relacionadas ao usuário
| Coisas tipo, visualização de eventos cadastrados, cadastramento e decadastramento
| de eventos, contabilidade de vagas, atualização de perfil e etc
|
*/

class UsuariosController extends Controller
{
    public $id_usuario;
    public $nome_usuario;

    // Método construtor que impede usuários não validados à 
    // acessar recursos que precisam de validação.
    // Para cada função que o usuário usar nesse controller, primeiramente 
    // ele terá que ser validado pelo o método construtor.
    // Neste caso, o método contrutor verifica a todo instante se o id armazenado
    // no $_COOKIE['usuario'] (onde é armazenado o id no client-side) 
    // existe e está ativado no Banco de dados
    public function __construct()
    {
        $this->id_usuario = @$_COOKIE['usuario'];
        $this->nome_usuario = @$_COOKIE['nome_usuario'];

        $query = DB::select("SELECT id, nome FROM tb_usuario WHERE id = ? AND status = 1;", [$this->id_usuario]);
        if (count($query) == 0) {
            redirect("/login");
        }
    }


    public function cadastrarHackathon(Request $request)
    {
        $usuarioId = $request->input('usuarioId');
        $eventoID = $request->input('eventoId');
        $usuarioCadastrado = count(DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?", [$eventoID, $usuarioId])) > 0;
        if ($usuarioCadastrado) {
            DB::delete("DELETE FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?", [$eventoID, $usuarioId]);
            return response()->json(['mensagem' => "Descadastrado"]);
        } else {

            if ($this->verificarConflitoHackathon($eventoID, $usuarioId, true)) {
                return response()->json(['mensagem' => "Conflito"]);
            }

            DB::insert("INSERT INTO 
            tb_evento_usuario(id_evento, id_usuario, status, checkin, checkout, data_insercao) 
            VALUES(?,?,?,?,?,?);",
                [$eventoID, $usuarioId, 0, null, null, date('Y-m-d H:i:s')]
            );
            return response()->json(['mensagem' => "Cadastrado"]);
        }
    }
    // status da tabela tb_evento_usuario: 0 = Cadastrado e 1 = Cadastro reserva
    public function cadastrarEvento(Request $request)
    {
        $mensagemResponse = "";
        $usuarioId = $request->input('usuarioId');
        $eventoID = $request->input('eventoId');
        $vagasTotais = DB::select("SELECT * FROM tb_evento WHERE id = ?", [$eventoID])[0]->vagas;
        $vagasOcupadas = count(DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ? AND status = 0", [$eventoID]));
        $todasIncricoes = count(DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ?", [$eventoID]));

        if ($this->verificaCadastro($request->input('usuarioId'), $request->input('eventoId'))) {
            // Descadastra o usuario no evento
            try {
                $mensagemResponse = $todasIncricoes > $vagasTotais ? "saiuFila" : "descadastroSemFila";
                $usuarioCadastrado = DB::select("SELECT status FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?", [$eventoID, $usuarioId])[0]->status;
                if ($usuarioCadastrado == 0 && $todasIncricoes > $vagasTotais) {
                    $mensagemResponse = "removidoFila";
                    $this->removerListaEspera($eventoID, $vagasTotais);
                }
                DB::delete("DELETE FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?", [$eventoID, $usuarioId]);
                return response()->json(['mensagem' => $mensagemResponse, 'evento' => $eventoID]);
            } catch (\Throwable $th) {
                return response()->json(['mensagem' => $th]);
            }
        } else {
            // Cadastra o usuario no evento
            try {
                if ($this->verificaConflito($eventoID, $usuarioId)) {
                    return response()->json(['mensagem' => "conflito", 'evento' => $eventoID]);
                }

                if ($this->verificarConflitoHackathon($eventoID, $usuarioId, false)) {
                    return response()->json(['mensagem' => "conflitoHackathon", 'evento' => $eventoID]);
                }

                $status = $vagasOcupadas < $vagasTotais ? 0 : 1;
                $mensagemResponse = $vagasOcupadas < $vagasTotais ? "cadastroNormal" : "cadastroReserva";
                DB::insert("INSERT INTO 
                tb_evento_usuario(id_evento, id_usuario, status, checkin, checkout, data_insercao) 
                VALUES(?,?,?,?,?,?);",
                    [$eventoID, $usuarioId, $status, null, null, date('Y-m-d H:i:s')]
                );
                return response()->json(['mensagem' => $mensagemResponse, 'evento' => $eventoID]);
            } catch (\Throwable $th) {
                return response()->json(['mensagem' => $th]);
            }
        }
    }


    public function removerListaEspera($eventoId, $vagasTotais)
    {
        $eventosUsuarios = DB::table('tb_evento_usuario')
            ->orderBy('data_insercao', 'asc')
            ->get();

        if ($eventosUsuarios->count() > $vagasTotais) {
            $eventoUsuario = $eventosUsuarios[$vagasTotais];
            $id = $eventoUsuario->id;

            DB::table('tb_evento_usuario')
                ->where('id', $id)
                ->update(['status' => 0]);
        }
    }

    public function verificaCadastro($usuarioId, $eventoID)
    {
        $resultados = DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ? AND id_usuario = ?", [$eventoID, $usuarioId]);

        if (count($resultados) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarConflitoHackathon($eventoId, $usuarioId, $cadastroHackathon)
    {

        if ($cadastroHackathon) {
            $queryConflitoAbertura = "SELECT COUNT(*) AS total_conflitos FROM tb_evento AS evento
                INNER JOIN tb_evento_usuario AS eventoRelacao ON evento.id = eventoRelacao.id_evento
                WHERE eventoRelacao.id_usuario = ? 
                AND evento.dia = '2023-10-23' 
                AND ('08:00:00' < evento.horarioF) AND ('12:00:00' > evento.horarioI)";
            $resultadoqueryConflitoAbertura = DB::select($queryConflitoAbertura, [$usuarioId]);

            $queryConflitoEncerramento = "SELECT COUNT(*) AS total_conflitos FROM tb_evento AS evento
                INNER JOIN tb_evento_usuario AS eventoRelacao ON evento.id = eventoRelacao.id_evento
                WHERE eventoRelacao.id_usuario = ? 
                AND evento.dia = '2023-10-26' 
                AND ('10:00:00' < evento.horarioF) AND ('12:00:00' > evento.horarioI)";
            $resultadoqueryConflitoEncerramento = DB::select($queryConflitoEncerramento, [$usuarioId]);
            if ($resultadoqueryConflitoEncerramento[0]->total_conflitos > 0 || $resultadoqueryConflitoAbertura[0]->total_conflitos > 0) {
                return true;
            }
            return false;

        } else {
            $hackathon = DB::select("SELECT * FROM tb_evento WHERE id_tipo_evento = 4;")[0];
            if($this->verificaCadastro($usuarioId, $hackathon->id)) {
                $evento = DB::select("SELECT * FROM tb_evento WHERE id = ?;", [$eventoId])[0];
                if($evento-> dia == '2023-10-23' || $evento->dia == '2023-10-26') {
                    if($evento-> dia == '2023-10-23') {
                        return '08:00:00' < $evento->horarioF AND '12:00:00' > $evento->horarioI;
                    } else {
                        return '10:00:00' < $evento->horarioF AND '12:00:00' > $evento->horarioI;
                    }
                } else {
                    return false;
                }
            }
            return false;
        }
    }

    public function verificaConflito($eventoId, $usuarioId)
    {
        $evento = DB::select("SELECT * FROM tb_evento WHERE id = ?;", [$eventoId])[0];
        $dia = $evento->dia;
        $horarioI = $evento->horarioI;
        $horarioF = "$evento->horarioF";
        $query = "SELECT COUNT(*) AS total_conflitos FROM tb_evento AS evento
                  INNER JOIN tb_evento_usuario AS eventoRelacao ON evento.id = eventoRelacao.id_evento
                  WHERE eventoRelacao.id_usuario = ? 
                  AND evento.dia = ? 
                  AND evento.id_tipo_evento != 4
                  AND ('$horarioI' < evento.horarioF) AND ('$horarioF' > evento.horarioI)";
        $resultado = DB::select($query, [$usuarioId, $dia]);
        if ($resultado[0]->total_conflitos > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function viewEventos()
    {
        $eventos = DB::select(" SELECT e.*, te.nome AS tipo_evento_nome
                                FROM tb_evento AS e
                                INNER JOIN tb_tipo_evento AS te ON e.id_tipo_evento = te.id
        ");
        $usuario = DB::select("SELECT * FROM tb_usuario WHERE id = ?;", [$this->id_usuario])[0];
        $eventosCadastrados = DB::select("SELECT * FROM tb_evento_usuario WHERE id_usuario = ?;", [$usuario->id]);
        $eventosMapeados = $this->mapearEventos($eventos, $eventosCadastrados);
        return view("usuarios.home", compact("eventosMapeados", "usuario"));
    }

    public function viewMeusEventos(){
        $cpf = DB::select("SELECT cpf FROM tb_usuario WHERE id = ?;", [$this->id_usuario])[0]->cpf;
        $eventos = DB::select(" SELECT tb_evento.id as id_evento,
                                tb_evento.titulo as titulo,
                                tb_evento.descricao as descricao,
                                tb_evento.dia as dia,
                                tb_evento.horarioI as horarioI,
                                tb_evento.horarioF as horarioF,
                                tb_evento.vagas as vagas,
                                tb_evento.horas as horas,
                                tb_evento.local as local,
                                tb_evento.url as url,
                                tb_evento.id_tipo_evento as id_tipo_evento
                                FROM tb_evento
                                INNER JOIN tb_evento_usuario ON tb_evento_usuario.id_evento = tb_evento.id
                                INNER JOIN tb_usuario ON tb_evento_usuario.id_usuario = tb_usuario.id
                                WHERE tb_usuario.id = ?;", [$this->id_usuario]);
        return view("meus-eventos.view", compact("eventos", "cpf"));
    }

    function mapearEventos($eventos, $eventosCadastrados)
    {
        $eventosMapeados = [];

        foreach ($eventos as $evento) {
            $proponentes = $this->getProponentesEvento($evento->id);
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
                $evento->id_tipo_evento,
                false,
                $evento->tipo_evento_nome,
                $this->calcularVagasRestantes($evento->id, $evento->vagas),
                $proponentes
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

    function calcularVagasRestantes($eventoId, $eventoVagasTotais)
    {
        $vagasOcupadas = count(DB::select("SELECT * FROM tb_evento_usuario WHERE id_evento = ? AND status = 0;", [$eventoId]));
        return $eventoVagasTotais - $vagasOcupadas;
    }

    function getProponentesEvento($eventoId)
    {
        $relacoesEventoProponente = DB::select("SELECT * FROM tb_proponente_evento WHERE id_evento = ?;", [$eventoId]);
        $proponentes = [];
        for ($i = 0; $i < count($relacoesEventoProponente); $i++) {
            array_push($proponentes, DB::select("SELECT * FROM tb_proponente WHERE id = ?;", [$relacoesEventoProponente[$i]->id_proponente])[0]);
        }
        return $proponentes;
    }

}

class EventoDto
{
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
    public $id_tipo_evento;
    public $usuario_cadastrado;
    public $tipo_evento_nome;
    public $vagas_restantes;
    public $proponentes;

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
        $id_tipo_evento,
        $usuario_cadastrado,
        $tipo_evento_nome,
        $vagas_restantes,
        $proponentes
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
        $this->id_tipo_evento = $id_tipo_evento;
        $this->id_tipo_evento = $id_tipo_evento;
        $this->usuario_cadastrado = $usuario_cadastrado;
        $this->tipo_evento_nome = $tipo_evento_nome;
        $this->vagas_restantes = $vagas_restantes;
        $this->proponentes = $proponentes;
    }
}