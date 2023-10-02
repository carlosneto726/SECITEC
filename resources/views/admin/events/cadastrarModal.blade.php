
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar um evento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

                <div class="modal-body">

                    <div class="d-flex mx-auto mb-3">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                --Selecione o(s) proponente(s)--
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($palestrantes as $palestrante)
                                    <li>
                                        <div class="form-check ms-2 border-bottom">
                                            <input class="form-check-input proponentes" type="checkbox" value="{{$palestrante->id}}" id="{{$palestrante->id}}">
                                            <label class="form-check-label" for="{{$palestrante->id}}" >
                                                {{$palestrante->nome}}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach                                
                            </ul>
                        </div>

                        <span class="ms-2 mt-2">
                            ou
                            <a href="{{url('/admin/proponente')}}" class="border-bottom">Cadastre um</a>
                        </span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Titulo do evento</span>
                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Atividade..." maxlength="255" required>
                    </div>
                    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Evento para ensinar crianças..."  maxlength="255" required>
                        <span class="input-group-text" id="basic-addon2">Descrição</span>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Data do evento</label>
                        <select class="form-select" name="data" id="data" required>
                            <option value="2023-10-23" selected>Dia 23/10/2023</option>
                            <option value="2023-10-24">Dia 24/10/2023</option>
                            <option value="2023-10-25">Dia 25/10/2023</option>
                            <option value="2023-10-26">Dia 26/10/2023</option>
                        </select>
                    </div>
                    
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="vagas" id="vagas" placeholder="75" onkeypress="return event.charCode >= 48" min="1"  required>
                        <span class="input-group-text">Vagas</span>
                    </div>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text">horário de início</span>
                        <input type="time" class="form-control" name="hrInicio" id="hrInicio" required>
                        <span class="input-group-text">horário de fim</span>
                        <input type="time" class="form-control" name="hrFim" id="hrFim" onchange="calcularHoras()" required>
                    </div>

                    
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="horas" id="horas" placeholder="10" onkeypress="return event.charCode >= 48" min="1"  required>
                        <span class="input-group-text" id="horas">Horas de certificado</span>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="horas">Local do evento</span>
                        <input type="text" class="form-control" name="local" id="local" placeholder="Auditório..." required>
                    </div>

                    <div class="mb-3">
                        <label for="basic-url" class="form-label">Escolha a foto que representa o Evento</label>
                        <div class="input-group">
                            <input class="form-control" type="file" name="arquivo" id="formFile" accept=".png, .jpg, .jpeg, .webp, .avif, .jfif" required>
                        </div>
                        <div class="form-text" id="basic-addon4">.png, .jpg, .jpeg, .webp, .avif, .jfif</div>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="tipoEvento">Tipo de evento</label>
                        <select class="form-select" name="tipoEvento" id="tipoEvento" required>
                            @foreach ($tipoEventos as $tipoEvento)
                                <option style="text-transform:capitalize;" value="{{ $tipoEvento->id }}">{{ $tipoEvento->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="fw-bold text-danger" id="alerta"></span>
                    <input class="btn btn-success ms-auto" type="submit" value="Enviar" onclick="cadastrarEvento('/admin/eventos/cadastrar', this)"/>
                </div>
            
                
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/desvg@1.0.2/desvg.min.js"></script>