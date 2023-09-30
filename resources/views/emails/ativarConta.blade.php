<!DOCTYPE html>
<html>
<head>
    <title>Confirmação de Email</title>
</head>
<body style="font-style: Courier New, monospace;">
    <!-- Inserindo imagens no email -->
    <img src="https://secitecformosa.online/images/logo_email.jpg" style="width: 20%; ">
    <!-- Texto para e link para ativação da conta -->
    <h2>Olá!</h2>
        <h4>Para ativar sua conta clique <a href="{{$dados}}">aqui</a>.</h4>
    
        <small style="font-size: 13px;">
            Ao clicar no link, sua conta será ativada e você será redirecionado para a página de login. 
            Na página de login, basta inserir o e-mail cadastrado e a sua senha para participar dos eventos.
        </small>
    <br>
    <!-- Imagem mostrando página de login -->
        <img src="https://secitecformosa.online/images/entrar_email.png" style="width: 60%; ">
    <br>
    <br>
    <small style="color: red;">Este email foi gerado e enviado automáticamente, por favor não responda essa mensagem</small>
</body>
</html>
