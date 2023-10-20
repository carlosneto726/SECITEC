<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Fpdf\FPDF;
class FpdfController extends Controller
{
    public function certificadoUsuario(){
        $pdf = new FPDF("L","pt","A4");
        $vw_evento = DB::select("SELECT * FROM vw_evento");
        $usuarios = []; // Array para armazenar os dados de cada usuário

        foreach($vw_evento as $linha){
            $nome = $linha->nome;
            $horas = $linha->horas;
            $presenca = 1; // $coluna["presenca"];
            
            // Verifica se o usuário já foi adicionado ao array
            if (!isset($usuarios[$nome])) {
                $usuarios[$nome] = [
                    'horasTotal' => 0,
                    'eventos' => [],
                ];
            }

            // Atualiza a carga horária total
            if("Turno" == 'Turno' and $presenca < 10800){ // $coluna['tipo'] == 'Turno'
                $usuarios[$nome]['horasTotal'] += $horas;
            } else {
                $usuarios[$nome]['horasTotal'] += ($horas * 3600);
            }

            // Adiciona o evento ao usuário
            $usuarios[$nome]['eventos'][] = [
                'titulo' => $linha->titulo,
                'horas' => gmdate("H:i:s", $horas),
            ];
        }




        foreach($usuarios as $nome => $dadosUsuario){
            //inicial
            $pdf->AddPage();
            $imagePath = 'images/Certificado_frente.png';
            $pdf->Image($imagePath, 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',20);
            $pdf->Ln(100); //pula linha
            $pdf->Ln(80); //pula linha

            $soma = $dadosUsuario['horasTotal'];
            $eventos = $dadosUsuario['eventos'];

            $pdf->SetFont('Arial','',20);
            //Texto 1
            $pdf->Cell(0,20,utf8_decode("Certificamos que,"),0,1,"C",false);
            $pdf->Ln(20);
            
            //Nome do proponente
            $pdf->SetTextColor(0, 128, 0); // Cor verde claro (R, G, B)
            $pdf->SetFont('Arial','B',24);
            $pdf->Cell(0,20,utf8_decode($nome),0,1,"C",false);
            $pdf->Ln(20);
            
            //Texto 2
            $pdf->SetTextColor(0, 0, 0); // Cor preta (R, G, B)
            $pdf->SetFont('Arial','',20);
            $pdf->MultiCell(0,20,utf8_decode(" participou do evento Semana de Educação, Ciência e Tecnologia (SECITEC) 2023, realizado nos dias 23 à 26 de outubro, com carga horário total de ".$soma.":00 hora(s), conforme descrito no verso."),0,"C",false);

            //verso
            $pdf->AddPage();
            $imagePath = 'images/Certificado_verso.png';
            $pdf->Image($imagePath, 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',16);
            $pdf->Ln(103); //pula linha           
            $vw_evento2 = DB::select("SELECT * FROM vw_evento"); //Retorna um array com informações do banco de dados da view vw_evento
            $pdf->SetFont('arial','B',14);
            $pdf->Cell(585,20,utf8_decode('Eventos participados'),1,0,"C");
            $pdf->Cell(200,20,'Horas',1,1,"C");
            foreach($vw_evento2 as $coluna){
                if($nome == $coluna->nome){
                    $titulo= $coluna->titulo;
                    $horas = $coluna->horas;

                    $pdf->SetFont('arial','I',012);
                    $pdf->Cell(585,20,utf8_decode($titulo),1,0,"L");
                    $pdf->Cell(200,20,"0".$horas.":00:00",1,1,"R");
                }
            }
            //Resultado da soma
            $pdf->SetFont('arial','B',14);
            $pdf->Cell(585,20,"TOTAL",1,0,"L");
            $pdf->Cell(200,20,"0".$soma.":00:00",1,1,"R");
            $pdf->Ln(30);
            $pdf->Ln(30); //pula linha
        }
        $pdf->Ln(30);
        $pdf->SetX(200);
        $pdf->SetX(200);
        //$pdf->MultiCell(1000,10, $i);
        $pdf->Output("F","pdfs/usuarios/certificado_usuarios.pdf");
    }

    //------------------------------------------------------------------------//

    //Certificado para os proponentes

    public function certificadoProponente(){
        //inicial   
        $vw_proponente = DB::select("SELECT * FROM vw_proponente_evento");
        foreach($vw_proponente as $dado){
            $pdf = new FPDF("L","pt","A4");
            $nome = $dado->nome;
            $horas = ($dado->horas * 2);
            $evento = $dado->titulo;
            $tipo = $dado->tipo_evento;

            $pdf->AddPage();
            $imagePath = 'images/Certificado_frente.png';
            $pdf->Image($imagePath, 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',20);
            $pdf->Ln(100); //pula linha          
            $pdf->Ln(80); //pula linha

            $pdf->SetFont('Arial','',20);
            //Texto 1
            $pdf->Cell(0,20,utf8_decode("Certificamos que,"),0,1,"C",false);
            $pdf->Ln(20);

            //Nome do proponente
            $pdf->SetTextColor(0, 128, 0); // Cor verde claro (R, G, B)
            $pdf->SetFont('Arial','B',24);
            $pdf->Cell(0,20,utf8_decode($nome),0,1,"C",false);
            $pdf->Ln(20);

            //Texto 2
            $pdf->SetTextColor(0, 0, 0); // Cor preta (R, G, B)
            $pdf->SetFont('Arial','',20);
            $pdf->MultiCell(0,20,utf8_decode("participou da Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG, como proponente ministrando o(a) $tipo de $evento, com carga horária total de $horas:00 hora(s)."),0,"C",false);
            
            $x1 = 0;
            $y1 = 475;
            $x2 = 900;
            $y2 = 475;
            $nome_pdf = iconv('UTF-8', 'ASCII//TRANSLIT', preg_replace("/[^a-zA-Z0-9.]/", "_", $nome."-".$evento));
            $pdf->Ln(135);
            $pdf->Line($x1,$y1,$x2,$y2);//
            $pdf->Image('images/qrAutenticidade.png', 740,485,100,100);
            $pdf->SetFont("","",20);
            $pdf->Cell(0,20,utf8_decode("Comprovação de autenticidade"),0,1,"L",false);
            $pdf->Output("F","pdfs/proponentes/$nome_pdf.pdf");
        }
        //$pdf->Output("D","Certificado.pdf");
    }

    
}


