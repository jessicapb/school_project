<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\ISubjectRepository;
use App\School\Entities\Subject;
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
            $sql = $this->db->prepare("INSERT INTO subjects (name, description, course) VALUES(:name, :description, :course)");
            $sql->execute([
                'name' => $subject->getName(),
                'description' => $subject->getDescription(),
                'course' => $subject->getCourse()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar l'estudiant: " . $e->getMessage());
        }
    }

    function findByName($name): Subject {
    }
}