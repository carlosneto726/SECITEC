<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Fpdf\fpdf;

class GerarPDFsOrganizacao extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gerar-certificados-organizadores';

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
        mb_internal_encoding('UTF-8');

        $organizador = DB::select("SELECT * FROM tb_organizacao_certificados");

        foreach($organizador as $dado){
            $pdf = new FPDF("L","pt","A4");

            $nome = $dado->nome;
            $horas = $dado->horas;
            $tipo = $dado->tipo;


            $pdf->AddPage();
            $imagePath = 'public/images/Certificado_frente.png';
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
            $pdf->Cell(0,20,mb_strtoupper(utf8_decode($nome)),0,1,"C",false);
            $pdf->Ln(20);

            //Texto 2
            $pdf->SetTextColor(0, 0, 0); // Cor preta (R, G, B)
            $pdf->SetFont('Arial','',20);
            if($tipo == "D"){ // Desenvolvimento
                $pdf->MultiCell(0,20,utf8_decode("participou ativamente na criação e desenvolvimento do sistema de divulgação e credenciamento para a Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG Campus Formosa, com carga horária total de $horas hora(s)."),0,"C",false);
                $folder = "DESENVOLVEDORES";
            }else if($tipo == "M"){
                $pdf->MultiCell(0,20,utf8_decode("participou ativamente no monitoramento dos eventos durante a Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG Campus Formosa, com carga horária total de $horas hora(s)."),0,"C",false);
                $folder = "MONITORES";
            }else if($tipo == "C"){
                $pdf->MultiCell(0,20,utf8_decode("participou ativamente no processo de credenciamento durante a Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG Campus Formosa, com carga horária total de $horas hora(s)."),0,"C",false);
                $folder = "CREDENCIAMENTO";
            }else if($tipo == "O"){
                $pdf->MultiCell(0,20,utf8_decode("participou da comissão organizadora da Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG Campus Formosa., com carga horária total de $horas hora(s)."),0,"C",false);
                $folder = "COMISSAO";
            }
            
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
            $pdf->Output("F","public/pdfs/organizadores/$folder/_".mb_strtoupper($nome)."_.pdf");
        }
    }
}
