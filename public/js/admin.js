

function excluirBtn(id, endpoint){
    var nome = document.getElementById("nome"+id).innerHTML;
    var input = document.getElementById("input"+id).value;
    var alert = document.getElementById("alert"+id);

    if(nome === input){
        excluir(id, endpoint);
    }else{
        alert.innerHTML = "Digite o nome corretamente para deletar o evento.";
    }
}

function excluir(id, endpoint){
    const url = 'http://127.0.0.1:8000/'+endpoint;
    const dados = {
        id: id,
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
        window.location.reload();
        appendAlert(localStorage.getItem("message"), localStorage.getItem("type"));
        localStorage.clear();
    })
    .catch(erro => console.error('Erro:', erro));
}


const alertPlaceholder = document.getElementById('alert')
const appendAlert = (message, type) => {
const wrapper = document.createElement('div')
wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('')
    alertPlaceholder.append(wrapper)
}
