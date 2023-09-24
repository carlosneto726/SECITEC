<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AlertController;

use Illuminate\Http\Request;

class ValidarAdmController extends Controller
{
    public function viewAdm(){
        $login = @$_COOKIE['nome_usuario'];
        $senha = @$_COOKIE['senha_usuario'];
        if(isset($login) && isset($senha)){
            if($this->validarLogin($login, $senha)){
                return view("admin.home");
            }
        }else{
            return view("admin.entrar");
        }
    }

    public function entrar(){
        $login = request("txtNome");
        $senha = request("txtSenha");
        if($this->validarLogin($login, $senha)){
            AlertController::alert('Logado com sucesso.', 'success');
            return redirect("/admin");
        }else{
            AlertController::alert('Usuáio ou senha incorreto(s)', 'danger');
            return redirect("/admin");
        }
    }

    public function validarLogin($login, $senha){
        $env_login = env('ADM_USER');
        $env_senha = env('ADM_PASSWORD');
        if($login == $env_login && $senha == $env_senha){
            setcookie("nome_usuario", $login, time() + (86400 * 30), "/");
            setcookie("senha_usuario", $senha, time() + (86400 * 30), "/");
            return true;
        }else{
            return false;
        }
    }
}
