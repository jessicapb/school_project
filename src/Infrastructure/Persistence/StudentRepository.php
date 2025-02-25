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

            return $stmt->rowCount() > 0;
        } catch (\PDOException $ex) {
            throw new BuildExceptions("Error al comprobar si el usuario existe: " . $ex->getMessage());
        }
    }

    function save(Student $student) {
        try {
            $sql = $this->db->prepare("INSERT INTO students(dni, enrollment, user_id, id) 
                                        VALUES(:dni, :enrollment, :user_id, :id)");
            $sql->execute([
                'dni' => $student->getDni(),
                'enrollment' => $student->getEnrollment(),
                'user_id' => $student->getUser_id(),
                'id' => $student->getId()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar l'estudiant: " . $e->getMessage());
        }
    }

    function findById(int $id): ?object{
        $sql = $this->db->prepare("SELECT * FROM students WHERE id = :id");
        $sql->execute([
            ':id' => $id
        ]);
        return $sql->fetch(\PDO::FETCH_OBJ) ?: null;
    }

    function show(){
        $allstudents = [];
        $sql = $this->db->prepare("SELECT students.*, users.name, users.surname, users.password, users.phonenumber, users.email, users.ident FROM students
                                INNER JOIN users ON students.user_id = users.id");
        $sql->execute();
        while($fila = $sql->fetch(\PDO::FETCH_ASSOC)){
            $students = new Student($fila['name'], $fila['surname'], $fila['password'], $fila['phonenumber'], $fila['email'], $fila['ident'], $fila['dni'], $fila['enrollment']);
            $students->setUser_id($fila['user_id']);
            $students->setId($fila['id']);
            $allstudents[] = $students;
        }
        return $allstudents;
    }

    function findByDni(string $dni): Student {
    }
}

