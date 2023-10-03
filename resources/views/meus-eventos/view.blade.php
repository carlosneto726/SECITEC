@extends('templates.template')
@section('content')

<script type="text/javascript" src="{{asset('js/qrcode.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jsPDF.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>

<center>
    <div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>
</center>

<h1>MEUS EVENTOS</h1>
@foreach ($eventos as $evento)
<div>
    {{$evento->id_evento}}
    {{$evento->titulo}}
    {{$evento->descricao}}
    {{$evento->dia}}
    {{$evento->horarioI}}
    {{$evento->horarioF}}
    {{$evento->vagas}}
    {{$evento->horas}}
    {{$evento->local}}
    {{$evento->url}}
    {{$evento->id_tipo_evento}}
</div>
@endforeach

<button onclick="downloadPDF()">Baixar comprovante</button>


<script>
    var cpf = {{ Js::from($cpf) }};

    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 100,
        height : 100
    });
    qrcode.makeCode( cpf );
    makeCode();
</script>

@endsection