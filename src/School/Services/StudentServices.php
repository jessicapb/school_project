<?php

namespace App\School\Services;

use App\Infrastructure\Persistence\StudentRepository;
use App\School\Entities\Student;

class StudentServices{
    private \PDO $db;
    private StudentRepository $StudentRepository;

    function __construct(\PDO $db, StudentRepository $StudentRepository){
        $this->db = $db;
        $this->StudentRepository = $StudentRepository;
    }

    function exists(string $dni):bool{
        return  $this->StudentRepository->exists($dni);
    }

    function save(Student $student){
        $students = $this->StudentRepository->save($student);
        return $students;
    }

    function findById($id){
        return $this->StudentRepository->findById($id);
    }

    function show(){
        return $this->StudentRepository->show();
    }
}