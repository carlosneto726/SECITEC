<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Participe da SECITEC 2023 do IFG-Formosa! Crie sua conta, inscreva-se em eventos, e receba certificados de participação. Esteja pronto para uma experiência educativa e enriquecedora!">
    <link rel="icon" href="{{asset('images\logo.png')}}">
    <link rel="stylesheet" href="{{asset("css\bootstrap\bootstrap.css")}}?v=1.0">
    <link rel="stylesheet" href="{{asset("css\bootstrap\bootstrap-icons.css")}}?v=1.0">
    <link rel="stylesheet" href="{{asset('css\templatemo-leadership-event.css')}}?v=1.0">
    <link rel="stylesheet" href="{{asset("css\user.css")}}?v=1.6">
    <link rel="stylesheet" href="{{asset("css\app.css")}}?v=1.2">
    <title>SECITEC</title>
</head>
<body>

    @if(@$_SESSION['mensagem'] != "")
        <div class="z-3 position-fixed top-0 end-0" style="margin-top: 100px;">
            <div class="alert alert-{{@$_SESSION['tipo']}} alert-dismissible" role="alert">
                <a href="{{ '/suporte' }}" target="_blanck">
                    <div class="d-flex justify-content-center align-items-center">
                        {{ $_SESSION['mensagem'] }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-info-circle ps-1" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                        
                    </div>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @php
            @$_SESSION['mensagem'] = "";
            @$_SESSION['tipo'] = "";
        @endphp
    @endif

    <header>
        @include('layout.navbar')
    </header>
    
    <div id="alert"></div>

    <section>
        @yield('content')
    </section>

    <footer>
        @include('layout.footer')
    </footer>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
          <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    <script src="{{asset('js/jquery.min.js')}}?v=1.0"></script>
    <script src="{{asset('js/jquery.sticky.js')}}?v=1.0"></script>
    <script src="{{asset('js/app.js')}}?v=1.1"></script>
    <script src="{{asset('js/usuario.js')}}?v=1.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script>
        var alerta = document.getElementById("alert");

        if(localStorage.getItem("message") != null && localStorage.getItem("type") != null){
            alerta.innerHTML =
            '<div class="z-3 position-fixed top-0 end-0" style="margin-top: 100px;">' +
            '    <div class="alert alert-'+localStorage.getItem("type")+' alert-dismissible" role="alert">'+
            '        <div>'+localStorage.getItem("message")+'</div>'+
            '        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
            '    </div>'+
            '</div>';
            localStorage.clear();
            localStorage.removeItem('message');
            localStorage.removeItem('type');
            localStorage.removeItem('endpoint');
        }

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>




</body>
</html>
