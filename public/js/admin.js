// Função que faz post com o corpo com JSON, não suporta enviar arquivos
function postHandler(endpoint, data){
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
        localStorage.setItem("message", data['message']);
        localStorage.setItem("type", data['type']);
        window.location.href = data['endpoint'];
    })
    .catch(erro => console.error('Erro:', erro));
}
// Função que faz post com o corpo com FormData, serve para enviar arquivos
function formDataPostHandler(endpoint, data){
    var url =  window.location.origin + endpoint;
    var dados = data;
    const configuracao = {
        method: 'POST',
        headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: dados
    };

    fetch(url, configuracao)
    .then(resposta => resposta.json())
    .then(data => {
        localStorage.setItem("message", data['message']);
        localStorage.setItem("type", data['type']);
        window.location.href = data['endpoint'];
    })
    .catch(erro => console.error('Erro:', erro));
}



function excluirBtn(endpoint, id, btn){
    var nome = document.getElementById("nome"+id).innerHTML;
    var input = document.getElementById("input"+id).value;
    var alert = document.getElementById("alert"+id);

    btn.innerHTML = "<div class='spinner-border' role='status'><span class='visually-hidden'>Loading</span></div>";
    
    if(nome === input){
        var dados = {
            id: id,
        };
        postHandler(endpoint, dados);
    }else{
        alert.innerHTML = "Digite o nome corretamente para deletar o evento.";
    }
}

function calcularHoras(){
    var hrInicio = document.getElementById("hrInicio").value;
    var hrFim = document.getElementById("hrFim").value;

    // Converta as strings em objetos Date
    const horaInicio = new Date(`2023-09-27T${hrInicio}`);
    const horaFim = new Date(`2023-09-27T${hrFim}`);

    // Calcule a diferença em milissegundos
    const diferencaEmMilissegundos = horaFim - horaInicio;

    // Calcule a diferença em horas e minutos
    const diferencaEmMinutos = Math.floor(diferencaEmMilissegundos / (1000 * 60));
    var horas = Math.floor(diferencaEmMinutos / 60) * 2;
    if(horas == 0){
        document.getElementById("horas").value = 2;
    }else{
        document.getElementById("horas").value = horas;
    }
}

function cadastrarEvento(endpoint, btn){
    btn.innerHTML = "<div class='spinner-border' role='status'><span class='visually-hidden'>Loading</span></div>";
    var proponentes = document.getElementsByClassName('proponentes');
    var listaProponentes = [];
    for (let i = 0; i < proponentes.length; i++) {
        if(proponentes[i].checked){
            listaProponentes.push(proponentes[i].value);
        }
    }
    const formData = new FormData();
    formData.append('titulo', document.getElementById("titulo").value);
    formData.append('descricao', document.getElementById("descricao").value);
    formData.append('data', document.getElementById("data").value);
    formData.append('hrInicio', document.getElementById("hrInicio").value);
    formData.append('hrFim', document.getElementById("hrFim").value);
    formData.append('vagas', document.getElementById("vagas").value);
    formData.append('horas', document.getElementById("horas").value);
    formData.append('local', document.getElementById("local").value);
    formData.append('tipoEvento', document.getElementById("tipoEvento").value);
    formData.append('arquivo', document.getElementById("formFile").files[0]);
    formData.append('proponentes', listaProponentes);
    // Fazendo o POST
    if(listaProponentes.length == 0){
        document.getElementById("alerta").innerHTML = "É preciso selecionar no mínimo 1 proponente.";
    }else if(
        document.getElementById("titulo").value == "" ||
        document.getElementById("descricao").value == "" ||
        document.getElementById("hrInicio").value == "" ||
        document.getElementById("hrFim").value == "" ||
        document.getElementById("vagas").value == "" ||
        document.getElementById("horas").value == "" ||
        document.getElementById("local").value == ""
    ){
        document.getElementById("alerta").innerHTML = "Por favor. Preencha todos os campos.";
    }else{
        formDataPostHandler(endpoint, formData);
    }
}
