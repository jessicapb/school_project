<?php

namespace App\School\Repositories;

use App\School\Entities\Student;
use App\Infrastructure\Persistence\StudentRepository;

interface IStudentRepository{
    public function save(Student $student);
    public function findByDni(string $dni);
}

