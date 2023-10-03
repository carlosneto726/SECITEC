@extends('admin.template')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<h2 class="text-center" style="margin-bottom: 100px;">{{ request('nome_evento') }}</h2>

<div class="container d-flex">
    <div class="mx-auto" style="width: 640px;">
        <canvas id="canvas"></canvas>
        <div class="text-danger" id="outputMessage" hidden>Qr Code lido com sucesso.</div>
        <h4 class="text-danger">Checkout</h4>
        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" id="cpfCheckout" class="form-control">
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-danger" onclick="checkinout('/admin/presenca/checkout', {{ request('id_evento') }}, this, false, 'out')">Efetuar
                Checkout
            </button>
            <button class="btn btn-primary ms-auto" onclick="lerQrcode()">Ler QRCode</button>
        </div>
    </div>
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

<script src="{{ asset('js/admin.js') }}?v=1.0"></script>
<script src="{{asset("js/jsQR.js")}}"></script>
<script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("cpfCheckout");

    function drawLine(begin, end, color) {
        canvas.beginPath();
        canvas.moveTo(begin.x, begin.y);
        canvas.lineTo(end.x, end.y);
        canvas.lineWidth = 4;
        canvas.strokeStyle = color;
        canvas.stroke();
    }

    function lerQrcode(){
        // Use facingMode: environment to attemt to get the front camera on phones
        navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: "environment"
            }
        }).then(function(stream) {
            video.srcObject = stream;
            video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
            video.play();
            requestAnimationFrame(tick);
        });
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
            } else {

            }
        }
        requestAnimationFrame(tick);
    }
</script>
@endsection
