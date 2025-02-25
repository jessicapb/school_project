<?php
namespace App\Controller\Curs;

use App\School\Entities\Course;
use App\Infrastructure\Persistence\CourseRepository;
use App\School\Exceptions\BuildExceptions;
use App\School\Services\CourseServices;

class BDCursController {
    private \PDO $db;
    private CourseServices $CourseService;
    private CourseRepository $CourseRepository;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->CourseRepository = new CourseRepository($db);
        $this->CourseService = new CourseServices($db, $this->CourseRepository);
    }

    public function savecourse() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['name']) 
                or empty($_POST['description'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexcurs');
                exit;
            }

            $name = $_POST['name'];
            $description = $_POST['description'];
            
            try {
                $course = new Course($name, $description);
                if ($this->CourseService->exists($name)) {
                    session_start();
                    $_SESSION['error'] = "El curs amb el $name ja existeix.";
                    header('Location: /indexcurs');
                    exit;
                }
                
                $this->CourseService->save($course);  
                header('Location: /veurecurs');
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] = $e->getMessage();
                header('Location: /indexcurs');
                exit;
            }
        }
    }
}
