<?php
namespace App\Controller\Curs_Grau;

use App\Infrastructure\Persistence\CourseRepository;
use App\Infrastructure\Persistence\DegreesRepository;
use App\School\Services\CourseServices;
use App\School\Services\DegreesServices;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;

class CursGrauAssignarBDController{
    private \PDO $db;
    private CourseServices $CourseService;
    private DegreesServices $DegreesServices;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->CourseRepository = new CourseRepository($db);
        $this->DegreesRepository = new DegreesRepository($db);

        $this->CourseService = new CourseServices($db, $this->CourseRepository);
        $this->DegreesServices = new DegreesServices($db, $this->DegreesRepository);
    }

    function addSubject(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //dd($_POST);
            if (empty($_POST['course']) 
                or empty($_POST['degree'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexcursalumne');
                exit;
            }
            
            $course_id = $_POST['course'];
            $degree_id = $_POST['degree'];
            
            try {
                $course = $this->CourseService->findById($course_id);
                $degree = $this->DegreesServices->findById($degree_id);
                $course->setDegreeId($degree_id);
                $this->CourseService->update($course);
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