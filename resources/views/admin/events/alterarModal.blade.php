<meta name="csrf-token" content="{{ csrf_token() }}">
 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop{{$dados->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabelChange" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="staticBackdropLabelChange">Alterar um evento</h1>
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
                                             <input class="form-check-input alterar-proponentes{{$dados->id}}" type="checkbox" value="{{$palestrante->id}}" @if(in_array($palestrante->nome, $dados->proponentes)) checked @endif>
                                             <label class="form-check-label" for="flexCheckDefault">
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
                         <span class="input-group-text">Titulo do evento</span>
                         <input type="text" class="form-control" name="titulo" id="alterar-titulo{{$dados->id}}" value="{{$dados->titulo}}" aria-describedby="basic-addon1" required>
                     </div>
                     
                     <div class="input-group mb-3">
                         <input type="text" class="form-control" name="descricao" id="alterar-descricao{{$dados->id}}" value="{{$dados->descricao}}" aria-describedby="basic-addon2" required>
                         <span class="input-group-text">Descrição</span>
                     </div>
 
                     <div class="input-group mb-3">
                         <label class="input-group-text" for="inputGroupSelect01">Data do evento</label>
                         <select class="form-select" name="data" id="alterar-data{{$dados->id}}" required>
                            <option value="{{$dados->dia}}" selected>Dia {{$dados->dia}}</option>
                            <option value="2023-10-23">Dia 23/10/2023</option>
                            <option value="2023-10-24">Dia 24/10/2023</option>
                            <option value="2023-10-25">Dia 25/10/2023</option>
                            <option value="2023-10-26">Dia 26/10/2023</option>
                         </select>
                     </div>
                     
                     <div class="input-group mb-3">
                         <input type="number" class="form-control" name="vagas" id="alterar-vagas{{$dados->id}}" value="{{$dados->vagas}}" onkeypress="return event.charCode >= 48" min="1"  required>
                         <span class="input-group-text">Vagas</span>
                     </div>
                     
                     <div class="input-group mb-3">
                         <span class="input-group-text">horário de início</span>
                         <input type="time" class="form-control" name="hrInicio" id="alterar-hrInicio{{$dados->id}}" value="{{$dados->horarioI}}" required>
                         <span class="input-group-text">horário de fim</span>
                         <input type="time" class="form-control" name="hrFim" id="alterar-hrFim{{$dados->id}}" value="{{$dados->horarioF}}" required>
                     </div>
 
                     
                     <div class="input-group mb-3">
                         <input type="number" class="form-control" name="horas" id="alterar-horas{{$dados->id}}" value="{{$dados->horas}}" onkeypress="return event.charCode >= 48" min="1"  required>
                         <span class="input-group-text">Horas de certificado</span>
                     </div>
 
                     <div class="input-group mb-3">
                         <span class="input-group-text" id="alterar-horas{{$dados->id}}">Local do evento</span>
                         <input type="text" class="form-control" name="local" id="alterar-local{{$dados->id}}" value="{{$dados->local}}" required>
                     </div>
 
                     <div class="mb-3">
                        <img class="img-fluid" src="{{asset( $dados->url )}}">
                         <label for="basic-url" class="form-label">Escolha a foto que representa o Evento</label>
                         <div class="input-group">
                             <input class="form-control" type="file" name="arquivo" id="alterar-formFile{{$dados->id}}" accept=".png, .jpg, .jpeg, .webp, .avif, .jfif" required>
                         </div>
                         <div class="form-text">.png, .jpg, .jpeg, .webp, .avif, .jfif</div>
                     </div>
 
                     <div class="input-group mb-3">
                         <label class="input-group-text" for="tipoEvento">Tipo de evento</label>
                         <select class="form-select" name="tipoEvento" id="alterar-tipoEvento{{$dados->id}}" required>
                             @foreach ($tipoEventos as $tipoEvento)
                                 <option style="text-transform:capitalize;" value="{{ $tipoEvento->id }}" @if($dados->id_tipo_evento == $tipoEvento->id) selected @endif>{{ $tipoEvento->nome }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <span class="fw-bold text-danger" id="alterar-alerta{{$dados->id}}"></span>
                     <input class="btn btn-success ms-auto" type="submit" value="Enviar" onclick="alterarEvento('/admin/eventos/alterar', {{$dados->id}}, this)"/>
                 </div>
             
                 
         </div>
     </div>
 </div>
