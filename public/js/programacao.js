window.onload = function () {


    for (let i = 0; i < programacoes.length; i++) {
        var horai = programacoes[i]['horarioI'];
        var horaf = programacoes[i]['horarioF'];
        var dia = programacoes[i]['dia'];

        if(dia == 23){
            document.getElementById("programacoes23").innerHTML += 
        
            '<div class="col-lg-8 col-12 mt-3 mt-lg-0">' +
                                                        
                                                    
            '     <h4 class="mb-2"> '+programacoes[i]['titulo']+'</h4>' +
            '     <p>'+programacoes[i]['descricao']+'</p>' +
            '     <div class="d-flex align-items-center mt-4">' +
            '         <div class="avatar-group d-flex">' +
            '             <img src="'+programacoes[i]['url_p']+'" class="img-fluid avatar-image" class="img-fluid avatar-image" alt="">' +
            '             <div class="ms-3">' +
                            programacoes[i]['proponente']+
            '                 <p class="speakers-text mb-0">'+programacoes[i]['titulacao']+'</p>' +
            '             </div>' +
            '         </div>' +
            '         <span class="mx-3 mx-lg-5">' +
            '             <i class="bi-clock me-2"></i>' +
            '              '+horai+' - '+horaf+' ' +
            '         </span>' +
            '         <span class="mx-1 mx-lg-5">' +
            '             <i class="bi-layout-sidebar me-2"></i>' +
                            programacoes[i]['local']+
            '         </span>' +
            '     </div>' +
            '   </div>' +
            ' </div>' +
            ' <div class="row border-bottom pb-5 mb-5">';
        }if(dia == 24){
            document.getElementById("programacoes24").innerHTML += 
        
            '<div class="col-lg-8 col-12 mt-3 mt-lg-0">' +
                                                        
                                                    
            '     <h4 class="mb-2"> '+programacoes[i]['titulo']+'</h4>' +
            '     <p>'+programacoes[i]['descricao']+'</p>' +
            '     <div class="d-flex align-items-center mt-4">' +
            '         <div class="avatar-group d-flex">' +
            '             <img src="'+programacoes[i]['url_p']+'" class="img-fluid avatar-image" class="img-fluid avatar-image" alt="">' +
            '             <div class="ms-3">' +
                            programacoes[i]['proponente']+
            '                 <p class="speakers-text mb-0">'+programacoes[i]['titulacao']+'</p>' +
            '             </div>' +
            '         </div>' +
            '         <span class="mx-3 mx-lg-5">' +
            '             <i class="bi-clock me-2"></i>' +
            '              '+horai+' - '+horaf+' ' +
            '         </span>' +
            '         <span class="mx-1 mx-lg-5">' +
            '             <i class="bi-layout-sidebar me-2"></i>' +
                            programacoes[i]['local']+
            '         </span>' +
            '     </div>' +
            '   </div>' +
            ' </div>' +
            ' <div class="row border-bottom pb-5 mb-5">';

        }if(dia == 25){
            document.getElementById("programacoes25").innerHTML += 
        
            '<div class="col-lg-8 col-12 mt-3 mt-lg-0">' +
                                                        
                                                    
            '     <h4 class="mb-2"> '+programacoes[i]['titulo']+'</h4>' +
            '     <p>'+programacoes[i]['descricao']+'</p>' +
            '     <div class="d-flex align-items-center mt-4">' +
            '         <div class="avatar-group d-flex">' +
            '             <img src="'+programacoes[i]['url_p']+'" class="img-fluid avatar-image" class="img-fluid avatar-image" alt="">' +
            '             <div class="ms-3">' +
                            programacoes[i]['proponente']+
            '                 <p class="speakers-text mb-0">'+programacoes[i]['titulacao']+'</p>' +
            '             </div>' +
            '         </div>' +
            '         <span class="mx-3 mx-lg-5">' +
            '             <i class="bi-clock me-2"></i>' +
            '              '+horai+' - '+horaf+' ' +
            '         </span>' +
            '         <span class="mx-1 mx-lg-5">' +
            '             <i class="bi-layout-sidebar me-2"></i>' +
                            programacoes[i]['local']+
            '         </span>' +
            '     </div>' +
            '   </div>' +
            ' </div>' +
            ' <div class="row border-bottom pb-5 mb-5">';
        }
        if(dia == 26){
            document.getElementById("programacoes26").innerHTML += 
        
            '<div class="col-lg-8 col-12 mt-3 mt-lg-0">' +
                                                        
                                                    
            '     <h4 class="mb-2"> '+programacoes[i]['titulo']+'</h4>' +
            '     <p>'+programacoes[i]['descricao']+'</p>' +
            '     <div class="d-flex align-items-center mt-4">' +
            '         <div class="avatar-group d-flex">' +
            '             <img src="'+programacoes[i]['url_p']+'" class="img-fluid avatar-image" class="img-fluid avatar-image" alt="">' +
            '             <div class="ms-3">' +
                            programacoes[i]['proponente']+
            '                 <p class="speakers-text mb-0">'+programacoes[i]['titulacao']+'</p>' +
            '             </div>' +
            '         </div>' +
            '         <span class="mx-3 mx-lg-5">' +
            '             <i class="bi-clock me-2"></i>' +
            '              '+horai+' - '+horaf+' ' +
            '         </span>' +
            '         <span class="mx-1 mx-lg-5">' +
            '             <i class="bi-layout-sidebar me-2"></i>' +
                            programacoes[i]['local']+
            '         </span>' +
            '     </div>' +
            '   </div>' +
            ' </div>' +
            ' <div class="row border-bottom pb-5 mb-5">';
        }
    }
}