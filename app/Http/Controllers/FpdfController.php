<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Fpdf\FPDF;

class FpdfController extends Controller
{
    public function certificadoUsuario(){
        $pdf = new FPDF("L","pt","A4");
        $vw_nome = DB::select("SELECT * FROM vw_nome");
        foreach($vw_nome as $linha){
            //inicial
            $pdf->AddPage();
            $pdf->Image("images/certificad.png", 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',20);
            $pdf->Ln(103); //pula linha
            $nome = $linha->nome;
            //$pdf->Cell(20,10,'Produtos');
            $pdf->Ln(130); //pula linha
            $texto = utf8_decode("A semana do SECITEC realizada nos dias 23 há 26 de outubro, confere a o presente pessoa ".$nome ." um certificado de presença");
            $pdf->MultiCell(0,20,$texto,0,"C",false);
            $pdf->SetFont('arial','I',12);
            //$pdf->Cell(585,20,utf8_decode($nome),1,0,"L");
            //verso
            $pdf->AddPage();
            $pdf->Image("images/certificado.png", 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',16);
            $pdf->Ln(103); //pula linha
            $soma=0;
            $vw_evento = DB::select("SELECT * FROM vw_evento"); //Retorna um array com informações do banco de dados da view vw_evento
            $pdf->SetFont('arial','B',14);
            $pdf->Cell(585,20,utf8_decode('Título'),1,0,"C");
            $pdf->Cell(200,20,'Horas',1,1,"C");
            foreach($vw_evento as $coluna){
                if($nome == $coluna->nome){
                    $titulo= $coluna->titulo;
                    $horas = $coluna->horas;
                    $presenca = 1;//$coluna["presenca"];
                    if("Turno" == 'Turno' and $presenca<10800){ // $coluna['tipo'] == 'Turno'
                        $pdf->SetFont('arial','I',12);
                        $pdf->Cell(585,20,utf8_decode($titulo),1,0,"L");
                        $pdf->Cell(200,20,gmdate("H:i:s", $presenca),1,1,"R");
                        $soma = $soma+$presenca;
                    }else{
                        $pdf->SetFont('arial','I',12);
                        $pdf->Cell(585,20,utf8_decode($titulo),1,0,"L");
                        $pdf->Cell(200,20,"0".$horas.":00:00",1,1,"R");
                        $soma = $soma+($horas*3600);
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
        $pdf->Output("D","certificado.pdf");
    }
}
