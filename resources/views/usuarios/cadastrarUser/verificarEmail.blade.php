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

                    <form action="{{url('/usuarios/verificar-email')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="input-group mb-2">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                        </div>
                        <small class="ms-1 mb-3 opacity-50">Informe o seu email para verificarmos se o seu email exite. Nós iremos enviar um email com link para você se cadastrar. <br> <strong>Cheque o a sua caixa de entrada e sua caixa de spam</strong>.</small>

                        <button class="btn btn-success w-100" type="submit">
                            Enviar email
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .link-tutorial{
        border-bottom: solid 2px #17882c;
    }
</style>

@endsection
