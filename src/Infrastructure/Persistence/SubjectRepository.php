<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\ISubjectRepository;
use App\School\Entities\Subject;
use App\School\Entities\Course;
use App\School\Exceptions\BuildExceptions;

class SubjectRepository implements ISubjectRepository{
    private \PDO $db;

    function __construct(\PDO $db){
        $this->db = $db;
    }

    function exists(string $name): bool{
        try {
            $stmt = $this->db->prepare("SELECT * FROM subjects WHERE name = :name");
            $stmt->execute(['name' => $name]);

            if($stmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        } catch (\PDOException $ex) {
            throw new BuildExceptions("Error en comprovar si l'assignatura existeix: " . $ex->getMessage());
        }
    }
    
    function save(Subject $subject){
        try {
            $sql = $this->db->prepare("INSERT INTO subjects (name, description, course_id, id) VALUES(:name, :description, :course_id, :id)");
            $sql->execute([
                'name' => $subject->getName(),
                'description' => $subject->getDescription(),
                'course_id' => $subject->getCourseId(),
                'id' => $subject->getId()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar l'estudiant: " . $e->getMessage());
        }
    }
    
    function findById(string $id): ?Subject {
        try {
            $sql = $this->db->prepare("SELECT * FROM subjects WHERE id=:id");
            $sql->execute(['id' => $id]);
            
            if ($fila = $sql->fetch(\PDO::FETCH_ASSOC)) {
                $subject = new Subject($fila['name'], $fila['description']); 
                $subject->setId($fila['id']);  
                return $subject;
            }
    
            return null;
            
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error al recuperar la asignatura: " . $e->getMessage());
        }
    }        

    function show(){
        $allsubject = [];
        $sql = $this->db->prepare("SELECT * FROM subjects");

        $sql->execute();
        while($fila = $sql->fetch(\PDO::FETCH_ASSOC)){
            $subject = new Subject($fila['name'], $fila['description']);
            $subject->setId($fila['id']);
            $allsubject[] = $subject;
        }
        return $allsubject;
    }

    function update(Subject $subject){
        $sql = $this->db->prepare("UPDATE subjects SET course_id = :course_id WHERE id = :id");
        $sql->execute([
            'course_id' => $subject->getCourseId(),
            'id' => $subject->getId()
        ]);
    }

    function findByName($name): Subject {
    }
}