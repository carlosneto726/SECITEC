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
                                <a class="nav-link text-dark border rounded" id="tab-login" data-mdb-toggle="pill"
                                    href="{{ url('/login') }}" role="tab" aria-controls="pills-login"
                                    aria-selected="true">ENTRAR</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-dark " id="tab-register" data-mdb-toggle="pill"
                                    href="{{ url('/cadastrar') }}" role="tab" aria-controls="pills-register"
                                    aria-selected="false">CADASTRAR</a>
                            </li>
                        </ul>

                        <form action="{{ url('/usuarios/login') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="E-Mail" name="email"
                                    id="email" required>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Senha" id="senha"
                                    name="senha" maxlength="255" required>
                                <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off"
                                    onclick="verSenha()">
                                <label class="btn btn-outline-secondary h-50" for="btn-check"><img
                                        src="{{ asset('icons/eye.svg') }}" width="16" height="16"></label>
                            </div>
                            <div class="m-1"><a href="#exampleModal" data-bs-toggle="modal">Esqueceu a senha?</a></div>

                            <div class="d-grid">
                                <button class="btn btn-success" type="submit">Entrar</button>
                        </form>

                        <hr class="my-4">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Redefinir senha</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/redefinir-senha" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Informe o E-mail</label>
                            <input type="email" class="form-control" id="RedefinirEmail" name="email" placeholder="Ex: exemplo@exemplo.com" required>
                        </div>
                        <div>Nós iremos enviar um E-mail para a redefinição da sua senha.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
