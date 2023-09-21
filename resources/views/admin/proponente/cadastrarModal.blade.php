 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar um evento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

           <form action="{{url('/admin/proponente/cadastrar')}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('POST')
               <div class="modal-body">
                   <div class="form-floating mb-3">
                       <p><label for="titulo">Informe o nome do palestrante</label></p>
                       <p><input class="form-control " type="text" name="txtNome" required/></p>
                       <p><label for="titulo">Informe a titulação</label></p>
                       <p><input class="form-control" type="text" name="txtTitulacao" required/></p>
                       <p><label>Escolha a foto da palestrante</label></p>
                       <p><input class="form-control" type="file" name="arquivo" required/></p>
                   </div>
               </div>
               <div class="modal-footer">
                   <input class="btn btn-dark" type="submit" value="Enviar"/>
                   <input class="btn btn-dark" type="reset" value="Limpar"/>
               </div>
           </form>
       </div>
   </div>
</div>
