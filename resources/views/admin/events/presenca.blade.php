@extends('admin.template')
@section('content')

<h2 class="text-center" style="margin-bottom: 100px;">Registrar presença</h2>

<div class="container d-flex">
    <div class="mx-auto">
        <h4 class="text-success">Checkin</h4>
        <form action="{{url('/admin/presenca/checkin')}}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="id_evento" value="{{ request('id_evento') }}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cód barras ou CPF</label>
                <input type="text" name="cpf" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Efetuar Checkin</button>
        </form>
    </div>

    <div class="mx-auto">
        <h4 class="text-danger">Checkout</h4>
        <form action="{{url('/admin/presenca/checkout')}}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" name="id_evento" value="{{ request('id_evento') }}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cód barras ou CPF</label>
                <input type="text" name="cpf" class="form-control">
            </div>
            <button type="submit" class="btn btn-danger">Efetuar Checkout</button>
        </form>
    </div>
</div>
@endsection
