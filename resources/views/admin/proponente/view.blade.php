@extends('admin.template')
@section('content')


@extends('admin.template')
@section('content')

<div class="container shadow p-3 mb-5 bg-body rounded" style="margin-top: 8.6%;">
    <div class="d-flex h5">Proponentes <a class="ms-auto" href="#staticBackdrop" data-bs-toggle="modal">Cadastrar proponente</a></div>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>TITULAÇÂO</th>
            <th>URL</th>
            <th>EXCLUIR</th>
        </tr>
        @foreach ($palestrantes as $palestrante) 
            <tr>
                <td>{{$palestrante->id}}</td>
                <td>{{$palestrante->nome}}</td>
                <td>{{$palestrante->titulacao}}</td>
                <td>{{$palestrante->url}}</td>
                <td>
                    <form method="post" action="{{url('/admin/proponente/deletar')}}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="{{$palestrante->id}}"/>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>            
        @endforeach
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@include('admin.proponente.cadastrarModal')


@endsection
