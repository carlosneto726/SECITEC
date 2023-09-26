<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Mail\AtivarConta;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ValidarUsuariosController extends Controller
{
    
    public function addUsuario(Request $request){
        $nome = $request->input("nome");
        $email = $request->input("email");
        $cpf = $request->input("cpf");
        $senha = Hash::make($request->input("senha"));
        $token = Str::random(60);

        // condição para verificar caso o cpf seja válido ou não
        if($this->validaCPF($cpf)){
            return response()->json(
                [
                    'message' => 'CPF inválido',
                    'type' => 'danger'
                ]
            );
        }

        $usuarios = DB::select("SELECT email, cpf FROM tb_usuario WHERE email = ? AND cpf = ?;", [$email, $cpf]);

        if(count($usuarios) > 0){
            return response()->json(
                [
                    'message' => 'Email ou CPF já cadastrado(s)',
                    'type' => 'danger'
                ]
            );
        }else{
            DB::insert('INSERT INTO tb_usuario (nome, email, cpf, senha, token, status) 
                        VALUES (?, ?, ?, ?, ?, 0);', 
            [$nome, $email, $cpf, $senha, $token]);
            $this->enviarEmail($email, $token);
            return response()->json(
                [
                    'message' => 'Enviamos um Email para '.$email.' para a ativação da conta.',
                    'type' => 'warning'
                ]
            );
        }
    }

    public function validarEmail(){
        $token = request("token");
        DB::update("UPDATE tb_usuario SET status = 1, token = '' WHERE token = ?", [$token]);
        return redirect("/login");
    }

    public function validarLogin(){
        $email = request("email");
        $senha = request("senha");

        $usuarios = DB::select("SELECT * FROM tb_usuario WHERE email = ? AND status = 1;",
        [$email]);

        if(count($usuarios) > 0){
            if(Hash::check($senha, $usuarios[0]->senha)){
                setcookie("usuario", $usuarios[0]->id, time() + (86400 * 30), "/");
                setcookie("nome_usuario", explode(" ", $usuarios[0]->nome)[0], time() + (86400 * 30), "/");
                echo "validado com sucesso";
                return redirect("/");
            }else{
                echo "E-mail ou senha incorreto(s)";
                return redirect("/entrar");
            }
        }else{
            echo "E-mail ou senha incorreto(s)";
            return redirect("/entrar");
        }
    }

    public function sair(){
        setcookie("usuario", "", time() - 3600, "/");
        setcookie("nome_usuario", "", time() - 3600, "/");
        setcookie("nome_usuario", "", time() - 3600, "/");
        setcookie("senha_usuario", "", time() - 3600, "/");
        return redirect("/");
    }

    public function enviarEmail($email, $token){
        $url = "http://127.0.0.1:8000/validar/usuario/".$token;
        Mail::to($email)->send(new AtivarConta($url, 'ativarConta'));
    }

    function validaCPF($cpf) {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se todos os dígitos são iguais (caso contrário, são inválidos)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Calcula e verifica o primeiro dígito verificador
        for ($i = 9, $j = 0, $soma = 0; $i > 0; $i--, $j++) {
            $soma += $cpf[$j] * $i;
        }
        $resto = $soma % 11;
        $dv1 = ($resto < 2) ? 0 : 11 - $resto;
    
        // Calcula e verifica o segundo dígito verificador
        for ($i = 9, $j = 1, $soma = 0; $i >= 0; $i--, $j++) {
            $soma += $cpf[$j] * $i;
        }
        $resto = $soma % 11;
        $dv2 = ($resto < 2) ? 0 : 11 - $resto;
    
        // Verifica se os dígitos verificadores estão corretos
        return ($cpf[9] == $dv1 && $cpf[10] == $dv2);
    }
    
}
