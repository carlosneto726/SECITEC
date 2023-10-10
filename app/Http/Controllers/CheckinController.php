<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public $nome_usuario; 
    public $senha_usuario;
    public function __construct() {
        $this->nome_usuario = $_COOKIE['ADM_USER'];
        $this->senha_usuario = $_COOKIE['ADM_PASSWORD'];

        if(!isset($this->nome_usuario) && !isset($this->senha_usuario)){
            abort(404, "Tem que se validar meu chapinha");
        }
    }

}
