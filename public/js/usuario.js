
function postHandler(endpoint, tipo){
    const url = window.location.origin + endpoint;
    var dados;

    if(tipo === 'cadastrar'){
        dados = {
            nome: document.getElementById("nome").value,
            cpf: document.getElementById("cpf").value,
            email: document.getElementById("email").value,
            senha: document.getElementById("senha").value
        };
    }else if(tipo === 'login'){
        dados = {
            email: document.getElementById("email").value,
            senha: document.getElementById("senha").value
        };
    }

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

function verSenha() {
    var inputSenha = document.getElementById("senha");
    if (inputSenha.type === "password") {
        inputSenha.type = "text";
    } else {
        inputSenha.type = "password";
    }
}