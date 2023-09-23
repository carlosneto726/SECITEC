@extends('templates.template')
@section('content')

<section class="hero" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 col-12 m-auto">
                            <div class="hero-text text-light">
                                <p class="fs-1 fw-semibold text-reset" >SECITEC 2023</p>
                                <p class="fs-2 fw-semibold text-reset" >IFG, Campus Formosa</p>

                                <p class="fs-1 fw-bolder text-reset" id="countdown"></p>

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
                                                ${days}:${hours}:${minutes}:${seconds}
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
            
            
            <!--
            <section class="highlight">
                <div class="container">
                    <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h6 class="highlight-title">Artigo</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h6 class="highlight-title">Mesa Redonda</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="highlight-thumb">
                                <img src="" class="highlight-image img-fluid" alt="">

                                <div class="highlight-info">
                                    <h6 class="highlight-title">Podcast</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            -->
</section>


@endsection