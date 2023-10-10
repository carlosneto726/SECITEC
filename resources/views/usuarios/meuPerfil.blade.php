@extends('templates.template')
@section('content')
<section class="schedule section-padding" id="section_4">
    <div class="container">
        <h2 class="mb-5 ">Seus <u class="text-success">Dados</u></h2>

        <p>
            Nesta página você poderá acessar os seus dados que foram cadastrados no site da <span class="text-success fw-bolder">SECITEC</span>. 
            Está página disponibiliza opções de atualização dos seus dados, nos campos abaixo você poderá mudar seus dados, ao alterar os dados basta somente 
            apertar no botão de <span class="text-success fw-bolder">Atualizar</span> para que seus dados sejão atualizados.
        </p>

        <form action="{{url('/meu-perfil/atualizar')}}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <h6 class="text-success"><label for="name" class="form-label">Nome:</label></h6>
                <input type="text" class="form-control" id="name" name="nome" value="{{$usuario->nome}}" required>
            </div>
        
            <div class="mb-3">
                <h6 class="text-success"><label for="email" class="form-label">Email:</label></h6>
                <input type="email" class="form-control" id="email" name="email" value="{{$usuario->email}}" required>
            </div>
            <div class="mb-3">
                <h6 class="text-success"><label for="senha" class="form-label">CPF:</label></h6>
                <input type="text" class="form-control" id="cpf" name="cpf" value="{{$usuario->cpf}}" required>
            </div>

            <div class="mb-3">
                <h6 class="text-success"><label for="senha" class="form-label">Senha:</label></h6>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="senha" name="senha" maxlength="255">
                    <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" onclick="verSenha()">
                    <label class="btn btn-outline-secondary h-50" for="btn-check"><img src="{{asset("icons/eye.svg")}}" width="16" height="16"></label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>
</section>
@endsection
