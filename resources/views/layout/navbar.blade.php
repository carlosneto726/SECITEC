<nav class="navbar navbar-expand-lg">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="{{ url('/') }}" class="navbar-brand mx-auto mx-lg-0">
            <i class="bi-gender-female"></i>
            <span class="brand-text">SECITEC 2023 <br> IFG</span>
        </a>

        <!-- <a class="nav-link custom-btn btn d-lg-none" href="#">Inscrever</a> -->

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                <li class="nav-item">
                    <a class="nav-link custom-btn btn d-none d-lg-block" href="{{ url('/loginUser') }}">Entrar</a>
                </li>
            </ul>
        <div>
                
    </div>
</nav>
        