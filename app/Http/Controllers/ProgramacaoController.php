<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramacaoController extends Controller
{
    public function viewProgramacao()
    {
        $programacoes = DB::select("SELECT * FROM vw_evento_proponente ORDER BY horarioI ASC");
        foreach ($programacoes as $programacao) {
            $proponentes = DB::select(" SELECT * FROM tb_proponente
                                        INNER JOIN tb_proponente_evento ON tb_proponente.id = tb_proponente_evento.id_proponente
                                        WHERE tb_proponente_evento.id_evento = ?;", [$programacao->id]);
            $programacao->proponentes = $proponentes;
        }
        json_encode($programacoes);
        return view("programacao.view", compact("programacoes"));
    }
}
