@extends('admin.template')
@section('content')

<div class="container mt-5 mb-5 pt-5 pb-5">
    <h1>CADASTRAR USUÁRIO</h1>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">

                    <form action="/admin/adicionar-usuario/cadastrar" method="POST">
                        @csrf
                        @method('POST')
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" required>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" maxlength="11" onkeypress="return /[0-9]/i.test(event.key)" required>
                        </div>
                        <small class="ms-1 mb-3 opacity-50">Apenas números. Sem símbolos.</small>
    
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="E-Mail" name="email" id="email" required>
                        </div>
                        <small class="ms-1 mb-3 opacity-50">A senha padrão é secitec2023</small>
                        <button class="btn btn-success w-100 mt-3" type="submit">Cadastrar usuário</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped table-hover container mt-5" style="width: 640px;">
    <thead>
        <tr>
            <th scope="col">nome</th>
            <th scope="col">cpf</th>
            <th scope="col">eventos</th>
            <th scope="col">cadastrar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{$usuario->nome}}</td>
                <td>{{$usuario->cpf}}</td>
                <td>
                    @foreach ($usuario->eventos as $evento)
                        {{$evento->titulo}}
                    @endforeach
                </td>
                <td>
                    <button class="btn btn-success">Cadastrar</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<script src="{{asset('js/admin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection
