<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramacaoController extends Controller
{
    public function viewProgramacao()
    {
        $programacoes = array(
            $this->getEventos("2023-10-23"),
            $this->getEventos("2023-10-24"),
            $this->getEventos("2023-10-25"),
            $this->getEventos("2023-10-26")
        );
        return view("programacao.view", compact("programacoes"));
    }
    
    public function getEventos($data){
        $eventos = DB::select("SELECT * FROM vw_evento_proponente WHERE dia = ? ORDER BY horarioI ASC", [$data]);
        foreach ($eventos as $evento) {
            $proponentes = DB::select(" SELECT *, tb_proponente.id as id_proponente FROM tb_proponente
                                        INNER JOIN tb_proponente_evento ON tb_proponente.id = tb_proponente_evento.id_proponente
                                        WHERE tb_proponente_evento.id_evento = ?;", [$evento->id]);
            $evento->proponentes = $proponentes;
        }
        $dia = explode("-", $data);
        return array('dia' => $dia[2]."/".$dia[1]."/".$dia[0], $eventos);
    }
}
