@extends('admin.template')
@section('content')


<div class="col-lg-8 mx-auto p-4 py-md-5">
    <main>
        <h1 class="text-body-emphasis">Credenciamento Da Secitec 2023</h1><br>
        <p class="fs-5 col-md-8">
            A página de administração de eventos da SECITEC 2023 oferece 
            um conjunto de ferramentas essenciais para a organização e 
            gerenciamento do evento. Neste guia, abordaremos passo a passo 
            de como adicionar criar, visualizar, atualizar e deletar 
            proponentes e eventos.
        </p>

        <hr class="col-12 col-md-8 mb-5">

        <div class="row g-5">
            <div class="col-md-6">
                <h2 class="text-body-emphasis">Adicionando Proponentes</h2>
                <ul class="list-unstyled ps-0">
                    <li>
                        <span>1.</span>
                        <span>
                            Acesse a seção <a href="{{url('admin/proponente')}}" class="link-tutorial"> Proponentes </a>, clique em "+" a direita de "Proponentes".
                        </span>
                    </li>
                    <li>
                        <span>2.</span>
                        <span>Preencha os campos obrigatórios: nome, titulação e faça o upload de uma foto do proponente.</span>
                    </li>
                    <li>
                        <span>3.</span>
                        <span>Caso desejado, inclua até três redes sociais para divulgação.</span>
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <h2 class="text-body-emphasis">Criando Eventos</h2>
                <ul class="list-unstyled ps-0">
                    <li>
                        <span>1.</span>
                        <span>Acesse a seção <a class="link-tutorial" href="{{url('admin/eventos')}}"> Eventos </a>, clique em "+" a direita de "Eventos".</span>
                    </li>
                    <li>
                        <span>2.</span>
                        <span>Selecione um proponente associado ao evento, caso o proponente ainda não tenha sido cadastrado, <a href="admin/proponente" class="link-tutorial">cadastre-o</a>.</span>
                    </li>
                    <li>
                        <span>4.</span>
                        <span>Preencha os campos obrigatórios: título, descrição, data, horário de início e fim, número de vagas, local, horas do certificado e faça o upload de uma foto representativa.</span>
                    </li>                    
                </ul>
            </div>

            <div class="col-md-6">
                <h2 class="text-body-emphasis">Atualizando Informações</h2>
                <ul class="list-unstyled ps-0">
                    <li>
                        <span>1.</span>
                        <span>Para editar informações de <a href="{{url('admin/proponente')}}" class="link-tutorial"> Proponente </a>, clique no ícone <span class="text-primary">azul</span> do respectivo proponente. Faça as alterações necessárias e salve.</span>
                    </li>
                    <li>
                        <span>2.</span>
                        <span>Para editar informações de eventos, vá até <a class="link-tutorial" href="{{url('admin/eventos')}}"> Eventos </a>, clique no ícone <span class="text-primary">azul</span> do respectivo evento. Faça as modificações necessárias e salve.</span>
                    </li>      
                </ul>
            </div>

            <div class="col-md-6">
                <h2 class="text-body-emphasis">Deletando Proponentes e Eventos</h2>
                <ul class="list-unstyled ps-0">
                    <li>
                        <span>1.</span>
                        <span>Na seção <a href="{{url('admin/proponente')}}" class="link-tutorial"> Proponente </a>, clique no botão <span class="text-danger">vermelho</span> do proponete respectivo que deseja excluir.</span>
                    </li>
                    <li>
                        <span>2.</span>
                        <span>Para deletar um evento, vá até <a class="link-tutorial" href="{{url('admin/eventos')}}"> Eventos </a>, clique no botão <span class="text-danger">vermelho</span> do evento respectivo que deseja excluir.</span>
                    </li>      
                </ul>
            </div>

        </div>
    </main>
</div>

<style>
    .link-tutorial{
        border-bottom: solid 2px #17882c;
    }
</style>
@endsection