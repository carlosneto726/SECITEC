<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class AdministradorController extends Controller
{

    public $nome_usuario; 
    public $senha_usuario;
    public function __construct() {
        $this->nome_usuario = $_COOKIE['nome_usuario'];
        $this->senha_usuario = $_COOKIE['senha_usuario'];

        if(!isset($this->nome_usuario) && !isset($this->senha_usuario)){
            redirect("/admin");
        }
    }

    public function sair(){
        setcookie("nome_usuario", "", time() - 3600, "/");
        setcookie("senha_usuario", "", time() - 3600, "/");
        return redirect("/admin");
    }


    // Eventos
    public function viewEventos(){
        $eventos = DB::select("
        SELECT e.*, te.nome AS tipo_evento_nome
        FROM tb_evento AS e
        INNER JOIN tb_tipo_evento AS te ON e.id_tipo_evento = te.id
        ");
        $palestrantes = DB::select("SELECT * FROM tb_proponente");
        $tipoEventos = DB::select("SELECT * FROM tb_tipo_evento");
        return view("admin.events.view", compact("eventos", "palestrantes", "tipoEventos"));
    }

    public function updateEvento(){
        $id = request("id");
        $titulo = request("txtTitulo");
        $descricao = request("txtDescricao");
        $diaEvento = request("diaEvento");
        $hrInicio = request("hrInicio");
        $hrFim = request("hrFim");
        $numVagas = request("numVagas");
        $hrHoras = request("numHoras");

        DB::update("UPDATE tb_evento 
                    SET titulo = ?, descricao = ?, dia = ?, horarioI = ?, horarioF = ?, vagas= ?, horas = ?
                    WHERE id = ?", 
                    [$titulo, $descricao, $diaEvento, $hrInicio, $hrFim, $numVagas, $hrHoras, $id]
                );

        return redirect("/admin/eventos");
    }

    public function insertEvento(Request $request): string{

        $titulo = request("txtTitulo");
        $descricao = request("txtDescricao");
        $dia = request("diaEvento");
        $hrInicio = request("hrInicio");
        $hrFim = request("hrFim");
        $numVagas = request("numVagas");
        $numHoras = request("numHoras");
        $local = request("txtLocal");
        $nomepalestrante = request("cbxPalestrante");
        $id_proponente = DB::select("SELECT * FROM tb_proponente WHERE nome = ?;", [$nomepalestrante])[0]->id;
        $id_tipo_evento = request("cbxTipoEvento");
        $path = $request->file('arquivo')->storeAs('images/schedule', "evento".$titulo.".".$request->file('arquivo')->extension(), 'public');
        $url = "storage/".$path;
        $types = array("png", "jpg", "jpeg", "webp", "avif", "jfif");

        DB::insert("INSERT INTO 
                    tb_evento(titulo,descricao,dia,horarioI,horarioF,vagas,horas,local,url,id_proponente,id_tipo_evento)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?);", 
                    [$titulo,$descricao,$dia,$hrInicio,$hrFim,$numVagas,$numHoras,$local,$url,$id_proponente, $id_tipo_evento]);

        return redirect("/admin/eventos");
    }

    public function deleteEvento(){
        $id = request("id");
        DB::delete("DELETE FROM tb_evento WHERE id = ?", [$id]);
        return redirect("/admin/eventos");
    }

    public function checkIn(){
        $dado = request("txtCheckin");
        $idevento = request("txtId");
        $ideventoaluno = $this->getAlunoId($dado, $idevento);
        DB::update("UPDATE tb_evento_aluno
                    WHERE id = ?
                    SET checkin = sysdate();",
                    [$ideventoaluno]
        );
    }

    public function checkOut(){
        $dado = request("txtCheckin");
        $idevento = request("txtId");
        $ideventoaluno = $this->getAlunoId($dado, $idevento);

        DB::update("UPDATE tb_evento_aluno
                    WHERE id = ?
                    SET status = 1, checkout = sysdate();",
        [$ideventoaluno]);
    }


    function getAlunoId($dado, $idevento){
        $ideventoaluno = DB::select("   SELECT a.id AS ida 
                                        FROM tb_evento_aluno a
                                        LEFT JOIN tb_aluno b
                                        ON a.id_aluno = b.id
                                        LEFT JOIN tb_evento c
                                        ON a.id_evento = c.id
                                        WHERE b.matricula = ? and c.id = ?;", 
                                        [$dado, $idevento]
        );
        
        return $ideventoaluno[0]->ida;
    }


    // Proponente
    public function viewProponente(){
        $palestrantes = DB::select("SELECT * FROM tb_proponente");
        return view("admin.proponente.view", compact("palestrantes"));
    }

    public function insertProponente(Request $request): string{
        $nome = request("txtNome");
        $titulacao = request("txtTitulacao");
        $path = $request->file('arquivo')->storeAs('images/avatar', "palestra".$nome.".".$request->file('arquivo')->extension(), 'public');
        $url = "storage/".$path;
        DB::insert("INSERT INTO 
                    tb_proponente(nome,titulacao,url) 
                    VALUES(?,?,?);", 
                    [$nome,$titulacao,$url]);

                    return redirect("/admin/proponente");
    }

    public function deleteProponente(){
        $id = request("id");
        DB::delete("DELETE FROM tb_proponente WHERE id = ?", [$id]);
        return redirect("/admin/proponente");
    }

}
