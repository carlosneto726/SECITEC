function downloadPDF() {
    var doc = new jsPDF();

    doc.setFontSize(18);
    var textoLongo = "Comprovante de inscrição de eventos SECITEC 2023 Formosa-GO";
    var linhas = doc.splitTextToSize(textoLongo, 180);
    doc.text(20, 30, linhas);

    doc.setFontSize(14);
    var textoLongo = "Para participar dos eventos, apresente o QR code abaixo na entrada e saída para contablilizar as suas horas.";
    var linhas = doc.splitTextToSize(textoLongo, 180);
    doc.text(20, 50, linhas);
    doc.addImage(qrImage, 'PNG', 60, 100, 100, 100);
    doc.addImage(logo, "JPEG", 125, 270);

    var data = [
        ['Nome do Evento', 'Data', 'Horário de ínicio', 'Horário de fim', 'Local']
    ];

    for (let i = 0; i < eventos.length; i++) {
        var titulo = eventos[i]['titulo'];
        var dia = eventos[i]['dia'];
        var horai = eventos[i]['horarioI'];
        var horaf = eventos[i]['horarioF'];
        var local = eventos[i]['local'];
        data.push([titulo, dia, horai, horaf, local]);
    }

    doc.addPage();

    doc.setFontSize(14);
    var textoLongo = "Eventos em que você se inscreveu.";
    var linhas = doc.splitTextToSize(textoLongo, 180);
    doc.text(20, 10, linhas);

    var margin = { top: 20, left: 10, right: 10, bottom: 10 };

    doc.autoTable({
        head: [data[0]],
        body: data.slice(1),
        startY: margin.top,
    });

    doc.addImage(logo, "JPEG", 125, 270);
    doc.save('comprovantesecitec2023.pdf')
}








