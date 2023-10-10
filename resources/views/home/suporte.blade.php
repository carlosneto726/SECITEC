@extends('templates.template')
@section('content')
<section class="schedule section-padding">
    <div class="container">
        <div>
            <h2 class="mb-5"><u class="text-success">Suporte</u></h2>
            <p class="fs-4 fw-bold mb-5 text-black">Nos contate <a href="mailto:secitec2023@gmail.com" target="_blank"><u class="text-success">aqui</u></a></p>
        </div>
        <div>
            <p class="fs-2 fw-bold mb-3 text-black">Perguntas frequentes:</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <p class="fs-5 fw-bold text-black" id="pergunta">O que devo fazer se esquecer minha senha de acesso ao site?</p>
                    <p class="fs-5 text-black" id="resposta">Ao clicar <a href="{{("/login")}}"><u class="text-success">aqui</u></a> você será redirecionado para a página de login. Acima do botão "Entrar" você seleciona <u class="text-success">Esqueceu a senha?</u>, e de continuidade ao passos para definir uma nova senha.</p>
                </li>
                <li class="list-group-item">
                    <p class="fs-5 fw-bold text-black" id="pergunta">Como posso atualizar minhas informações de cadastro?</p>
                    <p class="fs-5 text-black" id="resposta">Estando conectado a sua conta, selecione <u class="text-success">Meu perfil</u> e você estará apto para modificar seus dados.</p>
                </li>
                <li class="list-group-item">
                    <p class="fs-5 fw-bold text-black" id="pergunta">Não recebi o e-mail de confirmação de cadastro. O que devo fazer?</p>
                    <p class="fs-5 text-black" id="resposta">Você deve checar sua caixa de <u class="text-success">Spam</u> e verificar se o endereço de e-mail foi digitado corretamente ao tentar criar uma conta. Você pode tentar criar uma nova conta com o mesmo endereço de e-mail que você está tendo problema. Se o problema persistir, por favor entre em contato clicando <a href="mailto:secitec2023@gmail.com" target="_blank"><u class="text-success">aqui</u></a>.</p>
                </li>
                <li class="list-group-item">
                    <p class="fs-5 fw-bold text-black" id="pergunta">Posso criar uma conta em nome de outra pessoa, como um membro da minha família?</p>
                    <p class="fs-5 text-black" id="resposta">Não recomendamos essa conduta, pois os certificados serão gerados a partir das informações da sua conta. O que não será utilizado para o certificado, serão seu endereço de e-mail e sua senha, essas informações ficam a seu critério.</p>
                </li>
            </ul>
        </div>         
        </div>
    </div>
</section>
@endsection
