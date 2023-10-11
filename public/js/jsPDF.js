
var btn = document.getElementById("downloadPDF");
btn.addEventListener('click', function () {
    var doc = new jsPDF();

    doc.setFontSize(18);
    doc.setFont("helvetica", "bold");
    doc.setTextColor(25, 135, 84);
    doc.text("SECITEC 2023 IFG Formosa-GO", 20, 20);

    doc.setTextColor(0, 0, 0);
    doc.text("Cartão de Presença", 20, 30);

    doc.setFontSize(14);
    var textoLongo = "Para participar dos eventos, apresente o QR code abaixo na entrada e saída para que as suas horas sejam contablilizadas.";
    var linhas = doc.splitTextToSize(textoLongo, 175);
    doc.text(20, 40, linhas);
    doc.addImage(qrImage, 'PNG', 60, 100, 100, 100);
    doc.addImage(logo, "JPEG", 125, 270);

    var d = new Date();
    var data = (d.getDay() + 1) +'-'+ (d.getMonth() + 1) +'-'+ d.getFullYear() + ' ' + d.getHours() +':'+ d.getMinutes()
    doc.setFontSize(9);
    doc.text("Cartão gerado "+data, 20, 290);

    var data = [
        ['Nome do Evento', 'Data', 'Horário de ínicio', 'Horário de fim', 'Local']
    ];

    for (let i = 0; i < eventos.length; i++) {
        var titulo = eventos[i]['titulo'];
        var dia = eventos[i]['dia'];
        var horai = eventos[i]['titulo'] !== 'Hackathon' ? eventos[i]['horarioI'] : '-- : -- : -- ';
        var horaf = eventos[i]['titulo'] !== 'Hackathon' ? eventos[i]['horarioF'] : '-- : -- : -- ';
        var local = eventos[i]['local'];
        data.push([titulo, dia, horai, horaf, local]);
    }

    doc.addPage();

    doc.setFontSize(14);
    doc.setTextColor(255, 0, 0);
    doc.text("ATENÇÃO!!!", 20, 10);

    doc.setTextColor(0, 0, 0);
    doc.setFontSize(12);
    var textoLongo = "A partir do momento em que você se cadastra ou descadastra em um evento, a lista abaixo se torna obsoleta. O QR Code não muda e pode ser ultilizado o mesmo em todos os eventos cadastrados.";
    var linhas = doc.splitTextToSize(textoLongo, 175);
    doc.text(20, 20, linhas);

    doc.line(15, 35, 195, 35);

    doc.setFontSize(14);
    doc.text("Eventos em que você se inscreveu.", 15, 45);

    var margin = { top: 50, left: 10, right: 10, bottom: 10 };

    doc.autoTable({
        head: [data[0]],
        body: data.slice(1),
        startY: margin.top,
    });

    doc.addImage(logo, "JPEG", 125, 270);
    var data = new Date();
   
    var blob = new Blob([doc.output('blob')], { type: 'application/pdf' });

    if (window.navigator && window.navigator.msSaveOrOpenBlob) {
        window.navigator.msSaveOrOpenBlob(blob, 'cartao-de-entrada-SECITECFORMOSA'+data.getFullYear()+'-'+(data.getMonth()+1)+'-'+data.getDate()+'.pdf');
    } else {
        var objectUrl = URL.createObjectURL(blob);
        var link = document.createElement('a');
        link.href = objectUrl;
        link.download = 'cartao-de-entrada-SECITECFORMOSA'+data.getFullYear()+'-'+(data.getMonth()+1)+'-'+data.getDate()+'.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
});










