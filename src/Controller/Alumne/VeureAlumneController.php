<?php
namespace App\Controller\Alumne;

use App\School\Services\StudentServices;

class VeureAlumneController {

    private $studentServices;

    public function __construct(StudentServices $studentServices) {
        $this->studentServices = $studentServices;
    }

    public function veurealumne() {
        $students = $this->studentServices->show();
        echo view('veurealumnes', ['students' => $students]);
    }
}
