@extends('admin.template')
@section('content')

<h2 class="text-center" style="margin-bottom: 100px;">Registrar presença do evento {{request("nome_evento")}}</h2>

<div class="container d-flex">
    <div class="mx-auto">
        <h4 class="text-success">Checkin</h4>
        <div class="mb-3">
            <label class="form-label">Cód barras ou CPF</label>
            <input type="text" name="cpf" id="cpfCheckin" class="form-control">
        </div>
        <button type="submit" class="btn btn-success" onclick="checkinout('/admin/presenca/checkin', {{request('id_evento')}}, this, false, 'in')">Efetuar Checkin</button>
    </div>

    <div class="mx-auto">
        <h4 class="text-danger">Checkout</h4>
        <div class="mb-3">
            <label class="form-label">Cód barras ou CPF</label>
            <input type="text" name="cpf" id="cpfCheckout" class="form-control">
        </div>
        <button type="submit" class="btn btn-danger" onclick="checkinout('/admin/presenca/checkout', {{request('id_evento')}}, this, false, 'out')">Efetuar Checkout</button>
    </div>
</div>

<!-- Modal de confirmação do Checkin -->
<div class="modal" tabindex="-1" id="modalcheckin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Checkin já feito.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">O Checkin deste usuário já foi feito, tem certeza que deseja fazer novamente?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary" onclick="checkinout('/admin/presenca/checkin', {{request('id_evento')}}, this, true, 'in')">Sim</button>
            </div>
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
                <button type="button" class="btn btn-primary" onclick="checkinout('/admin/presenca/checkout', {{request('id_evento')}}, this, true, 'out')">Sim</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset("js/admin.js")}}"></script>
@endsection
