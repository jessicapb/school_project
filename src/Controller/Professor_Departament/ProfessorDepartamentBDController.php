<?php
namespace App\Controller\Professor_Departament;

use App\Infrastructure\Persistence\TeacherRepository;
use App\Infrastructure\Persistence\DepartamentRepository;
use App\School\Services\DepartamentServices;
use App\School\Services\TeacherServices;
use App\School\Exceptions\BuildExceptions;
use App\School\Exceptions\ServicesExceptions;
use App\School\Entities\Teacher;

class ProfessorDepartamentBDController{
    private \PDO $db;
    private DepartamentServices $DepartamentServices;
    private TeacherServices $TeacherServices;

    public function __construct(\PDO $db) {
        $this->db = $db;

        $this->DepartamentRepository = new DepartamentRepository($db);
        $this->TeacherRepository = new TeacherRepository($db);

        $this->DepartamentServices = new DepartamentServices($db, $this->DepartamentRepository);
        $this->TeacherServices = new TeacherServices($db, $this->TeacherRepository);
    }

    function addTeacher(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['department']) 
            or empty($_POST['teacher'])) {
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexprofessordepartament');
                exit;
            }
            
            $department_id = $_POST['department'];
            $teacher_id = $_POST['teacher'];
            
            try {
                $department = $this->DepartamentServices->findById($department_id);
                $teacher = $this->TeacherServices->findById($teacher_id);
                $teacher->setDepartamentId($department_id);
                $this->TeacherServices->update($teacher);
                header('Location: /index');
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] =  $e->getMessage();
                header('Location: /indexprofessordepartament');
                exit;
            }
        }
    }
}