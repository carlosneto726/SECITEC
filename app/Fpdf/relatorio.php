<?php
namespace App\Fpdf;
require('fpdf.php');
function convert($String){
    return iconv("UTF-8","ISO8859-1", $String);

}


public static function gerarRelatotio(){
    $pdf = new FPDF("L","pt","A4");
    /*
    $busca = new manipuladados();
    $busca->setTable("vw_nome");
    $resultado = $busca->getAllDataTable();
    */

    while($linha = mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
    //inicial
            $pdf->AddPage();
            $pdf->Image("img/certificad.png", 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',20);
            $pdf->Ln(103); //pula linha
            $nome = $linha["nome"];
            

            //$pdf->Cell(20,10,'Produtos');
            $pdf->Ln(130); //pula linha

            $texto = utf8_decode("A semana do SECITEC realizada nos dias 05 há 10 de julho, confere a o presente aluno ".$nome ." um certificado de presença");
            $pdf->MultiCell(0,20,$texto,0,"C",false);
            $pdf->SetFont('arial','I',12);
            //$pdf->Cell(585,20,utf8_decode($nome),1,0,"L");

            //verso
            $pdf->AddPage();
            $pdf->Image("img/certificado.png", 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',16);
            $pdf->Ln(103); //pula linha
            $soma=0;

            $busca->setTable("vw_evento");
            $resultado2 = $busca->getAllDataTable();
            $pdf->SetFont('arial','B',14);
            $pdf->Cell(585,20,utf8_decode('Título'),1,0,"C");
            $pdf->Cell(200,20,'Horas',1,1,"C");
            while($coluna = mysqli_fetch_array($resultado2,MYSQLI_ASSOC)){
                if($nome == $coluna['nome']){
                $titulo= $coluna["titulo"];
                $horas = $coluna["horas"];
                $presenca = $coluna["presenca"];
                if($coluna['tipo'] == 'Turno' and $presenca<10800){
                    $pdf->SetFont('arial','I',12);
                    $pdf->Cell(585,20,utf8_decode($coluna["titulo"]),1,0,"L");
                    $pdf->Cell(200,20,gmdate("H:i:s", $presenca),1,1,"R");
                    $soma = $soma+$presenca;
                }else{
                    $pdf->SetFont('arial','I',12);
                    $pdf->Cell(585,20,utf8_decode($coluna["titulo"]),1,0,"L");
                    $pdf->Cell(200,20,"0".$coluna["horas"].":00:00",1,1,"R");
                    $soma = $soma+($coluna["horas"]*3600);
                }
            /*$teste = $coluna["entrada"];
                $teste1 = $coluna["saida"]; 
                $partes = explode(':', $teste);
            $segundos = $partes[0] * 3600 + $partes[1] * 60 + $partes[2];
            
            $partes2 = explode(':', $teste1);
            $segundos2 = $partes2[0] * 3600 + $partes2[1] * 60 + $partes2[2];

            $resp = $segundos2-$segundos;*/
        }
            } 
            
        
            //Resultado da soma
            $pdf->SetFont('arial','B',14);
            $pdf->Cell(585,20,"TOTAL",1,0,"L");
            $pdf->Cell(200,20,gmdate("H:i:s", $soma),1,1,"R");
            $pdf->Ln(30);

    //$pdf->Cell(20,10,'Produtos');
    $pdf->Ln(30); //pula linha
        
    }

    $pdf->Ln(30);
    //$pdf->Cell(10,10,'Soma  dos valores:  R$');
    //$i = 0;
    /*foreach ($linha as $dados) {

    $pdf->Ln(-0.4);
    $i = $i + $dados["valor"];

    }*/

    $pdf->SetX(200);
    //$pdf->MultiCell(1000,10, $i);

    //Verso




    //$pdf->Cell(10,10,'Soma  dos valores:  R$');
    //$i = 0;
    /*foreach ($linha as $dados) {

    $pdf->Ln(-0.4);
    $i = $i + $dados["valor"];

    }*/

    $pdf->SetX(200);
    //$pdf->MultiCell(1000,10, $i);

    $pdf->Output("I","certificado.pdf",true);
}
?>