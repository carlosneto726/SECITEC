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
</style>

<script type="text/javascript" src="{{asset('js/qrcode.js')}}"></script>
<img src="{{asset('images/logo_email.jpg')}}" id="logo" hidden>


<section class="schedule section-padding" id="section_4">
    <div class="container">
        <!-- texto aparece so em tamanho sm-->
        <h2 class="mb-5 d-block d-md-none">Seus <u class="text-success">Eventos Cadastrados</u></h2>
        <div class="clearfix">
                <!-- Aparece o qr code e botão em ao lado menos no tamanho sm-->
                <div class="col-md-3 float-sm-end ms-md-3">
                    <center>
                        <div id="qrcode" style="width:100px; height:100px;"></div>
                        <br>
                        <p><button class="btn btn-success" id="downloadPDF">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                            Cartão de Presença
                        </button></p>
                    </center>
                </div>

                <!-- texto não aparece em tamanho sm-->
                <h2 class="mb-5 d-none d-md-block">Seus <u class="text-success">Eventos Cadastrados</u></h2>
                <p>
                    Nesta página você encontrará as informações sobre os eventos da <span class="text-success fw-bolder">SECITEC</span> para os quais se cadastrou. 
                    A página exibirá detalhes sobre essas programações, facilitando seu acesso às informações necessárias. 
                    Além disso, esta mesma página oferece uma maneira fácil de obter seu cartão de entrada para os eventos nos quais você se inscreveu. 
                    Você pode fazer isso de duas maneiras: pressionando o botão <span class="text-success fw-bolder">Cartão de Entrada</span> para baixar o cartão em formato PDF, ou utilizando o código <span class="text-success fw-bolder">QR Code</span> disponível na página. 
                    Este código <span class="text-success fw-bolder">QR Code</span> séra escaneado para a validação de presença nos eventos para os quais você se inscreveu.
                </p>
                <!-- Aparece o qr code e botão em baixo tamanho sm-->
            
        </div>
        
        
    </div>
    <br>
    <div class="container">
        <div class="accordion" id="accordionExample">
                
        </div>
    </div>

    <script>
  
        const accordion = document.getElementById('accordionExample');
        var eventos = @json($eventos);
        const eventosAgrupados = agruparEventosPorDia(eventos);
        //console.log(eventosAgrupados);
        
        function gerarAvatarProponentes(proponentes){
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
                                          <h5 class=""><strong class="card-titulo">${evento.titulo} </strong> &nbsp;&nbsp;&nbsp;</h5>
                                          
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
                                  <div class="card-footer" id="footer-evento" style="height:;">
                                      <div class="d-flex overflow-x-auto h-scroll">
                                          <div class=" position-relative text-dark-emphasis ms-2 me-1 avatares-wrapper">
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

</section>

<script>
    var eventos = {{ Js::from($eventos) }};
    var cpf = {{ Js::from($cpf) }};

    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 100,
        height : 100
    });

    qrcode.makeCode( cpf );

    var qrImage = document.getElementById("qrcode").getElementsByTagName('img')[0];
    var logo = document.getElementById('logo');
</script>

<script type="text/javascript" src="{{asset('js/jsPDF.js')}}?v=1.3"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>
@endsection