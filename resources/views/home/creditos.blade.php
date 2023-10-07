@extends('templates.template')
@section('content')

<section class="schedule section-padding container">
    <div class="col-lg-12 col-12">
        <h2 class="mb-5"><u class="text-success">Créditos</u></h2>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h5>
            O site da SECITEC IFG Formosa 2023 foi meticulosamente elaborado por alunos do TADS IFG Campus Formosa. <br>
            Cada pessoa abaixo desempenhou um papel fundamental contribuindo com suas habilidades e paixão pela tecnologia
            na concepção, design, implementação e teste deste site <br> <br>
            Agradecemos sinceramente a todos os envolvidos por sua dedicação e trabalho árduo. <br>
            Este site é o resultado do compromisso conjunto em promover e compartilhar o conhecimento 
            e os eventos da SECITEC IFG Formosa 2023.
        </h5>
        <h6 class="border-bottom pb-2 mb-0">Desenvolvedores</h6>
        <a href="https://github.com/carlosneto726" target="_blank" class="d-flex text-body-secondary pt-3">
            <img src="https://avatars.githubusercontent.com/u/85174500?s=400&u=b24077b26834b9c99aa5878b4169e48ab4d97b45&v=4" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="64" height="64">
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="fw-bold d-block text-gray-dark">Carlos Henrique Neto</strong>
                Desenvolvedor Web FullStack, engenheiro de software, Analista e graduando em TADS.
            </p>
        </a>
        <a href="https://github.com/JulianoSchaurich" target="_blank" class="d-flex text-body-secondary pt-3">
            <img src="https://julianoschaurich.github.io/images/foto-perfil.png" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="64" height="64">
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="fw-bold d-block text-gray-dark">Juliano Schaurich</strong>
                Graduando em Análise e Desenvolvimento de Sistemas e Técnico em Informática.
            </p>
        </a>
        <a href="https://github.com/maykkk1" target="_blank" class="d-flex text-body-secondary pt-3">
            <img src="https://maycondouglas.netlify.app/images/profile.jpg" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="64" height="64">
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="fw-bold d-block text-gray-dark">Maycon Douglas</strong>
                Desenvolvedor FullStack Graduando em TADS.
            </p>
        </a>
        <a href="https://github.com/Barro23" target="_blank" class="d-flex text-body-secondary pt-3">
            <img src="https://avatars.githubusercontent.com/u/102668293?v=4" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="64" height="64">
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="fw-bold d-block text-gray-dark">Pedro Henrique Barros</strong>
                Desenvolvedor web FullStack, Editor de vídeo, Editor de Fotos graduando em TADS.
            </p>
        </a>
        <a href="https://github.com/matheus341" target="_blank" class="d-flex text-body-secondary pt-3">
            <img src="{{asset('storage/images/avatar/placeholder.jpeg')}}" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="64" height="64">
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="fw-bold d-block text-gray-dark">Matheus Rodrigues</strong>
                Ciência de Dados, SQL, Power BI, Cloud e graduando em TADS.
            </p>
        </a>
        <a href="https://github.com/OtavioProfeta" target="_blank" class="d-flex text-body-secondary pt-3">
            <img src="{{asset('storage/images/avatar/placeholder.jpeg')}}" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="64" height="64">
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="fw-bold d-block text-gray-dark">Otávio Profeta</strong>
                Desenvolvimento de sistemas HTML, CSS, Bootstrap, PHP, C#, UX/UI e graduado em TADS.
            </p>
        </a>
        <a href="https://github.com/joaograndotto" target="_blank" class="d-flex text-body-secondary pt-3">
            <img src="https://avatars.githubusercontent.com/u/63874169?v=4" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="64" height="64">
            <p class="pb-3 mb-0 small lh-sm border-bottom">
                <strong class="fw-bold d-block text-gray-dark">João Gabriel Grandotto</strong>
                IFG - Tecnologia em Análise e Desenvolvimento de Sistemas (6/6) e graduando em TADS.
            </p>
        </a>
        <small class="d-block text-end mt-3">
            <span>Feito com ❤️</span>
        </small>
    </div>
</section>

@endsection
