<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\IDepartmentRepository;
use App\School\Entities\Department;
use App\School\Exceptions\ServicesExceptions;
use App\School\Exceptions\BuildExceptions;

class DepartamentRepository implements IDepartmentRepository{
    private \PDO $db;

    function __construct(\PDO $db) {
        $this->db = $db;
    }

    function exists(string $name): bool {
        try {
            $stmt = $this->db->prepare("SELECT * FROM department WHERE name = :name");
            $stmt->execute(['name' => $name]);
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            throw new BuildExceptions("Error en comprovar si el departament existeix: " . $ex->getMessage());
        }
    }

    function save(Department $department) {
        try {
            $sql = $this->db->prepare("INSERT INTO department(name, people) VALUES(:name, :people)");
            $sql->execute([
                'name' => $department->getName(),
                'people' => $department->getPeople()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar el departament: " . $e->getMessage());
        }
    }

    function findByName($name): Department {
    }
}