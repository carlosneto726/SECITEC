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
        $this->nome_usuario = $_COOKIE['ADM_USER'];
        $this->senha_usuario = $_COOKIE['ADM_PASSWORD'];

        if(!isset($this->nome_usuario) && !isset($this->senha_usuario)){
            abort(404, "Tem que se validar meu chapinha");
        }
    }

    public function sair(){
        setcookie("ADM_USER", "", time() - 3600, "/");
        setcookie("ADM_PASSWORD", "", time() - 3600, "/");
        return redirect("/admin");
    }

    // Eventos
    public function viewEventos(){
        $eventos = DB::select(" SELECT e.*, te.nome AS tipo_evento_nome
                                FROM tb_evento AS e
                                INNER JOIN tb_tipo_evento AS te ON e.id_tipo_evento = te.id
                                WHERE te.id != 4;
        ");

        foreach ($eventos as $evento) {
            $proponentes_nome = [];
            $proponentes = DB::select(" SELECT nome FROM tb_proponente
                                        INNER JOIN tb_proponente_evento ON tb_proponente.id = tb_proponente_evento.id_proponente
                                        WHERE tb_proponente_evento.id_evento = ?;", [$evento->id]);
            foreach ($proponentes as $proponente) {
                array_push($proponentes_nome, $proponente->nome);
            }
            
            $evento->proponentes = $proponentes_nome;
        }

        $palestrantes = DB::select("SELECT * FROM tb_proponente");
        $tipoEventos = DB::select("SELECT * FROM tb_tipo_evento WHERE id != 4;");
        return view("admin.events.view", compact("eventos", "palestrantes", "tipoEventos"));
    }

    public function updateEvento(Request $request){
        $id = request("id");
        $titulo = request("titulo");
        $descricao = request("descricao");
        $dia = request("data");
        $hrInicio = request("hrInicio");
        $hrFim = request("hrFim");
        $numVagas = request("vagas");
        $numHoras = request("horas");
        $local = request("local");
        $id_tipo_evento = request("tipoEvento");
        $proponentes = explode(",", request("proponentes")); // O post pelo o javascript volta uma lista dos proponentes no formato JSON, que aqui no php é interpretada por uma string

        if($request->file('arquivo')){ // Caso o POST venha com uma imagem
            $img_url = DB::select("SELECT url FROM tb_evento WHERE id = ?;", [$id])[0]->url; // Pegando o caminho da imagem antiga
            @unlink($img_url); // Deletando a imagem antiga do storage
            $path = $request->file('arquivo')->storeAs('images/schedule', "evento".$titulo.".".$request->file('arquivo')->extension(), 'public'); // Pegando o caminho do arquivo Ex: images/schedule/TituloEvento.png
            $url = "storage/".$path; // Definindo o arquivo para o caminho relativo da pasta storage Ex: storage/images/schedule/TituloEvento.png
            DB::update("UPDATE tb_evento
                SET titulo = ?, descricao = ?, dia = ?, horarioI = ?, horarioF = ?, vagas= ?, horas = ?, url = ?, local = ?, id_tipo_evento = ?
                WHERE id = ?", 
                [$titulo, $descricao, $dia, $hrInicio, $hrFim, $numVagas, $numHoras, $url, $local, $id_tipo_evento, $id]
            ); // Atualizando o evento
        }else{
            DB::update("UPDATE tb_evento 
                SET titulo = ?, descricao = ?, dia = ?, horarioI = ?, horarioF = ?, vagas= ?, horas = ?, local = ?, id_tipo_evento = ?
                WHERE id = ?", 
                [$titulo, $descricao, $dia, $hrInicio, $hrFim, $numVagas, $numHoras, $local, $id_tipo_evento, $id]
            ); // Atualizando o evento
        }
        DB::delete("DELETE FROM tb_proponente_evento WHERE id_evento = ?", [$id]); // Deletando os antigos proponentes
        foreach($proponentes as $proponente){            
            DB::insert("INSERT INTO
                        tb_proponente_evento(id_evento, id_proponente)
                        VALUES(?, ?);",
                        [$id, $proponente]); // Inserindo os novos proponentes
        }
        // Por alguma foda de motivo a porra desse response não funciona javascript/php do cão imaculado dos infernos.
        return response()->json(
            [
                'message' => 'Evento atualizado com sucesso.',
                'type' => 'success',
                'endpoint' => '/admin/eventos' 
            ]
        );
    }

    public function insertEvento(Request $request){
        $titulo = request("titulo");
        $descricao = request("descricao");
        $dia = request("data");
        $hrInicio = request("hrInicio");
        $hrFim = request("hrFim");
        $numVagas = request("vagas");
        $numHoras = request("horas");
        $local = request("local");
        $id_tipo_evento = request("tipoEvento");
        $proponentes = explode(",", request("proponentes"));
        $path = $request->file('arquivo')->storeAs('images/schedule', "evento".$titulo.".".$request->file('arquivo')->extension(), 'public');
        $url = "storage/".$path;
        // $types = array("png", "jpg", "jpeg", "webp", "avif", "jfif");

        DB::insert("INSERT INTO 
                    tb_evento(titulo,descricao,dia,horarioI,horarioF,vagas,horas,local,url,id_tipo_evento)
                    VALUES (?,?,?,?,?,?,?,?,?,?);",
                    [$titulo,$descricao,$dia,$hrInicio,$hrFim,$numVagas,$numHoras,$local,$url,$id_tipo_evento]);

        $id_evento = DB::getPdo()->lastInsertId();
        foreach($proponentes as $proponente){
            DB::insert("INSERT INTO
                        tb_proponente_evento(id_evento, id_proponente)
                        VALUES(?, ?);",
                        [$id_evento, $proponente]);
        }
        
        return response()->json(
            [
                'message' => 'Evento cadastrado com sucesso.',
                'type' => 'success',
                'endpoint' => '/admin/eventos' 
            ]
        );
    }

    public function deleteEvento(){
        $id = request("id");
        $img_url = DB::select("SELECT url FROM tb_evento WHERE id = ?;", [$id])[0]->url; // Pegando o caminho da imagem
        @unlink($img_url); // Deletando a imagem do storage
        DB::delete("DELETE FROM tb_proponente_evento WHERE tb_proponente_evento.id_evento = ?;", [$id]); // Deletando a relação entre evento e proponente
        DB::delete("DELETE FROM tb_evento WHERE tb_evento.id = ?;", [$id]); // Deletando o proponente
        return response()->json(
            [
                'message' => 'Evento deletado com sucesso.',
                'type' => 'warning',
                'endpoint' => '/admin/eventos' 
            ]
        );
    }
    public function viewPresenca(){
        return view("admin.events.presenca");
    }

    public function checkIn(){
        $cpf = request("cpf"); // CPF
        $id_evento = request("id_evento");
        $confirmacao = request("confirmacao");
        $id_eventousuario = $this->getusUarioId($cpf, $id_evento);
        $checkin = DB::select("SELECT * FROM tb_evento_usuario WHERE id = ?;", [$id_eventousuario])[0]->checkin;
        if(($checkin == null && $confirmacao == false) || $confirmacao){
            DB::update("UPDATE tb_evento_usuario
                        SET checkin = sysdate()
                        WHERE id = ?;",
                        [$id_eventousuario]
            );
            return response()->json(
                [
                    'message' => 'Checkin efetuado com sucesso.',
                    'type' => 'success'
                ]
            );
        }else{
            return response()->json(
                [
                    'id_modal' => 'modalcheckin'
                ]
            );
        }
    }

    public function checkOut(){
        $cpf = request("cpf"); // CPF
        $id_evento = request("id_evento");
        $confirmacao = request("confirmacao");
        $id_eventousuario = $this->getusUarioId($cpf, $id_evento);
        $checkout = DB::select("SELECT * FROM tb_evento_usuario WHERE id = ?;", [$id_eventousuario])[0]->checkout;

        if(($checkout == null && $confirmacao == false) || $confirmacao){
            DB::update("UPDATE tb_evento_usuario
                        SET status = 1, checkout = sysdate()
                        WHERE id = ?;",
                        [$id_eventousuario]);
            return response()->json(
                [
                    'message' => 'Checkout efetuado com sucesso.',
                    'type' => 'success'
                ]
            );
        }else{
            return response()->json(
                [
                    'id_modal' => 'modalcheckout'
                ]
            );
        }
    }

    function getusUarioId($cpf, $idevento){
        $ideventousuario = DB::select(" SELECT tb_evento_usuario.id AS id_usuario
                                        FROM tb_evento_usuario
                                        LEFT JOIN tb_usuario
                                        ON tb_evento_usuario.id_usuario = tb_usuario.id
                                        LEFT JOIN tb_evento
                                        ON tb_evento_usuario.id_evento = tb_evento.id
                                        WHERE tb_usuario.cpf = ? and tb_evento.id = ?;", 
                                        [$cpf, $idevento]
        );
        if(count($ideventousuario) == 0){
            echo "Usuário não cadastrado nesse evento";
            // 24247688030
        }else{
            return $ideventousuario[0]->id_usuario;
        }
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
            $img_url = DB::select("SELECT url FROM tb_proponente WHERE id = ?;", [$id_proponente])[0]->url; // Pegando o caminho da imagem antiga
            @unlink($img_url); // Deletando a imagem antiga do storage
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
        return redirect("/admin/proponente");
    }

    public function deleteProponente(){
        $id = request("id");
        $img_url = DB::select("SELECT url FROM tb_proponente WHERE id = ?;", [$id])[0]->url; // Pegando o caminho da imagem
        @unlink($img_url); // Deletando a imagem do storage
        DB::delete("DELETE FROM tb_proponente_evento WHERE id_proponente = ?;", [$id]);
        DB::delete("DELETE FROM tb_redes_proponente WHERE id_proponente = ?", [$id]);
        DB::delete("DELETE FROM tb_proponente WHERE id = ?", [$id]);
        return response()->json(
            [
                'message' => 'Proponente deletado com sucesso.',
                'type' => 'warning',
                'endpoint' => '/admin/proponente'
            ]
        );
    }
}
