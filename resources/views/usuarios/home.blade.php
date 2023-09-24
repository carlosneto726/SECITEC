@extends('templates.template')
@section('content')
    <div class="container">
        <h2>Bem vindo, {{ $usuario->nome }}</h2>
        <hr>
        <section class="user-eventos container row">
            @foreach ($eventosMapeados as $evento)
                <div class="event-card col-lg-6">
                    <div class="event-content col-8">
                        <div class="text">
                            <h3>{{ $evento->titulo }}</h3>
                            <p>{{ $evento->descricao }}</p>
                        </div>
                        <hr>
                        <button onclick="enviarRequisicao()" type="button"
                            class="btn {{ $evento->usuario_cadastrado ? 'btn-danger' : 'btn-success' }}">{{ $evento->usuario_cadastrado ? 'Descadastrar' : 'Cadastrar' }}</button>
                    </div>
                    <div class="event-image col-4">
                        <img src="" alt="">
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <script>
        function enviarRequisicao() {
            var nome = "Maycon";
            $.ajax({
                url: "/usuarios/cadastarEvento",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Obtém o token CSRF do meta tag
                    nome: nome
                },
                success: function(data) {
                    // Manipular a resposta aqui
                    console.log(data);
                }
            });
        }
    </script>
@endsection
