 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar um proponente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{url('/admin/proponente/cadastrar')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="txtNome" placeholder="Ex: Juliano" maxlength="255" required/>
                        <label>Informe o nome do proponente</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="txtTitulacao" placeholder="Ex: Doutorado em ciências sociáis"  maxlength="255" required/>
                        <label>Informe a titulação</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="rede1" placeholder="Ex: https://www.instagram.com/carlosneto726/"  maxlength="255"/>
                        <label>Rede Social 1</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="rede2" placeholder="Ex: https://www.instagram.com/carlosneto726/"  maxlength="255"/>
                        <label>Rede Social 2</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control " type="text" name="rede3" placeholder="Ex: https://www.instagram.com/carlosneto726/"  maxlength="255"/>
                        <label>Rede Social 3</label>
                    </div>
                    <div class="mb-2">
                        <label for="basic-url" class="form-label">Escolha uma foto da palestrante</label>
                        <div class="input-group">
                            <input class="form-control" type="file" name="arquivo" id="formFile" accept=".png, .jpg, .jpeg, .webp, .avif, .jfif">
                        </div>
                        <div class="form-text" id="basic-addon4">.png, .jpg, .jpeg, .webp, .avif, .jfif</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-dark" type="submit" value="Enviar"/>
                </div>
            </form>
       </div>
   </div>
</div>
