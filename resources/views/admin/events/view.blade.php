@extends('admin.template')
@section('content')

<div class="container shadow p-3 mb-5 bg-body rounded" style="margin-top: 8.6%;">
    <div class="d-flex h5">Eventos <a class="ms-auto" href="#staticBackdrop" data-bs-toggle="modal">Cadastrar evento</a></div>

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Tipo de Evento</th>
            <th>Descrição</th>
            <th>Dia</th>
            <th>Horário Inicio</th>
            <th>Horário Fim</th>
            <th>Vagas</th>
            <th>Horas</th>
            <th>Registrar Presença</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
        @foreach ($eventos as $dados)
            <tr>
                <td>{{$dados->id}}</td>
                <td>{{$dados->titulo}}</td>
                <td style="text-transform:capitalize;">{{$dados->tipo_evento_nome}}</td>
                <td>{{$dados->descricao}}</td>
                <td>{{$dados->dia}}</td>
                <td>{{$dados->horarioI}}</td>
                <td>{{$dados->horarioF}}</td>
                <td>{{$dados->vagas}}</td>
                <td>{{$dados->horas}}</td>
                @include('admin.events.alterarModal')
                <td><a href="#" class="btn btn-primary" data-bs-toggle="modal">Registrar presença</a></td>
                <td><a href="#staticBackdrop{{$dados->id}}" class="btn btn-success" data-bs-toggle="modal">Alterar</a></td>
                <form action="/admin/eventos/deletar" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" value="{{$dados->id}}"/>
                    <td><button type="submit" class="btn btn-danger">Excluir</button></td>
                </form>
            </tr>            
        @endforeach
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@include('admin.events.cadastrarModal')


@endsection