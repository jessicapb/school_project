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
            $sql = $this->db->prepare("INSERT INTO department(name, people, id) VALUES(:name, :people, :id)");
            $sql->execute([
                'name' => $department->getName(),
                'people' => $department->getPeople(),
                'id' => $department->getId()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar el departament: " . $e->getMessage());
        }
    }

    function findById(string $id): Department {
        try {
            $sql = $this->db->prepare("SELECT * FROM department WHERE id=:id");
            $sql->execute(['id' => $id]);
            
            $fila = $sql->fetch(\PDO::FETCH_ASSOC);
            
            if ($fila) {
                $department = new Department($fila['name'], $fila['people']);
                $department->setId($fila['id']);
                return $department;
            }
            
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error al recuperar el curso: " . $e->getMessage());
        }
    }
    

    function show(){
        $alldepartment = [];
        $sql = $this->db->prepare("SELECT * FROM department");

        $sql->execute();
        while($fila = $sql->fetch(\PDO::FETCH_ASSOC)){
            $department = new Department($fila['name'], $fila['people']);
            $department->setId($fila['id']);
            $alldepartment[] = $department;
        }
        return $alldepartment;
    }

    function findByName($name): Department {
    }
}