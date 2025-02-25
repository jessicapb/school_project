<?php

namespace App\School\Services;

use App\Infrastructure\Persistence\EnrollmentRepository;
class EnrollmentServices{
    private EnrollmentRepository $EnrollmentRepository;

    function __construct(EnrollmentRepository $EnrollmentRepository){
        $this->EnrollmentRepository = $EnrollmentRepository;
    }

    function save(int $studentid, int $courseid,string $year): bool {
        return $this->EnrollmentRepository->save($studentid, $courseid, $year);
    }
    
}