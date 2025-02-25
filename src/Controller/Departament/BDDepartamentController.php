<?php
namespace App\Controller\Departament;

use App\School\Entities\Department;
use App\Infrastructure\Persistence\DepartamentRepository;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;
use App\School\Services\DepartamentServices;

class BDDepartamentController {
    private \PDO $db;
    private DepartamentServices $DepartmentService;
    private DepartamentRepository $DepartamentRepository;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->DepartamentRepository = new DepartamentRepository($db);
        $this->DepartmentService = new DepartamentServices($db, $this->DepartamentRepository);
    }

    public function savedepartment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['name']) 
            or empty($_POST['people'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexdepartament');
                exit;
            }
            
            $name = $_POST['name'];
            $people = $_POST['people'];
            
            try {
                $department = new Department($name, $people);
                if($this->DepartmentService->exists($name)){
                    session_start();
                    $_SESSION['error'] = "El departament amb el $name ja existeix.";
                    header('Location: /indexdepartament');
                    exit;
                }
                $this->DepartmentService->save($department);
                header('Location: /veuredepartament');
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexdepartament');
                exit;
            }
        }
    }
}
