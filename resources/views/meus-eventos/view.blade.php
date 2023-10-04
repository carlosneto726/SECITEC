@extends('templates.template')
@section('content')

<script type="text/javascript" src="{{asset('js/qrcode.js')}}"></script>
<img src="{{asset('images/logo_email.jpg')}}" id="logo" hidden>


<section class="schedule section-padding" id="section_4">
    <div class="container">
        <!-- texto aparece so em tamanho sm-->
        <h2 class="mb-5 d-block d-md-none">Seus <u class="text-success">Eventos Cadastrados</u></h2>
        <div class="clearfix">
                <!-- Aparece o qr code e botão em ao lado menos no tamanho sm-->
                <div class="col-md-6 float-sm-end ms-md-3 d-none d-md-block">
                    <center>
                        <div id="qrcode" style="width:100px; height:100px;"></div>
                        <br>
                        <p><button class="btn btn-success" onclick="downloadPDF()">Cartão de Entrada</button></p>
                    </center>
                </div>

                <!-- texto não aparece em tamanho sm-->
                <h2 class="mb-5 d-none d-md-block">Seus <u class="text-success">Eventos Cadastrados</u></h2>
                <p>
                    As programações da <span class="text-success fw-bolder">SECITEC</span> que você se cadastratou serão mostra nessa página. 
                    Também nesta página está disponível o cartão de entrada para os eventos que você está inscrito, basta apertar no botão de  <span class="text-success fw-bolder">Cartão de Entrada</span>
                    para fazer o download em pdf ou ultilizar o qr code mostrado nessa página para entrar nos seus eventos cadastrados.
                </p>
                <!-- Aparece o qr code e botão em baixo tamanho sm-->
                <div class="d-block d-md-none">
                    <center>
                        <div id="qrcode2" style="width:100px; height:100px;"></div>
                        <br>
                        <p><button class="btn btn-success" onclick="downloadPDF()">Cartão de Entrada</button></p>
                    </center>
                </div>
            
        </div>
        
        
    </div>


    @foreach ($eventos as $evento)
        <div class="container">
            <div class="card mt-3 mb-3">
                <div class="card-body card-conteudo">
                    <div class="card-text">
                        <h5 class="mb-4"> <strong class="card-titulo"> {{$evento->titulo}} </strong> &nbsp;&nbsp;&nbsp;<small style="font-size: 18px;" class="text-muted ${ evento.nome_tipo_evento == 'hackathon' ? 'remover-horario' : '' }"><i class="bi bi-clock text-primary me-2"></i> {{$evento->horarioI}} às {{$evento->horarioF}}</small></h5>
                        <p>{{$evento->descricao}}</p>
                        <div class="row">
                        
                        </div>
                    </div>
                </div>
                <div class="card-footer" id="footer-evento">
                    <div class="row">
                        <div class="col-6">
                        <span class="col-12 mx-1 mx-lg-2 " style="color: green;">
                                    <i class="bi-layout-sidebar me-2"></i>
                                    {{$evento->local}}
                                </span>
                            
                        </div>
                        
                    </div>
                </div>
               </div>
        </div>
    @endforeach

</section>

<script>
    var eventos = {{ Js::from($eventos) }};

    var cpf = {{ Js::from($cpf) }};

    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 100,
        height : 100
    });
    var qrcode2 = new QRCode(document.getElementById("qrcode2"), {
        width : 100,
        height : 100
    });
    qrcode.makeCode( cpf );
    qrcode2.makeCode( cpf );

    var qrImage = document.getElementById("qrcode").getElementsByTagName('img')[0];
    var logo = document.getElementById('logo');
</script>

<script type="text/javascript" src="{{asset('js/jsPDF.js')}}?v=1.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>
@endsection