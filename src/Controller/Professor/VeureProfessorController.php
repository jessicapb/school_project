<?php
namespace App\Controller\Professor;

use App\School\Services\TeacherServices;

class VeureProfessorController {

    private $TeacherServices;

    public function __construct(TeacherServices $TeacherServices) {
        $this->TeacherServices = $TeacherServices;
    }

    public function veureprofessor() {
        $teachers = $this->TeacherServices->show();
        echo view('veureprofessor', ['teachers' => $teachers]);
    }
}