<?php

namespace App\School\Services;

use App\Infrastructure\Persistence\TeacherRepository;
use App\School\Entities\Teacher;

class TeacherServices{
    private \PDO $db;
    private TeacherRepository $TeacherRepository;

    function __construct(\PDO $db, TeacherRepository $TeacherRepository){
        $this->db = $db;
        $this->TeacherRepository = $TeacherRepository;
    }

    function exists(string $dni):bool{
        return  $this->TeacherRepository->exists($dni);
    }

    function save(Teacher $teacher){
        $teachers = $this->TeacherRepository->save($teacher);
        return $teachers;
    }

    function findById($id){
        return $this->TeacherRepository->findById($id);
    }

    function update(Teacher $teacher){
        $this->TeacherRepository->update($teacher);
    }

    function show(){
        return $this->TeacherRepository->show();
    }
}