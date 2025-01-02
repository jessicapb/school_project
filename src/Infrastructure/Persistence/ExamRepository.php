<?php
namespace App\Infrastructure\Persistence;

use App\School\Repositories\IExamRepository;
use App\School\Entities\Exam;
use App\School\Exceptions\ServicesExceptions;
use App\School\Exceptions\BuildExceptions;

class ExamRepository implements IExamRepository{
    private \PDO $db;

    function __construct(\PDO $db) {
        $this->db = $db;
    }

    function save(Exam $exam) {
        try {
            $sql = $this->db->prepare("INSERT INTO examens(nom, descripcio, dia) VALUES(:nom, :descripcio, :dia)");
            $sql->execute([
                'nom' => $exam->getNom(),
                'descripcio' => $exam->getDescripcio(),
                'dia' => $exam->getDia()
            ]);
        } catch (\PDOException $e) {
            throw new BuildExceptions("Error en guardar l'examen: " . $e->getMessage());
        }
    }

    function findByDay($day): Exam {
    }
}