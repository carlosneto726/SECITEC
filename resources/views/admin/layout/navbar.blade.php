<header class="mb-5">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top "  style="background-color:#1d1d1b;">
        <div class="container">
            <a class="navbar-brand" href="{{url('/admin')}}"><img src="{{asset('images/logo-ifg-formosa.png')}}" height="64" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="background-color:#1d1d1b;">
                    <ul class="navbar-nav d-flex justify-content-end flex-grow-1 pe-5">
                        <li class="nav-item ">
                            <a class="nav-link active px-3 fw-bold" href="{{url('/admin')}}">INÍCIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active px-3 fw-bold" href="{{url('/admin/eventos')}}">EVENTOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active px-3 fw-bold" href="{{url('/admin/proponente')}}">CADASTRAR PROPONENTE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active px-3 fw-bold  " href="{{url('/admin/sair')}}">LOGOUT</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>