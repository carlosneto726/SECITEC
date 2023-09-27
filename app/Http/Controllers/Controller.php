<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
session_start();

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function viewHome(){
        return view("home.view");
    }

    public function viewSobre(){
        return view("sobre.view");
    }

    public function viewLocal(){
        return view("local.view");
    }

    public function viewProgramacao(){
        return view("programacao.view");
    }
    public function viewLogin(){
        return view("usuarios.loginUser.view");
    }
    public function viewCadastrar(){
        return view("usuarios.cadastrarUser.view");
    }
    public function viewTermos(){
        return view("home.termos");
    }

}
