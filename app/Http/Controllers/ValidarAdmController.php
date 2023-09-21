<?php

namespace App\Http\Controllers;

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
            return redirect("/admin");
        }else{
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
