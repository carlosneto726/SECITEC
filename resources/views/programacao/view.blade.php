
@extends('templates.template')
@section('content')

<!--CSS PARA ICONES DOS PROPONENTES-->
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
    .custom-tooltip {
      --bs-tooltip-bg: #17882c;
      --bs-tooltip-color: var(--bs-white);
    }    
</style>

<!--LOCAL QUE RECEBE O CONTEÚDO QUE É GERADO-->
<section class="schedule section-padding" id="section_4">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12">
        <h2 class="mb-5 ">Nossos <u class="text-success">Eventos</u></h2>
        <div class="tab-content mt-5" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-DayOne" role="tabpanel" aria-labelledby="nav-DayOne-tab">
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
  //console.log(eventosAgrupados);
    function gerarAvatarEvento(evento){
        let avatares = ''
        if(evento.url){
            avatares += `<div class="avatar-proponente"><a "><img src="${evento.url}" style="height: 50px; width: 50px; border-radius: 50px;" alt="Avatar" /></a></div>`
        }
        return avatares;
    }
    function gerarAvatarProponentes(proponentes){
        let avatares = ''
        proponentes.forEach(proponente => {
            avatares += `<div class="avatar-proponente"><a href="/proponente/${proponente.id_proponente}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="${proponente.nome}"><img src="${proponente.url}" style="height: 50px; width: 50px; border-radius: 50px;" alt="Avatar" /></a></div>`
        });
        return avatares;
    }
    function agruparEventosPorDia(eventos) {
        const grupos = { Hackathon: [] };

        eventos.forEach(evento => {
            const dia = evento.dia;
            if (!grupos[dia]) {
                if(evento.nome_tipo_evento !== 'hackathon')
                    grupos[dia] = [];
            }
            if(evento.nome_tipo_evento == 'hackathon') {
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
                            
                            <h5 class=""><small style="font-size: 16px;" class="text-muted ${ evento.nome_tipo_evento == 'hackathon' ? 'remover-horario' : '' }"><i class="bi bi-clock text-primary me-2"></i> ${formatarHora(evento.horarioI)} às ${formatarHora(evento.horarioF)}</small></h5>

                            <span class="" style="color: green;">
                                <i class="bi-layout-sidebar me-2"></i>
                                ${ evento.local}
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
                                ${ gerarAvatarEvento(evento) }
                                ${ gerarAvatarProponentes(evento.proponentes) } 
                            </div>
                        </div>
                    </div>
                </div>`;
            eventos += eventoItem;
        })
        return eventos;
    }
    renderizarAccordions();
</script>

@endsection