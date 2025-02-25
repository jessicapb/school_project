<?php

namespace App\Controller\Curs_Alumne;

use App\Infrastructure\Persistence\StudentRepository;
use App\Infrastructure\Persistence\CourseRepository;
use App\School\Services\StudentServices;
use App\School\Services\CourseServices;
use App\School\Services\EnrollmentServices;
use App\Infrastructure\Persistence\EnrollmentRepository;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;

class CursAlumneBDController{
    private \PDO $db;
    private StudentServices $StudentServices;
    private StudentRepository $StudentRepository;
    private CourseServices $CourseService;
    private CourseRepository $CourseRepository;
    private EnrollmentServices $EnrollmentServices;
    private EnrollmentRepository $EnrollmentRepository;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->StudentRepository = new StudentRepository($db);
        $this->CourseRepository = new CourseRepository($db);
        $this->EnrollmentRepository = new EnrollmentRepository($db);

        $this->StudentServices = new StudentServices($db, $this->StudentRepository);
        $this->CourseService = new CourseServices($db, $this->CourseRepository);
        $this->EnrollmentServices = new EnrollmentServices($this->EnrollmentRepository);
    }

    function addEnrollment(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //dd($_POST);
            if (empty($_POST['course']) 
                or empty($_POST['student'])) {
            $_SESSION['error'] = "Camps obligatoris.";
            header('Location: /indexcursalumne');
            exit;
        }
        
        $course_id = $_POST['course'];
        $student_id = $_POST['student'];
            try {
                $student = $this->StudentServices->findById($student_id);
                $course = $this->CourseService->findById($course_id);
                $year = date("Y-m-d");
                $enrollement = $this->EnrollmentServices->save($student_id, $course_id, $year);
                header('Location: /index');
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexcursalumne');
                exit;
            }
        }
    }
}