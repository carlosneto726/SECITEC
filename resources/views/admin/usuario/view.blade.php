@extends('admin.template')
@section('content')


<style>
    .dropdown {
      position: relative;
      display: inline-block;
      width: 100%;
    }

    .search-box {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .options-list {
      position: absolute;
      z-index: 1;
      left: 0;
      top: 100%;
      width: 100%;
      max-height: 200px;
      overflow-y: auto;
      border: 1px solid #ccc;
      border-top: none;
      display: none;
      background-color: #fff;
      padding: 0;
    }

    .option {
      cursor: pointer;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border: 1px solid rgba(0, 0, 0, .2);
    }

    .option input {
      width: 3%; 
    }

    .option label {
      padding-left: 5px;  
      width: 95%;
    }


    .dropdown-edit {
      position: relative;
      display: inline-block;
      width: 100%;
    }

    .search-box-edit {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .options-list-edit {
      position: absolute;
      z-index: 1;
      left: 0;
      top: 100%;
      width: 100%;
      max-height: 200px;
      overflow-y: auto;
      border: 1px solid #ccc;
      border-top: none;
      display: none;
      background-color: #fff;
      padding: 0;
    }

    .option-edit {
      cursor: pointer;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border: 1px solid rgba(0, 0, 0, .2);
    }

    .option-edit input {
      width: 3%;
    }

    .option-edit label {
      padding-left: 5px;  
      width: 95%;
    }

    .modal-title-user-adm {
        color: gray;
        text-decoration: underline;
        text-decoration-color: green;
        margin-bottom: 10px;
    }

</style>

<section class="schedule mb-5" id="section_4"> <div class="container"> <h2 class=""><u class="text-success"><a class=""
    href="#staticBackdrop" data-bs-toggle="modal">Usuários <svg data-bs-toggle="modal"
    data-bs-target="#cadastroUsuarioModal" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
    class="bi bi-plus-square
            float-end" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0
            0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
<path
d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
</svg>
</a></u>
</h2>
</div>
</section>

<div class="container"> <input type="text" id="searchInput" class="form-control mb-3" placeholder="Pesquisar
por nome, cpf e evento"> <table class="table table-bordered table-striped shadow">
    <thead>
    <tr>
    <th class="align-middle text-center">nome</th>
    <th class="align-middle text-center">cpf</th>
    <th class="align-middle text-center">eventos</th>
    <th class="align-middle text-center">cadastrar</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td class="align-middle text-center text-break" id="nome-usuario">{{$usuario->nome}}</td>
            <td class="align-middle text-center text-break" id="cpf-usuario">{{$usuario->cpf}}</td>
            <td class="align-middle text-center text-break" id="nome-evento">
                @foreach ($usuario->eventos as $evento)
                {{$evento->titulo}}
                @endforeach
            </td>
            <td class="align-middle text-center">
                <button onclick="openModalUserEdit({{$usuario->id}}, '{{$usuario->nome}}', '{{$usuario->email}}')" class="btn btn-success">
                    <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>


 <!-- Modal de criacao de usuario -->
<div class="modal fade" id="cadastroUsuarioModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" method="">
                    <h3  class="modal-title-user-adm" class="text-center">Cadastro de usuário</h3>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" required>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" maxlength="11"
                            onkeypress="return /[0-9]/i.test(event.key)" required>
                    </div>
                    <small class="ms-1 mb-3 opacity-50">Apenas números. Sem
                        símbolos.</small>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="E-Mail" name="email" id="email" required>
                    </div>
                    <small class="ms-1 mb-3 opacity-50">A senha padrão é
                        secitec2023</small>
                    <div id="cadastro-msg" class="alert alert-success d-none" role="alert">
                        Cadastrado com sucesso!
                    </div>
                    <div id="error-msg" class="alert alert-danger d-none" role="alert">
                        
                    </div>
                    <br>
                    <span>Cadastrar em eventos</span>
                    <div class="dropdown">
                        <input type="text" class="search-box" placeholder="Pesquisar evento">
                        <ul class="options-list" id="event-list">
                        </ul>
                    </div>
                    <button type="button" onClick="enviarRequisicao()" class="btn btn-success w-100 mt-3" type="submit">Cadastrar usuário</button>
                    <button type="button" onClick="clearModalCadastro(false)" class="btn btn-danger w-100 mt-3" data-bs-dismiss="modal">Sair</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal de edição de usuario -->
<div id="modalEdicao" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title-user-adm">Cadastrar usuário em eventos</h5>
                <div class="row">
                    <strong>Usuario: <strong><p id ="nameUserEdit"></p>
                </div>
                <div class="row">
                    <strong>Email: <strong><p id ="emailUserEdit"></p>
                </div>
                <div class="row">
                    <form action="">
                        <div class="dropdown-edit">
                            <input type="text" class="search-box-edit" placeholder="Pesquisar evento">
                            <ul class="options-list-edit" id="event-list-edit">
                            </ul>
                        </div>
                        <div type="button" onclick="enviarRequisicaoCadastroEventos()" style="margin-top: 10px;" class="btn btn-success w-100 mt-3">Cadastrar</div>
                        <button type="button" onClick="clearModalEdit(false)" class="btn btn-danger w-100 mt-3" data-bs-dismiss="modal">Sair</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery.min.js')}}?v=1.0"></script>
<script src="{{asset('js/jquery.sticky.js')}}?v=1.0"></script>
<script>

    function openModalUserEdit(id, nome, email){
        selectedUserIdEdit = id;
        document.getElementById('nameUserEdit').innerHTML = nome;
        document.getElementById('emailUserEdit').innerHTML = email;
        var myModal = new bootstrap.Modal(document.getElementById('modalEdicao'))
        myModal.show()
        getEventosById(id);
    }

var allEventos = null;

function getEventos() {
  $.ajax({
    url: "/admin/eventos/all",
    type: "GET",
    dataType: "json",
    success: function (data) {
        renderEventosDropdown(data);
        allEventos = data;
    },
    error: function (xhr, status, error) {
      console.error(error);
    }
  });
}

function getEventosById(userId) {
  $.ajax({
    url: "/admin/eventos/byId",
    type: "POST",
    dataType: "json",
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'), // Obtém o token CSRF do meta tag
        id: userId
    },
    success: function (data) {
      console.log(data);
        renderEventosDropdownEdit(data);
    },
    error: function (xhr, status, error) {
      console.error(error);
    }
  });
}


getEventos();

const searchBox = document.querySelector('.search-box');
const optionsList = document.querySelector('.options-list');
let options = document.querySelectorAll('.option');

const searchBoxEdit = document.querySelector('.search-box-edit');
const optionsListEdit = document.querySelector('.options-list-edit');
let optionsEdit = document.querySelectorAll('.option-edit');

const errorAlert = document.getElementById('error-msg');
const cadastroAlert = document.getElementById('cadastro-msg');

let selectedUserIdEdit = null;



// FUNCOES DO CADASTRO DE USUARIO
searchBox.addEventListener('click', () => {
  optionsList.style.display = 'block';
});

searchBox.addEventListener('input', () => {
  const searchTerm = searchBox.value.toLowerCase();
  options.forEach(option => {
    const label = option.querySelector('label');
    console.log(label);
    const labelText = label.textContent.toLowerCase();
    if (labelText.includes(searchTerm)) {
      option.style.display = 'flex';
    } else {
      option.style.display = 'none';
    }
  });

  optionsList.style.display = 'block';
});


optionsList.addEventListener('click', (event) => {
  event.stopPropagation();
});


document.addEventListener('click', (event) => {
  if (!event.target.classList.contains('dropdown') && event.target !== searchBox) {
    optionsList.style.display = 'none';
  }
});


// FUNCOES DA EDICAO DO USUARIO
searchBoxEdit.addEventListener('click', () => {
  optionsListEdit.style.display = 'block';
});

searchBoxEdit.addEventListener('input', () => {
  const searchTermEdit = searchBoxEdit.value.toLowerCase();
  optionsEdit.forEach(option => {
    const labelEdit = option.querySelector('label');
    const labelTextEdit = labelEdit.textContent.toLowerCase();
    if (labelTextEdit.includes(searchTermEdit)) {
        option.style.display = 'flex';
    } else {
        option.style.display = 'none';
    }
  });

  optionsListEdit.style.display = 'block';
});


optionsListEdit.addEventListener('click', (event) => {
  event.stopPropagation();
});


document.addEventListener('click', (event) => {
  if (!event.target.classList.contains('dropdown-edit') && event.target !== searchBoxEdit) {
    optionsListEdit.style.display = 'none';
  }
});

const modalCadastro = document.getElementById('cadastroUsuarioModal');
const modalEdicao = document.getElementById('modalEdicao');

modalCadastro.addEventListener('hidden.bs.modal', function () {
  clearModalCadastro(false);
});

modalEdicao.addEventListener('hidden.bs.modal', function () {
  clearModalEdit(false);
});

function enviarRequisicao() {
  if (document.getElementById('email').value == "" || document.getElementById('cpf').value == "" || document.getElementById('nome').value == "") {
    errorAlert.innerHTML = "É necessário preencher todos os campos.";
    cadastroAlert.classList.add('d-none');
    return errorAlert.classList.remove('d-none');
  }
  $.ajax({
    url: "/admin/adicionar-usuario/cadastrar",
    type: "POST",
    data: {
      email: document.getElementById('email').value,
      cpf: document.getElementById('cpf').value,
      nome: document.getElementById('nome').value,
      eventosSelecionados: getEventosSelecionados(),
      _token: $('meta[name="csrf-token"]').attr('content') // Obtém o token CSRF do meta tag
    },
    success: function (data) {
      if (data.mensagem) {
        errorAlert.classList.add('d-none');
        cadastroAlert.classList.remove('d-none');
        clearModalCadastro(true);
      }

      if (data.error) {
        errorAlert.innerHTML = data.error;
        cadastroAlert.classList.add('d-none');
        errorAlert.classList.remove('d-none');
      }
    }
  });
}

function enviarRequisicaoCadastroEventos() {
    // tratar n ter evento adicionado
  $.ajax({
    url: "/admin/adicionar-usuario-evento/cadastrar",
    type: "POST",
    data: {
      userId: selectedUserIdEdit,
      eventosSelecionados: getEventosSelecionadosEdit(),
      _token: $('meta[name="csrf-token"]').attr('content') // Obtém o token CSRF do meta tag
    },
    success: function (data) {
      if (data.mensagem) {
        clearModalCadastro(true);
      }

      if (data.error) {
      }
    }
  });
}

function renderEventosDropdown(eventos) {
    const listaDeEventos = document.getElementById('event-list');
    eventos.forEach(evento => {
        listaDeEventos.innerHTML += `
            <li class="option">
                <input value="${evento.id}" class="check-evento" id="event-t${evento.id}" type="checkbox">
                <label for="event-t${evento.id}">${evento.titulo}</label>
            </li>
        `
    });
    options = document.querySelectorAll('.option');
}

function renderEventosDropdownEdit(eventos) {
    const listaDeEventos = document.getElementById('event-list-edit');
    eventos.forEach(evento => {
        listaDeEventos.innerHTML += `
            <li class="option-edit">
                <input value="${evento.id}" class="check-evento-edit" id="event-t${evento.id}-edit" type="checkbox">
                <label for="event-t${evento.id}-edit">${evento.titulo}</label>
            </li>
        `
    });
    optionsEdit = document.querySelectorAll('.option-edit');
}

function clearModalCadastro(cadastro) {
  document.getElementById('email').value = "";
  document.getElementById('cpf').value = "";
  document.getElementById('nome').value = "";
  if(!cadastro) {
    if(!errorAlert.classList.contains('d-none')) {
        errorAlert.classList.add('d-none'); 
  }  
    if(!cadastroAlert.classList.contains('d-none')) {
        cadastroAlert.classList.add('d-none'); 
  } 
  }
  desmarcarEventos();
}


// CADASTRO DE USUARIO EVENTOS MARCADOS HANDLERS
function getEventosSelecionados(){
    let eventos = Array.from(document.querySelectorAll('.check-evento'));
    const eventosSelecionados = [];
    eventos.forEach(evento => {
        if(evento.checked) {
            eventosSelecionados.push(parseInt(evento.value));
        }
    });
    return eventosSelecionados;
}

function desmarcarEventos() {
    let eventos = Array.from(document.querySelectorAll('.check-evento'));
    eventos.forEach(evento => {
        evento.checked = false;
    });
}


// EDICAO DE USUARIO EVENTOS MARCADOS HANDLERS
function getEventosSelecionadosEdit(){
    let eventos = Array.from(document.querySelectorAll('.check-evento-edit'));
    const eventosSelecionados = [];
    eventos.forEach(evento => {
        if(evento.checked) {
            eventosSelecionados.push(parseInt(evento.value));
        }
    });
    return eventosSelecionados;
}

function desmarcarEventosEdit() {
    let eventos = Array.from(document.querySelectorAll('.check-evento-edit'));
    eventos.forEach(evento => {
        evento.checked = false;
    });
}

function clearModalEdit(cadastro){
    optionsListEdit.innerHTML = "";
    desmarcarEventosEdit();
}



// Evento de input e a tabela
var input = document.getElementById('searchInput');
var table = document.querySelector('.table');

// Adiciona um ouvinte de eventos ao input para detectar mudanças de entrada
input.addEventListener('input', function () {
  var searchText = input.value.toLowerCase();

  // Obtém todas as linhas da tabela
  var rows = table.querySelectorAll('tbody tr');

  // Itera sobre as linhas e verifica se o texto de pesquisa corresponde ao nome do usuário ou nome do evento
  rows.forEach(function (row) {
    var nomeUsuario = row.querySelector('#nome-usuario').textContent.toLowerCase();
    var nomeEvento = row.querySelector('#nome-evento').textContent.toLowerCase();
    var cpfUsuario = row.querySelector('#cpf-usuario').textContent.toLowerCase();

    if (nomeUsuario.includes(searchText) || nomeEvento.includes(searchText) || cpfUsuario.includes(searchText)) {
      row.style.display = 'table-row';
    } else {
      row.style.display = 'none';
    }
  });
});
               
</script>
<script src="{{asset('js/admin.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>
@endsection