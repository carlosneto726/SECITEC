<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlertController extends Controller
{
    public static function alert(string $mensagem, string $tipo){
        $_SESSION["mensagem"] = $mensagem;
        $_SESSION["tipo"] = $tipo;
    }
}