<?php
namespace App\Controller\Alumne;

use App\School\Entities\Student;
use App\Infrastructure\Persistence\StudentRepository;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;

class GuardarAlumneController {
    private \PDO $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function savestudent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['name']) 
                or empty($_POST['surname']) 
                or empty($_POST['password']) 
                or empty($_POST['phonenumber'])
                or empty($_POST['email'])
                or empty($_POST['ident'])
                or empty($_POST['course'])
                or empty($_POST['subject'])
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
            $course = $_POST['course'];
            $subject = $_POST['subject'];
            $dni = $_POST['dni'];
            $enrollment = $_POST['enrollment'];

            try {
                $studentRepository = new StudentRepository($this->db);
                if ($studentRepository->exists($dni)) {
                    session_start();
                    $_SESSION['error'] = "L'alumne amb el DNI $dni ja existeix.";
                    header('Location: /indexalumne');
                    exit;
                }
                $student = new Student($name, $surname, $password, $phonenumber, $email, $ident, $course, $subject, $dni, $enrollment);
                $studentRepository->save($student);
                header('Location: /index');
                exit;
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexalumne');
                exit;
            }
            
        }
    }

    public function getStudents() {
        session_start();
        $sql = "SELECT name, surname, password, phonenumber, email, ident, course, subject, dni, enrollment FROM students";
        $stmt = $this->db->query($sql);
        $students = [];
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $row) {
                    $students[] = [
                        'title' => $row['name'],
                        'description' => $row['descripcio'],
                        'start' => $fecha_formateada
                    ];
            }
        }
        $_SESSION['eventos'] = $eventos;
        return $eventos;
    }
    
    public function mostrarVista() {
        $eventos = $this->getEventos();
        echo view('veureexamen', ['eventos' => $eventos]);
    }
}
