<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidarUsuariosController extends Controller
{
    public function viewUsuarios(){
        $login = @$_COOKIE['nome_usuario'];
        $senha = @$_COOKIE['senha_usuario'];
        if(isset($login) && isset($senha)){
            if($this->validarLogin($login, $senha)){
                return view("home.view");
            }
        }else{
            return view("usuarios.loginUser.view");
        }
    }

    public function loginUser(){
        $login = request("txtNome");
        $senha = request("txtSenha");
        
        if($this->validarLogin($login, $senha)){
            return redirect("/usuarios");
        }else{
            return redirect("/usuarios");
        }
    }

    public function validarLogin($login, $senha){
        
        setcookie("nome_usuario", $login, time() + (86400 * 30), "/");
        setcookie("senha_usuario", $senha, time() + (86400 * 30), "/");
        return true;
      
    }
}
