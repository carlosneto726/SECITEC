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
    <link rel="stylesheet" href="{{asset("css\user.css")}}?v=1.5">
    <link rel="stylesheet" href="{{asset("css\app.css")}}?v=1.1">
    <title>ERRO</title>
</head>
<body>


    <section>
        @yield('content')
    </section>

</body>
</html>
