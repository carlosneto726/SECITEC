<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\AtivarConta;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| ValidarUsuáriosController
|--------------------------------------------------------------------------
|
| Este Controller é responsável por executar funções relacionadas a validação
| no quesito de login e email, criação de contas, validação de cpf e etc.
|
*/

class ValidarUsuariosController extends Controller
{
    
    public function addUsuario(Request $request){
        $nome = $request->input("nome");
        $email = $request->input("email");
        $cpf = $request->input("cpf");
        $senha = Hash::make($request->input("senha")); // Senha criptografada
        $token = Str::random(60); // Token gerado aleatoriamente

        // condição para verificar caso o cpf seja válido ou não
        if(!$this->validaCPF($cpf)){
            return response()->json(
                [
                    'message' => 'CPF inválido',
                    'type' => 'danger',
                    'endpoint' => '/cadastrar'
                ]
            );
        }

        $usuarios = DB::select("SELECT email, cpf FROM tb_usuario WHERE email = ? OR cpf = ?;", [$email, $cpf]);
        if(count($usuarios) > 0){
            return response()->json(
                [
                    'message' => 'Email ou CPF já cadastrado(s)',
                    'type' => 'danger',
                    'endpoint' => '/cadastrar'
                ]
            );
        }else{
            try {
                $this->enviarEmail($email, 'validar/usuario/'.$token, 'ativarConta');
                DB::insert('INSERT INTO tb_usuario (nome, email, cpf, senha, token, status) 
                            VALUES (?, ?, ?, ?, ?, 0);', 
                            [$nome, $email, $cpf, $senha, $token]);
                return response()->json(
                    [
                        'message' => 'Enviamos um Email para '.$email.'. Verifique a sua caixa de entrada e a caixa de spam.',
                        'type' => 'warning',
                        'endpoint' => '/login'
                    ]
                );
            } catch (\Throwable $th) {
                return response()->json(
                    [
                        'message' => 'Email inválido, por favor insira outro endereço de Email.',
                        'type' => 'danger',
                        'endpoint' => '/cadastrar'
                    ]
                );
            }
        }
    }

    public function validarEmail(){
        $token = request("token");
        $query = DB::update("UPDATE tb_usuario SET status = 1, token = '' WHERE token = ?", [$token]);
        if($query){
            return redirect("/login");
        }else{
            return redirect("/cadastrar");
        }
    }

    public function validarLogin(){
        $email = request("email");
        $senha = request("senha");

        $usuarios = DB::select("SELECT * FROM tb_usuario WHERE email = ? AND status = 1;",
        [$email]);

        if(count($usuarios) > 0){
            if(Hash::check($senha, $usuarios[0]->senha)){ // A função Hasg::check compara o hash da senha do bd e a senha que o usário digitou.
                setcookie("usuario", $usuarios[0]->id, time() + (86400 * 30), "/");
                setcookie("nome_usuario", explode(" ", $usuarios[0]->nome)[0], time() + (86400 * 30), "/");
                return response()->json(
                    [
                        'message' => 'Usuário validado com sucesso.',
                        'type' => 'success',
                        'endpoint' => '/eventos'
                    ]
                );
            }else{
                return response()->json(
                    [
                        'message' => 'Email ou senha incorreto(s).',
                        'type' => 'danger',
                        'endpoint' => '/login'
                    ]
                );
            }
        }else{
            return response()->json(
                [
                    'message' => 'Email ou senha incorreto(s).',
                    'type' => 'danger',
                    'endpoint' => '/login'
                ]
            );
        }
    }

    // Esvazia todos os cookies
    public function sair(){
        setcookie("usuario", "", time() - 3600, "/");
        setcookie("nome_usuario", "", time() - 3600, "/");
        setcookie("nome_usuario", "", time() - 3600, "/");
        setcookie("senha_usuario", "", time() - 3600, "/");
        return redirect("/");
    }


    public function redefinirSenhaEmail(){
        $email = request("email");
        $token = Str::random(60);
        $update_usuario = DB::update("UPDATE tb_usuario SET token = ? WHERE email = ?", [$token, $email]);
        if($update_usuario == 0){
            return response()->json(
                [
                    'message' => 'Email inválido.',
                    'type' => 'danger',
                    'endpoint' => '/login'
                ]
            );
        }
        $this->enviarEmail($email, 'atualizar-senha/'.$token, 'redefinirSenha');
        return response()->json(
            [
                'message' => 'Email enviado.',
                'type' => 'success',
                'endpoint' => '/login'
            ]
        );
    }

    public function viewAtualizarSenha(){
        $token = request("token");
        $usuario = DB::select("SELECT token FROM tb_usuario WHERE token = ?", [$token]);
        if(count($usuario) == 0){
            return redirect("/login");
        }
        return view("usuarios.atualizarSenha", compact("token"));
    }

    public function redefinirSenha(){
        $token = request("token");
        $senha = Hash::make(request("senha"));
        $usuario = DB::select("SELECT * FROM tb_usuario WHERE token = ?", [$token]);

        if(count($usuario) == 1){
            DB::update("UPDATE tb_usuario SET senha = ?, token = 0 WHERE token = ?", [$senha, $token]);
            AlertController::alert("Senha atualizada com sucesso.","success");
            return redirect("/login");
        }else{
            AlertController::alert("Ocorreu um erro","danger");
            return redirect("/redefinir-senha");
        }
    }






    // Função que envia um email para a ativação da conta, o token no 
    // link é o mesmo armazenado no bando de dados na tb_usuario, quando o 
    // usuário acessar o link, a conta dele é ativada e o token é apagado
    public function enviarEmail($email, $endpoint, $tipo){
        $url = "https://secitecformosa.online/".$endpoint;
        Mail::to($email)->send(new AtivarConta($url, $tipo));
    }

    // Skynet kkkkk
    function validaCPF($cpf) {
 
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    
    }
    
}
