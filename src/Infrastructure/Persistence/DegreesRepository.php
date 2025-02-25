<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\IDegreesRepository;
use App\School\Entities\Degrees;
use App\School\Exceptions\BuildExceptions;

class DegreesRepository implements IDegreesRepository{
    private \PDO $db;

    function __construct(\PDO $db){
        $this->db = $db;
    }

    function exists(string $name): bool{
        try {
            $stmt = $this->db->prepare("SELECT * FROM degrees WHERE name = :name");
            $stmt->execute(['name' => $name]);
            if($stmt->rowCount()> 0){
                return true;
            }else{
                return false;
            }
        } catch (\PDOException $ex) {
            throw new BuildExceptions("Error en comprovar si el departament existeix: " . $ex->getMessage());
        }
    }

    function save(Degrees $degrees){
        try {
            $sql = $this->db->prepare("INSERT INTO degrees(name, duration_years, id) VALUES(:name, :duration_years, :id)");
            $sql->execute([
                'name' => $degrees->getName(),
                'duration_years' => $degrees->getDurationYears(),
                'id' => $degrees->getId(),
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar el grau: " . $e->getMessage());
        }
    }

    function findById(string $id): Degrees {
        try {
            $sql = $this->db->prepare("SELECT * FROM degrees WHERE id=:id");
            $sql->execute(['id' => $id]);
            
            $fila = $sql->fetch(\PDO::FETCH_ASSOC);
            
            if ($fila) {
                $department = new Degrees($fila['name'], $fila['duration_years']);
                $department->setId($fila['id']);
                return $department;
            }
            
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error al recuperar el curso: " . $e->getMessage());
        }
    }
    

    function show(){
        $alldegrees = [];
        $sql = $this->db->prepare("SELECT * FROM degrees");

        $sql->execute();
        while($fila = $sql->fetch(\PDO::FETCH_ASSOC)){
            $degrees = new Degrees($fila['name'], $fila['duration_years']);
            $degrees->setId($fila['id']);
            $alldegrees[] = $degrees;
        }
        return $alldegrees;
    }

    function findByName($name): Degrees{
        
    }
}