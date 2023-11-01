@extends('templates.template')
@section('content')

<section class="schedule section-padding">

    <div class="container p-4">
        <h2 class="schedule mb-5">
            <u class="text-success d-flex">
                Certificados
                {{-- <div class="dropdown ms-4">
                    <button class="btn custom-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Sobre
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Monitoria</a></li>
                        <li><a class="dropdown-item" href="#">Desenvolvedor</a></li>
                        <li><a class="dropdown-item" href="#">Credenciamento</a></li>
                    </ul>
                </div> --}}
            </u>
        </h2>

        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Pesquisar por nome.">

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Participante</th>
                    <th scope="col">Certificado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certificados as $certificado)
                    <tr>
                        <th scope="row" id="nome-usuario">{{ strtoupper(str_replace(['_', '.pdf'], '', $certificado)) }}</th>
                        <td><a href="{{ asset('pdfs/usuarios/' . $certificado) }}" target="_blank">Abrir</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

</section>

<script>
    // Evento de input e a tabela
    var input = document.getElementById('searchInput');
    var table = document.querySelector('.table');

    // Adiciona um ouvinte de eventos ao input para detectar mudanças de entrada
    input.addEventListener('input', function () {
        var searchText = input.value.toUpperCase();

        // Obtém todas as linhas da tabela
        var rows = table.querySelectorAll('tbody tr');

        // Itera sobre as linhas e verifica se o texto de pesquisa corresponde ao nome do usuário ou nome do evento
        rows.forEach(function (row) {
            var nomeUsuario = row.querySelector('#nome-usuario').textContent.toUpperCase();

            if (nomeUsuario.includes(searchText)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
