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
            $sql = $this->db->prepare("INSERT INTO degrees(name, duration_years) VALUES(:name, :duration_years)");
            $sql->execute([
                'name' => $degrees->getName(),
                'duration_years' => $degrees->getDurationYears()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar el grau: " . $e->getMessage());
        }
    }

    function findByName($name): Degrees{
        
    }
}