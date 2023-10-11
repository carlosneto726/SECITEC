<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait AdminTrait {
    public function viewEventos(){
        $eventos = DB::select(" SELECT e.*, te.nome AS tipo_evento_nome
                                FROM tb_evento AS e
                                INNER JOIN tb_tipo_evento AS te ON e.id_tipo_evento = te.id
                                WHERE te.id != 4 ORDER BY titulo;
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

        $palestrantes = DB::select("SELECT * FROM tb_proponente WHERE id != 7 AND id != 8 AND id != 9 AND id != 10 ORDER BY nome;");
        $tipoEventos = DB::select("SELECT * FROM tb_tipo_evento WHERE id != 4;");
        return view("admin.events.view", compact("eventos", "palestrantes", "tipoEventos"));
    }
}
