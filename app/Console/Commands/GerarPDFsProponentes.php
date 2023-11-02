<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Fpdf\fpdf;

class GerarPDFsProponentes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gerar-certificados-proponentes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //inicial   
        $vw_proponente = DB::select("SELECT * FROM vw_proponente_evento");
        foreach($vw_proponente as $dado){
            $pdf = new FPDF("L","pt","A4");
            $nome = $dado->nome;
            $horas = ($dado->horas * 2);
            $evento = $dado->titulo;
            $tipo = $dado->tipo_evento;

            $pdf->AddPage();
            $imagePath = public_path('images/Certificado_frente.png');
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
            $pdf->Cell(0,20,utf8_decode(mb_strtoupper($nome)),0,1,"C",false);
            $pdf->Ln(20);

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

            //Texto 2
            $pdf->SetTextColor(0, 0, 0); // Cor preta (R, G, B)
            $pdf->SetFont('Arial','',20);
            $pdf->MultiCell(0,20,utf8_decode("participou da Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG Campus Formosa, $texto, com carga horária total de $horas hora(s)."),0,"C",false);

            $x1 = 0;
            $y1 = 475;
            $x2 = 900;
            $y2 = 475;
            $pdf->Line($x1,$y1,$x2,$y2);
            $pdf->Image('public/images/assinaturas.png', 220, 485, 400);
            $pdf->Image('public/images/qrAutenticidade.png', 740,485,100,100);
            $pdf->SetY(485);
            $pdf->SetFont("","",12);
            $pdf->Cell(0,5,utf8_decode("Comprovação de autenticidade"),0,1,"L",false);
            $pdf->Output("F","public/pdfs/proponentes/_".str_replace(["'", ":"], " ", mb_strtoupper(($nome."-".$evento)))."_.pdf");
        }
    }
}
