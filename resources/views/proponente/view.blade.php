
@extends('templates.template')
@section('content')

<section class="container section-padding">

    <div class="perfil-proponente">
        <div class="img-wrapper-proponente">
            <img src="{{asset($proponente->url)}}">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <p class="text-reset fs-2 fw-bold">{{$proponente->nome}}</p>
            <p class="text-reset fs-3 fst-italic">{{$proponente->titulacao}}</p>
        </div>
    </div>

    @if($proponente->redes->rede3 || $proponente->redes->rede1 || $proponente->redes->rede2)
        <div class="mt-4">
            <p class="text-reset fs-3 fw-semibold">Redes sociais:</p>
            @if($proponente->redes->rede1)
                <div>
                    <p class="text-reset fs-4 ps-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat-square-heart" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12ZM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Z"/>
                            <path d="M8 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                        </svg> 
                        <a href="{{$proponente->redes->rede1}}" target="_blank"><u class="text-success">clique aqui</u></a>
                    </p>
                </div>
            @endif
            @if($proponente->redes->rede2)
                <div>
                    <p class="text-reset fs-4 ps-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat-square-heart" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12ZM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Z"/>
                            <path d="M8 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                        </svg> 
                        <a href="{{$proponente->redes->rede2}}" target="_blank"><u class="text-success">clique aqui</u></a>
                    </p>
                </div>
            @endif
            @if($proponente->redes->rede3)
                <div>
                    <p class="text-reset fs-4 ps-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat-square-heart" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12ZM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2Z"/>
                            <path d="M8 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
                        </svg> 
                        <a href="{{$proponente->redes->rede3}}" target="_blank"><u class="text-success">clique aqui</u></a>
                    </p>
                </div>
            @endif
        <div>
    @endif

    <div class="mt-4">
        <p class="text-reset fs-3 fw-semibold">Está presente em:</p>
    </div>

    <div class="row justify-content-center justify-content-lg-start">
        @foreach ($eventos as $evento)
            <div class="col-12 col-md-12 col-lg-10 mb-3">
                <div class="card">
                    <h5 class="card-header bg-success text-light">Featured</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{$evento->titulo}}</h5>
                        <p class="card-text text-reset">{{$evento->descricao}}</p>
                        <p class="card-text text-reset">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg> {{$evento->dia}}</p>
                        <p class="card-text text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                            </svg> {{$evento->horarioI}} {{$evento->horarioF}}</p>
                        <p class="card-text text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-layout-sidebar" viewBox="0 0 16 16">
                                <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H5zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2V2z"/>
                            </svg> {{$evento->local}}</p>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>
    

    
</section>
@endsection