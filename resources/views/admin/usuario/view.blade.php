@extends('admin.template')
@section('content')

<section class="schedule mb-5" id="section_4">
    <div class="container">
        <h2 class=""><u class="text-success"><a class="" href="#staticBackdrop" data-bs-toggle="modal">Usuários
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square float-end" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            </a></u>
            </h2>
   </div>
</section>

<div class="container">
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Pesquisar por nome, cpf e evento">
    <table class="table table-bordered table-striped shadow">
        <thead>
            <tr>
                <th class="align-middle text-center">nome</th>
                <th class="align-middle text-center">cpf</th>
                <th class="align-middle text-center">eventos</th>
                <th class="align-middle text-center">cadastrar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td class="align-middle text-center" id="nome-usuario">{{$usuario->nome}}</td>
                    <td class="align-middle text-center" id="cpf-usuario">{{$usuario->cpf}}</td>
                    <td class="align-middle text-center" id="nome-evento">
                        @foreach ($usuario->eventos as $evento)
                            {{$evento->titulo}}
                        @endforeach
                    </td>
                    <td class="align-middle text-center">
                        <button class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container mt-5 mb-5 pt-5 pb-5">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">

                    <form action="/admin/adicionar-usuario/cadastrar" method="POST">
                        @csrf
                        @method('POST')
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
                        <small class="ms-1 mb-3 opacity-50">A senha padrão é secitec2023</small>
                        <button class="btn btn-success w-100 mt-3" type="submit">Cadastrar usuário</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Obtém o elemento de input e a tabela
    var input = document.getElementById('searchInput');
    var table = document.querySelector('.table');

    // Adiciona um ouvinte de eventos ao input para detectar mudanças de entrada
    input.addEventListener('input', function () {
        var searchText = input.value.toLowerCase();

        // Obtém todas as linhas da tabela
        var rows = table.querySelectorAll('tbody tr');

        // Itera sobre as linhas e verifica se o texto de pesquisa corresponde ao nome do usuário ou nome do evento
        rows.forEach(function (row) {
            var nomeUsuario = row.querySelector('#nome-usuario').textContent.toLowerCase();
            var nomeEvento = row.querySelector('#nome-evento').textContent.toLowerCase();
            var cpfUsuario = row.querySelector('#cpf-usuario').textContent.toLowerCase();

            if (nomeUsuario.includes(searchText) || nomeEvento.includes(searchText) || cpfUsuario.includes(searchText)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
<script src="{{asset('js/admin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection
