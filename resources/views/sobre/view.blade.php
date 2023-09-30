@extends('templates.template')
@section('content')
<!--Sobre-->
<section class="about section-padding" id="section_2">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item dropdown">
                <h2><a class=" dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Sobre</a>
                <ul class="dropdown-menu">
                <li><a onclick="selecionarSecao(0)" class="dropdown-item" href="#"><p>O que é a <u class="text-success">SECITEC?</u></p></a></li>
                <li><a onclick="selecionarSecao(1)" class="dropdown-item" href="#"><p>O que <u class="text-success">promovemos?</u></p></a></li>
                <li><a onclick="selecionarSecao(2)" class="dropdown-item" href="#"><p>Como <u class="text-success">participar?</u></p></a></li>
                </ul>
                </h2>
            </li>
        </ul>
        <!--SOBRE O EVENTO-->
        <div class="row show" id="sobre-section">
            <div class="col-lg-12 col-12 p-5 ">
                <div class="">
                    <h2 class="mb-4">O que é a <u class="text-success">SECITEC?</u></h2>
                </div>
                <!--Conteúdo/texto sobre a secitec-->
                <div class="row border border-light-subtle rounded-4 p-5" >
                    <div class="col align-self-center">
                        <h3 class="mb-3">SECITEC</h3>
                        <p>
                            O Instituto Federal de Educação, Ciência e Tecnologia de Goiás, campus <span class="text-success fw-bolder">Formosa</span>, participa da Semana Nacional de Ciência e Tecnologia desde sua criação em 2010. Nós promovemos, a nível local, a Semana de Educação, Ciência e Tecnologia (<span class="text-success fw-bolder">SECITEC</span>).
                        </p>
                        <p>
                            Na sua <span class="text-success fw-bolder">XIV</span> edição, a <span class="text-success fw-bolder">SECITEC</span> do Campus <span class="text-success fw-bolder">Formosa</span> acontecerá entre os <span class="text-success fw-bolder">dias 23 e 26 de outubro</span>. Mantemos nosso compromisso de realizar um evento aberto e diversificado, atendendo às necessidades acadêmicas de nossas diversas áreas, além de fomentar o diálogo essencial entre as instituições de ensino profissional e superior e as escolas de educação básica do Município de <span class="text-success fw-bolder">Formosa</span>.
                        </p>
                        <p>
                            A programação oficial da <span class="text-success fw-bolder">SECITEC</span> inclui palestras abrangendo diversas áreas do conhecimento, trazendo intelectuais e estudiosos para a cidade de Formosa. Além disso, oferecemos oficinas e minicursos ministrados por professores da instituição, profissionais de outras instituições e estudantes. A apresentação de trabalhos acadêmicos é uma atividade cada vez mais organizada e integrada ao evento.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!--PROMOVEMOS-->
        <div class="row" id="sobre-section">
            <div class="col-lg-12 col-12 p-5 ">
                    <div class="">
                        <h2 class="mb-4">O que <u class="text-success">promovemos?</u></h2>
                    </div>
                    <!--Ícones que preenchem "promovemos"-->
                    <div class="row justify-content-md-center text-center border border-light-subtle rounded-4 p-5 ">
                    <!--Primeiro ícone-->
                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                        </svg>
                        <p class="fs-6 pt-3 text-reset">NETWORKING</p>
                    </div>
                    <!--Segundo ícone-->
                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                            <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                        </svg>
                        <p class="fs-6 pt-3 text-reset">CERTIFICADOS</p>
                    </div>
                    <!--Terceiro ícone-->
                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                        </svg>
                        <p class="fs-6 pt-3 text-reset">OFICINAS</p>
                    </div>
                    <!--Quarta ícone-->
                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-highlighter" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.096.644a2 2 0 0 1 2.791.036l1.433 1.433a2 2 0 0 1 .035 2.791l-.413.435-8.07 8.995a.5.5 0 0 1-.372.166h-3a.5.5 0 0 1-.234-.058l-.412.412A.5.5 0 0 1 2.5 15h-2a.5.5 0 0 1-.354-.854l1.412-1.412A.5.5 0 0 1 1.5 12.5v-3a.5.5 0 0 1 .166-.372l8.995-8.07.435-.414Zm-.115 1.47L2.727 9.52l3.753 3.753 7.406-8.254-2.905-2.906Zm3.585 2.17.064-.068a1 1 0 0 0-.017-1.396L13.18 1.387a1 1 0 0 0-1.396-.018l-.068.065 2.85 2.85ZM5.293 13.5 2.5 10.707v1.586L3.707 13.5h1.586Z"/>
                        </svg>
                        <p class="fs-6 pt-3 text-reset">INSIGHTS</p>
                    </div>
                    <!--Quinto ícone-->
                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-code" viewBox="0 0 16 16">
                            <path d="M5.854 4.854a.5.5 0 1 0-.708-.708l-3.5 3.5a.5.5 0 0 0 0 .708l3.5 3.5a.5.5 0 0 0 .708-.708L2.707 8l3.147-3.146zm4.292 0a.5.5 0 0 1 .708-.708l3.5 3.5a.5.5 0 0 1 0 .708l-3.5 3.5a.5.5 0 0 1-.708-.708L13.293 8l-3.147-3.146z"/>
                        </svg>
                        <p class="fs-6 pt-3 text-reset">HACKATHON</p>
                    </div>
                    <!--Sexto ícone-->
                    <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-standing" viewBox="0 0 16 16">
                            <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM6 6.75v8.5a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2.75a.75.75 0 0 0 1.5 0v-2.5a.25.25 0 0 1 .5 0Z"/>
                        </svg>
                        <p class="fs-6 pt-3 text-reset">PALESTRAS</p>
                    </div>
                </div>
            </div>
        </div>

        <!---->
        <div class="row" id="sobre-section">
            <div class="col-lg-12 col-12 p-5 ">
                <div class="">
                    <h2 class="mb-4">Como <u class="text-success">participar?</u></h2>
                </div>
                <!--Conteúdo/texto sobre a secitec-->
                <div class="row border border-light-subtle rounded-4 p-5" >
                    <div class="col align-self-center">
                        <h3 class="mb-3"><a class="" href="{{ url('/cadastrar') }}">Cadastre-se</a></h3>
                        <p class="mb-5">Para ter acesso ao conteúdo de programação e se inscrever em nossos eventos, basta se cadastrar clicando <a class="" href="{{ url('/cadastrar') }}"><span class="text-success fw-bolder">aqui</span></a>. Somente dessa forma você poderá desfrutar de nosso evento.</p>
                        <h3 class="mb-3">Check-in e Check-out</h3>
                        <p class="mb-5">Ao chegar ao evento, você será solicitado a fazer o <span class="text-success fw-bolder">check-in</span> escaneando o código de barras em seu <span class="text-success fw-bolder">crachá</span>. Da mesma forma, quando você sair do evento, será necessário fazer o <span class="text-success fw-bolder">check-out</span>, escaneando novamente o código de barras. Isso nos ajudará a manter um registro preciso de quem está presente e quando deixam o local.</p>
                        <h3 class="mb-3">Tolerância de Tempo</h3>
                        <p class="mb-5">Para sua comodidade, estamos implementando uma tolerância de <span class="text-success fw-bolder">30 minutos</span> tanto para o <span class="text-success fw-bolder">check-in</span> quanto para o <span class="text-success fw-bolder">check-out</span>. Isso significa que, se você chegar até <span class="text-success fw-bolder">30 minutos</span> após o início do evento, ainda poderá fazer o <span class="text-success fw-bolder">check-in</span>. Da mesma forma, se você deixar o evento até <span class="text-success fw-bolder">30 minutos</span> após o término, poderá fazer o <span class="text-success fw-bolder">check-out</span>.</p>
                        <h3 class="mb-3">Pontualidade</h3>
                        <p class="mb-5">Embora tenhamos a tolerância de tempo, incentivamos todos os participantes a chegar ao evento no horário programado. Isso nos ajuda a planejar e garantir que tudo funcione sem problemas.</p>
                        <h3 class="mb-3">Lista de Espera</h3>
                        <p class="mb-5">Se todas as vagas estiverem preenchidas, você pode entrar na <span class="text-success fw-bolder">lista de espera</span>. Se, ao chegar no evento, vagas adicionais estiverem disponíveis devido a cancelamentos ou mudanças, você terá a oportunidade de participar. Daremos prioridade aos participantes na lista de espera com base na ordem de inscrição. Portanto, mesmo que as vagas estejam esgotadas inicialmente, ainda há a chance de participar do evento se vagas adicionais se tornarem disponíveis.</p>                        
                        <h3 class="mb-3">Certificados</h3>
                        <p class="mb-5">Ao confirmar sua presença no início e término do evento, você será elegível para receber um <span class="text-success fw-bolder">certificado</span> de participação exclusivo. Vale lembrar de definir o seu nome completo para o <span class="text-success fw-bolder">certificado</span> que será gerado.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #sobre-section {
    display: none;
    }

    #sobre-section.show {
    display: block;
    }
</style>
<script>
    function selecionarSecao(secaoIdx){
        const secoes = Array.from(document.querySelectorAll("#sobre-section"));
        secoes.forEach(secao => {
            secao.classList.remove('show');
        });

        secoes[secaoIdx].classList.add('show');
    }
</script>

@endsection