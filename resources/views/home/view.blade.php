@extends('templates.template')
@section('content')

<section class="hero" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 col-12 m-auto">
                            <div class="hero-text">

                                <h1 class="text-white mb-4"><u class="text-info">SECITEC</u> <br> IFG, 2023</h1>

                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="date-text">06 a 09 de março, 2024</span>

                                    <span class="location-text">IFG, Formosa</span>
                                </div>

                                <a href="#section_2" class="custom-link bi-arrow-down arrow-icon"></a>
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


@endsection