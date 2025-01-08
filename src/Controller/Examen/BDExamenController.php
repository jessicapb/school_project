<?php

namespace App\Controller\Examen;

use App\School\Entities\Exam;
use App\Infrastructure\Persistence\ExamRepository;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;

class BDExamenController {
    private \PDO $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function saveexam() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['nom']) 
                or empty($_POST['descripcio']) 
                or empty($_POST['dia'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexexamen');
                exit;
            }

            $nom = $_POST['nom'];
            $descripcio = $_POST['descripcio'];
            $dia = $_POST['dia'];
            try {
                $examRepository = new ExamRepository($this->db);
                $exam = new Exam($nom, $descripcio, $dia);
                $examRepository->save($exam);
                header('Location: /veureexamen');
                exit;
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexexamen');
                exit;
            }
        }
    }
    
    public function getEsdeveniments() {
        session_start();
        $sql = "SELECT nom, descripcio, dia FROM examens";
        $stmt = $this->db->query($sql);
        $esdeveniments = [];
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $row) {
                if ($row['dia'] != null) {
                    $fecha_formateada = date('Y-m-d', strtotime($row['dia']));
                    $esdeveniments[] = [
                        'title' => $row['nom'],
                        'description' => $row['descripcio'],
                        'start' => $fecha_formateada
                    ];
                }
            }
        }
        $_SESSION['esdeveniments'] = $esdeveniments;
        return $esdeveniments;
    }
    
    public function mostrarVista() {
        $esdeveniments = $this->getEsdeveniments();
        echo view('veureexamen', ['esdeveniments' => $esdeveniments]);
    }
}
