@extends('admin.template')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container pb-5">
    <h2 class=""><u class="text-success">{{ request('nome_evento') }}</u></h2>
</div>

<div class="container">
    <div class="mx-auto">
        <div class="position-relative">
            <canvas class="img-fluid rounded" id="canvas" hidden></canvas>
            <button class="btn btn-danger position-absolute top-0 end-0" id="fecharCamera" onclick="fecharCamera()" hidden>Fechar Câmera</button>
        </div>

        <h4 class="text-danger" id="titulo">Checkout</h4>
        <div class="mb-3">
            <input type="text" name="cpf" id="cpfCheckout" class="form-control" placeholder="CPF">
        </div>
        <div class="d-flex">
            <button 
                type="submit" 
                class="btn btn-danger"
                id="btn-checkinout"
                onclick="checkinout('/admin/presenca/checkout', {{ request('id_evento') }}, this, false, 'out')">
                Efetuar Checkout
            </button>
            <button class="btn btn-success ms-auto" onclick="lerQrcode()">Ler QRCode</button>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-striped table-hover container mt-5">
        <thead>
            <tr>
                <th scope="col">nome</th>
                <th scope="col">cpf</th>
                <th scope="col">checkin</th>
                <th scope="col">checkout</th>
                <th class="d-none d-md-block" scope="col">status</th>
                <th scope="col">data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios_evento as $usuario)
                @php
                    $datetime = new DateTime($usuario->data_insercao);
                @endphp
                <tr>
                    <td>{{$usuario->nome}}</td>
                    <td class="text-break">{{$usuario->cpf}}</td>
                    <td>{{$usuario->checkin}}</td>
                    <td id="{{$usuario->id}}">{{$usuario->checkout}}</td>
                    <td class="d-none d-md-block">{{$usuario->status}}</td>
                    <td>{{ date_format($datetime, 'd/m') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal de confirmação do Checkout -->
<div class="modal" tabindex="-1" id="modalcheckout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Checkout já feito.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">O Checkout deste usuário já foi feito, tem certeza que deseja fazer novamente?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary"
                    onclick="checkinout('/admin/presenca/checkout', {{ request('id_evento') }}, this, true, 'out')">Sim</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação do Checkin -->
<div class="modal" tabindex="-1" id="modalerro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Erro.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">Não foi possível fazer o check-out.</p>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin.js') }}?v=1.1"></script>
<script src="{{asset("js/jsQR.js")}}"></script>
<script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("cpfCheckout");
    var cpf = "";
    var stream;

    function drawLine(begin, end, color) {
        canvas.beginPath();
        canvas.moveTo(begin.x, begin.y);
        canvas.lineTo(end.x, end.y);
        canvas.lineWidth = 4;
        canvas.strokeStyle = color;
        canvas.stroke();
    }

    function lerQrcode(){
        document.getElementById("canvas").hidden=false;
        document.getElementById("fecharCamera").hidden=false;
        // Use facingMode: environment to attemt to get the front camera on phones
        navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: "environment"
            }
        }).then(function(str) {
            stream = str; // Armazena o stream na variável global
            video.srcObject = stream;
            video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
            video.play();
            requestAnimationFrame(tick);
        });
    }

    function fecharCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
            video.srcObject = null;
            document.getElementById("canvas").hidden = true;
            document.getElementById("fecharCamera").hidden=true;
            outputMessage.hidden = true;
            outputData.value = "";
            cpf = "";
        }
    }


    function tick() {
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
            var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
            var code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: "dontInvert",
            });
            if (code) {
                drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                outputMessage.hidden = false;
                outputData.value = code.data;
                if(cpf != code.data){
                    checkinout('/admin/presenca/checkout', {{ request('id_evento') }}, this, false, 'out')
                    document.getElementById("cpfCheckout").value = "";
                }
                cpf = code.data;
            } else {

            }
        }
        requestAnimationFrame(tick);
    }
</script>
@endsection
