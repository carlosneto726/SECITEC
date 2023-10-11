<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\PresencaTrait;
use App\Traits\MonitorTrait;
use App\Traits\AdminTrait;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    use PresencaTrait, MonitorTrait, AdminTrait;
    public $nome_usuario; 
    public $senha_usuario;
    public function __construct() {
        $this->nome_usuario = $_COOKIE['ADM_USER'];
        $this->senha_usuario = $_COOKIE['ADM_PASSWORD'];

        if(!isset($this->nome_usuario) && !isset($this->senha_usuario)){
            abort(450);
        }
        if($this->nome_usuario != env('ADM_USER') || $this->senha_usuario != env('ADM_PASSWORD')){
            abort(450);
        }
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
        if($request->file('arquivo')){ // Caso o POST venha com uma imagem
            @$path = $request->file('arquivo')->storeAs('images/schedule', "evento".$titulo.".".$request->file('arquivo')->extension(), 'public');
            $url = "storage/".$path;
        }else{
            $url = "storage/images/avatar/placeholder.jpeg";
        }

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

    // Proponente
    public function viewProponente(Request $request){
        $eventos = DB::select ("SELECT * FROM tb_evento");
        $proponentes = DB::select("SELECT * FROM tb_proponente WHERE id != 7 AND id != 8 AND id != 9 AND id != 10 ORDER BY nome;");
        foreach ($proponentes as $proponente) {
            $redes = DB::select("SELECT * FROM tb_redes_proponente WHERE id_proponente = ?;", [$proponente->id]);
            $proponente->redes = $redes;
        }
        return view("admin.proponente.view", compact("proponentes", "eventos"));
    }

    public function insertProponente(Request $request): string{
        $nome = request("txtNome");
        $titulacao = request("txtTitulacao");
        $rede1 = request("rede1");
        $rede2 = request("rede2");
        $rede3 = request("rede3");
        
        if($request->file('arquivo')){ // Caso o POST venha com uma imagem
            $path = $request->file('arquivo')->storeAs('images/avatar', "palestra".$nome.".".$request->file('arquivo')->extension(), 'public');
            $url = "storage/".$path;
        }else{
            $url = "storage/images/avatar/placeholder.jpeg";
        }
        DB::insert("INSERT INTO 
                    tb_proponente(nome,titulacao,url) 
                    VALUES(?,?,?);", 
                    [$nome,$titulacao,$url]);

        $id_proponente = DB::getPdo()->lastInsertId();

        DB::insert("INSERT INTO
                    tb_redes_proponente(id_proponente,rede1,rede2,rede3)
                    VALUES(?,?,?,?);",
                    [$id_proponente,$rede1,$rede2,$rede3]);

        if(request("eventos")){
            foreach (request("eventos") as $evento) {
                DB::insert("INSERT INTO 
                            tb_proponente_evento(id_evento, id_proponente)
                            VALUES(?,?);", [$evento, $id_proponente]);
            }
        }

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
        if($img_url != "storage/images/avatar/placeholder.jpeg"){
            @unlink($img_url); // Deletando a imagem do storage
        }
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


    public function viewAdicionarUsuario(){
        $usuarios = DB::select("SELECT * FROM tb_usuario ORDER BY id DESC;");
        foreach ($usuarios as $usuario) {
            $usuario_eventos = DB::select(" SELECT tb_evento.titulo
                                            FROM tb_evento
                                            INNER JOIN tb_evento_usuario ON tb_evento_usuario.id_evento = tb_evento.id
                                            WHERE tb_evento_usuario.id_usuario = ?;", [$usuario->id]);
            $usuario->eventos = $usuario_eventos;
        }

        return view("admin.usuario.view", compact("usuarios"));
    }

    public function addUsuario(Request $request){
        $email = request("email");
        $cpf = request("cpf");
        $nome = request("nome");
        $senha = Hash::make("secitec2023"); // Senha criptografada
        $eventosSelecionados = request("eventosSelecionados");

        $validarCPF = new ValidarUsuariosController;
        if(!$validarCPF->validaCPF($cpf)){
            return response()->json(['error' => 'CPF ou email já cadastrado']);
        }

        $usuarios = DB::select("SELECT email, cpf FROM tb_usuario WHERE email = ? OR cpf = ?;", [$email, $cpf]);
        if(count($usuarios) > 0){
            return response()->json(['error' => 'CPF ou EMAIL já cadastrado']);
        }

        try {
            $maiorId = DB::table('tb_usuario')->max('id');
            $novoId = $maiorId + 1;
            DB::insert("INSERT INTO tb_usuario(id, nome, senha, cpf, email, status) VALUES(?,?,?,?,?,?);", [$novoId,$nome, $senha, $cpf, $email, "1"]);
            if (!empty($eventosSelecionados)) {
                foreach ($eventosSelecionados as $eventoId) {
                    DB::insert("INSERT INTO tb_evento_usuario(id_evento, id_usuario, status, data_insercao) VALUES(?,?,?,?);", [$eventoId, $novoId, 1, date('Y-m-d H:i:s')]);
                }
            }
            return response()->json(['mensagem' => 'Cadastrado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function AddUsuariosEventos(Request $request){
        $userId = request("userId");
        $eventosSelecionados = request("eventosSelecionados");

        try {
            if (!empty($eventosSelecionados)) {
                foreach ($eventosSelecionados as $eventoId) {
                    DB::insert("INSERT INTO tb_evento_usuario(id_evento, id_usuario, status, data_insercao) VALUES(?,?,?,?);", [$eventoId, $userId, 1, date('Y-m-d H:i:s')]);
                }
            }
            return response()->json(['mensagem' => 'Eventos cadastrados com sucesso!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function viewLogs(){
        $logs = DB::select("SELECT * FROM log_tb_evento_usuario ORDER BY data_hora ASC;");
        return view("admin.logs", compact("logs"));
    }

    public function getEventos(){
        $eventos = DB::select("SELECT * FROM tb_evento;");
        return response()->json($eventos);
    }

    // Eventos que o usuario não esta cadastrado ainda
    public function getEventosByUserId(Request $request){
        $userId = request("id");
        try {
            $eventos = DB::select("SELECT *
            FROM tb_evento
            WHERE tb_evento.id NOT IN (
             SELECT id_evento
             FROM tb_evento_usuario
             WHERE id_usuario = ?);", [$userId]);
            return response()->json($eventos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
