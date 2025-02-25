<?php

namespace App\School\Services;

use App\Infrastructure\Persistence\CourseRepository;
use App\School\Entities\Course;

class CourseServices{
    private \PDO $db;
    private CourseRepository $CourseRepository;

    function __construct(\PDO $db, CourseRepository $CourseRepository){
        $this->db = $db;
        $this->CourseRepository = $CourseRepository;
    }

    function exists(string $name):bool{
        return $this->CourseRepository->exists($name);
    }

    function save(Course $course){
        $course = $this->CourseRepository->save($course);
        return $course;
    }

    function findById($id){
        return $this->CourseRepository->findById($id);
    }

    function show(){
        return $this->CourseRepository->show();
    }

    function update(Course $course){
        $this->CourseRepository->update($course);
    }
}