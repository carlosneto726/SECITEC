window.onload = function () {

    console.log(programacoes);

    for (let i = 0; i < programacoes.length; i++) {
        
        var horai = programacoes[i]['horarioI'];
        var horaf = programacoes[i]['horarioF'];
        var dia = programacoes[i]['dia'];
        var proponentes;


        for (let j = 0; j < programacoes[i]['proponentes'].length; j++) {
            proponentes +=
                '   <div class="col-9 avatar-group d-flex">' +
                '       <img src="'+programacoes[i]['proponentes'][j]['url']+'" class="img-fluid avatar-image mx-1 mx-lg-2" class="img-fluid avatar-image" alt="">' +
                '           <div class="ms-3">' +
                                programacoes[i]['proponentes'][j]['nome']+
                '               <p class="speakers-text mb-0">'+programacoes[i]['proponentes'][j]['titulacao']+'</p>' +
                '           </div>' +
                '   </div>';
        }

        var element = 
            '<div class="container">' +
            '   <div class="row">' +
            '       <span class="col-8 mx-1 mx-lg-2">' +
            '           <i class="bi-clock me-2"></i>' +
            '           '+horai+' às '+horaf+' ' +
            '       </span>' +     
            '       <span class="col mx-10 mx-lg-20" style="color: blue;">' +
            '           <i class="bi-hash me-2 "></i>' +
                        programacoes[i]['nome_tipo_evento']+
            '       </span>' + 
            '       <span class="col-12 mx-1 mx-lg-2 " style="color: green;">' +
            '           <i class="bi-layout-sidebar me-2"></i>' +
                        programacoes[i]['local']+
            '       </span>' + 
            '</div>' +   
            '<div class="row">' +                               
            '   <p><h5 class="col  text-break mx-1 mx-lg-2"> '+programacoes[i]['titulo']+'</h5></p>' +
                        
            '   <p class="text-break mx-1 mx-lg-2" >'+programacoes[i]['descricao']+'</p>' +
            '   <div class="row d-flex align-items-center mt-4">' +
                    proponentes
            '       </span>' +
            '       </div>' +
            '   </div>' +
            '   </div>' +
            ' <div class="row border-bottom pb-5 mb-5">';

        if(dia == '2023-10-23'){
            document.getElementById("programacoes23").innerHTML += element;
        }if(dia == '2023-10-24'){
            document.getElementById("programacoes24").innerHTML += element;
        }if(dia == '2023-10-25'){
            document.getElementById("programacoes25").innerHTML += element;
        }if(dia == '2023-10-26'){
            document.getElementById("programacoes26").innerHTML += element;
        }
    }
}
