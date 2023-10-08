@extends('templates.template')
@section('content')

<!--CSS PARA ICONES DOS PROPONENTES-->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Share+Tech&display=swap');
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

<!--LOCAL QUE RECEBE O CONTEÚDO QUE É GERADO-->
<section class="schedule section-padding" id="section_4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h2 class="mb-5 ">Nossos <u class="text-success">Eventos</u></h2>
                <div class="tab-content mt-5" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-DayOne" role="tabpanel"
                        aria-labelledby="nav-DayOne-tab">
                        <div class="row pb-5 mb-5">
                            <div class="accordion" id="accordionExample">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--GERANDO CONTEÚDO PARA EVENTOS-->
<script>
    const accordion = document.getElementById('accordionExample');
    var eventos = @json($eventos);
    const eventosAgrupados = agruparEventosPorDia(eventos);
    function gerarAvatarEvento(evento) {
        let avatares = ''
        if (evento.url) {
            avatares += `<div class="avatar-proponente"><a "><img src="${evento.url}" style="height: 50px; width: 50px; border-radius: 50px;" alt="Avatar" /></a></div>`
        }
        return avatares;
    }
    function gerarAvatarProponentes(proponentes) {
        let avatares = ''
        proponentes.forEach(proponente => {
            avatares += `<div class="avatar-proponente"><a href="/proponente/${proponente.id_proponente}"><img src="${proponente.url}" style="height: 50px; width: 50px; border-radius: 50px;" alt="Avatar" /></a></div>`
        });
        return avatares;
    }
    function agruparEventosPorDia(eventos) {
        const grupos = { Hackathon: [] };

        eventos.forEach(evento => {
            const dia = evento.dia;
            if (!grupos[dia]) {
                if (evento.nome_tipo_evento !== 'hackathon')
                    grupos[dia] = [];
            }
            if (evento.nome_tipo_evento == 'hackathon') {
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

    function formatarHora(hora) {
        const horaSeparada = hora.split(':');
        return `${horaSeparada[0]}:${horaSeparada[1]}`
    }
    // FUNCOES DE RENDER
    function renderizarAccordions() {
        accordion.innerHTML = renderizarHackathon();
        Object.keys(eventosAgrupados).forEach(function (key) {
            if (key !== 'Hackathon') {
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
    }
    function renderizarEventosDia(dia) {
        let eventos = "";
        eventosAgrupados[dia].forEach(evento => {
            const eventoItem = `
            <div class="card mt-3 mb-3">
                    <div class="card-body card-conteudo">
                        <div class="card-text">
                            <h5 class=""><a href="/evento/${evento.id}"><strong class="card-titulo">${evento.titulo} </strong></a> &nbsp;&nbsp;&nbsp;</h5>
                            
                            <p>${evento.descricao}</p>
                            
                            <h5 class=""><small style="font-size: 16px;" class="text-muted ${evento.nome_tipo_evento == 'hackathon' ? 'remover-horario' : ''}"><i class="bi bi-clock text-primary me-2"></i> ${formatarHora(evento.horarioI)} às ${formatarHora(evento.horarioF)}</small></h5>

                            <span class="" style="color: green;">
                                <i class="bi-layout-sidebar me-2"></i>
                                ${evento.local}
                            </span>
                            
                            <div class="row">
                                <div class="col-6">
                                </div>
                                <div class="col-6 tipo-evento-wrapper">
                                    <span class="tipo-evento">${evento.nome_tipo_evento}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="footer-evento" style="">
                        <div class="d-flex overflow-x-auto h-scroll">
                            <div class=" position-relative text-dark-emphasis ms-2 me-1 avatares-wrapper">
                                ${gerarAvatarEvento(evento)}
                                ${gerarAvatarProponentes(evento.proponentes)} 
                            </div>
                        </div>
                    </div>
                </div>`;
            eventos += eventoItem;
        })
        return eventos;
    }

    function renderizarHackathon(evento) {
        return `    <div class="accordion-item hackathon">
        <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#accordion${'hack'}" aria-expanded="false" aria-controls="accordion${'hack'}">
                <h6 class="hack-title"> Hackathon </h6>
            </button>
        </h2>
        <div id="accordion${'hack'}" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
            data-bs-parent="#accordionFlushExample">
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
                        e relevante para a sociedade. <a target="_blank" class="hack_saiba_mais"
                            href="https://hackathonsecitecifg.netlify.app/">SAIBA MAIS</a>
                    </p>
                    <div class="row">
                        <ul class="hack-avisos">
                            <li>
                                <strong>Check-in e Check-out:</strong> O check-in e check-out do hackathon será
                                realizado na abertura e encerramento do evento, mediante a apresentação dos projetos.
                            </li>
                            <li>
                                <strong>Inscrição Individual:</strong> A inscrição é individual. A formação dos grupos e
                                a inscrição dos mesmos serão feitas na abertura do Hackathon.
                            </li>
                            <li>
                                <strong>Horário:</strong> O Hackathon ocorrerá ao longo de toda a SECITEC, com uma
                                variedade de atividades relacionadas ao longo do evento. No entanto, a presença dos
                                participantes será obrigatória apenas na cerimônia de abertura e na apresentação dos
                                projetos, que acontecerão no dia 23, das 08:00 às 12:00, e no dia 26, das 10:00 às
                                12:00. Não será possível se cadastrar no evento caso já estejam cadastrados em eventos
                                que coincidam com essas datas.
                            </li>
                        </ul>
                        <table class="cyber-table">
                            <thead>
                                <tr>
                                    <th scope="col">Atividade</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Horário</th>
                                    <th scope="col">Local</th>
                                    <th class="tb-descricao" scope="col">Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Abertura do Hackathon e formação de equipes</td>
                                    <td>Dia 23</td>
                                    <td style="white-space: nowrap;">8h - 12h</td>
                                    <td>Auditório</td>
                                    <td class="tb-descricao">Boas vindas, explicação sobre as regras e aula introdutória
                                    </td>
                                </tr>
                                <tr>
                                    <td>Oficina de Scratch e mentoria</td>
                                    <td>Dia 23</td>
                                    <td style="white-space: nowrap;">16h - 18h</td>
                                    <td>LAB 1</td>
                                    <td class="tb-descricao">Ensino da linguagem de programação SCRATCH e mentoria</td>
                                </tr>
                                <tr>
                                    <td>Tempo livre para desenvolvimento no LAB (OPCIONAL)</td>
                                    <td>Dia 24</td>
                                    <td style="white-space: nowrap;">10h - 12h</td>
                                    <td>LAB 1</td>
                                    <td class="tb-descricao">Tempo para desenvolvimento e acompanhamento.
                                        Disponibilização dos computadores do
                                        IFG para desenvolverem
                                        o projeto</td>
                                </tr>
                                <tr>
                                    <td>Sessões de mentoria e acompanhamento (OPCIONAL)</td>
                                    <td>Dia 24</td>
                                    <td style="white-space: nowrap;">15h - 17h</td>
                                    <td>LAB 1</td>
                                    <td class="tb-descricao">Tempo para desenvolvimento e acompanhamento.
                                        Disponibilização dos computadores do
                                        IFG para desenvolverem
                                        o projeto</td>
                                </tr>
                                <tr>
                                    <td>Tempo livre para desenvolvimento no LAB (OPCIONAL)</td>
                                    <td>Dia 25</td>
                                    <td>10h - 12h</td>
                                    <td>LAB 1</td>
                                    <td class="tb-descricao">Tempo para desenvolvimento e acompanhamento.
                                        Disponibilização dos computadores do
                                        IFG para desenvolverem
                                        o projeto</td>
                                </tr>
                                <tr>
                                    <td>Tempo livre para desenvolvimento no LAB (OPCIONAL)</td>
                                    <td>Dia 25</td>
                                    <td style="white-space: nowrap;">15h - 17h</td>
                                    <td>LAB 1</td>
                                    <td class="tb-descricao">Tempo para desenvolvimento e acompanhamento.
                                        Disponibilização dos computadores do
                                        IFG para desenvolverem
                                        o projeto</td>
                                </tr>
                                <tr>
                                    <td>Entrega do programa</td>
                                    <td>Dia 25</td>
                                    <td style="white-space: nowrap;">até 18h</td>
                                    <td>Formulário online</td>
                                    <td class="tb-descricao">Entrega para avaliação prévia da banca</td>
                                </tr>
                                <tr>
                                    <td>Finalização e entrega de prêmios</td>
                                    <td>Dia 26</td>
                                    <td style="white-space: nowrap;">10h - 12h</td>
                                    <td>Auditório</td>
                                    <td class="tb-descricao">Apresentação aberta ao público dos melhores jogos
                                        selecionados</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="code-block">
                ${gerarAvatarProponentes(eventosAgrupados.Hackathon[0].proponentes)} 
            </div>
            </div>
        </div>
    </div>`
    }

    renderizarAccordions();
</script>

@endsection