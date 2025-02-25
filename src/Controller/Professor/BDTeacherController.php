<?php
namespace App\Controller\Professor;

use App\School\Entities\Teacher;
use App\Infrastructure\Persistence\TeacherRepository;
use App\School\Services\TeacherServices;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;

class BDTeacherController {
    private \PDO $db;
    private TeacherServices $TeacherService;
    private TeacherRepository $TeacherRepository;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->TeacherRepository = new TeacherRepository($db);
        $this->TeacherServices = new TeacherServices($db, $this->TeacherRepository);
    }

    public function saveteacher() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //dd($_POST);
            if (empty($_POST['name']) 
                or empty($_POST['surname']) 
                or empty($_POST['dni'])
                or empty($_POST['email'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexprofessor');
                exit;
            }

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $dni = $_POST['dni'];
            $email = $_POST['email'];
            try {
                $teacher = new Teacher($name, $surname, $dni, $email);
                if($this->TeacherServices->exists($dni)){
                    session_start();
                    $_SESSION['error'] = "El professor amb el $dni ja existeix.";
                    header('Location: /indexprofessor');
                    exit;
                }
                $this->TeacherServices->save($teacher);  
                header('Location: /veureprofessor');
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexprofessor');
                exit;
            }
        }
    }
}