<?php
namespace App\Infrastructure\Persistence;

use App\School\Exceptions\BuildExceptions;
class EnrollmentRepository{
    private \PDO $db;

    function __construct(\PDO $db) {
        $this->db = $db;
    }

    function save(int $studentid, int $courseid, string $year){
        $sql = $this->db->prepare("INSERT INTO enrollments (student_id, course_id, enrollment) VALUES (:student_id, :course_id, :enrollment)");
        return $sql->execute([
            'student_id' => $studentid,
            'course_id' => $courseid,
            'enrollment' => $year
        ]);
    }
    
}