<?php

namespace App\Controller\Assignatura;

use App\School\Entities\Subject;
use App\Infrastructure\Persistence\SubjectRepository;
use App\School\Exceptions\BuildExceptions;

class BDAssignaturaController{
    private \PDO $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function savesubject(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (empty($_POST['name'])
                or empty($_POST['description']) 
                or empty($_POST['course'])){
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexassignatura');
                exit;
            }

            $name = $_POST['name'];
            $description = $_POST['description'];
            $course = $_POST['course'];
            try {
                $subjectRepository = new SubjectRepository($this->db);
                if($subjectRepository->exists($name)){
                    session_start();
                    $_SESSION['error'] = "L'assignatura amb el $name ja existeix.";
                    header('Location: /indexassignatura');
                    exit;
                }
                $subject = new Subject($name, $description, $course);
                $subjectRepository->save($subject);
                header('Location: /index');
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexassignatura');
                exit;
            }
        }
    }
    
}