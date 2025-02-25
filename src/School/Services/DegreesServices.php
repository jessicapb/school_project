<?php

namespace App\School\Services;

use App\Infrastructure\Persistence\DegreesRepository;
use App\School\Entities\Degrees;

class DegreesServices{
    private \PDO $db;
    private DegreesRepository $DegreesRepository;

    function __construct(\PDO $db, DegreesRepository $DegreesRepository){
        $this->db = $db;
        $this->DegreesRepository = $DegreesRepository;
    }

    function exists(string $name):bool{
        return $this->DegreesRepository->exists($name);
    }

    function save(Degrees $degrees){
        $course = $this->DegreesRepository->save($degrees);
        return $course;
    }

    function findById($id){
        return $this->DegreesRepository->findById($id);
    }

    function show(){
        return $this->DegreesRepository->show();
    }
}