@extends('templates.template')
@section('content')


<div class="container">
    <div class="d-flex m-5">
        <img class="mx-auto img-fluid" src="https://media.tenor.com/n4Js74XTN_4AAAAd/bh187-braveheart.gif">
    </div>
    
    <h4 class="text-center">Página de cadastramento dos monitores, LETSGO CAMBADAA!!!</h4>
    <h5 class="text-center">APERTE NOS BOTÕES DO ABAIXO PARA SE CADASTRAR COMO MONITOR DO SEU TURNO</h5>
    <div class="text-center">Se cadastre apenas nos turnos em que você foi selecionado, está com duvida? consulte a <a href="https://docs.google.com/spreadsheets/d/1sp7KI_g77PCA7qisBBlFyiW-pRHM74U9jyVtpyZH1CY/edit#gid=2137755893" target="_blank">planilha</a>.</div>
    
    <div class="d-flex">
        <form action="{{url('/usuarios/cadastarEvento')}}" method="post" class="m-5 mx-auto">
            @method('POST')
            @csrf
            <input type="text" name="usuarioId" value="{{$usuario->id}}" hidden>
            <input type="text" name="eventoId" value="80" hidden>
            <button class="btn btn-primary btn-lg">Sou do turno da manhã</button>
        </form>

        <form action="{{url('/usuarios/cadastarEvento')}}" method="post" class="m-5 mx-auto">
            @method('POST')
            @csrf
            <input type="text" name="usuarioId" value="{{$usuario->id}}" hidden>
            <input type="text" name="eventoId" value="83" hidden>
            <button class="btn btn-warning btn-lg">Sou do turno da tarde</button>
        </form>

        <form action="{{url('/usuarios/cadastarEvento')}}" method="post" class="m-5 mx-auto">
            @method('POST')
            @csrf
            <input type="text" name="usuarioId" value="{{$usuario->id}}" hidden>
            <input type="text" name="eventoId" value="84" hidden>
            <button class="btn btn-secondary btn-lg">Sou do turno da noite</button>
        </form>
    </div>
</div>

@endsection