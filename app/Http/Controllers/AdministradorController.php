<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Mail\AtivarConta;
use Illuminate\Support\Facades\Mail;

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
        $eventos = DB::select("SELECT * FROM tb_evento");
        $palestrantes = DB::select("SELECT * FROM tb_proponente");
        return view("admin.events.view", compact("eventos", "palestrantes"));
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

        AlertController::alert('Evento atualizado com sucesso.', 'success');
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
        $path = $request->file('arquivo')->storeAs('images/schedule', "evento".$titulo.".".$request->file('arquivo')->extension(), 'public');
        $url = "storage/".$path;
        $types = array("png", "jpg", "jpeg", "webp", "avif", "jfif");

        // Maycon alterar a funcionalidade de alterar o tipo de cadastro
        DB::insert("INSERT INTO 
                    tb_evento(titulo,descricao,dia,horarioI,horarioF,vagas,horas,local,url,id_proponente,id_tipo_evento)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?);", 
                    [$titulo,$descricao,$dia,$hrInicio,$hrFim,$numVagas,$numHoras,$local,$url,$id_proponente,1]);

        AlertController::alert('Evento adicionado com sucesso.', 'success');
        return redirect("/admin/eventos");
    }

    public function deleteEvento(){
        $id = request("id");
        DB::delete("DELETE FROM tb_evento WHERE id = ?", [$id]);
        AlertController::alert('Evento deletado sucesso.', 'warning');
        return response()->json(
            [
                'message' => 'Evento deletado com sucesso.',
                'type' => 'warning'
            ]
        );
    }

    public function viewPresenca(){
        return view("admin.events.presenca");
    }

    public function checkIn(){
        $cpf = request("cpf"); // CPF
        $id_evento = request("id_evento");
        $id_eventousuario = $this->getusUarioId($cpf, $id_evento);
        DB::update("UPDATE tb_evento_usuario
                    WHERE id = ?
                    SET checkin = sysdate();",
                    [$id_eventousuario]
        );
    }

    public function checkOut(){
        $cpf = request("cpf"); // CPF
        $id_evento = request("id_evento");
        $id_eventousuario = $this->getusUarioId($cpf, $id_evento);

        DB::update("UPDATE tb_evento_usuario
                    WHERE id = ?
                    SET status = 1, 
                    checkout = sysdate();",
        [$id_eventousuario]);
    }


    function getusUarioId($cpf, $idevento){
        $ideventousuario = DB::select("   SELECT tb_evento_usuario.id AS id_usuario
                                        FROM tb_evento_usuario
                                        LEFT JOIN tb_usuario
                                        ON tb_evento_usuario.id_usuario = tb_usuario.id
                                        LEFT JOIN tb_evento
                                        ON tb_evento_usuario.id_evento = tb_evento.id
                                        WHERE tb_usuario.cpf = ? and tb_evento.id = ?;", 
                                        [$cpf, $idevento]
        );
        
        return $ideventousuario[0]->ida;
    }


    // Proponente

    public function viewProponente(){
        $proponentes = DB::select("SELECT * FROM tb_proponente");
        foreach ($proponentes as $proponente) {
            $redes = DB::select("SELECT * FROM tb_redes_proponente WHERE id_proponente = ?;", [$proponente->id]);
            $proponente->redes = $redes;
        }
        return view("admin.proponente.view", compact("proponentes"));
    }

    public function insertProponente(Request $request): string{
        $nome = request("txtNome");
        $titulacao = request("txtTitulacao");
        $rede1 = request("rede1");
        $rede2 = request("rede2");
        $rede3 = request("rede3");
        $path = $request->file('arquivo')->storeAs('images/avatar', "palestra".$nome.".".$request->file('arquivo')->extension(), 'public');
        $url = "storage/".$path;
        DB::insert("INSERT INTO 
                    tb_proponente(nome,titulacao,url) 
                    VALUES(?,?,?);", 
                    [$nome,$titulacao,$url]);

        $id_proponente = DB::getPdo()->lastInsertId();

        DB::insert("INSERT INTO
                    tb_redes_proponente(id_proponente,rede1,rede2,rede3)
                    VALUES(?,?,?,?);",
                    [$id_proponente,$rede1,$rede2,$rede3]);

        AlertController::alert('Proponente adicionado com sucesso.', 'success');
        return redirect("/admin/proponente");
    }

    public function updateProponente(Request $request): string{
        $id_proponente = request('id_proponente');
        $nome = request("nome");
        $titulacao = request("titulacao");
        $rede1 = request("rede1");
        $rede2 = request("rede2");
        $rede3 = request("rede3");
        if($request->file('arquivo')){
            $path = $request->file('arquivo')->storeAs('images/avatar', "palestra".$nome.".".$request->file('arquivo')->extension(), 'public');
            $url = "storage/".$path;
            DB::update("UPDATE tb_proponente
                        SET nome = ?, titulacao = ?, url = ? WHERE id = ?;", 
                        [$nome,$titulacao,$url,$id_proponente]);
        }else{
            DB::update("UPDATE tb_proponente
                        SET nome = ?, titulacao = ? WHERE id = ?;", 
                        [$nome,$titulacao,$id_proponente]);
        }

        DB::update("UPDATE tb_redes_proponente
                    SET rede1 = ?, rede2 = ?, rede3 = ?
                    WHERE id_proponente = ?",
                    [$rede1,$rede2,$rede3,$id_proponente]);

        AlertController::alert('Proponente atualizado com sucesso.', 'success');
        return redirect("/admin/proponente");
    }

    public function deleteProponente(){
        $id = request("id");
        DB::delete("DELETE FROM tb_proponente WHERE id = ?", [$id]);
        AlertController::alert('Proponente deletado com sucesso.', 'warning');
        return response()->json(
            [
                'message' => 'Proponente deletado com sucesso.',
                'type' => 'warning'
            ]
        );
    }

    public function enviarEmail(){
        $dados = "https://www.youtube.com/watch?v=yhtLGnExKYk&t=12s";
        $email = "contasdocaique@gmail.com";
        Mail::to($email)->send(new AtivarConta($dados, 'ativarConta'));
    }
}
