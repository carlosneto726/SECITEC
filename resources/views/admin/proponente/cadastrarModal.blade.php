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

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            --Selecione o(s) eventos(s) (OPCIONAL)--
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($eventos as $evento)
                                <li>
                                    <div class="form-check ms-2 border-bottom">
                                        <input class="form-check-input proponentes" type="checkbox" name="eventos[]" value="{{$evento->id}}" id="{{$evento->id}}">
                                        <label class="form-check-label" for="{{$evento->id}}" >
                                            {{$evento->titulo}}
                                        </label>
                                    </div>
                                </li>
                            @endforeach                                
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-dark" type="submit" value="Enviar"/>
                </div>
            </form>
       </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/desvg@1.0.2/desvg.min.js"></script>