@extends('templates.template')
@section('content')
<style>
    @media (max-width: 768px) {
        .avatar-proponente {
            display: flex;
            overflow: hidden;
        }
    }
    .avatar-proponente img{
        border: 1px solid black;
    }    
</style>

    <div class="container section-padding mb-5">
        <h2 class="">Bem vindo, <strong><u class="text-success">{{ $usuario->id == 6 || $usuario->id == 4 ? $usuario->nome. ' Gostosão' : $usuario->nome }}</u></strong></h2>
        <small class="aviso-presenca"><strong style="color: red;">Aviso Importante</strong>: O controle de presença será feito
            através de check-in e
            check-out.</small> <a class="link-modal-user" data-bs-toggle="modal" data-bs-target="#exampleModal">Saiba Mais</a>
        <hr>
        <h3 class="user-page-title">Eventos da <strong>SECITEC 2023</strong></h3>
        <section>
            <div class="accordion" id="accordionExample">
            </div>
        </section>
        <div id="alerta-custom" class="alerta-custom">
            <p id="alerta-texto">Cadastrado com Sucesso!</p>
        </div>
    </div>

    <!-- Modal generico -->
    <div id="modalGenerico" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" onclick="clearModalGenerico()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearModalGenerico()" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
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
                                <strong>Check-in e Check-out</strong>: Ao chegar ao evento, você será solicitado a fazer o <span class="text-success fw-bolder">check-in</span> escaneando seu <span class="text-success fw-bolder">QR Code</span>. Da mesma forma, quando você sair do evento, será necessário fazer o <span class="text-success fw-bolder">check-out</span>, escaneando novamente o seu <span class="text-success fw-bolder">QR Code</span>. Isso nos ajudará a manter um registro preciso de quem está presente e quando deixam o local.
                            </p>
                        </li>
                        <li>
                            <p>
                                <strong>Tolerância de Tempo</strong>: Para sua comodidade, estamos implementando uma tolerância de <span class="text-success fw-bolder">30 minutos</span> tanto para o <span class="text-success fw-bolder">check-in</span> quanto para o <span class="text-success fw-bolder">check-out</span>. Isso significa que, se você chegar até <span class="text-success fw-bolder">30 minutos</span> após o início do evento, ainda poderá fazer o <span class="text-success fw-bolder">check-in</span>. Da mesma forma, se você deixar o evento até <span class="text-success fw-bolder">30 minutos</span> após o término, poderá fazer o <span class="text-success fw-bolder">check-out</span>.
                            </p>
                        </li>
                        <li>
                            <p>
                                <strong>Pontualidade</strong>: Embora tenhamos a tolerância de tempo, incentivamos todos
                                os
                                participantes a chegar ao evento no horário programado. Isso nos ajuda a planejar e
                                garantir
                                que tudo funcione sem problemas.
                            </p>
                        </li>
                        <li>
                            <p>
                                <strong>Lista de Espera</strong>: Se todas as vagas estiverem preenchidas, você pode entrar na <span class="text-success fw-bolder">lista de espera</span>. Se, ao chegar no evento, vagas adicionais estiverem disponíveis devido a cancelamentos ou mudanças, você terá a oportunidade de participar. Daremos prioridade aos participantes na lista de espera com base na ordem de inscrição. Portanto, mesmo que as vagas estejam esgotadas inicialmente, ainda há a chance de participar do evento se vagas adicionais se tornarem disponíveis.
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Share+Tech&display=swap');


        </style>
        <script>
            // VARIAVEIS
            var eventosMapeados = @json($eventosMapeados);
            const eventosAgrupados = agruparEventosPorDia(eventosMapeados);
            const accordion = document.getElementById('accordionExample');

            // CHAMADAS DE FUNCAO 
            renderizarAccordions();


            // FUNCOES AUXILIARES 
            function agruparEventosPorDia(eventos) {
                const grupos = { Hackathon: [] };

                eventos.forEach(evento => {
                    const dia = evento.dia;
                    if (!grupos[dia]) {
                        if(evento.tipo_evento_nome !== 'hackathon')
                            grupos[dia] = [];
                    }
                    if(evento.tipo_evento_nome == 'hackathon') {
                        grupos['Hackathon'].push(evento);
                    } else {
                        grupos[dia].push(evento);
                    }
                });
                return grupos;
            }

            function formatarData(data) {
                data = new Date(data);
                return data.toLocaleDateString('pt-BR', {
                    timeZone: 'UTC'
                });
            }

            function formatarHora(hora){
                const horaSeparada = hora.split(':');
                return `${horaSeparada[0]}:${horaSeparada[1]}`
            }

            // FUNCOES DE RENDER
            function renderizarAccordions() {
                Object.keys(eventosAgrupados).forEach(function(key) {
                    if(key !== 'Hackathon') {
                        accordion.innerHTML += `  
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion${key}" aria-expanded="false" aria-controls="accordion${key}">
                                    <strong> ${key == 'Hackathon' ? 'Hackathon' : formatarData(key)} </strong>
                                </button>
                                </h2>
                                <div id="accordion${key}" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
    
                                <div class="accordion-body accordion-body-eventos p-2 m-0" id="accordion-body$key">
                                    ${renderizarEventosDia(key)}
                                </div>
                                </div>
                            </div>`
                    }
                });

                if(eventosAgrupados['Hackathon']) {
                    accordion.innerHTML = renderizarHackathon(eventosAgrupados['Hackathon'][0]) + accordion.innerHTML;
                }
            }

            function renderizarHackathon(evento){
                return `  <div class="accordion-item hackathon">
                        <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion${'hack'}" aria-expanded="false" aria-controls="accordion${'hack'}">
                            <h6 class="hack-title"> Hackathon </h6>
                        </button>
                        </h2>
                            <div id="accordion${'hack'}" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body accordion-body-hackathon p-2 m-0" id="accordion-body$key">
                                    <div class="row">
                                        <h2>O Hackathon</h2>
                                    </div>
                                    <div class="row">
                                        <p>
                                            O Hackathon será realizado durante quatro dias, de
                                            <strong class="hack-tema-color">23 a 26 de outubro de 2023</strong>, no
                                            <strong class="hack-tema-color">IFG Campus Formosa</strong>, como parte da
                                            <strong class="hack-tema-color">SECITEC 2023</strong>. Durante esse período, os
                                            participantes terão a oportunidade de trabalhar em suas soluções,
                                            receber orientações de mentores especializados e participar de
                                            workshops introdutórios.                    
                                        </p>
                                        <p>
                                            Esse projeto visa promover a inovação, a colaboração, o pensamento
                                            criativo e o desenvolvimento de soluções práticas para questões
                                            relacionadas ao desenvolvimento sustentável. Esperamos incentivar o
                                            engajamento dos participantes e fornecer uma oportunidade única para
                                            aplicarem seus conhecimentos e habilidades em um contexto desafiador
                                            e relevante para a sociedade. <a target="_blank" class="hack_saiba_mais" href="https://hackathonsecitecifg.netlify.app/">SAIBA MAIS</a>
                                        </p>
                                    <div class="row">
                                    <ul class="hack-avisos">
                                         <li>
                                                <strong>Check-in e Check-out:</strong> O check-in e check-out do hackathon será realizado na abertura e encerramento do evento, mediante a apresentação dos projetos.
                                        </li>
                                        <li>
                                                <strong>Inscrição Individual:</strong> É necessário se inscrever individualmente no evento abaixo, mas a formação dos grupos e a inscrição dos mesmos serão feitas na abertura do Hackathon.
                                        </li>
                                        <li>
                                                <strong>Horário:</strong> O Hackathon ocorrerá ao longo de toda a SECITEC, com uma variedade de atividades relacionadas ao longo do evento. No entanto, a presença dos participantes será obrigatória apenas na cerimônia de abertura e na apresentação dos projetos, que acontecerão no dia 23, das 08:00 às 12:00, e no dia 26, das 10:00 às 12:00. Não será possível se cadastrar no evento caso já estejam cadastrados em eventos que coincidam com essas datas.
                                        </li>
                                    </ul>
                                    </div>
                                    </div> 
                                        <div id="hackBtn" onclick="enviarRequisicaoHackathon(${evento.id})"
                                                class="btn ${ evento.usuario_cadastrado ? 'btn-danger' : (evento.vagas_restantes == 0 ? 'btn-warning' : 'btn-success') }">
                                                ${ evento.usuario_cadastrado ? 'Descadastrar' : (evento.vagas_restantes == 0 ? 'Entrar na Fila' : 'Cadastrar') }
                                        </div>
                                    </div>
                            </div>
                        </div>`
            }

            function renderizarEventosDia(dia) {
                let eventos = "";
                eventosAgrupados[dia].forEach(evento => {
                    const eventoItem = `
                    <div class="card mt-3 mb-3">
                            <div class="card-body card-conteudo">
                                <div class="card-text">
                                    <h5 class=""><strong class="card-titulo">${evento.titulo} </strong> &nbsp;&nbsp;&nbsp;</h5>

                                    <p>${evento.descricao}</p>

                                    <h5 class=""><small style="font-size: 16px;" class="text-muted ${ evento.nome_tipo_evento == 'hackathon' ? 'remover-horario' : '' }"><i class="bi bi-clock text-primary me-2"></i> ${formatarHora(evento.horarioI)} às ${formatarHora(evento.horarioF)}</small></h5>
                                    
                                    <span class="" style="color: green;">
                                        <i class="bi-layout-sidebar me-2"></i>
                                        ${ evento.local}
                                    </span>
                                    
                                    <p class=" fw-bolder">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill me-2" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                        </svg>
                                        Vagas: <strong style="color: ${evento.vagas_restantes > 0 ? '' : 'red'};" id="vagas_restantes${ evento.id }">${evento.vagas_restantes}</strong></p>  
                                    <div class="row">
                                        <div class="col-6">
                                            <div id="${evento.id}" onclick="enviarRequisicao(${evento.id})"
                                                class="btn ${ evento.usuario_cadastrado ? 'btn-danger' : (evento.vagas_restantes == 0 ? 'btn-warning' : 'btn-success') }">

                                                ${ evento.usuario_cadastrado ? 'Descadastrar' : (evento.vagas_restantes == 0 ? 'Entrar na Fila' : 'Cadastrar') }
                                                
                                            </div>
                                        </div>
                                        <div class="col-6 tipo-evento-wrapper">
                                            <span class="tipo-evento">${evento.tipo_evento_nome}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" id="footer-evento">
                                <div class="d-flex overflow-x-auto h-scroll">
                                    <div class="position-relative text-dark-emphasis ms-2 me-1 avatares-wrapper">
                                        ${ gerarAvatarProponentes(evento.proponentes) } 
                                    </div>
                                </div>
                            </div>
                     </div>`;
                    eventos += eventoItem;
                })
                return eventos;
            }

            function lancarAviso(titulo, texto) {
                document.getElementById('modalTitle').innerHTML = titulo;
                document.getElementById('modalText').innerHTML = texto;
                var myModal = new bootstrap.Modal(document.getElementById('modalGenerico'))
                myModal.show()
            }

            function clearModalGenerico(){
                document.getElementById('modalTitle').innerHTML = '';
                document.getElementById('modalText').innerHTML = '';
            }

            function mostrarAlerta(corBackground, texto) {
                const alerta = document.getElementById("alerta-custom");
                const textoAlerta = document.getElementById("alerta-texto");

                alerta.style.backgroundColor = corBackground;
                textoAlerta.innerText = texto;

                alerta.style.top = "90px";
                alerta.style.display = "block"; 

                setTimeout(function () {
                alerta.style.top = "60px"; 
                }, 100);

                setTimeout(function () {
                    alerta.style.display = "none";
                }, 3000);
            }

            function gerarAvatarProponentes(proponentes){
                let avatares = ''
                proponentes.forEach(proponente => {
                    avatares += `<div class="avatar-proponente"><a href="/proponente/${proponente.id}"><img src="${proponente.url}" style="height: 50px; width: 50px;" alt="Avatar" /></a></div>`
                });
                return avatares;
            }

            function gerarProponenteInfo(proponente){
                return `<div class="card">
            	            <div class="card-body">
                                 <div class="row">
                                    <div class="col-5">
                                        <img src="${proponente.url}" class="img-fluid" alt="Imagem Quadrada">
                                    </div>
                                    <div class="col-7 text-capitalize">
                                        <h5 class="card-title">${proponente.nome}</h5>
                                        <p class="card-text">
                                            ${proponente.titulacao}
                                        </p>
                                    </div>
                                </div>
                        </div>`
            }

            // FUNCAO QUE ENVIA REQUISICAO DE CADASTRO E DESCADASTRO.
            function enviarRequisicaoHackathon(eventoId){
                var usuarioId = `{{ $usuario->id }}`;

                $.ajax({
                    url: "/usuarios/cadastarHackathon",
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // Obtém o token CSRF do meta tag
                        usuarioId: usuarioId,
                        eventoId: eventoId
                    },
                    success: function(data) {
                        const hackBtn = document.getElementById('hackBtn');
                        switch (data.mensagem) {
                            case 'Cadastrado':
                                mostrarAlerta("#42f59e", "Cadastrado com Sucesso!");
                                hackBtn.classList.add('btn-danger');
                                hackBtn.classList.remove('btn-success');
                                hackBtn.innerHTML = 'Descadastrar';
                                break;
                            case 'Descadastrado':
                                mostrarAlerta("#f05d5d", "Descadastrado com Sucesso!");
                                hackBtn.classList.remove('btn-danger');
                                hackBtn.classList.add('btn-success');
                                hackBtn.innerHTML = 'Cadastrar';
                                break;
                            default:
                                lancarAviso('Conflito de Horário',
                                    `Você está cadastrado(a) em eventos que coincidem com atividades obrigatórias do Hackathon.
                                    <br>
                                    <small>Abertura do Hackathon - 23 de outubro | 08:00 às 12:00</small>
                                    <br>
                                    <small>Apresentação e encerramento - 26 de outubro | 10:00 às 12:00</small>`
                                )
                                break;
                        }
                    }
                })
            }
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
                                if (vagas.style.color == 'red') {
                                    vagas.style.color = 'gray';
                                }
                                mostrarAlerta("#f05d5d", "Descadastrado com Sucesso!");
                                break;
                            case "saiuFila":
                                eventoBtn.classList.remove('btn-danger');
                                eventoBtn.classList.add('btn-warning');
                                eventoBtn.innerHTML = 'Entrar na Fila'
                                mostrarAlerta("#f05d5d", "Descadastrado com Sucesso!");
                                break;
                            case "cadastroNormal":
                                eventoBtn.classList.remove('btn-success');
                                eventoBtn.classList.add('btn-danger');
                                eventoBtn.innerHTML = 'Descadastrar'
                                if (parseInt(vagas.innerHTML) > 0) {
                                    vagas.innerHTML = parseInt(vagas.innerHTML) - 1;
                                    if (parseInt(vagas.innerHTML) == 0) {
                                        vagas.style.color = "red";
                                    }
                                }
                                mostrarAlerta("#42f59e", "Cadastrado com Sucesso!");
                                break;
                            case "removidoFila":
                                eventoBtn.classList.remove('btn-danger');
                                eventoBtn.classList.add('btn-warning');
                                eventoBtn.innerHTML = 'Entrar na Fila'
                                // TALVEZ COLOCAR UM AVISO E UM BOTAO PARA SABER SE REALMENTE QUER SE DESCADASTRAR
                                mostrarAlerta("#f05d5d", "Descadastrado com Sucesso!");
                                break;

                            case "conflito":
                                lancarAviso('Conflito de Horário',
                                    `O horário deste evento coincide com o horário de um evento ao qual você já está cadastrado.`
                                )
                                break;
                            case "conflitoHackathon":
                                lancarAviso('Hackathon',
                                    `Você está inscrito no Hackathon e esse evento coincide com o horário da abertura ou da apresentação dos projetos(Presença obrigatória).`
                                )
                                break;
                                // cadastro reserva
                            default:
                                eventoBtn.classList.remove('btn-warning');
                                eventoBtn.classList.add('btn-danger');
                                eventoBtn.innerHTML = 'Descadastrar'
                                mostrarAlerta("#42f59e", "Cadastrado na fila com Sucesso!");

                                lancarAviso("Fila de espera", `Você entrou na fila de espera .Se, ao chegar no evento, vagas adicionais estiverem disponíveis
                                            devido a cancelamentos ou mudanças, você terá a oportunidade de participar. Daremos prioridade aos
                                            participantes na lista de espera com base na ordem de inscrição. Portanto, mesmo que as
                                            vagas estejam esgotadas inicialmente, ainda há a chance de participar do evento se vagas
                                            adicionais se tornarem disponíveis.`)
                        }
                    }
                });
            }
        </script>
    @endsection
