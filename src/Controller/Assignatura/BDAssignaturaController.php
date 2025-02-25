<?php

namespace App\Controller\Assignatura;

use App\School\Entities\Subject;
use App\Infrastructure\Persistence\SubjectRepository;
use App\School\Exceptions\BuildExceptions;
use App\School\Services\SubjectServices;

class BDAssignaturaController{
    private \PDO $db;
    private SubjectServices $SubjectServices;
    private SubjectRepository $SubjectRepository;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->SubjectRepository = new SubjectRepository($db);
        $this->SubjectServices = new SubjectServices($db, $this->SubjectRepository);
    }

    public function savesubject(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (empty($_POST['name'])
                or empty($_POST['description'])){
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexassignatura');
                exit;
            }

            $name = $_POST['name'];
            $description = $_POST['description'];
            try {
                $subject = new Subject($name, $description);
                if($this->SubjectServices->exists($name)){
                    session_start();
                    $_SESSION['error'] = "L'assignatura amb el $name ja existeix.";
                    header('Location: /indexassignatura');
                    exit;
                }
                $this->SubjectServices->save($subject);
                header('Location: /veureassignatura');
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexassignatura');
                exit;
            }
        }
    }
    
}