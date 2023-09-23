 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop{{$proponente->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar um proponente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{url('/admin/proponente/atualizar/'.$proponente->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="nome" value="{{$proponente->nome}}"/>
                        <label>Informe o nome do proponente</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="titulacao" value="{{$proponente->titulacao}}"/>
                        <label>Informe a titulação</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="rede1" value="{{@$proponente->redes[0]->rede1}}"/>
                        <label>Rede Social 1</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="rede2" value="{{@$proponente->redes[0]->rede2}}"/>
                        <label>Rede Social 2</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="rede3" value="{{@$proponente->redes[0]->rede3}}"/>
                        <label>Rede Social 3</label>
                    </div>

                    <p><label>Escolha uma foto da palestrante</label></p>
                    <p><input class="form-control" type="file" name="arquivo"/></p>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-dark" type="submit" value="Enviar"/>
                    <input class="btn btn-dark" type="reset" value="Limpar"/>
                </div>
            </form>
       </div>
   </div>
</div>
