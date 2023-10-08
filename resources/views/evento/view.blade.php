@extends('templates.template')
@section('content')

<style>
    .custom-tooltip {
      --bs-tooltip-bg: #17882c;
      --bs-tooltip-color: var(--bs-white);
    }  
</style>

<section class="container section-padding">

    <div class="perfil-proponente">
        <div class="img-wrapper-proponente">
            <img src="{{asset($evento[0]->url)}}">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <p class="text-reset fs-2 fw-bold">{{$evento[0]->titulo}}</p>
            <p class="text-reset fs-3 fst-bolder">{{$evento[0]->descricao}}</p>       
            <p class="card-text text-reset">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                </svg> {{$evento[0]->dia}}
            </p>
            <p class="card-text text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                </svg> {{$evento[0]->horarioI}} {{$evento[0]->horarioF}}
            </p>
            <p class="card-text text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-layout-sidebar" viewBox="0 0 16 16">
                    <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H5zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2V2z"/>
                </svg> {{$evento[0]->local}}
            </p>
        </div>
    </div>

    <div class="mt-4">
        <p class="text-reset fs-3 fw-semibold">Proponentes:</p>
    </div>

    <div class="d-flex overflow-x-auto h-scroll">
    @foreach ($proponentes as $proponente)
            <a href="{{url('/proponente/'.$proponente->id_proponente)}}">
                <div class="position-relative ms-2 me-1 img-wrapper-proponente m-2" style="height:100px; width: 100px;">
                    <img src="{{asset($proponente->url)}}"  data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="{{($proponente->nome)}}">
                </div>
            </a>
    @endforeach
    </div>
</section>

@endsection
