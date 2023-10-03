<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramacaoController extends Controller
{
    public function viewProgramacao()
    {
        $eventos = DB::select("SELECT * FROM vw_evento_proponente");
        foreach ($eventos as $evento) {
            $proponentes = DB::select(" SELECT *, tb_proponente.id as id_proponente FROM tb_proponente
                                        INNER JOIN tb_proponente_evento ON tb_proponente.id = tb_proponente_evento.id_proponente
                                        WHERE tb_proponente_evento.id_evento = ? ORDER BY dia;", [$evento->id]);
            $evento->proponentes = $proponentes;
        }
        return view("programacao.view", compact("eventos"));
    }
}
