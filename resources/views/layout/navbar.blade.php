<nav class="navbar navbar-expand-lg navbar-bg text-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="{{ url('/') }}" class="onavbar-brand mx-auto mx-lg-0 d-flex align-items-center">
            <img src="{{asset('images/logo_ifg.png')}}" class="logo" alt="">
            <span class="text-light">SECITEC 2023</span>
        </a>
        <!-- <a class="nav-link custom-btn btn d-lg-none" href="#">Inscrever</a> -->

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto d-flex align-items-lg-center align-items-md-center">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll"  href="{{ url('/sobre') }}">Sobre</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ url('/programacao') }}">Programação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll"  href="{{ url('/local') }}">Local</a>
                </li>

                @if(isset($_COOKIE['usuario']) && isset($_COOKIE['nome_usuario']))
                    <li class="nav-item">
                        <a class="nav-link click-scroll"  href="{{ url('/eventos') }}">Eventos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link custom-btn btn d-none d-lg-block" href="{{ url('/usuarios/sair') }}">Sair</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link custom-btn btn btn-danger d-none d-lg-block" href="{{ url('/login') }}">Entrar</a>
                    </li>
                @endif
            </ul>
        <div>    
    </div>
</nav>
        