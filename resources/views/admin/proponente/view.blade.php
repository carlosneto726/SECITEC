@extends('admin.template')
@section('content')

<script>
    var proponentes = {{ Js::from($proponentes)}};
</script>
<script src="{{asset('js/adm_proponentes.js')}}"></script>

<div class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Proponentes</h6>
        @foreach ($proponentes as $proponente)
            <div class="d-flex text-body-secondary pt-3 border-bottom">
                <img class="rounded object-fit-cover" src="{{asset($proponente->url)}}" height="64" width="64">
                <div class="pb-3 mb-0 small lh-sm w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="fs-5 text-gray-dark ms-1">{{$proponente->nome}}</strong>
                        
                        <span class="text-break ms-5 me-5">Rede social 1: <a href="{{@$proponente->redes[0]->rede1}}" target="_blank">{{@$proponente->redes[0]->rede1}}</a></span>
                        <span class="text-break ms-5 me-5">Rede social 2: <a href="{{@$proponente->redes[0]->rede2}}" target="_blank">{{@$proponente->redes[0]->rede2}}</a></span>
                        <span class="text-break ms-5 me-5">Rede social 3: <a href="{{@$proponente->redes[0]->rede3}}" target="_blank">{{@$proponente->redes[0]->rede3}}</a></span>
                        
                        <div class="d-flex mt-3">
                            <button type="submit" class="btn btn-primary btn-sm" title="alterar" href="#staticBackdrop{{$proponente->id}}" data-bs-toggle="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-toggles" viewBox="0 0 16 16">
                                    <path d="M4.5 9a3.5 3.5 0 1 0 0 7h7a3.5 3.5 0 1 0 0-7h-7zm7 6a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm-7-14a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm2.45 0A3.49 3.49 0 0 1 8 3.5 3.49 3.49 0 0 1 6.95 6h4.55a2.5 2.5 0 0 0 0-5H6.95zM4.5 0h7a3.5 3.5 0 1 1 0 7h-7a3.5 3.5 0 1 1 0-7z"/>
                                </svg>
                            </button>
                            <form method="POST" action="{{url('/admin/proponente/deletar')}}">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id" value="{{$proponente->id}}"/>
                                <button type="submit" class="btn btn-danger btn-sm" title="deletar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <span class="d-block ms-1">{{$proponente->titulacao}}</span>
                </div>
            </div>
            @include('admin.proponente.editarModal')
        @endforeach
        <small class="d-block text-end mt-3"> 
            <a class="ms-auto btn btn-primary" href="#staticBackdrop" data-bs-toggle="modal">Cadastrar proponente</a>
        </small>
    </div>      
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@include('admin.proponente.cadastrarModal')


@endsection
