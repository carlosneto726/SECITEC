@extends('templates.template')
@section('content')

<section class="schedule section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h2 class="mb-5">Veja o <u class="text-info">Local</u></h2>
            </div>

            <div class="col-lg-6 col-12">
                <iframe class="google-map" src="https://maps.google.com/maps?q=ifgformosa&t=&z=10&ie=UTF8&iwloc=&output=embed" width="100%" height="371.59" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                <div class="venue-thumb bg-white shadow-lg">
                    
                    <div class="venue-info-title">
                        <h3 class="text-white mb-0">Instituto Federal de Goiás</h3>
                    </div>

                    <div class="venue-info-body">
                        <h4 class="d-flex">
                            <i class="bi-geo-alt me-2"></i> 
                            <span>Rua 64, s/n - Esq. c/ Rua 11 - Parque Lago, Formosa - GO, 73813-816</span>
                        </h4>

                        <h5 class="mt-4 mb-3">
                            <a href="uyara.silva@ifg.edu.br">
                                <i class="bi-envelope me-2"></i>
                                uyara.silva@ifg.edu.br
                            </a>
                        </h5>

                        <h5 class="mb-0">
                            <a href="tel: 305-240-9671">
                                <i class="bi-telephone me-2"></i>
                                (61) 3642-9450
                            </a>
                        </h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection