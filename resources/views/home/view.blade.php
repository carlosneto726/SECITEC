@extends('templates.template')
@section('content')

<!--Home-->
<!--Banner-->
<section class="hero" id="section_1">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-12 m-auto">
                <div class="hero-text text-light">
                    <h1 class="text-reset" >SECITEC 2023</h1>

                    <h3 class="fw-semibold text-reset" >IFG, Campus Formosa</h3>

                    <div class="d-flex justify-content-center align-items-center p-2">
                        <span class="fs-5 date-text">23 a 26 de Outubro de 2023</span>
                    </div>  

                    <p class="fs-1 pt-5 pb-2 text-light cronometro" id="countdown"></p>

                    

                    <!--script para o cronômetro até o dia do evento-->
                    <script>
                        // Define a data alvo
                        const targetDate = new Date('2023-10-23T00:00:00').getTime();

                        // Atualiza o cronômetro a cada segundo
                        const countdown = setInterval(function() {
                            const currentDate = new Date().getTime();
                            const timeLeft = targetDate - currentDate;

                            if (timeLeft <= 0) {
                                clearInterval(countdown);
                                //Mensagem a ser mostrada quando o cronômetro acabar
                                document.getElementById('countdown').innerHTML = 'Nosso evento já começou!';
                            } else {
                                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                                //Mensagem que está sendo mostrada no cronômetro
                                document.getElementById('countdown').innerHTML = `
                                    ${days}d ${hours}h ${minutes}m ${seconds}s
                                `;
                            }
                        }, 1000); // Atualiza a cada 1 segundo
                    </script>

                  @if(!isset($_COOKIE['usuario']) && !isset($_COOKIE['nome_usuario']))
                    
                    
                    <div class="nav-item d-flex align-items-center justify-content-center">
                        <h6><a class="nav-link btn text-light pt-2 pb-2 ps-4 pe-4 mt-1 rounded-pill" href="{{ url('/cadastrar') }}" id="botao_cadastrar">Cadastre-se</a></h6>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <!--Imagem do banner aqui-->
    <div class="video-wrap">
        <!--<video autoplay="" loop="" muted="" class="custom-video" poster=""></video>-->
        <img src="{{asset('images/banner_ideia.gif')}}" alt="" class="custom-video">
    </div>
</section>

<!--Highlight-->
<section class="highlight">
    <div class="container">
        <div class="row justify-content-md-center">
            <!--Primeira coluna-->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="highlight-thumb">
                    <img src="{{asset('images/ifg_secitec_2022.png')}}" class="highlight-image img-fluid" alt="">
                    <!--Ícone quando o mouse está em cima da imagem-->
                    <div class="highlight-info">
                        <h6 class="highlight-title">SECITEC, 2022</h6>
                        <a href="https://www.ifg.edu.br/component/content/article/158-ifg/campus/formosa/noticias-campus-formosa/32193-xiii-secitec-discute-educacao-profissional-e-tecnologica-e-inclusao-de-pessoas-com-deficiencia?highlight=WyJzZWNpdGVjIiwyMDIyLCJzZWNpdGVjIDIwMjIiXQ==" class="bi-plus-circle highlight-icon" target="_blank"></a>
                    </div>
                </div>
            </div>
            <!--Segunda coluna-->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="highlight-thumb">
                    <img src="{{asset('images/hackathon.png')}}" class="highlight-image img-fluid" alt="">
                    <!--Ícone quando o mouse está em cima da imagem-->
                    <div class="highlight-info">
                        <h6 class="highlight-title">HACKATHON, 2023</h6>
                        <a href="https://hackathonsecitecifg.netlify.app" class="bi-plus-circle highlight-icon" target="_blank"></a>
                    </div>
                </div>
            </div>
            <!--Terceira coluna-->
            <div class="col-lg-4 col-md-6 col-12 self-align-center">
                <div class="highlight-thumb">
                    <img src="{{asset('images/ifg_facebook.png')}}" class="highlight-image img-fluid" alt="">
                    <!--Ícone quando o mouse está em cima da imagem-->
                    <div class="highlight-info">
                        <h6 class="highlight-title">FACEBOOK IFG-FORMOSA</h6>
                        <a href="https://www.facebook.com/ifgformosa" class="bi-plus-circle highlight-icon" target="_blank"></a>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</section> 
<style>
    #botao_cadastrar{
        background: #0693e3 !important;
    }
</style>
@endsection