@extends('templates.template')
@section('content')

<section class="hero" id="section_1">
    <div class="container">
        <div class="row">

            <div class="col-lg-5 col-12 m-auto">
                <div class="hero-text text-light">
                    <p class="fs-1 fw-semibold text-reset" >SECITEC 2023</p>
                    <p class="fs-2 fw-semibold text-reset" >IFG, Campus Formosa</p>

                    <p class="fs-1 fw-bolder text-reset cronometro" id="countdown"></p>

                    <script>
                        // Define a data alvo
                        const targetDate = new Date('2023-10-23T00:00:00').getTime();

                        // Atualiza o cronômetro a cada segundo
                        const countdown = setInterval(function() {
                            const currentDate = new Date().getTime();
                            const timeLeft = targetDate - currentDate;

                            if (timeLeft <= 0) {
                                clearInterval(countdown);
                                document.getElementById('countdown').innerHTML = 'Nosso evento já começou!';
                            } else {
                                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                                document.getElementById('countdown').innerHTML = `
                                    ${days} dias e ${hours}:${minutes}:${seconds}
                                `;
                            }
                        }, 1000); // Atualiza a cada 1 segundo
                    </script>

                    <div class="d-flex justify-content-center align-items-center p-3">
                        <span class="date-text">23 a 26 de Outubro de 2023</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

        <div class="video-wrap">
            <!--<video autoplay="" loop="" muted="" class="custom-video" poster="">
            </video>
                    -->
            <img src="{{asset('images/banner_ideia.gif')}}" alt="" class="custom-video">
        </div>
</section>
                                    
<section class="highlight">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="highlight-thumb">
                    <img src="{{asset('images/ifg_secitec_2022.png')}}" class="highlight-image img-fluid" alt="">

                    <div class="highlight-info">
                        <h6 class="highlight-title">SECITEC, 2022</h6>
                        <a href="https://www.ifg.edu.br/component/content/article/158-ifg/campus/formosa/noticias-campus-formosa/32193-xiii-secitec-discute-educacao-profissional-e-tecnologica-e-inclusao-de-pessoas-com-deficiencia?highlight=WyJzZWNpdGVjIiwyMDIyLCJzZWNpdGVjIDIwMjIiXQ==" class="bi-plus-circle highlight-icon"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="highlight-thumb">
                    <img src="{{asset('images/hackathon.png')}}" class="highlight-image img-fluid" alt="">

                    <div class="highlight-info">
                        <h6 class="highlight-title">HACKATHON, 2023</h6>
                        <a href="https://sensational-kangaroo-32bc8f.netlify.app/" class="bi-plus-circle highlight-icon"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 self-align-center">
                <div class="highlight-thumb">
                    <img src="{{asset('images/caliandras.png')}}" class="highlight-image img-fluid" alt="">

                    <div class="highlight-info">
                        <h6 class="highlight-title">CALIANDRAS DIGITAIS I SIMPÓSIO, 2024</h6>
                        <a href="https://caliandrasdigitais.com.br/?secao=sobre" class="bi-plus-circle highlight-icon"></a>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</section> 
@endsection