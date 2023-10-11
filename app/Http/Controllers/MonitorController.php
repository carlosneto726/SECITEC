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
        $credenciamento = DB::select("SELECT * FROM tb_credenciamento WHERE matricula = ?;", [$this->matricula]);
        if(@$credenciamento[0]->tipo == 0 && @$credenciamento[0]->tipo == 1){
            abort(450);
        }
    }
}
