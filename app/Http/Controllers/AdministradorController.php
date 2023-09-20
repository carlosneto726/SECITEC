<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministradorController extends Controller
{
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
                    VALUES( titulo = ?, descricao = ?, dia = ?, horarioI = ?, horarioF = ?, vagas= ?, horas = ?)", 
                    [$id, $titulo, $descricao, $diaEvento, $hrInicio, $hrFim, $numVagas, $hrHoras]
                );
    }
}
