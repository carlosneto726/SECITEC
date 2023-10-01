@extends('templates.template')
@section('content')

<div class="container section-padding"> 

<div class="p-5 border mx-auto card border-0 shadow rounded-3 my-5" style="width: fit-content; background-color: var(--light-gray);">
    <h4>Redefir <u class="text-success">senha</u></h4>

    <form method="POST" action="{{url("/redefinir-senha/".$token)}}">
        @csrf
        @method("POST")
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Digite a sua nova senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <button class="btn btn-success mt-2 w-100" type="submit">Atualizar senha</button>
        <hr class="my-4">
    </form>
</div>
</div>
@endsection
