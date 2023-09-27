@extends('templates.template')
@section('content')

<div class="container mt-5 mb-5 pt-5 pb-5">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <!-- Pills navs -->
                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark" id="tab-login" data-mdb-toggle="pill"
                                href="{{ url('/login') }}" role="tab" aria-controls="pills-login"
                                aria-selected="true">ENTRAR</a>
                        </li>
                        <li class="nav-item border rounded" role="presentation">
                            <a class="nav-link text-dark" id="tab-register" data-mdb-toggle="pill"
                                href="{{ url('/cadastrar') }}" role="tab" aria-controls="pills-register"
                                aria-selected="false">CADASTRAR</a>
                        </li>
                    </ul>

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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha" maxlength="255" required>
                        <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" onclick="verSenha()">
                        <label class="btn btn-outline-secondary h-50" for="btn-check"><img src="{{asset("icons/eye.svg")}}" width="16" height="16"></label>
                    </div>

                    <button class="btn btn-success w-100" onclick="cadastrarUsuario('/usuarios/cadastrar', this)">
                        Cadastrar
                    </button>
                    <small>
                        Ao clicar em <strong>Cadastrar</strong>, você concorda com nossos <a href="{{("/termos")}}" target="_blank">Termos, Política de Privacidade e Política de Cookies</a>. Você poderá receber E-mails.
                    </small>
                    <hr class="my-4">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
