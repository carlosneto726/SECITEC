@extends('templates.template')
@section('content')     

<body style="background-color: rgba(150, 150, 150, 0.192);">
<nav class="navbar navbar-expand-lg">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="index.html" class="navbar-brand mx-auto mx-lg-0">
            <i class="bi-gender-female"></i>
            <span class="brand-text">Caliandras Digitais <br> I Simpósio</span>
        </a>

        <a class="nav-link custom-btn btn d-lg-none" href="#">Inscrever</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="?secao=formEvento">CADASTRAR ATIVIDADE</a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="?secao=evento">ALTERAR ATIVIDADE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="?secao=formPalestrante">CADASTRAR PALESTRANTE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="../fpdf/relatorio.php">CERTIFICADO PARTICIPANTE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-btn btn d-none d-lg-block" href="{{url('/admin/sair')}}">Logout</a>
                </li>
            </ul>
        <div>
    </div>
</nav>

<section>
    <article>
            <//?php
            $red = new verURL();
            $red->trocarUrl(@$_GET['secao']);

            ?>
            
    </article>
</section>
<footer>
    <//?php include "includes/rodape.php"; ?>
</footer>


@endsection