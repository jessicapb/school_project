<?php

namespace App\School\Repositories;

use App\School\Entities\Teacher;
use App\Infrastructure\Persistence\TeacherRepository;

interface IteacherRepository{
    public function save(Teacher $teacher);
    public function findByDni(string $dni);
    public function findById(int $id);
}