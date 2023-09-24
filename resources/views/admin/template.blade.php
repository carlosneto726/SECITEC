<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css\app.css")}}">
    <link rel="stylesheet" href="{{asset("css\bootstrap\bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset('css\templatemo-leadership-event.css')}}">
    <title>SECITEC</title>
</head>

    
<body style="background-color: rgba(150, 150, 150, 0.192);">

    <header>
        @include('admin.layout.navbar')
    </header>

    <div class="z-3 position-fixed top-0 end-0" id="alert" style="margin-top: 100px;"></div>

    <section class="section-padding">
        @yield('content')
    </section>

    <footer class="footer mt-auto py-3">
        @include('admin.layout.footer')
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/desvg@1.0.2/desvg.min.js"></script>
    

</body>

</html>