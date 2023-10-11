<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AlertController;
use Illuminate\Http\Request;

class ValidarAdmController extends Controller
{
    public function viewAdm(){
        $login = @$_COOKIE['ADM_USER'];
        $senha = @$_COOKIE['ADM_PASSWORD'];
        if(isset($login) && isset($senha)){
            if($this->validarLogin($login, $senha)){
                return view("admin.home");
            }
        }else{
            // Condição para caso o usuário não tenha feiro logout para acessar a pagina de administrador
            if(isset($_COOKIE['usuario']) || isset($_COOKIE['nome_usuario'])){
                return redirect("/");
            }
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

    public function sair(){
        setcookie("ADM_USER", "", time() - 3600, "/");
        setcookie("ADM_PASSWORD", "", time() - 3600, "/");
        setcookie("ADM_TIPO", "", time() - 3600, "/");
        return redirect("/");
    }

    public function validarLogin($login, $senha){
        
        if($login == env('ADM_USER') && $senha == env('ADM_PASSWORD')){
            setcookie("ADM_USER", $login, time() + (86400 * 30), "/");
            setcookie("ADM_PASSWORD", $senha, time() + (86400 * 30), "/");
            setcookie("ADM_TIPO", "0", time() + (86400 * 30), "/");
            return true;

        }else if($login == env('ADM_MONITORAMENTO_USER') && $senha == env('ADM_MONITORAMENTO_PASSWORD')){
            setcookie("ADM_USER", $login, time() + (86400 * 30), "/");
            setcookie("ADM_PASSWORD", $senha, time() + (86400 * 30), "/");
            setcookie("ADM_TIPO", "1", time() + (86400 * 30), "/");
            return true;

        }else if($login == env('ADM_PRESENCA_USER') && $senha == env('ADM_PRESENCA_PASSWORD')){
            setcookie("ADM_USER", $login, time() + (86400 * 30), "/");
            setcookie("ADM_PASSWORD", $senha, time() + (86400 * 30), "/");
            setcookie("ADM_TIPO", "2", time() + (86400 * 30), "/");
            return true;

        }else{
            return false;
        }
    }
}
