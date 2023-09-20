<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

session_start();

class AdministradorController extends Controller
{

    public function viewAdm(){
        $login = @$_COOKIE['nome_usuario'];
        $senha = @$_COOKIE['senha_usuario'];
        if(isset($login) && isset($senha)){
            if($this->validarLogin($login, $senha)){
                return view("admin.view");
            }
        }else{
            return view("admin.entrar");
        }
    }

    public function entrar(){
        $login = request("txtNome");
        $senha = request("txtSenha");
        if($this->validarLogin($login, $senha)){
            return redirect("/admin");
        }else{
            return redirect("/admin");
        }
    }

    public function validarLogin($login, $senha){
        if($login == "SECITECADM" && $senha == "acjmop"){
            setcookie("nome_usuario", $login, time() + (86400 * 30), "/");
            setcookie("senha_usuario", $senha, time() + (86400 * 30), "/");
            return true;
        }else{
            return false;
        }
    }

    public function sair(){
        setcookie("nome_usuario", "", time() - 3600, "/");
        setcookie("senha_usuario", "", time() - 3600, "/");
        return redirect("/admin");
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
                    WHERE id = ?
                    SET titulo = ?, descricao = ?, dia = ?, horarioI = ?, horarioF = ?, vagas= ?, horas = ?)", 
                    [$id, $titulo, $descricao, $diaEvento, $hrInicio, $hrFim, $numVagas, $hrHoras]
                );
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
        $idpalestrante = DB::select("SELECT * FROM tb_palestrante WHERE nome = ?;", [$nomepalestrante])[0]->id;
        $url = $request->file('arquivo')->storeAs('storage/images/schedule/', "evento".$titulo.".".$request->file('imagem')->extension(), 'public');
        $types = array("png", "jpg", "jpeg", "webp", "avif", "jfif");

        DB::insert("INSERT INTO 
                    tb_evento(titulo,descricao,dia,horarioI,horarioF,vagas,horas,local,url,id_palestrante)
                    VALUES (?,?,?,?,?,?,?,?,?,?);", 
                    [$titulo,$descricao,$dia,$hrInicio,$hrFim,$numVagas,$numHoras,$local,$url,$idpalestrante]);

        return false;
    }
    
    public function insertPalestrante(Request $request): string{
        $nome = request("txtNome");
        $titulacao = request("txtTitulacao");
        $url = $request->file('arquivo')->storeAs('storage/images/avatar/', "palestra".$nome.".".$request->file('arquivo')->extension(), 'public');
        DB::insert("INSERT INTO 
                    tb_palestrante(nome,titulacao,url) 
                    VALUES(?,?,?);", 
                    [$nome,$titulacao,$url]);

        return false;
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

}
