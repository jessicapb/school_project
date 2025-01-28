<?php
namespace App\Controller\Curs;

use App\School\Entities\Course;
use App\School\Entities\Subject;
use App\Infrastructure\Persistence\CourseRepository;
use App\School\Exceptions\BuildExceptions;

class BDCursController {
    private \PDO $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function savecourse() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificación de campos obligatorios
            if (empty($_POST['name']) or empty($_POST['description']) or empty($_POST['degree']) or empty($_POST['subject'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexcurs');
                exit;
            }

            $name = $_POST['name'];
            $description = $_POST['description'];
            $subject = $_POST['subject'];  // Asegúrate de que esto es un array de IDs
            $degree = $_POST['degree'];
            //var_dump($subject);
            //die;
            try {
                $courseRepository = new CourseRepository($this->db);

                // Verificar si el curso ya existe
                if ($courseRepository->exists($name)) {
                    session_start();
                    $_SESSION['error'] = "El curs amb el $name ja existeix.";
                    header('Location: /indexcurs');
                    exit;
                }

                // Crear el objeto Course
                $course = new Course($name, $description, $degree, []);
                foreach ($subject as $subjects) {
                    $subject = new Subject($subjects);
                    $course->addSubject($subjects);
                }

                // Guardar el curso
                $courseRepository->save($course);  // Solo pasa el objeto Course

                // Redirigir a la página principal
                header('Location: /index');
            } catch (BuildExceptions $e) {
                // Si hay errores al crear el curso
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexcurs');
                exit;
            }
        }
    }
}
