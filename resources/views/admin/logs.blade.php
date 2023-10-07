@extends('admin.template')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container pb-5">
    <h2 class=""><u class="text-success">Logs</u></h2>
</div>

<table class="table table-striped table-hover container mt-5">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">nome_evento</th>
            <th scope="col">nome_usuario</th>
            <th scope="col">tipo_operacao</th>
            <th scope="col">data_hora</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logs as $log)
            <tr>
                <td>{{$log->id}}</td>
                <td>{{$log->nome_evento}}</td>
                <td>{{$log->nome_usuario}}</td>
                <td>{{$log->tipo_operacao}}</td>
                <td>{{$log->data_hora}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
