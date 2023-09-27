@extends('admin.template')
@section('content')

<div class="container shadow p-3 mb-5 bg-body rounded">
    <div class="d-flex h5">Eventos <a class="btn btn-primary ms-auto" href="#staticBackdrop" data-bs-toggle="modal">Cadastrar evento</a></div>

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Tipo de Evento</th>
            <th>Descrição</th>
            <th>Dia</th>
            <th>Horário Inicio</th>
            <th>Horário Fim</th>
            <th>Vagas</th>
            <th>Horas</th>
            <th>Registrar Presença</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
        @foreach ($eventos as $dados)
            <tr>
                <td>{{$dados->id}}</td>
                <td>{{$dados->titulo}}</td>
                <td style="text-transform:capitalize;">{{$dados->tipo_evento_nome}}</td>
                <td>{{$dados->descricao}}</td>
                <td>{{$dados->dia}}</td>
                <td>{{$dados->horarioI}}</td>
                <td>{{$dados->horarioF}}</td>
                <td>{{$dados->vagas}}</td>
                <td>{{$dados->horas}}</td>
                @include('admin.events.alterarModal')
                <td><a href="{{url('/admin/presenca/'.$dados->id)}}" class="btn btn-primary">Registrar presença</a></td>
                <td><a href="#staticBackdrop{{$dados->id}}" class="btn btn-success" data-bs-toggle="modal">Alterar</a></td>
                <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$dados->id}}">Excluir</button></td>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$dados->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Deletar Evento</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span class="fw-bold fs-4">
                                    Tem certeza que você deseja deletar esse evento?
                                    Essa é uma ação permanente e sem volta.
                                </span>
                                <hr>
                                <p class="mt-3">
                                    Para deletar esse evento, digite extamente o nome do mesmo no campo abaixo.
                                </p>
                                <div class="text-danger">
                                    <div class="fw-bold fs-6 ms-2" id="alert{{$dados->id}}"></div>
                                    <div class="fw-bold fs-6 ms-2 border border-danger rounded p-1 m-1" id="nome{{$dados->id}}" style="width: fit-content;">{{$dados->titulo}}</div>

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="input{{$dados->id}}">
                                        <label>Digite o nome do evento acima</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" onclick="excluirBtn('/admin/eventos/deletar', {{$dados->id}}, this)" id="deletarBtn">Deletar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </tr>            
        @endforeach
    </table>
</div>

<script src="{{asset('js/admin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

@include('admin.events.cadastrarModal')


@endsection