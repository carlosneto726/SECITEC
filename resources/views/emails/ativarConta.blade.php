<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Conta</title>
</head>
<body style="font-style: Courier New, monospace;">
    <!-- Inserindo imagens no email -->
    <img src="https://secitecformosa.online/images/logo_email.jpg" style="width: 20%; ">
    <!-- Texto para e link para ativação da conta -->
    <h2>Olá!</h2>
        <h3>Para criar uma conta clique <a href="{{$dados}}">aqui</a>.</h3>

        <small style="font-size: 16px;">
            Ao clicar no link, você será redirecionado para a página de cadastramento de conta. 
            Nesta página, basta inserir o seu nome completo, CPF, senha e apertar o botão de <a href="#cadastrar" style="color: #17882c;">Cadastrar</a> para criar sua conta.
        </small>
    <br>
    <br>
    <!-- Imagem mostrando página de cadastro de conta -->
        <center><img src="https://secitecformosa.online/images/cadastrar_conta.png" id="cadastrar" style="width: 60%; "></center>
    <br>
    <br>
        <small style="font-size: 16px;">
            Após cadastradar-se você será redirecionado para a página de login. 
            Na página de login, basta inserir o e-mail cadastrado e a sua senha para participar dos eventos.
        </small>
    <br>
    <br>
    <!-- Imagem mostrando página de login -->
        <center><img src="https://secitecformosa.online/images/entrar_email.png" style="width: 60%; "></center>
    <br>
    <br>
    <small style="color: red;">Este email foi gerado e enviado automáticamente, por favor não responda essa mensagem</small>
</body>
</html>
