@extends('templates.template')
@section('content')

<div class="container mt-5 mb-5 pt-5 pb-5">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">

                    <form action="{{url('/usuarios/cadastrar/'.$token)}}" method="POST">
                        @csrf
                        @method('POST')

                         <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" required>
                        </div>
                        <small class="ms-1 mb-4 opacity-50">Informe o seu nome completo. <a href="{{("/sobre#1")}}" class="link-tutorial" target="_blank">Saiba mais</a>.</small>
                        
                        <div class="input-group">
                          <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" maxlength="14" onkeypress="return /[0-9]/i.test(event.key)" required>
                        </div>
                        <small class="ms-1 mb-4 opacity-50">Apenas números. Sem símbolos.</small>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha" maxlength="255" required>
                            <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" onclick="verSenha()">
                            <label class="btn btn-outline-secondary h-50" for="btn-check"><img src="{{asset("icons/eye.svg")}}" width="16" height="16"></label>
                        </div>

                        <button class="btn btn-success w-100 disabled" onclick="'/usuarios/cadastrar', this)">
                            Cadastrar
                        </button>

                        <small>
                            Ao clicar em <strong>Cadastrar</strong>, você concorda com nossos <a href="{{("/termos")}}" class="link-tutorial" target="_blank">Termos, Política de Privacidade e Política de Cookies</a>. Você poderá receber E-mails.
                        </small>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

<style>
    .link-tutorial{
        border-bottom: solid 2px #17882c;
    }
</style>

@endsection
