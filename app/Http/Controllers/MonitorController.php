<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\MonitorTrait;
use App\Traits\AdminTrait;
use Illuminate\Support\Facades\DB;

class MonitorController extends Controller
{
    use MonitorTrait, AdminTrait;
    public $tipo; 
    public function __construct() {
        $this->tipo = $_COOKIE['ADM_TIPO'];
        if($this->tipo == 2){
            abort(450);
        }
    }
}
