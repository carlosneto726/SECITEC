<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\relatorio;

class FpdfController extends Controller
{
    public function localiza (){
        locate("relatorio.php");
    }
}
