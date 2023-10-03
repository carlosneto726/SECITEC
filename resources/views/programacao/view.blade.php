
@extends('templates.template')
@section('content')


<section class="schedule section-padding" id="section_4">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12">
        <h2 class="mb-5 ">Nossa <u class="text-success">Programação</u></h2>
        <div class="tab-content mt-5" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-DayOne" role="tabpanel" aria-labelledby="nav-DayOne-tab">
            <div class="row pb-5 mb-5">
              <div class="accordion" id="accordionExample">
                @php
                    $c = 0;
                @endphp

                @foreach ($programacoes as $programacao)
                    @php
                        $c ++;
                    @endphp
                  <div class="accordion-item">
                      <h2 class="accordion-header">
                          <button class="accordion-button" type="button" 
                              data-bs-toggle="collapse"
                              data-bs-target="#collapse{{$c}}"
                              @if( $c == 1 ) aria-expanded="true" @else aria-expanded="false" @endif
                              aria-controls="collapse{{$c}}">
                              {{$programacao['dia']}}
                          </button>
                      </h2>
                      <div id="collapse{{$c}}"
                      @if( $c == 1 ) class="accordion-collapse collapse show" @else class="accordion-collapse collapse" @endif
                      
                          data-bs-parent="#accordionExample">
                          <div class="accordion-body">

                            @if(count($programacao[0]) == 0)
                              <div class="fw-bold h5">
                                Parece que ainda não temos nenhum evento para esta data, por favor, volte mais tarde.
                              </div>
                            @endif

                                @foreach ($programacao[0] as $evento)
                                    <div class="border-bottom mb-3">
                                        <div class="row">
                                            <span class="col-8 mx-1 mx-lg-2">
                                                <i class="bi-clock me-2"></i>
                                                {{$evento->horarioI}} Ás {{$evento->horarioF}}
                                            </span>
                                            <span class="col mx-10 mx-lg-20" style="color: blue;">
                                                <i class="me-2 "></i>
                                                {{$evento->nome_tipo_evento}}
                                            </span>
                                            <span class="col-12 mx-1 mx-lg-2 " style="color: green;">
                                                <i class="bi-layout-sidebar me-2"></i>
                                                {{$evento->local}}
                                            </span>
                                        </div>
                                        <div class="row">
                                            <p>
                                            <h5 class="col  text-break mx-1 mx-lg-2">{{$evento->titulo}}</h5>
                                            </p>
                                            <p class="text-break mx-1 mx-lg-2">
                                                {{$evento->descricao}}
                                              </p>
                                            <div class="row d-flex align-items-center mt-4 mb-2">
                                                @foreach ($evento->proponentes as $proponente)
                                                  <a href="{{url('/proponente/'.$proponente->id_proponente)}}" class="col-9 avatar-group d-flex">
                                                      <img src="{{asset($proponente->url)}}" class="img-fluid avatar-image mx-1 mx-lg-2"/>
                                                      <div class="ms-3">
                                                        {{$proponente->nome}}
                                                        <p class="speakers-text mb-0">{{$proponente->titulacao}}</p>
                                                      </div>
                                                  </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                          </div>
                      </div>
                  </div>

                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  
  const accordion = document.getElementById('accordionExample');
  var eventos = @json($eventos);
  const eventosAgrupados = agruparEventosPorDia(eventos);
  //console.log(eventosAgrupados);
  
  function gerarAvatarProponentes(proponentes){
                let avatares = ''
                proponentes.forEach(proponente => {
                    avatares += `<div class="avatar-proponente"><img src="${proponente.url}" style="height: 50px; width: 50px;" alt="Avatar" /></div>`
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
                                    <h5 class="mb-4"> <strong class="card-titulo"> ${evento.titulo} </strong> &nbsp;&nbsp;&nbsp;<small style="font-size: 18px;" class="text-muted ${ evento.nome_tipo_evento == 'hackathon' ? 'remover-horario' : '' }"><i class="bi bi-clock text-primary me-2"></i> ${formatarHora(evento.horarioI)} às ${formatarHora(evento.horarioF)}</small></h5>
                                    <p>${evento.descricao}</p>
                                    <div class="row">
                                        <div class="col-6">
                                        </div>
                                        <div class="col-6 tipo-evento-wrapper">
                                            <span class="tipo-evento" ">${evento.nome_tipo_evento}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" id="footer-evento">
                                <div class="row">
                                     <div class="col-6">
                                     <span class="col-12 mx-1 mx-lg-2 " style="color: green;">
                                                <i class="bi-layout-sidebar me-2"></i>
                                                ${ evento.local}
                                            </span>
                                        
                                     </div>
                                    <div class="col-6 avatares-wrapper">
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