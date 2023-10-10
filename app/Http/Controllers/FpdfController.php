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
            $imagePath = public_path('images\Certificado_frente.png');
            $pdf->Image($imagePath, 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',20);
            $pdf->Ln(103); //pula linha          
            $soma = $dadosUsuario['horasTotal'];
            $eventos = $dadosUsuario['eventos'];
            $pdf->Ln(130); //pula linha
            $texto = utf8_decode("Certificamos que, ".$nome." participou do evento Semana de Educação, Ciência e Tecnologia (SECITEC) 2023, realizado nos dias 23 à 26 de outubro, com carga horário total de ".$soma.":00 hora(s), conforme descrito no verso.");
            $pdf->MultiCell(0,20,$texto,0,"C",false);
            $pdf->SetFont('arial','I',12);



            //verso
            $pdf->AddPage();
            $imagePath = public_path('images\Certificado_verso.png');
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
        $pdf->Output("D","Certificado.pdf");
    }
}
