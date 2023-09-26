@extends('templates.template')
@section('content')
    <div class="container">
        <h2 class="user-name">Bem vindo, <strong>{{ $usuario->nome }}</strong></h2>
        <small class="aviso-presenca"><strong style="color: red;">Aviso Importante</strong>: O controle de presença será feito
            através de check-in e
            check-out.</small> <a class="link-modal-user" data-bs-toggle="modal" data-bs-target="#exampleModal">Saiba Mais</a>
        <hr>
        <h3 class="user-page-title">Eventos da <strong>SECITEC 2023</strong></h3>
        <section class="user-eventos container row">
            @foreach ($eventosMapeados as $evento)
                <div class="evento">
                    <div style="margin-bottom: 5px;" class="horario-evento">
                        <span class="d-flex align-items-center">
                            <i class="bi bi-clock text-primary me-2"></i>
                            <span class="text-muted">{{ date('d/m/Y', strtotime($evento->dia)) }} | {{ $evento->horarioI }}
                                - {{ $evento->horarioF }}</span>
                        </span>
                    </div>
                    <div id="event-card{{ $evento->id }}"
                        class="event-card {{ $evento->usuario_cadastrado ? 'cadastrado' : ($evento->vagas_restantes == 0 ? 'fila' : '') }} col-12">
                        <div class="event-content col-lg-10 col-8">
                            <div class="text">
                                <h3>{{ $evento->titulo }}</h3>
                                <p>{{ $evento->descricao }}</p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <button id="{{ $evento->id }}" onclick="enviarRequisicao({{ $evento->id }})"
                                        class="btn {{ $evento->usuario_cadastrado ? 'btn-danger' : ($evento->vagas_restantes == 0 ? 'btn-warning' : 'btn-success') }}">
                                        {{ $evento->usuario_cadastrado ? 'Descadastrar' : ($evento->vagas_restantes == 0 ? 'Entrar na Fila' : 'Cadastrar') }}
                                    </button>
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
                    <div class="vagas-evento">
                        <span id="vagas_esgotadas_alert{{ $evento->id }}"
                            class="esgotadas {{ $evento->vagas_restantes < 1 ? 'show' : '' }}">Esgotadas</span>
                        <span>Vagas restantes: <strong
                                id="vagas_restantes{{ $evento->id }}">{{ $evento->vagas_restantes }}</strong></span>
                    </div>
                </div>
            @endforeach
        </section>
    </div>

    <!-- Modal Aviso -->
    <div id="avisoModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aviso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Você entrou na fila de espera .Se, ao chegar no evento, vagas adicionais estiverem disponíveis devido
                        a
                        cancelamentos ou mudanças, você terá a oportunidade de participar. Daremos prioridade aos
                        participantes na lista de espera com base na ordem de inscrição. Portanto, mesmo que as
                        vagas estejam esgotadas inicialmente, ainda há a chance de participar do evento se vagas
                        adicionais se tornarem disponíveis.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Regras -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Controle de Presença</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="regras-list">
                        <li>
                            <p>
                                <strong>Check-in e Check-out</strong>: Ao chegar ao evento, você será solicitado a fazer o
                                check-in escaneando o código de barras em seu crachá. Da mesma forma, quando você sair do
                                evento, será necessário fazer o check-out, escaneando novamente o código de barras. Isso nos
                                ajudará a manter um registro preciso de quem está presente e quando deixam o local.
                            </p>
                        </li>
                        <li>
                            <p>
                                <strong>Tolerância de Tempo</strong>: Para sua comodidade, estamos implementando uma
                                tolerância de 30 minutos tanto para o check-in quanto para o check-out. Isso significa que,
                                se você chegar até 30 minutos após o início do evento, ainda poderá fazer o check-in. Da
                                mesma forma, se você deixar o evento até 30 minutos após o término, poderá fazer o
                                check-out.
                            </p>
                        </li>
                        <li>
                            <p>
                                <strong>Pontualidade</strong>: Embora tenhamos a tolerância de tempo, incentivamos todos os
                                participantes a chegar ao evento no horário programado. Isso nos ajuda a planejar e garantir
                                que tudo funcione sem problemas.
                            </p>
                        </li>
                        <li>
                            <p>
                                <strong>Lista de Espera</strong>: Se todas as vagas estiverem preenchidas, você pode entrar
                                na lista de espera. Se, ao chegar no evento, vagas adicionais estiverem disponíveis devido a
                                cancelamentos ou mudanças, você terá a oportunidade de participar. Daremos prioridade aos
                                participantes na lista de espera com base na ordem de inscrição. Portanto, mesmo que as
                                vagas estejam esgotadas inicialmente, ainda há a chance de participar do evento se vagas
                                adicionais se tornarem disponíveis.
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
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
                    const eventoBtn = document.getElementById(`${data.evento}`);
                    const vagas = document.getElementById(`vagas_restantes${data.evento}`);
                    const vagasEsgotadasAlert = document.getElementById(`vagas_esgotadas_alert${data.evento}`)
                    switch (data.mensagem) {
                        case "descadastroSemFila":
                            eventoBtn.classList.remove('btn-danger');
                            eventoBtn.classList.add('btn-success');
                            eventoBtn.innerHTML = 'Cadastrar'
                            vagas.innerHTML = parseInt(vagas.innerHTML) + 1;
                            if (vagasEsgotadasAlert.classList.contains(
                                    'show')) {
                                vagasEsgotadasAlert.classList.remove('show');
                            }
                            break;
                        case "saiuFila":
                            eventoBtn.classList.remove('btn-danger');
                            eventoBtn.classList.add('btn-warning');
                            eventoBtn.innerHTML = 'Entrar na Fila'
                            break;
                        case "cadastroNormal":
                            eventoBtn.classList.remove('btn-success');
                            eventoBtn.classList.add('btn-danger');
                            eventoBtn.innerHTML = 'Descadastrar'
                            if (parseInt(vagas.innerHTML) > 0) {
                                vagas.innerHTML = parseInt(vagas.innerHTML) - 1;
                            }
                            if (parseInt(vagas.innerHTML) < 1 && !vagasEsgotadasAlert.classList.contains(
                                    'show')) {
                                vagasEsgotadasAlert.classList.add('show');
                            }
                            break;
                        case "removidoFila":
                            eventoBtn.classList.remove('btn-danger');
                            eventoBtn.classList.add('btn-warning');
                            eventoBtn.innerHTML = 'Entrar na Fila'
                            break;
                            // cadastro reserva
                        default:
                            eventoBtn.classList.remove('btn-warning');
                            eventoBtn.classList.add('btn-danger');
                            eventoBtn.innerHTML = 'Descadastrar'
                            var myModal = new bootstrap.Modal(document.getElementById('avisoModal'))
                            myModal.show()
                    }
                }
            });
        }
    </script>
@endsection
