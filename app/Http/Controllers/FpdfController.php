<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Fpdf\FPDF;
use React\EventLoop\Factory;
use React\Promise\Promise;

class FpdfController extends Controller
{
    public function certificadoUsuario(){
        $id_usuario = request("id_usuario");
        $vw_evento = DB::select("SELECT * FROM vw_evento WHERE vw_evento.id = ?;", [$id_usuario]);
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
            $pdf = new FPDF("L","pt","A4");
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


            $x1 = 0;
            $y1 = 475;
            $x2 = 900;
            $y2 = 475;
            $pdf->Line($x1,$y1,$x2,$y2);
            $pdf->Image('images/assinaturas.png', 220, 485, 400);
            $pdf->Image('images/qrAutenticidade.png', 740,485,100,100);
            $pdf->SetY(485);
            $pdf->SetFont("","",12);
            $pdf->Cell(0,5,utf8_decode("Comprovação de autenticidade"),0,1,"L",false);


            //verso
            $pdf->AddPage();
            $imagePath = 'images/Certificado_verso.png';
            $pdf->Image($imagePath, 0,0,$pdf->GetPageWidth(), $pdf->GetPageHeight());
            $pdf->SetFont('Arial','',16);
            $pdf->Ln(103); //pula linha           
            $vw_evento2 = DB::select("SELECT * FROM vw_evento WHERE vw_evento.id = ?;", [$id_usuario]); //Retorna um array com informações do banco de dados da view vw_evento
            $pdf->SetFont('arial','B',14);
            $pdf->Cell(585,20,utf8_decode('Eventos participados'),1,0,"C");
            $pdf->Cell(200,20,'Horas',1,1,"C");
            foreach($vw_evento2 as $coluna){
                if($nome == $coluna->nome){
                    $titulo= $coluna->titulo;
                    $horas = $coluna->horas;

                    $pdf->SetFont('arial','I',012);
                    $pdf->Cell(585,20,utf8_decode($titulo),1,0,"L");
                    $pdf->Cell(200,20,$horas.":00:00",1,1,"R");
                }
            }
            //Resultado da soma
            $pdf->SetFont('arial','B',14);
            $pdf->Cell(585,20,"TOTAL",1,0,"L");
            $pdf->Cell(200,20,$soma.":00:00",1,1,"R");
            $pdf->Ln(30);
            $pdf->Ln(30); //pula linha
            
            $pdf->Ln(30);
            $pdf->SetX(200);
            $pdf->SetX(200);
            //$pdf->MultiCell(1000,10, $i);
            $nome_pdf = $this->converteNomeArquivo($nome, "");
            $pdf->Output("F","pdfs/usuarios/$nome_pdf.pdf");
        }
    }

    //------------------------------------------------------------------------//

    //Certificado para os proponentes

    public function certificadoProponente(){
        //inicial   
        $id_proponente = request("id_proponente");

        $vw_proponente = DB::select("SELECT * FROM vw_proponente_evento WHERE pid = ?;", [$id_proponente]);
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

            if($tipo == "palestra"){
                $texto = "ministrando a palestra de $evento";
            }
            else if($tipo == "mini-curso"){
                $texto = "ministrando o mini-curso de $evento";
            }
            else if($tipo == "oficina"){
                $texto = "ministrando a oficina de $evento";
            }
            else if($tipo == "hackathon"){
                $texto = "promovendo o Hackathon";
            }
            else if($tipo == "exposição"){
                $texto = "realizando a exposição de $evento";
            }
            else if($tipo == "mesa redonda"){
                $texto = "intermediando a mesa redonda de $evento";
            }
            else if($tipo == "visita técnica"){
                $texto = "como instrutor da visita técnica de $evento";
            }
            else if($tipo == "encontro de egressos"){
                $texto = "intermediando a mesa redonda de $evento";
            }

            
            $pdf->MultiCell(0,20,utf8_decode("participou da Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG Campus Formosa, $texto, com carga horária total de $horas hora(s)."),0,"C",false);
            
            $x1 = 0;
            $y1 = 475;
            $x2 = 900;
            $y2 = 475;
            $nome_pdf = $this->converteNomeArquivo($nome, $evento);
            $pdf->Line($x1,$y1,$x2,$y2);
            $pdf->Image('images/assinaturas.png', 220, 485, 400);
            $pdf->Image('images/qrAutenticidade.png', 740,485,100,100);
            $pdf->SetY(485);
            $pdf->SetFont("","",12);
            $pdf->Cell(0,5,utf8_decode("Comprovação de autenticidade"),0,1,"L",false);
            $pdf->Output("F","pdfs/proponentes/$nome_pdf.pdf");
        }
        return redirect("/admin/proponente");

    }


    public function certificadoDesenvolvedor(){

        $desenvolvedor = DB::select("SELECT * FROM tb_desenvolvedor;");

        foreach($desenvolvedor as $dado){
            $pdf = new FPDF("L","pt","A4");
            $nome = $dado->nome;
            $horas = 80;


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
            
            $pdf->MultiCell(0,20,utf8_decode("participou ativamente na criação e desenvolvimento do sistema de divulgação e credenciamento para a Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG Campus Formosa, com carga horária total de $horas hora(s)."),0,"C",false);
            
            $x1 = 0;
            $y1 = 475;
            $x2 = 900;
            $y2 = 475;
            $nome_pdf = $this->converteNomeArquivo($nome, "");
            $pdf->Line($x1,$y1,$x2,$y2);
            $pdf->Image('images/assinaturas.png', 220, 485, 400);
            $pdf->Image('images/qrAutenticidade.png', 740,485,100,100);
            $pdf->SetY(485);
            $pdf->SetFont("","",12);
            $pdf->Cell(0,5,utf8_decode("Comprovação de autenticidade"),0,1,"L",false);
            $pdf->Output("F","pdfs/proponentes/$nome_pdf.pdf");
        }
        return redirect("/admin/proponente");

    }


    private function converteNomeArquivo($nome, $evento) {
        return strtoupper(preg_replace("/[^a-zA-Z0-9.]/", "_", iconv('UTF-8', 'ASCII//TRANSLIT', $nome."-".$evento)));
    }
}


