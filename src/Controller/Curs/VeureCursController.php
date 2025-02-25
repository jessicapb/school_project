<?php
namespace App\Controller\Curs;

use App\School\Services\CourseServices;

class VeureCursController {

    private $CourseServices;

    public function __construct(CourseServices $CourseServices) {
        $this->CourseServices = $CourseServices;
    }

    public function veurecurs() {
        $courses = $this->CourseServices->show();
        echo view('veurecurs', ['courses' => $courses]);
    }
}