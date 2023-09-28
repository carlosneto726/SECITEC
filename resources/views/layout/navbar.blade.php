<nav class="navbar navbar-expand-lg navbar-bg text-light" >
    <div class="container ">
        <a href="{{ url('/') }}" class="onavbar-brand mx-auto mx-lg-0 d-flex align-items-center">
            <img src="{{asset('images/logo_ifg.png')}}" class="logo" alt="">
            <span class="text-light">SECITEC 2023</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav d-flex justify-content-end flex-grow-1 pe-5">
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

                    <li class="nav-item d-flex align-items-center justify-content-center">
                        <a class="nav-link custom-btn btn btn-danger" href="{{ url('/usuarios/sair') }}">Sair</a>
                    </li>
                @else
                    <li class="nav-item d-flex align-items-center justify-content-center">
                        <a class="nav-link custom-btn btn btn-danger" href="{{ url('/login') }}">Entrar</a>
                    </li>
                @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
