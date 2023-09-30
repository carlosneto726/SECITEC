@extends('admin.template')
@section('content')


<script src="{{asset('js/admin.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="schedule mb-5" id="section_4">
    <div class="container">
        <h2 class=""><u class="text-success"><a class="" href="#staticBackdrop" data-bs-toggle="modal">Eventos
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square float-end" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </a></u></h2>
    </div>
</section>

<div class="container shadow p-3 mb-5 bg-body rounded">
    <table class="table table-bordered">
        <tr>
            <th class="align-middle text-center">Imagem</th>
            <th class="align-middle text-center">Titulo</th>
            <div class=""><th class="d-none d-lg-table-cell align-middle text-center">Tipo</th></div>
            <th class="d-none d-lg-table-cell align-middle text-center">Descrição</th>
            <th class="align-middle text-center">Dia</th>
            <th class="align-middle text-center">Horário Inicio</th>
            <th class="d-none d-lg-table-cell align-middle text-center">Horário Fim</th>
            <th class="align-middle text-center">Vagas</th>
            <th class="d-none d-lg-table-cell align-middle text-center">Horas</th>
            <th class="d-none d-lg-table-cell align-middle text-center">Proponentes</th>
            <th class="align-middle text-center">Alterar</th>
            
        </tr>
        @if(count($eventos) == 0)
            <tr>
                <td 
                class="align-middle text-center h5 fw-bold" colspan="11">
                    Esse lugar parece tão vazio 🍃<br>
                    <a href="#staticBackdrop" 
                    data-bs-toggle="modal" 
                    style="text-decoration: underline;">Cadastre</a>
                    algum evento.
                </td>
            </tr>
        @endif
        @foreach ($eventos as $dados)
            <tr>
                <td class="align-middle text-center"><img src="{{asset($dados->url)}}" class="img-flex" width="64"></td>
                <td class="align-middle text-center">{{$dados->titulo}}</td>
                <td class="d-none d-lg-table-cell align-middle text-center text-transform:capitalize;">{{$dados->tipo_evento_nome}}</td>
                <td class="d-none d-lg-table-cell align-middle text-center"> {{$dados->descricao}}</td>
                <td class="align-middle text-center">{{ date('d', strtotime($dados->dia)) }}</td>
                <td class="align-middle text-center">{{ date('H:i', strtotime($dados->horarioI)) }}</td>
                <td class="d-none d-lg-table-cell align-middle text-center">{{ date('H:i', strtotime($dados->horarioF)) }}</td>
                <td class="align-middle text-center">{{$dados->vagas}}</td>
                <td class="d-none d-lg-table-cell align-middle text-center">{{$dados->horas}}</td>
                <td class="d-none d-lg-table-cell align-middle text-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Proponente(s)
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($dados->proponentes as $proponente)
                                <li class="p-2 border">{{ $proponente }}</li>
                            @endforeach
                        </ul>
                    </div>
                </td>
                @include('admin.events.alterarModal')
                <td class="align-middle text-center"><a href="{{url('/admin/presenca/'.$dados->id.'/'.$dados->titulo)}}" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>
                </a>
                    <a href="#staticBackdrop{{$dados->id}}" class="btn btn-primary" data-bs-toggle="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggles" viewBox="0 0 16 16">
                            <path d="M4.5 9a3.5 3.5 0 1 0 0 7h7a3.5 3.5 0 1 0 0-7h-7zm7 6a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm-7-14a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm2.45 0A3.49 3.49 0 0 1 8 3.5 3.49 3.49 0 0 1 6.95 6h4.55a2.5 2.5 0 0 0 0-5H6.95zM4.5 0h7a3.5 3.5 0 1 1 0 7h-7a3.5 3.5 0 1 1 0-7z"/>
                        </svg>
                    </a>
                
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$dados->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                        </svg>
                    </button>
                </td>
                
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