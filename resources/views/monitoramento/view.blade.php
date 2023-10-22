@extends('templates.template')
@section('content')


<div class="container p-5">    
    <h4 class="text-center">Página de cadastramento dos monitores</h4>
    <h5 class="text-center">APERTE NOS BOTÕES DO ABAIXO PARA SE CADASTRAR COMO MONITOR DO SEU TURNO</h5>
    <div class="text-center">Se cadastre apenas nos turnos em que você foi selecionado, está com duvida? consulte a <a class="btn btn-outline-success btn-sm" href="https://docs.google.com/spreadsheets/d/1sp7KI_g77PCA7qisBBlFyiW-pRHM74U9jyVtpyZH1CY/edit#gid=2137755893" target="_blank">planilha</a></div>
    
    <div class="d-flex">
        <button class="btn btn-primary btn-lg m-5 mx-auto" onclick="cadastrar({{$usuario->id}}, 80)">Sou do turno da manhã</button>
        <button class="btn btn-warning btn-lg m-5 mx-auto" onclick="cadastrar({{$usuario->id}}, 83)">Sou do turno da tarde</button>
        <button class="btn btn-secondary btn-lg m-5 mx-auto" onclick="cadastrar({{$usuario->id}}, 84)">Sou do turno da noite</button>
    </div>
</div>

<script>

function cadastrarMonitoriaPOST(endpoint, data){
    var url = window.location.origin + endpoint; // Dominio + endpoint da API
    var dados = data; // Dados no formato JSON
    const configuracao = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(dados)
    };

    fetch(url, configuracao)
    .then(resposta => resposta.json())
    .then(data => {
        if(data["mensagem"] == "cadastroNormal"){
            alert("Cadastrado com sucesso.");
        }else if(data["mensagem"] == "descadastroSemFila"){
            alert("Descadastrado.");
        }else{
            alert("ERRO.");
        }
    })
    .catch(erro => console.error('Erro:', erro));
}

function cadastrar(id_usuario, id_evento){
    var endpoint = '/usuarios/cadastarEvento';
    var data = {
        usuarioId: id_usuario,
        eventoId: id_evento
    }

    cadastrarMonitoriaPOST(endpoint, data);
}

</script>
@endsection