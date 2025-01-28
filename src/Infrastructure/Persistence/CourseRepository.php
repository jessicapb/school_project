<?php
namespace App\Infrastructure\Persistence;

use App\School\Repositories\ICourseRepository;
use App\School\Entities\Course;
use App\School\Exceptions\BuildExceptions;

class CourseRepository implements ICourseRepository{
    private \PDO $db;

    function __construct(\PDO $db){
        $this->db = $db;
    }

    function exists(string $name): bool{
        try {
            $stmt = $this->db->prepare("SELECT * FROM course WHERE name = :name");
            $stmt->execute(['name' => $name]);
            if($stmt->rowCount()> 0){
                return true;
            }else{
                return false;
            }
        } catch (\PDOException $ex) {
            throw new BuildExceptions("Error en comprovar si el curs existeix: " . $ex->getMessage());
        }
    }

    function save(Course $course){
        try {
            // Obtener los nombres de las asignaturas como una cadena separada por comas
            $subjectNames = [];
            foreach ($course->getSubjects() as $subject) {
                $subjectNames[] = $subject->getName();
            }
            $subjectNamesString = implode(',', $subjectNames);  // Combina los nombres de las asignaturas en una cadena
            var_dump($subjectNamesString);
            die;
            // Ahora guarda la cadena de nombres de asignaturas en la base de datos
            $sql = $this->db->prepare("INSERT INTO course(name, description, degree, subject) VALUES(:name, :description, :degree, :subject)");
            $sql->execute([
                'name' => $course->getName(),
                'description' => $course->getDescription(),
                'degree' => $course->getDegree(),
                'subject' => $subjectNamesString,  // Guarda los nombres de asignaturas como una cadena
            ]);
            
            $courseId = $this->db->lastInsertId();
            $course->setId($courseId); 
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar el curs: " . $e->getMessage());
        }
    }

    function findByName($name){
        // Este método debería ser implementado si se requiere
    }
}
