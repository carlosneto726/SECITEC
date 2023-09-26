
function cadastrarBtn(endpoint){
    var nome = document.getElementById("nome").value;
    var cpf = document.getElementById("cpf").value;
    var email = document.getElementById("email").value;
    var senha = document.getElementById("senha").value;

    const url = 'http://127.0.0.1:8000/'+endpoint;
    const dados = {
        nome: nome,
        cpf: cpf,
        email: email,
        senha: senha
    };

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
        window.location.href = "/cadastrar";
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