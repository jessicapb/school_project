<?php

namespace App\Controller\Graus;

use App\School\Services\DegreesServices;

class VeureGrauController{
    private $degreesservices;

    public function __construct(DegreesServices $degreesservices) {
        $this->degreesservices = $degreesservices;
    }

    function veuregrau(){
        $degrees = $this->degreesservices->show();
        echo view('veuregraus',['degrees' => $degrees]);
    }
}