@extends('templates.template')
@section('content')     


<nav class="navbar navbar-expand-lg">
    <div class="container">
        <button 
        class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="index.php" class="navbar-brand mx-auto mx-lg-0">
            <i class="bi-gender-female"></i>
            <span class="brand-text">Caliandras Digitais <br> I Simpósio</span>
        </a>
        <div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
                    <form method="POST" action="{{url('/admin/entrar')}}" class="login">
                        @csrf
                        @method("POST")
                        <div class="form-floating mb-3">
                            <input type="text" name="txtNome" placeholder="Informe o Nome:" class="form-control" required>
                            <label for="floatingInput">Nome</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="txtSenha" placeholder="Informe a senha:" class="form-control" required>
                            <label for="floatingPassword">Senha</label>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                            <label class="form-check-label" for="rememberPasswordCheck">
                                Lembrar senha
                            </label>
                        </div>
                        <div class="d-grid">
                            <input type="submit" value="Entrar" class="btn text-light bg-dark btn-login text-uppercase fw-bold" type="submit"> <br>
                            <input type="reset" value="Limpar" class="btn text-light bg-dark btn-login text-uppercase fw-bold" type="submit">
                        </div>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection