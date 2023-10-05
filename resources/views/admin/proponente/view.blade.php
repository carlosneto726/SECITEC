@extends('admin.template')
@section('content')

<script src="{{asset('js/admin.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="schedule mb-5" id="section_4">
    <div class="container">
        <h2 class=""><u class="text-success"><a class="" href="#staticBackdrop" data-bs-toggle="modal">Proponentes
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-square float-end" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </a></u></h2>
    </div>
</section>

<div class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        @if(count($proponentes) == 0)
            <div class="fw-bold h5">
                Esse lugar parece tão vazio 🍃<br>
                <a href="#staticBackdrop" 
                data-bs-toggle="modal" 
                style="text-decoration: underline;">Cadastre</a>
                algum proponente.
            </div>
        @endif
        @foreach ($proponentes as $proponente)
            <div class="d-flex text-body-secondary pt-3 border-bottom">
                <img class="rounded object-fit-cover" src="{{asset($proponente->url)}}" height="74" width="74">
                <div class="pb-3 mb-0 small lh-sm w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="fs-5 text-gray-dark ms-1">{{$proponente->nome}}</strong>
                        
                        <div class="d-flex mt-3">
                            <button type="submit" class="btn btn-primary btn-sm me-1" title="alterar" href="#staticBackdrop{{$proponente->id}}" data-bs-toggle="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggles" viewBox="0 0 16 16">
                                    <path d="M4.5 9a3.5 3.5 0 1 0 0 7h7a3.5 3.5 0 1 0 0-7h-7zm7 6a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm-7-14a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm2.45 0A3.49 3.49 0 0 1 8 3.5 3.49 3.49 0 0 1 6.95 6h4.55a2.5 2.5 0 0 0 0-5H6.95zM4.5 0h7a3.5 3.5 0 1 1 0 7h-7a3.5 3.5 0 1 1 0-7z"/>
                                </svg>
                            </button>

                            <button type="button" class="btn btn-danger btn-sm" title="deletar" data-bs-toggle="modal" data-bs-target="#exampleModal{{$proponente->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                </svg>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$proponente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Deletar Evento</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <span class="fw-bold fs-4">
                                                Tem certeza que você deseja deletar este proponente?
                                                Essa é uma ação permanente e sem volta.
                                            </span>
                                            <hr>
                                            <p class="mt-3">
                                                Para deletar este proponente, digite extamente o nome do mesmo no campo abaixo.
                                            </p>
                                            <div class="text-danger">
                                                <div class="fw-bold fs-6 ms-2" id="alert{{$proponente->id}}"></div>
                                                <div class="fw-bold fs-6 ms-2 border border-danger rounded p-1 m-1" id="nome{{$proponente->id}}" style="width: fit-content;">{{$proponente->nome}}</div>

                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="input{{$proponente->id}}">
                                                    <label>Digite o nome acima</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger" onclick="excluirBtn('/admin/proponente/deletar', {{$proponente->id}}, this)">Deletar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                <!--aparecer redes e titulação em baixo em tamanho sm-->
                    <span class="d-block ms-1" style="margin-top: -5px;">{{$proponente->titulacao}}</span>
                   
                    <div class="container" style="margin-top: 10px; margin-left: -47px;">
                        <div class="row">
                            <br><br>

                            <span class="text-break ms-5 me-5 d-block d-lg-none d-xl-none d-xxl-none">Rede social 1: <a href="{{@$proponente->redes[0]->rede1}}" target="_blank">{{@$proponente->redes[0]->rede1}}</a></span>
                            <br>
                            <span class="text-break ms-5 me-5 d-block d-lg-none d-xl-none d-xxl-none">Rede social 2: <a href="{{@$proponente->redes[0]->rede2}}" target="_blank">{{@$proponente->redes[0]->rede2}}</a></span>
                            <br>
                            <span class="text-break ms-5 me-5 d-block d-lg-none d-xl-none d-xxl-none">Rede social 3: <a href="{{@$proponente->redes[0]->rede3}}" target="_blank">{{@$proponente->redes[0]->rede3}}</a></span>

                            <span class="text-break ms-5 me-5 d-none d-lg-block d-xl-block d-xxl-block col">Rede social 1: <a href="{{@$proponente->redes[0]->rede1}}" target="_blank">{{@$proponente->redes[0]->rede1}}</a></span>
                            <span class="text-break ms-5 me-5 d-none d-lg-block d-xl-block d-xxl-block col">Rede social 2: <a href="{{@$proponente->redes[0]->rede2}}" target="_blank">{{@$proponente->redes[0]->rede2}}</a></span>
                            <span class="text-break ms-5 me-5 d-none d-lg-block d-xl-block d-xxl-block col">Rede social 3: <a href="{{@$proponente->redes[0]->rede3}}" target="_blank">{{@$proponente->redes[0]->rede3}}</a></span>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.proponente.editarModal')
        @endforeach
    </div>      
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@include('admin.proponente.cadastrarModal')


@endsection               
