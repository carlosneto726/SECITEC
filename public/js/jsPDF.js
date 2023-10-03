function downloadPDF(){
    /*
    * Let's demonstrate string splitting with the first page of Shakespeare's Romeo and Juliet!
    * We'll use a 8.5 x 11 inch sheet, measuring everything in inches.
    */
    var pageWidth = 8.5,
    lineHeight = 1.2,
    margin = 0.5,
    maxLineWidth = pageWidth - margin * 2,
    fontSize = 24,
    ptsPerInch = 72,
    oneLineHeight = (fontSize * lineHeight) / ptsPerInch,
    text = "PEDRO BANANA MEU GAROTO BONITO OLHA SO QUE BONITO ELE AIIIIN PEDRINHOSSSSSS!!!!!!!!!!!!!!!!!!!!!";
    doc = new jsPDF({
    unit: "in",
    lineHeight: lineHeight
    }).setProperties({ title: "String Splitting" });

    // splitTextToSize takes your string and turns it in to an array of strings,
    // each of which can be displayed within the specified maxLineWidth.
    var textLines = doc
    .setFont("helvetica")
    .setFontSize(fontSize)
    .splitTextToSize(text, maxLineWidth);

    // doc.text can now add those lines easily; otherwise, it would have run text off the screen!
    doc.text(textLines, margin, margin + 2 * oneLineHeight);

    // You can also calculate the height of the text very simply:
    var textHeight = (textLines.length * fontSize * lineHeight) / ptsPerInch;
    doc
    .setFont("Helvetica", "bold")
    .text(
    "COMPROVANTE DO QUANTO O PREDO É DELICIOSO.",
    margin,
    margin + oneLineHeight
    );
    doc.save('comprovantesecitec2023.pdf')
}








