@extends('admin.template')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container pb-5">
    <h2 class=""><u class="text-success">Logs</u></h2>
</div>

<div class="container mt-5">
    <input type="text" id="search-input" class="form-control mb-3" placeholder="Pesquisar por nome do proponente e usuário">
    <table class="table table-striped table-hover">

    <thead>
        <tr>
            <th scope="col" class="align-middle text-center">Evento</th>
            <th scope="col" class="align-middle text-center">Usuário</th>
            <th scope="col" class="align-middle text-center">Data Hora</th>
            <th scope="col" class="align-middle text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hash" viewBox="0 0 16 16">
                    <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
                </svg>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logs as $log)
            <tr>
                <td class="align-middle text-center" id="nome-evento">{{$log->nome_evento}}</td>
                <td class="align-middle text-center" id="nome-usuario">{{$log->nome_usuario}}</td>
                <td class="align-middle text-center">{{$log->data_hora}}</td>
                <td class="align-middle text-center">
                    @if ($log->tipo_operacao == "CADASTRAR")
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<script>
// Captura o campo de pesquisa e adiciona um evento de digitação
document.getElementById('search-input').addEventListener('input', function() {
    var searchValue = this.value.toLowerCase(); // Valor de pesquisa em letras minúsculas

    // Seleciona todas as linhas da tabela
    var rows = document.querySelectorAll('table tbody tr');

    // Itera pelas linhas da tabela
    rows.forEach(function(row) {
        var nomeEvento = row.querySelector('#nome-evento').textContent.toLowerCase();
        var nomeUsuario = row.querySelector('#nome-usuario').textContent.toLowerCase();

        // Verifica se o valor de pesquisa corresponde a algum valor na coluna "nome-evento" ou "nome-usuario"
        if (nomeEvento.includes(searchValue) || nomeUsuario.includes(searchValue)) {
            // Mostra a linha se houver correspondência
            row.style.display = 'table-row';
        } else {
            // Oculta a linha se não houver correspondência
            row.style.display = 'none';
        }
    });
});

</script>

@endsection
