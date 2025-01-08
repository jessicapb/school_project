<?php
namespace App\Controller\Departament;

use App\School\Entities\Department;
use App\Infrastructure\Persistence\DepartamentRepository;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;

class BDDepartamentController {
    private \PDO $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function savedepartment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['people']) or empty($_POST['name'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexdepartament');
                exit;
            }
            $people = $_POST['people'];
            $name = $_POST['name'];
            try {
                $departamentRepository = new DepartamentRepository($this->db);
                if ($departamentRepository->exists($name)) {
                    session_start();
                    $_SESSION['error'] = "El departament amb el $name ja existeix.";
                    header('Location: /indexdepartament');
                    exit;
                }
                $department = new Department($people,$name); 
                $departamentRepository->save($department);
                header('Location: /veuredepartament');
                exit;
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexdepartament');
                exit;
            }
        }
    }
    
    public function getDepartment() {
        session_start();
        $sql = "SELECT name, people FROM department";
        $stmt = $this->db->query($sql);
        $department = [];
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $row) {
                    $department[] = [
                        'name' => $row['name'],
                        'people' => $row['people']
                    ];
                }
        }
        $_SESSION['department'] = $department;
        return $department;
    }
    
    public function mostrarVista() {
        $department = $this->getDepartment();
        echo view('veuredepartament', ['department' => $department]);
    }
}
