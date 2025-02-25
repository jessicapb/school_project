<?php
namespace App\Controller\Assignatura;

use App\School\Services\SubjectServices;

class VeureAssignaturaController {

    private $SubjectServices;

    public function __construct(SubjectServices $SubjectServices) {
        $this->SubjectServices = $SubjectServices;
    }

    public function veureassignatura() {
        $subjects = $this->SubjectServices->show();
        echo view('veureassignatura', ['subjects' => $subjects]);
    }
}