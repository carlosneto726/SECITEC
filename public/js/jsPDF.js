function downloadPDF(){
    
    var doc = new jsPDF();


    
    for (let i = 0; i < eventos.length; i++) {
        
        var titulo = eventos[i]['titulo'];
        var descricao = eventos[i]['descricao'];
        var dia = eventos[i]['dia'];
        var horai = eventos[i]['horarioI'];
        var horaf = eventos[i]['horarioF'];
        var horas = eventos[i]['horas'];
        var local = eventos[i]['local'];
        
        doc.setLineWidth(0.5);
        doc.line(20, 25, 60, 25);
        doc.setFontSize(40);
        doc.text(titulo, 35, 35);
        doc.setLineWidth(0.5);
        doc.line(20, 45, 60, 45);
        
        doc.setFontSize(40);
        doc.text(descricao, 35, 55);
        doc.setFontSize(40);
        doc.text(dia, 35, 65);
    }

    // Don't forget, that there are CORS-Restrictions. So if you want to run it without a Server in your Browser you need to transform the image to a dataURL
// Use http://dataurl.net/#dataurlmaker
   

    



    doc.save('comprovantesecitec2023.pdf')
}








