@extends('templates.template')
@section('content')

<section class="schedule section-padding" id="section-2">
    <div class="container">
        <div class="col-lg-12 col-12">
            <h2 class="mb-5"><u class="text-success">Certificados</u></h2>
        </div>
    </div>
    
    <div class="container p-4">
       
        <div class="dropdown-center mb-5">
            <button id="dropdown-button" class="btn custom-btn dropdown-toggle fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false">Selecione uma opção</button>
            <ul class="dropdown-menu">
                <li><a onclick="selecionarSecao(0)" class="dropdown-item" href="#">Participantes</a></li>
                <li><a onclick="selecionarSecao(1)" class="dropdown-item" href="#">Monitoria</a></li>
                <li><a onclick="selecionarSecao(2)" class="dropdown-item" href="#">Desenvolvedor</a></li>
                <li><a onclick="selecionarSecao(3)" class="dropdown-item" href="#">Credenciamento</a></li>
                <li><a onclick="selecionarSecao(4)" class="dropdown-item" href="#">Proponentes</a></li>
                <li><a onclick="selecionarSecao(5)" class="dropdown-item" href="#">Comissão Organizadora</a></li>
            </ul>
        </div>

        <div class="row">
            <input type="text" id="searchInput" class="form-control mt-5 col-12 mb-5" placeholder="Pesquisar por nome.">
        </div>

         <!--PARTICIPANTES-->
         <div class="row show" id="sobre-section">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Participante</th>
                        <th class="text-end" scope="col">Certificado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificados_usuario as $certificado)
                        <tr>
                            <th class="text-break" scope="row" id="nome-usuario">{{ strtoupper(str_replace(['participante', '_', '.pdf'], '', $certificado)) }}</th>
                            <td class="text-end"><a href="{{ asset('pdfs/usuarios/' . $certificado) }}" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!--MONITORES-->
        <div class="row show" id="sobre-section">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Monitor</th>
                        <th class="text-end" scope="col">Certificado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificados_monitor as $certificado)
                        <tr>
                            <th class="text-break" scope="row" id="nome-usuario">{{ strtoupper(str_replace(['_', '.pdf'], '', $certificado)) }}</th>
                            <td class="text-end"><a href="{{ asset('pdfs/organizadores/MONITORES/' . $certificado) }}" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

         <!--DESENVOLVEDOR-->
         <div class="row show" id="sobre-section">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Desenvolvedor</th>
                        <th class="text-end" scope="col">Certificado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificados_desenvolvedor as $certificado)
                        <tr>
                            <th class="text-break" scope="row" id="nome-usuario">{{ strtoupper(str_replace(['_', '.pdf'], '', $certificado)) }}</th>
                            <td class="text-end"><a href="{{ asset('pdfs/organizadores/DESENVOLVEDORES/' . $certificado) }}" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!--CREDENCIAMENTO-->
        <div class="row show" id="sobre-section">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-break" scope="col">Analista de Credenciamento</th>
                        <th class="text-end" scope="col">Certificado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificados_credenciamento as $certificado)
                        <tr>
                            <th class="text-break" scope="row" id="nome-usuario">{{ strtoupper(str_replace(['_', '.pdf'], '', $certificado)) }}</th>
                            <td class="text-end"><a href="{{ asset('pdfs/organizadores/CREDENCIAMENTO/' . $certificado) }}" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!--PROPONENTES-->
        <div class="row show" id="sobre-section">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Proponente</th>
                        <th class="text-end" scope="col">Certificado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificados_proponente as $nome => $links)
                        <tr>
                            <th class="text-break" scope="row" id="nome-usuario">{{ strtoupper(str_replace(['_', '.pdf'], ' ', $nome)) }}</th>
                            <td class="text-end">
                                @if(count($links) > 1)

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach ($links as $link)
                                            <li class="text-end"><a class="dropdown-item" href="{{asset("pdfs/proponentes/".$link)}}" target="_blank">{{str_replace("_.pdf", "", explode("-", $link)[1])}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                    
                                @else
                                    <a href="{{ asset('pdfs/proponentes/' . $links[0]) }}" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                        </svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!--COMISSÃO ORGANIZADORA-->
        <div class="row show" id="sobre-section">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-break" scope="col">Comissão Organizadora</th>
                        <th class="text-end" scope="col">Certificado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificados_comissao as $certificado)
                        <tr>
                            <th class="text-break" scope="row" id="nome-usuario">{{ strtoupper(str_replace(['_', '.pdf'], '', $certificado)) }}</th>
                            <td class="text-end"><a href="{{ asset('pdfs/organizadores/COMISSAO/' . $certificado) }}" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</section>

<style>
    #sobre-section {
    display: none;
    }

    #sobre-section.show {
    display: block;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>

<script>
    var input = document.getElementById('searchInput');
    var table = document.querySelector('.table.show');

    function selecionarSecao(secaoIdx){
        var nomeSecao;
        switch (secaoIdx) {
            case 0:
                nomeSecao = "Participantes";
                break;
            case 1:
                nomeSecao = "Monitoria";
                break;
            case 2:
                nomeSecao = "Desenvolvedor";
                break;
            case 3:
                nomeSecao = "Credenciamento";
                break;
            case 4:
                nomeSecao = "Proponentes";
                break;
            case 5:
                nomeSecao = "Comissão Organizadora";
                break;
            default:
                nomeSecao = "Selecione uma opção";
        }

        // Atualize o conteúdo do botão com o nome da seção selecionada
        document.getElementById("dropdown-button").textContent = nomeSecao;

        const secoes = Array.from(document.querySelectorAll("#sobre-section"));
        
        secoes.forEach(secao => {
            secao.classList.remove('show');
            secao.querySelector(".table").classList.remove('show');
            
        });

        secoes[secaoIdx].classList.add('show');
        secoes[secaoIdx].querySelector(".table").classList.add('show');
        input = document.getElementById('searchInput');
        table = document.querySelector('.table.show');
        pesquisar();
    }
    var urlAtual = window.location.href;
    if(urlAtual.includes("#")){
        selecionarSecao(0);
    }    

    function pesquisar(){
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
    }

    // Adiciona um ouvinte de eventos ao input para detectar mudanças de entrada
    input.addEventListener('input', function () {
        pesquisar();
    });


</script>
@endsection