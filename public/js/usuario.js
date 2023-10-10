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








function cadastrarUsuario(endpoint, btn){
    btn.innerHTML = "<div class='spinner-border' role='status'><span class='visually-hidden'>Loading</span></div>";
    var dados = {
        nome: document.getElementById("nome").value,
        cpf: document.getElementById("cpf").value,
        senha: document.getElementById("senha").value
    };
    postHandler(endpoint, dados);
}

function verificarEmail(endpoint, btn){
    btn.innerHTML = "<div class='spinner-border' role='status'><span class='visually-hidden'>Loading</span></div>";
    var dados = {
        email: document.getElementById("email").value
    };
    postHandler(endpoint, dados);
}

function loginUsuario(endpoint){
    var dados = {
        email: document.getElementById("email").value,
        senha: document.getElementById("senha").value
    };
    postHandler(endpoint, dados);
}

function verSenha() {
    var inputSenha = document.getElementById("senha");
    if (inputSenha.type === "password") {
        inputSenha.type = "text";
    } else {
        inputSenha.type = "password";
    }
}

function redefinirSenha(endpoint, btn){
    var email = document.getElementById("RedefinirEmail").value;
    btn.innerHTML = "<div class='spinner-border' role='status'><span class='visually-hidden'>Loading</span></div>";
    var data = {
        email: email
    }
    postHandler(endpoint, data);
}