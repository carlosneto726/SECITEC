@extends('templates.template')
@section('content')

<h2 class="text-center">Redefinir senha</h2>

<div class="p-5 mx-auto container rounded" style="width: fit-content; background-color: var(--light-gray);">
    <h4>Redefina a sua senha</h4> 

    <form method="POST" action="{{url("/redefinir-senha/".$token)}}">
        @csrf
        @method("POST")
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Digite a sua nova senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <button class="btn btn-success mt-2 w-100" type="submit">Atualizar senha</button>
    </form>
</div>

@endsection
