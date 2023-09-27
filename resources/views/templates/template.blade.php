<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css\bootstrap\bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("css\bootstrap\bootstrap-icons.css")}}">
    <link rel="stylesheet" href="{{asset('css\templatemo-leadership-event.css')}}">
    <link rel="stylesheet" href="{{asset('css\user.css')}}">
    <link rel="stylesheet" href="{{asset("css\app.css")}}">
    <title>SECITEC</title>
</head>
<body>
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

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/usuario.js') }}"></script>
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
    </script>
</body>
</html>