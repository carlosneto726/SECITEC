 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop{{$dados->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar um evento</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>

            <form action="{{url('/admin/eventos/alterar')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="hidden" name="id" value="{{$dados->id}}"/>
                        <p><label>Informe o titulo do evento</label></p>
                        <p> <input class="form-control" type="text" name="txtTitulo" value="{{$dados->titulo}}" required/></p>
                        <p><label>Informe a descrição do evento</label></p>
                        <p> <input class="form-control" type="text" name="txtDescricao" value="{{$dados->descricao}}" required/></p>
                        <p><label>Informe a data do evento</label></p>
                        <p> <input class="form-control" type="date" name="diaEvento" value="{{$dados->dia}}" required/></p>
                        <p><label>Informe o horário de início</label></p>
                        <p> <input class="form-control" type="time" name="hrInicio" value="{{$dados->horarioI}}" required/></p>
                        <p><label>Informe o horário de fim</label></p>
                        <p> <input class="form-control" type="time" name="hrFim" value="{{$dados->horarioF}}"  required/></p>
                        <p><label>Informe o número de vagas</label></p>
                        <p> <input  class="form-control" type="number" name="numVagas" value="{{$dados->vagas}}" required/></p>
                        <p><label>Informe a quantidade de horas</label></p>
                        <p> <input class="form-control" type="number" name="numHoras" value="{{$dados->horas}}" required/></p>
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
