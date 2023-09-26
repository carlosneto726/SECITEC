<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramacaoController extends Controller
{
    public function viewProgramacao()
    {
        $programacoes = DB::select("SELECT * FROM vw_evento_proponente ORDER BY horarioI ASC");
        json_encode($programacoes);
        return view("programacao.view", compact("programacoes"));
    }
}
