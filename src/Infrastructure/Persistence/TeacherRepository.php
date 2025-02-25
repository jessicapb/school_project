<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\IteacherRepository;
use App\School\Entities\Teacher;
use App\School\Exceptions\ServicesExceptions;
use App\School\Exceptions\BuildExceptions;

class TeacherRepository implements IteacherRepository {
    private \PDO $db;

    function __construct(\PDO $db) {
        $this->db = $db;
    }

    function exists(string $dni): bool {
        try {
            $stmt = $this->db->prepare("SELECT * FROM teacher WHERE dni = :dni");
            $stmt->execute(['dni' => $dni]);

            return $stmt->rowCount() > 0;
        } catch (\PDOException $ex) {
            throw new BuildExceptions("Error en comprovar si el professor existeix: " . $ex->getMessage());
        }
    }

    function save(Teacher $teacher) {
        try {
            $sql = $this->db->prepare("INSERT INTO teacher(name, surname, dni, email, id, department_id) 
                                        VALUES(:name,:surname, :dni, :email, :id, :department_id)");
            $sql->execute([
                'name' => $teacher->getName(),
                'surname' => $teacher->getSurname(),
                'dni' => $teacher->getDni(),
                'email' => $teacher->getEmail(),
                'id' => $teacher->getId(),
                'department_id' => $teacher->getDepartmentId()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar el professor: " . $e->getMessage());
        }
    }

    function findById(int $id): ?Teacher{
        try {
            $sql = $this->db->prepare("SELECT * FROM teacher WHERE id=:id");
            $sql->execute(['id' => $id]);
            
            if ($fila = $sql->fetch(\PDO::FETCH_ASSOC)) {
                $subject = new Teacher($fila['name'], $fila['surname'], $fila['dni'], $fila['email']); 
                $subject->setId($fila['id']);  
                return $subject;
            }
    
            return null;
            
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error al recuperar la asignatura: " . $e->getMessage());
        }
    }

    function show(){
        $allteachers = [];
        $sql = $this->db->prepare("SELECT * FROM teacher");
        $sql->execute();
        while($fila = $sql->fetch(\PDO::FETCH_ASSOC)){
            $teachers = new Teacher($fila['name'], $fila['surname'], $fila['dni'], $fila['email']);
            $teachers->setId($fila['id']);
            $allteachers[] = $teachers;
        }
        return $allteachers;
    }
    
    function update(Teacher $teacher){
        $sql = $this->db->prepare("UPDATE teacher SET department_id = :department_id WHERE id = :id");
        $sql->execute([
            'department_id' => $teacher->getDepartmentId(),
            'id' => $teacher->getId()
        ]);
    }

    function findByDni(string $dni): Teacher {
    }
}

