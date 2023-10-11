<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\MonitorTrait;
use App\Traits\AdminTrait;
use Illuminate\Support\Facades\DB;

class MonitorController extends Controller
{
    use MonitorTrait, AdminTrait;
    public $matricula; 
    public function __construct() {
        $this->matricula = $_COOKIE['ADM_USER'];
        //$credenciamento = DB::select("SELECT * FROM tb_credenciamento WHERE matricula = ?;", [$this->matricula]);
        $tipo = "0";
        if($tipo == 2){
            abort(450);
        }
    }
}
