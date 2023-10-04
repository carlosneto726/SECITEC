@extends('templates.template')
@section('content')

<script type="text/javascript" src="{{asset('js/qrcode.js')}}"></script>
<img src="{{asset('images/logo_email.jpg')}}" id="logo" hidden>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>Eventos Cadastrados</h2>
        </div>
        <div class="col-4">
            <div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>
        </div>
    </div>
    <button onclick="downloadPDF()">Baixar comprovante</button>
</div>


@foreach ($eventos as $evento)
<div class="container">


    <div class="card mt-3 mb-3">
        <div class="card-body card-conteudo">
            <div class="card-text">
                <h5 class="mb-4"> <strong class="card-titulo"> {{$evento->id_evento}} </strong> &nbsp;&nbsp;&nbsp;<small style="font-size: 18px;" class="text-muted ${ evento.nome_tipo_evento == 'hackathon' ? 'remover-horario' : '' }"><i class="bi bi-clock text-primary me-2"></i> ${formatarHora(evento.horarioI)} às ${formatarHora(evento.horarioF)}</small></h5>
                <p>{{$evento->titulo}}</p>
                <div class="row">
                    <div class="col-6">
                    </div>
                   
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



<script>
    var eventos = {{ Js::from($eventos) }};

    var cpf = {{ Js::from($cpf) }};

    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 120,
        height : 120
    });
    qrcode.makeCode( cpf );
    var qrImage = document.getElementById("qrcode").getElementsByTagName('img')[0];
    var logo = document.getElementById('logo');
</script>

<script type="text/javascript" src="{{asset('js/jsPDF.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>
@endsection