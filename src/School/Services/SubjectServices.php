<?php

namespace App\School\Services;

use App\Infrastructure\Persistence\SubjectRepository;
use App\School\Entities\Subject;
class SubjectServices{
    private \PDO $db;
    private SubjectRepository $SubjectRepository;

    function __construct(\PDO $db, SubjectRepository $SubjectRepository){
        $this->db = $db;
        $this->SubjectRepository = $SubjectRepository;
    }

    function exists(string $name):bool{
        return $this->SubjectRepository->exists($name);
    }

    function save(Subject $subject){
        $course = $this->SubjectRepository->save($subject);
        return $subject;
    }

    function findById($id){
        return $this->SubjectRepository->findById($id);
    }

    function show(){
        return $this->SubjectRepository->show();
    }

    function update(Subject $subject){
        $this->SubjectRepository->update($subject);
    }
}