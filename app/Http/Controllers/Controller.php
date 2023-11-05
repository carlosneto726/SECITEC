<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use ZipArchive;

session_start();

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function viewHome(){
        return view("home.view");
    }

    public function viewSobre(){
        return view("sobre.view");
    }

    public function viewLocal(){
        return view("local.view");
    }

    public function viewProgramacao(){
        return view("programacao.view");
    }
    public function viewLogin(){
        return view("usuarios.loginUser.view");
    }
    public function viewCadastrar(){
        return view("usuarios.cadastrarUser.verificarEmail");
    }
    public function viewTermos(){
        return view("home.termos");
    }

    public function viewCreditos(){
        return view("home.creditos");
    }

    public function viewSuporte(){
        return view("home.suporte");
    }

    public function viewProponente(Request $request){
        $id = request("id");
        $proponente = DB::select("SELECT * FROM tb_proponente WHERE id = ?;", [$id])[0];
        $redes = DB::select("SELECT * FROM tb_redes_proponente WHERE id_proponente = ?;",[$id])[0];
        $proponente->redes = $redes;
        $eventos = DB::select(" SELECT * FROM tb_evento
                                INNER JOIN tb_proponente_evento ON tb_evento.id = tb_proponente_evento.id_evento
                                WHERE tb_proponente_evento.id_proponente = ?;", [$id]);
        foreach($eventos as $evento){
            $tipo_evento = DB::select(" SELECT * FROM tb_tipo_evento WHERE id = ?;", [$evento->id_tipo_evento]); 
            $evento->tipo_evento = $tipo_evento;
        }
        return view("proponente.view", compact("proponente", "eventos"));
    }

    public function viewEvento(Request $request){
        $id = request("id");
        $evento = DB::select("SELECT * FROM tb_evento WHERE id = ?;", [$id]);
        $proponentes = DB::select(" SELECT * FROM tb_proponente 
                                    INNER JOIN tb_proponente_evento ON tb_proponente.id = tb_proponente_evento.id_proponente
                                    WHERE tb_proponente_evento.id_evento = ?;", [$id]);
        return view("evento.view", compact("evento", "proponentes"));
    }

    public function viewCertificados(Request $request){
        $certificados_usuario = [];
        $certificados_proponente = [];
        $certificados_monitor = [];
        $certificados_desenvolvedor = [];
        $certificados_credenciamento = [];
        $certificados_comissao = [];

        $files = scandir('pdfs/usuarios');
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                array_push($certificados_usuario, $file);
            }
        }

        $files = scandir('pdfs/proponentes');

        foreach ($files as $file) {

            if ($file != "." && $file != ".." && $file != "") {
                @list($nome, $evento) = explode("-", $file);
                if (!isset($certificados_proponente[$nome])) {
                    $certificados_proponente[$nome] = [];
                }
                
                $certificados_proponente[$nome][] = $file;
            }
        }


        $files = scandir('pdfs/organizadores/MONITORES');
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                array_push($certificados_monitor, $file);
            }
        }

        $files = scandir('pdfs/organizadores/DESENVOLVEDORES');
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                array_push($certificados_desenvolvedor, $file);
            }
        }

        $files = scandir('pdfs/organizadores/COMISSAO');
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                array_push($certificados_comissao, $file);
            }
        }

        $files = scandir('pdfs/organizadores/CREDENCIAMENTO');
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                array_push($certificados_credenciamento, $file);
            }
        }

        return view("certificados.view", compact("certificados_usuario", "certificados_proponente", "certificados_monitor", "certificados_desenvolvedor", "certificados_comissao", "certificados_credenciamento"));
    }
}
