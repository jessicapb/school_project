<?php
namespace App\Controller\Curs_Assignatura;

use App\Infrastructure\Persistence\CourseRepository;
use App\Infrastructure\Persistence\SubjectRepository;
use App\School\Services\CourseServices;
use App\School\Services\SubjectServices;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;

class AssignarCursAssignaturaBDController{
    private \PDO $db;
    private CourseServices $CourseService;
    private SubjectServices $SubjectService;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->CourseRepository = new CourseRepository($db);
        $this->SubjectRepository = new SubjectRepository($db);

        $this->CourseService = new CourseServices($db, $this->CourseRepository);
        $this->SubjectService = new SubjectServices($db, $this->SubjectRepository);
    }

    function addCourse(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //dd($_POST);
            if (empty($_POST['course']) 
                or empty($_POST['subject'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexcursalumne');
                exit;
            }
            
            $course_id = $_POST['course'];
            $subject_id = $_POST['subject'];
            
            try {
                $course = $this->CourseService->findById($course_id);
                $subject = $this->SubjectService->findById($subject_id);
                $subject->setCourseId($course_id);
                $this->SubjectService->update($subject);
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