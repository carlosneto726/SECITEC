@extends('templates.template')
@section('content')
<section class="schedule section-padding" id="section_4">
    <div class="container">
        <h2 class="mb-5 ">Seu <u class="text-success">Perfil</u></h2>

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
                <span style="font-size:12px;color: #717275">Ao alterar seu CPF você deve se atentar a baixar seu cartão de inscrição novamente, pois, o QR Code gerado é feito com o seu CPF.</span>
            </div>

            <div class="mb-3">
                <h6 class="text-success"><label for="senha" class="form-label">Senha:</label></h6>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="senha" name="senha" maxlength="255">
                    <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" onclick="verSenha()">
                    <label class="btn btn-outline-secondary h-50" for="btn-check"><img src="{{asset("icons/eye.svg")}}" width="16" height="16"></label>
                </div>
            </div>
            <div class="mx-auto justify-content-end">
                <div class="d-flex">
                    <button type="submit" class="btn btn-success ms-auto me-2">Atualizar</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Apagar</button>
                </div>
            </div>
        </form>
  
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Apagar Conta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Deseja realmente apagar sua conta?</h6>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                <a href="/meu-perfil/deletar" type="submit" class="btn btn-danger">Apagar</a>
                </div>
            </div>
            </div>
        </div>
        
      
    </div>
</section>

<script>
    document.getElementById('cpf').addEventListener('input', function (event) {
    let input = event.target;
    let value = input.value.replace(/\D/g, '');

    if (value.length > 3) {
        value = value.substring(0, 3) + '.' + value.substring(3);
    }
    if (value.length > 7) {
        value = value.substring(0, 7) + '.' + value.substring(7);
    }
    if (value.length > 11) {
        value = value.substring(0, 11) + '-' + value.substring(11);
    }

    input.value = value;
});
</script>
@endsection
