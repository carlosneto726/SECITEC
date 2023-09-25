@extends('templates.template')
@section('content')
    <div class="container">
        <h2 class="bem-vindo-user">Bem vindo, {{ $usuario->nome }}</h2>
        <hr>
        <section class="user-eventos container row">
            @foreach ($eventosMapeados as $evento)
                <div class="event-card col-12">
                    <div class="event-content col-lg-10 col-8">
                        <div class="text">
                            <h3>{{ $evento->titulo }}</h3>
                            <p>{{ $evento->descricao }}</p>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <button id="{{ $evento->id }}" onclick="enviarRequisicao({{ $evento->id }})" type="button"
                                    class="btn {{ $evento->usuario_cadastrado ? 'btn-danger' : 'btn-success' }}">{{ $evento->usuario_cadastrado ? 'Descadastrar' : 'Cadastrar' }}</button>
                            </div>
                            <div class="col-6 tipo-evento-wrapper">
                                <span class="tipo-evento">{{ $evento->tipo_evento_nome }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="event-image col-lg-2 col-4">
                        <img src="{{ $evento->url }}" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <script>
        function enviarRequisicao(eventoId) {
            var usuarioId = `{{ $usuario->id }}`;

            $.ajax({
                url: "/usuarios/cadastarEvento",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Obtém o token CSRF do meta tag
                    usuarioId: usuarioId,
                    eventoId: eventoId
                },
                success: function(data) {
                    if(data.mensagem == 'Cadastrado com sucesso!') {
                        handleCadastro(true, data.evento)
                    } else if (data.mensagem == 'Descadastrado com sucesso!') {
                        handleCadastro(false, data.evento)
                    }
                }
            });
        }

        const handleCadastro = (cadastrar, evento) =>{
            const eventoBtn = document.getElementById(`${evento}`)
            if(cadastrar) {
                eventoBtn.classList.remove('btn-success');
                eventoBtn.classList.add('btn-danger');
                eventoBtn.innerHTML = 'Descadastrar'
            } else {
                eventoBtn.classList.remove('btn-danger');
                eventoBtn.classList.add('btn-success');
                eventoBtn.innerHTML = 'Cadastrar'
            }
        }
    </script>
@endsection
