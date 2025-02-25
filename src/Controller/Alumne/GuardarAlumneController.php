<?php
namespace App\Controller\Alumne;

use App\School\Entities\Student;
use App\School\Entities\User;
use App\Infrastructure\Persistence\StudentRepository;
use App\Infrastructure\Persistence\UserRepository;
use App\School\Services\StudentServices;
use App\School\Services\UserServices;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;

class GuardarAlumneController {
    private \PDO $db;
    private StudentServices $StudentService;
    private UserServices $UserService;

    private UserRepository $UserRepository;
    private StudentRepository $StudentRepository;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->StudentRepository = new StudentRepository($db);
        $this->UserRepository = new UserRepository($db);

        $this->UserService = new UserServices($db, $this->UserRepository);
        $this->StudentService = new StudentServices($db, $this->StudentRepository);
    }

    public function savestudent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //dd($_POST);
            if (empty($_POST['name']) 
                or empty($_POST['surname']) 
                or empty($_POST['password']) 
                or empty($_POST['phonenumber'])
                or empty($_POST['email'])
                or empty($_POST['ident'])
                or empty($_POST['dni'])
                or empty($_POST['enrollment'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexalumne');
                exit;
            }

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $password = $_POST['password'];
            $phonenumber = $_POST['phonenumber'];
            $email = $_POST['email'];
            $ident = $_POST['ident'];
            $dni = $_POST['dni'];
            $enrollment = $_POST['enrollment'];
            try {
                $user = new User($name, $surname, $password, $phonenumber, $email, $ident);
                $userid = $this->UserService->saves($user);

                $student = new Student($name, $surname, $password, $phonenumber, $email, $ident, $dni, $enrollment);
                if($this->StudentService->exists($dni)){
                    session_start();
                    $_SESSION['error'] = "El alumne amb el $dni ja existeix.";
                    header('Location: /indexalumne');
                    exit;
                }
                $student->setUser_id($userid); 
                $this->StudentService->save($student);  
                header('Location: /veurealumne');
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexalumne');
                exit;
            }
        }
    }
}
