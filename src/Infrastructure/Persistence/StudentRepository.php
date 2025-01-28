<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\IStudentRepository;
use App\School\Entities\Student;
use App\School\Exceptions\ServicesExceptions;
use App\School\Exceptions\BuildExceptions;

class StudentRepository implements IStudentRepository {
    private \PDO $db;

    function __construct(\PDO $db) {
        $this->db = $db;
    }

    function exists(string $dni): bool {
        try {
            $stmt = $this->db->prepare("SELECT * FROM students WHERE dni = :dni");
            $stmt->execute(['dni' => $dni]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            throw new BuildExceptions("Error en comprovar si l'usuari existeix: " . $ex->getMessage());
        }
    }

    function save(Student $student) {
        try {
            $sql = $this->db->prepare("INSERT INTO students(name, dni, surname, password, phonenumber, email, ident, course, subject, enrollment) 
                                        VALUES(:name, :dni, :surname, :password, :phonenumber, :email, :ident, :course, :subject, :enrollment)");
            $sql->execute([
                'name' => $student->getName(),
                'dni' => $student->getDni(),
                'surname' => $student->getSurname(),
                'password' => $student->getPassword(),
                'phonenumber' => $student->getPhonenumber(),
                'email' => $student->getEmail(),
                'ident' => $student->getIdent(),
                'course' => $student->getCourse(),
                'subject' => $student->getSubject(),
                'enrollment' => $student->getEnrollment()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar l'estudiant: " . $e->getMessage());
        }
    }

    function findByDni(string $dni): Student {

    }
}

