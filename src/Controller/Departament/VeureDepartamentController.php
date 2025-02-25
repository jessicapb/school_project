<?php

namespace App\Controller\Departament;

use App\School\Services\DepartamentServices;

class VeureDepartamentController{
    private $departmentservices;

    public function __construct(DepartamentServices $departmentservices) {
        $this->departmentservices = $departmentservices;
    }

    function veuredepartament(){
        $departments = $this->departmentservices->show();
        echo view('veuredepartament',['departments' => $departments]);
    }
}