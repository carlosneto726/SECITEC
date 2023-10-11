<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait PresencaTrait {

    public function viewCheckin(){
        $orderBy = "ORDER BY tb_usuario.cpf, tb_evento_usuario.checkin;";
        $usuarios_evento = $this->getUsuariosEvento(request('id_evento'), $orderBy);
        return view("admin.events.checkin", compact("usuarios_evento"));
    }

    public function viewCheckout(){
        $orderBy = "ORDER BY tb_usuario.cpf, tb_evento_usuario.checkout;";
        $usuarios_evento = $this->getUsuariosEvento(request('id_evento'), $orderBy);
        return view("admin.events.checkout", compact("usuarios_evento"));
    }

    private function getUsuariosEvento($id_evento, $orderBy){
        $usuario_evento = DB::select("  SELECT tb_usuario.nome,
                                        tb_usuario.id,
                                        tb_usuario.cpf,
                                        tb_evento_usuario.checkin,
                                        tb_evento_usuario.checkout,
                                        tb_evento_usuario.status,
                                        tb_evento_usuario.data_insercao
                                        FROM tb_evento_usuario
                                        INNER JOIN tb_usuario ON tb_usuario.id = tb_evento_usuario.id_usuario
                                        WHERE tb_evento_usuario.id_evento = ? ".$orderBy, [$id_evento]);
        return $usuario_evento;
    }

    public function checkIn(){
        $cpf = request("cpf"); // CPF
        $id_evento = request("id_evento");
        $confirmacao = request("confirmacao");

        try {
            $id_eventousuario = $this->getusUarioId($cpf, $id_evento)->id_evento;
            $id_usuario = $this->getusUarioId($cpf, $id_evento)->id_usuario;
        } catch (\Throwable $th) {
            return response()->json(['id_modal' => 'modalerro']);
        }


        if($id_eventousuario == false){ return response()->json(['id_modal' => 'modalerro']); }
        $checkin = DB::select("SELECT * FROM tb_evento_usuario WHERE id = ?;", [$id_eventousuario]);
        date_default_timezone_set('America/Sao_Paulo');
        $horarioAtual = date("H:i:s");
        if(($checkin[0]->checkin == null && $confirmacao == false && $checkin[0]->status == 0) || $confirmacao){
            DB::update("UPDATE tb_evento_usuario
                        SET checkin = ?
                        WHERE id = ?;",
                        [$horarioAtual,$id_eventousuario]
            );
            return response()->json(
                [
                    'message' => 'Checkin efetuado com sucesso.',
                    'type' => 'success',
                    'reload' => 'false',
                    'cpf' => $cpf,
                    'hora_atual' => $horarioAtual,
                    'id_usuario' => $id_usuario

                ]
            );
        }else{
            if($checkin[0]->status == 1){ 
                return response()->json( ['id_modal' => 'fila'] ); 
            }
            return response()->json( ['id_modal' => 'modalcheckin'] );
        }
    }

    public function checkOut(){
        $cpf = request("cpf"); // CPF
        $id_evento = request("id_evento");
        $confirmacao = request("confirmacao");

        try {
            $id_eventousuario = $this->getusUarioId($cpf, $id_evento)->id_evento;
            $id_usuario = $this->getusUarioId($cpf, $id_evento)->id_usuario;
        } catch (\Throwable $th) {
            return response()->json(['id_modal' => 'modalerro']);
        }

        if($id_eventousuario == false){ return response()->json(['id_modal' => 'modalerro']); }
        $checkout = DB::select("SELECT * FROM tb_evento_usuario WHERE id = ?;", [$id_eventousuario])[0]->checkout;
        date_default_timezone_set('America/Sao_Paulo');
        $horarioAtual = date("H:i:s");

        if(($checkout == null && $confirmacao == false) || $confirmacao){
            DB::update("UPDATE tb_evento_usuario
                        SET status = 1, checkout = ?
                        WHERE id = ?;",
                        [$horarioAtual, $id_eventousuario]);
            return response()->json(
                [
                    'message' => 'Checkout efetuado com sucesso.',
                    'type' => 'success',
                    'reload' => 'false',
                    'cpf' => $cpf,
                    'hora_atual' => $horarioAtual,
                    'id_usuario' => $id_usuario

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
    private function getusUarioId($cpf, $idevento){
        $ideventousuario = DB::select(" SELECT tb_evento_usuario.id AS id_evento,
                                        tb_evento_usuario.id_usuario AS id_usuario
                                        FROM tb_evento_usuario
                                        LEFT JOIN tb_usuario
                                        ON tb_evento_usuario.id_usuario = tb_usuario.id
                                        LEFT JOIN tb_evento
                                        ON tb_evento_usuario.id_evento = tb_evento.id
                                        WHERE tb_usuario.cpf = ? and tb_evento.id = ?;", 
                                        [$cpf, $idevento]
        );
        if(count($ideventousuario) == 0){
            return false;
        }else{
            return $ideventousuario[0];
        }
    }

}