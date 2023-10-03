
@extends('templates.template')
@section('content')

<section class="container section-padding">

    <div class="perfil-proponente">
        <div class="img-wrapper-proponente">
            <img src="{{asset($proponente->url)}}">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-6">
            <p class="text-reset fs-2 fw-bold">{{$proponente->nome}}</p>
            <p class="text-reset fs-3">{{$proponente->titulacao}}</p>
        </div>
    </div>




<h3>rede1: {{$proponente->redes->rede1}}</h3>
<h3>rede2: {{$proponente->redes->rede2}}</h3>
<h3>rede3: {{$proponente->redes->rede3}}</h3>




<h1>Eventos que o proponente participa</h1>

@foreach ($eventos as $evento)
    <div>
        <h3>titulo evento: {{$evento->titulo}}</h3>
        <h3>descricao: {{$evento->descricao}}</h3>
        <h3>descricao: {{$evento->descricao}}</h3>
        <h3>dia: {{$evento->dia}}</h3>
        <h3>horario: {{$evento->horarioI}} {{$evento->horarioF}}</h3>
        <h3>local: {{$evento->local}}</h3>
    </div>
@endforeach

{{var_dump($proponente)}}
{{var_dump($eventos)}}
</section>
@endsection