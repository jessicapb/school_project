<?php
namespace App\School\Repositories;

use App\School\Entities\Exam;
use App\Infrastructure\Persistence\ExamRepository;

interface IExamRepository{
    public function save(Exam $exam);
    public function findByDay($day);
}