@extends('templates.template')
  @section('content')

    <div class="container">
        
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
              <div class="card-body p-4 p-sm-5">
                <!-- Pills navs -->
                  <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link text-dark" id="tab-login" data-mdb-toggle="pill" href="{{ url('/loginUser') }}" role="tab"
                        aria-controls="pills-login" aria-selected="true">ENTRAR</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link text-dark " id="tab-register" data-mdb-toggle="pill" href="{{ url('/cadastrarUser') }}" role="tab"
                        aria-controls="pills-register" aria-selected="false">CADASTRAR</a>
                    </li>
                    </ul>

                <form method="post" action="{{url('/usuarios/loginUser/view')}}" class="login">
                  @csrf
                  @method('POST')
                    <div class="form-floating mb-3">
                    <input type="text" name="txtNome" placeholder="Informe o Nome" class="form-control" required>
                      <label for="floatingInput">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" name="txtSenha" placeholder="Informe a senha" class="form-control" required>
                      <label for="floatingPassword">Senha</label>
                    </div>

                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                      <label class="form-check-label" for="rememberPasswordCheck">
                        Lembrar senha
                      </label>
                    </div>
                    <div class="d-grid">
                      <input type="submit" value="Entrar" class="btn  text-light bg-dark btn-login text-uppercase fw-bold" type="submit"> <br>
                        <input type="reset" value="Limpar" class="btn  text-light bg-dark btn-login text-uppercase fw-bold" type="submit"><br>
                
                    </div>
                    <hr class="my-4">

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection