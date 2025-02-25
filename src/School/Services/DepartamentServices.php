<?php

namespace App\School\Services;

use App\Infrastructure\Persistence\DepartamentRepository;
use App\School\Entities\Department;

class DepartamentServices{
    private \PDO $db;
    private DepartamentRepository $DepartamentRepository;

    function __construct(\PDO $db, DepartamentRepository $DepartamentRepository){
        $this->db = $db;
        $this->DepartamentRepository = $DepartamentRepository;
    }

    function exists(string $name):bool{
        return $this->DepartamentRepository->exists($name);
    }

    function save(Department $department){
        $department = $this->DepartamentRepository->save($department);
        return $department;
    }

    function findById($id){
        return $this->DepartamentRepository->findById($id);
    }

    function show(){
        return $this->DepartamentRepository->show();
    }
}