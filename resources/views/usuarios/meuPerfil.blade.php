@extends('templates.template')
@section('content')

<div class="container" style="margin-top: 120px;">
    <form action="{{url('/meu-perfil/atualizar')}}" method="POST">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="nome" value="{{$usuario->nome}}" required>
        </div>
    
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$usuario->email}}" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{$usuario->cpf}}" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" id="senha" name="senha" maxlength="255">
                <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" onclick="verSenha()">
                <label class="btn btn-outline-secondary h-50" for="btn-check"><img src="{{asset("icons/eye.svg")}}" width="16" height="16"></label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

@endsection
