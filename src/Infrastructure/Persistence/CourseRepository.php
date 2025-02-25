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
            $sql = $this->db->prepare("INSERT INTO course(name, description, degree_id, id) VALUES(:name, :description, :degree_id, :id)");
            $sql->execute([
                'name' => $course->getName(),
                'description' => $course->getDescription(),
                'degree_id' => $course->getDegreeId(),
                'id' => $course->getId()
            ]);
            
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar el curs: " . $e->getMessage());
        }
    }

    function findById(string $id): Course {
        try {
            $sql = $this->db->prepare("SELECT * FROM course WHERE id=:id");
            $sql->execute(['id' => $id]);
            
            $fila = $sql->fetch(\PDO::FETCH_ASSOC);
            
            if ($fila) {
                $course = new Course($fila['name'], $fila['description']);
                $course->setId($fila['id']);
                return $course;
            }
            
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error al recuperar el curso: " . $e->getMessage());
        }
    }
    

    function show(){
        $allcourse = [];
        $sql = $this->db->prepare("SELECT * FROM course");

        $sql->execute();
        while($fila = $sql->fetch(\PDO::FETCH_ASSOC)){
            $course = new Course($fila['name'], $fila['description']);
            $course->setId($fila['id']);
            $allcourse[] = $course;
        }
        return $allcourse;
    }

    function update(Course $course){
        $sql = $this->db->prepare("UPDATE course SET degree_id = :degree_id WHERE id = :id");
        $sql->execute([
            'degree_id' => $course->getDegreeId(),
            'id' => $course->getId()
        ]);
    }

    function findByName($name){        
    }
}
