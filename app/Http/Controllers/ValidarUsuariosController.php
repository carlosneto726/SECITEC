<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\AtivarConta;
use App\Http\Controllers\AlertController;
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
        $cpf = preg_replace( '/[^0-9]/is', '', $request->input("cpf"));
        $senha = Hash::make($request->input("senha")); // Senha criptografada
        $token = request("token"); // Token gerado aleatoriamente

        // condição para verificar caso o cpf seja válido ou não
        if(!$this->validaCPF($cpf)){
            AlertController::alert("CPF inválido", "danger");
            return redirect("/usuarios/cadastrar/".$token);
        }

        $usuarios = DB::select("SELECT cpf FROM tb_usuario WHERE cpf = ?;", [$cpf]);
        if(count($usuarios) > 0){
            AlertController::alert("CPF já cadastrado(s)", "danger");
            return redirect("/usuarios/cadastrar/".$token);
        }else{
            try {
                DB::update('UPDATE tb_usuario 
                            SET nome = ?, 
                            cpf = ?, 
                            senha = ?, 
                            status = 1 
                            WHERE token  = ?;', 
                            [$nome, $cpf, $senha, $token]);
                            
                    AlertController::alert("Conta criada com sucesso", "success");
                    return redirect("/login");
            } catch (\Throwable $th) {
                AlertController::alert("Ocorreu um erro, tente novamente ou contate o suporte.", "danger");
                return redirect("/usuarios/cadastrar/".$token);
            }
        }
    }

    public function validarEmail(){
        $email = request("email");
        $token = Str::random(60);
        $usuario = DB::select("SELECT email FROM tb_usuario WHERE email = ?;", [$email]);
        if(count($usuario) > 0){
            AlertController::alert("Email já cadastrado", "warning");
            return redirect("/cadastrar");
        }else{
            DB::insert("INSERT INTO tb_usuario(email, token, status) VALUES(?, ?, 0)", [$email, $token]);
            $this->enviarEmail($email, "usuarios/cadastrar/".$token, "ativarConta");

            AlertController::alert("Email enviado.", "success");
            return redirect("/");
        }
    }

    public function viewUsuarioCadastrar(){
        $token = request("token");
        $usuario = DB::select("SELECT * FROM tb_usuario WHERE token = ?;", [$token]);
        if(count($usuario) > 0){
            return view("usuarios.cadastrarUser.view", compact("token"));
        }else{
            AlertController::alert("Link inválido", "danger");
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

                AlertController::alert("Usuário validado com sucesso.", "success");
                return redirect("/eventos");
            }else{
                AlertController::alert("Email ou senha incorreto(s).", "danger");
                return redirect("/login");
            }
        }else{
            AlertController::alert("Email ou senha incorreto(s).", "danger");
            return redirect("/login");
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
            AlertController::alert("Email inválido.", "danger");
            return redirect("/login");
        }
        $this->enviarEmail($email, 'atualizar-senha/'.$token, 'redefinirSenha');
        AlertController::alert("Email enviado.", "success");
        return redirect("/login");
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
        $usuario = DB::select("SELECT * FROM tb_usuario WHERE token = ? AND status = 1;", [$token]);

        if(count($usuario) == 1){
            DB::update("UPDATE tb_usuario SET senha = ?, token = 0 WHERE token = ?", [$senha, $token]);
            AlertController::alert("Senha atualizada com sucesso.","success");
            return redirect("/login");
        }else{
            AlertController::alert("Sua conta não foi ativada.","danger");
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
