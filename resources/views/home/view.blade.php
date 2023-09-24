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
                        // Define a data alvo (30 de setembro de 2023)
                        const targetDate = new Date('2023-10-23T00:00:00').getTime();

                        // Atualiza o cronômetro a cada segundo
                        const countdown = setInterval(function() {
                            const currentDate = new Date().getTime();
                            const timeLeft = targetDate - currentDate;

                            if (timeLeft <= 0) {
                                clearInterval(countdown);
                                document.getElementById('countdown').innerHTML = 'Tempo esgotado!';
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
                        <span class="date-text">06 a 09 de março, 2024</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

        <div class="video-wrap">
            <video autoplay="" loop="" muted="" class="custom-video" poster="">
            </video>
        </div>
</section>
                                    
<section class="highlight">
    <div class="container">
        <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
                <div class="highlight-thumb">
                    <img src="{{asset('images/hackathon.png')}}" class="highlight-image img-fluid" alt="">

                    <div class="highlight-info">
                        <h6 class="highlight-title">HACKATHON</h6>
                        <a href="https://sensational-kangaroo-32bc8f.netlify.app/#cronograma" class="bi-plus-circle highlight-icon"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="highlight-thumb">
                    <img src="{{asset('images/ifg_facebook.png')}}" class="highlight-image img-fluid" alt="">

                    <div class="highlight-info">
                        <h6 class="highlight-title">FACEBOOK</h6>
                        <a href="https://www.facebook.com/ifgformosa" class="bi-facebook highlight-icon"></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="highlight-thumb">
                    <img src="{{asset('images/ifg_secitec_2022.png')}}" class="highlight-image img-fluid" alt="">

                    <div class="highlight-info">
                        <h6 class="highlight-title">SECITEC 2022</h6>
                        <a href="https://www.ifg.edu.br/component/content/article/158-ifg/campus/formosa/noticias-campus-formosa/32193-xiii-secitec-discute-educacao-profissional-e-tecnologica-e-inclusao-de-pessoas-com-deficiencia?highlight=WyJzZWNpdGVjIiwyMDIyLCJzZWNpdGVjIDIwMjIiXQ==" class="bi-plus-circle highlight-icon"></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section> 

<section>
<div class="container section-padding">
        <div class="col-lg-10 col-12">
            <h2 class="mb-4">Nossas <u class="text-success">vantagens</u></h2>
        </div>

        <div class="row justify-content-md-center text-center border border-light-subtle rounded-4 p-5">
            
          <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
            </svg>
            <p class="fs-4 pt-3 text-reset">NETWORKING</p>
          </div>

          <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
            </svg>
            <p class="fs-4 pt-3 text-reset">CERTIFICADOS</p>
          </div>

          <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
            </svg>
            <p class="fs-4 pt-3 text-reset">OFICINAS</p>
          </div>
        </div>
    </div>
</section>

@endsection