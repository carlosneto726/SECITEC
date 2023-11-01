<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Fpdf\FPDF;

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

        $organizador = array(
            [
            'nome' => 'Aline da Conceição Lopes Braz',
            'horas' => 60
            ],

            [
            'nome' => 'Alice Yasmim Santos Dourado',
            'horas' => 20
            ],

            [
            'nome' => 'Ana Clara Monteiro de Andrade',
            'horas' => 40
            ],

            [
            'nome' => 'Andressa Carvalho Vieira da Silva',
            'horas' => 20
            ],

            [
            'nome' => 'Bruno Calazans Carritilha',
            'horas' => 10
            ],

            [
            'nome' => 'Carlos Henrique Teixeira de Carvalho Neto',
            'horas' => 60
            ],

            [
            'nome' => 'Deivison Barbosa do Nascimento',
            'horas' => 40
            ],

            [
            'nome' => 'Eliane Fernandes Pereira da Cruz',
            'horas' => 10
            ],

            [
            'nome' => 'Erik Takeshi Miura',
            'horas' => 60
            ],

            [
            'nome' => 'Flávia Espindula dos Santos',
            'horas' => 40
            ],

            [
            'nome' => 'Hendrew Neres de Queiroz',
            'horas' => 20
            ],

            [
            'nome' => 'Henrique Anthony Carneiro Silva',
            'horas' => 20
            ],

            [
            'nome' => 'Ícaro Maia Mendonça',
            'horas' => 40
            ],

            [
            'nome' => 'Jamily Luiza Marques Lourenço',
            'horas' => 60
            ],

            [
            'nome' => 'João Marcos de Sousa Pieniz',
            'horas' => 60
            ],

            [
            'nome' => 'Juciely Sivirino Vieira',
            'horas' => 60
            ],

            [
            'nome' => 'Kelly Cristina da Silva Leite',
            'horas' => 20
            ],

            [
            'nome' => 'Letícia Bittencourt Vieira',
            'horas' => 60
            ],

            [
            'nome' => 'Leandro Sousa dos Santos',
            'horas' => 60
            ],

            [
            'nome' => 'Luciano Jose Vieira',
            'horas' => 20
            ],

            [
            'nome' => 'Matheus Costa Gonçalves',
            'horas' => 20
            ],

            [
            'nome' => 'Matheus Damacena Carvalho',
            'horas' => 20
            ],

            [
            'nome' => 'Maycon Douglas Dias da Silva',
            'horas' => 60
            ],

            [
            'nome' => 'Naoki Rafael Miura',
            'horas' => 40
            ],

            [
            'nome' => 'Sthéfanny Mémore do Carmo',
            'horas' => 40
            ]

        );

        foreach($organizador as $dado){
            $pdf = new FPDF("L","pt","A4");

            $nome = $dado['nome'];
            $horas = $dado['horas'];

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
            $pdf->Cell(0,20,utf8_decode($nome),0,1,"C",false);
            $pdf->Ln(20);

            //Texto 2
            $pdf->SetTextColor(0, 0, 0); // Cor preta (R, G, B)
            $pdf->SetFont('Arial','',20);
            
            $pdf->MultiCell(0,20,utf8_decode("participou da comissão organizadora da Semana de Educação, Ciência e Tecnologia (SECITEC) 2023 do IFG Campus Formosa., com carga horária total de $horas hora(s)."),0,"C",false);
            
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
            $pdf->Output("F","public/pdfs/organizadores/COMISSAO/_".mb_strtoupper($nome)."_.pdf");
        }
    }
}
